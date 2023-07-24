<?php

namespace App\Models\MasterData\Software;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Software extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'software';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'software_name',
        'software_category',
        'serial_number',
        'license_amount',
        'start_license',
        'finish_license',
        'no_pp',
        'license_type',
        'purchase_year',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function device_pc()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\Hardware\DeviceUser', 'software_id');
    }
}
