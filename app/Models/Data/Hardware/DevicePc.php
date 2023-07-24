<?php

namespace App\Models\Data\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DevicePc extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'device_pc';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'motherboard_id',
        'processor_id',
        'hardisk_id',
        'ram_id',
        'no_asset',
        'name',
        'file',
        'status',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function hardisk()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Hardware\Hardisk', 'hardisk_id', 'id');
    }
    // one to many
    public function motherboard()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Hardware\Motherboard', 'motherboard_id', 'id');
    }
    // one to many
    public function processor()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Hardware\Processor', 'processor_id', 'id');
    }
    // one to many
    public function ram()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Hardware\Ram', 'ram_id', 'id');
    }
    // one to many
    public function device_pc()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\Hardware\DeviceUser', 'device_pc_id');
    }

    public function troubleshoot_pc()
    {
        return $this->hasMany(TroubleshootPC::class, 'device_pc_id');
    }
}
