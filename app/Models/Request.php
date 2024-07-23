<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFormatRupiah;


class Request extends Model
{
    use HasFactory;
    use HasFormatRupiah;


    protected $fillable = [
        'user_id', 'item_name', 'item_id', 'description', 'price', 'request_type', 'status', 'id', 'request_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
