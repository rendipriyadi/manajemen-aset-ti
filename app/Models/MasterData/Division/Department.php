<?php

namespace App\Models\MasterData\Division;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'department';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'division_id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function division()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Division\Division', 'division_id', 'id');
    }
    // one to many
    public function section()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\MasterData\Division\Section', 'department_id');
    }
    // one to many
    public function employee()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\MasterData\Employee', 'department_id');
    }
    // one to many
    public function device_pc()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\Hardware\DeviceUser', 'department_id');
    }
}
