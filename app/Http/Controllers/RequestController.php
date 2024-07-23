<?php

namespace App\Http\Controllers;

use App\Models\Request as UserRequest;
use App\Models\ActivityLog;
use App\Models\Barang;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        $requests = Auth::user()->level === 'admin' ? UserRequest::all() : Auth::user()->requests;
        $activityLogs = Auth::user()->level === 'kasir' ? ActivityLog::with('user')->get() : collect();
        $barang = Barang::all();
        return view('requests.index', compact('requests', 'activityLogs','barang'));
    }

    public function store(HttpRequest $request)
    {
        $request->validate([
            'item_name' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'description' => 'nullable|string|max:500',
            'request_type' => 'required|string|max:255',
            'item_id' => 'nullable|integer|exists:barangs,id',
        ]);
    
        if ($request->request_type === 'anomali harga' && empty($request->item_id)) {
            return redirect()->route('requests.create')->withErrors(['item_id' => 'Item must be selected for Anomali Harga request.']);
        } elseif ($request->request_type === 'pengadaan barang' && empty($request->item_name)) {
            return redirect()->route('requests.create')->withErrors(['item_name' => 'Item name must be provided for Pengadaan Barang request.']);
        }
    
        if ($request->request_type === 'anomali harga') {
            $barang = Barang::findOrFail($request->item_id);
            $request->merge(['item_name' => $barang->nama]);
        }
    
        // Generate request_id
        $datePrefix = date('Ymd'); // Format: YYYYMMDD
        $lastRequest = UserRequest::whereDate('created_at', today())->latest('id')->first();
        $increment = $lastRequest ? (int) substr($lastRequest->request_id, -3) + 1 : 1;
        $formattedIncrement = str_pad($increment, 3, '0', STR_PAD_LEFT);
        $requestId = 'REQ-' . $datePrefix . '-' . $formattedIncrement;
    
        // Save request
        $createdRequest = Auth::user()->requests()->create(array_merge($request->all(), ['request_id' => $requestId]));
    
        ActivityLog::create([
            'user_id' => Auth::id(),
            'request_id' => $createdRequest->request_id,
            'log_type' => $createdRequest->request_type,
            'description' => 'Request created by cashier.',
        ]);
    
        return redirect()->route('requests.index')->with('success', 'Request created successfully.');
    }
    
    public function approve(UserRequest $request)
    {
        if ($request->status === 'approved') {
            return redirect()->route('requests.index')->with('error', 'Request is already approved.');
        } elseif ($request->status === 'not approved') {
            return redirect()->route('requests.index')->with('error', 'Request is already not approved.');
        }
    
        $request->update(['status' => 'approved']);
    
        ActivityLog::create([
            'user_id' => Auth::id(),
            'request_id' => $request->request_id,
            'log_type' => 'request_approved',
            'description' => 'Request approved by admin.',
        ]);
    
        return redirect()->route('requests.index')->with('success', 'Request approved successfully.');
    }
    
    public function notApprove(UserRequest $request)
    {
        if ($request->status === 'not approved') {
            return redirect()->route('requests.index')->with('error', 'Request is already not approved.');
        } elseif ($request->status === 'approved') {
            return redirect()->route('requests.index')->with('error', 'Request is already approved.');
        }
    
        $request->update(['status' => 'not approved']);
    
        ActivityLog::create([
            'user_id' => Auth::id(), 
            'request_id' => $request->request_id,
            'log_type' => 'request_not_approved',
            'description' => 'Request not approved by admin.',
        ]);
    
        return redirect()->route('requests.index')->with('success', 'Request not approved.');
    }
    
}
