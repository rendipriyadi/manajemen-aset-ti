<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyActivityFile extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'daily_activity_file';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'daily_activity_id',
        'file',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
