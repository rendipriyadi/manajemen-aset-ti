<?php

namespace App\Models\MasterData\Network;

use App\Models\MasterData\Division\Division;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IpAddress extends Model
{
    // declare table
    public $table = 'network_ip_address';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // declare fillable
    protected $fillable = [
        'division_id',
        'start_ip',
        'end_ip',
        'description',
        'created_at',
        'updated_at',
    ];

    // one to many
    public function division()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
}
