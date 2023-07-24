<?php

namespace App\Models\Data\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TroubleshootPC extends Model
{
    // declare table
    public $table = 'troubleshooting_pc';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'device_pc_id',
        'tgl_perbaikan',
        'description',
        'created_at',
        'updated_at',
    ];

    public function device_pc()
    {
        return $this->belongsTo(DevicePc::class, 'device_pc_id');
    }
}
