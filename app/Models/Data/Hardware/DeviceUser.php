<?php

namespace App\Models\Data\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceUser extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'device_user';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'employee_id',
        'device_pc_id',
        'device_monitor_id',
        'device_additional_id',
        'device_more_id',
        'software_id',
        'location_detail_id',
        'file',
        'status',
        'tgl_deploy',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function employee()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Employee', 'employee_id', 'id');
    }
    // one to many
    public function location_detail()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Location\LocationDetail', 'location_detail_id', 'id');
    }
    // one to many
    public function software()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Software\Software', 'software_id', 'id');
    }
    public function device_more()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\Data\Hardware\DeviceMore', 'device_more_id', 'id');
    }
    public function device_additional()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\Data\Hardware\DeviceAdditional', 'device_additional_id', 'id');
    }
    public function device_monitor()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\Data\Hardware\DeviceMonitor', 'device_monitor_id', 'id');
    }
    public function device_pc()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\Data\Hardware\DevicePc', 'device_pc_id', 'id');
    }
}
