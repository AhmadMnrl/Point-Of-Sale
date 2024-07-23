@extends('layout.app')

@section('title', ' - Request')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Requests</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-white">
                        <h4 class="position-absolute text-success">Data Requests</h4>
                        @if(Auth::user()->level === 'kasir')
                        <div class="card-header-form float-right">
                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#form-create-request"><i class="fa fa-plus"></i> Add Request</button>
                        </div>
                        @endif
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-requests">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Request ID</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Request Type</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        @if(Auth::user()->level === 'admin')
                                        <th>Created At</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requests as $request)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $request->request_id }}</td>
                                        <td>{{ $request->item_name }}</td>
                                        <td>{{ $request->formatRupiah('price')}}</td>
                                        <td>{{ $request->request_type }}</td>
                                        <td>
                                            @if(Auth::user()->level === 'admin')
                                                @if($request->status === 'submitted')
                                                    Waiting to Approval
                                                @else
                                                    {{ ucfirst($request->status) }}
                                                @endif
                                            @else
                                                {{ ucfirst($request->status) }}
                                            @endif
                                        </td>
                                        <td>{{ $request->description }}</td>
                                        @if(Auth::user()->level === 'admin')
                                        <td>{{ $request->created_at }}</td>
                                        <td>{{ $request->user ? $request->user->nama : 'User not found' }}</td>
                                        <td>
                                            @if($request->status !== 'approved' && $request->status !== 'not approved')
                                                <form action="{{ route('requests.approve', $request->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success"><i class="fa fa-check"></i> Approve</button>
                                                </form>
                                                <form action="{{ route('requests.notApprove', $request->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-times"></i> Not Approve</button>
                                                </form>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(Auth::user()->level === 'kasir')
        <div class="card shadow">
            <div class="card-header bg-white">
                <h4 class="position-absolute text-success">Activity Logs</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-hover" id="table-logs">
                        <thead>
                            <tr>
                                <th>Log ID</th>
                                <th>Input By</th>
                                <th>Request ID</th>
                                <th>Log Type</th>
                                <th>Description</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activityLogs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->user ? $log->user->nama : 'User not found' }}</td>
                                <td>{{ $log->request_id }}</td>
                                <td>{{ $log->log_type }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

@include('requests.create')
@endsection

@push('script')
<script>
    $(document).ready(function () {
        $('#table-requests').DataTable();
        $('#table-logs').DataTable();
    });
</script>
@endpush