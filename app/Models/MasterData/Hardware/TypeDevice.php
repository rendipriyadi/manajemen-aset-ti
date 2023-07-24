<?php

namespace App\Models\MasterData\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeDevice extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'hardware_type_device';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'name',
        'category',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function device_more()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\Hardware\DeviceMore', 'type_device_id');
    }

    // one to many
    public function device_additional()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\Hardware\DeviceAdditional', 'type_device_id');
    }
}
