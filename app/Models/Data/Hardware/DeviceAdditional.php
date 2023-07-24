<?php

namespace App\Models\Data\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceAdditional extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'device_additional';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'no_non_asset',
        'type_device_id',
        'name',
        'specification',
        'file',
        'status',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function type_device()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Hardware\TypeDevice', 'type_device_id', 'id');
    }
    // one to many
    public function device_pc()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\Hardware\DeviceUser', 'device_additional_id');
    }
}
