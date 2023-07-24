<?php

namespace App\Models\Data\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpAddressMore extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'ip_address_more';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'device_more_id',
        'port',
        'ip_address',
        'keterangan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
