<?php

namespace App\Models\Data\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceMonitor extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'device_monitor';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'no_asset',
        'name',
        'size',
        'file',
        'status',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function device_pc()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\Hardware\DeviceUser', 'device_monitor_id');
    }
}
