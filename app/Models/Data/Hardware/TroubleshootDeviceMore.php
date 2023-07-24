<?php

namespace App\Models\Data\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TroubleshootDeviceMore extends Model
{
    // use HasFactory;

    // declare table
    public $table = 'troubleshooting_device_more';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'device_more_id',
        'tgl_perbaikan',
        'description',
        'created_at',
        'updated_at',
    ];

    public function device_more()
    {
        return $this->belongsTo(DeviceMore::class, 'device_more_id');
    }
}
