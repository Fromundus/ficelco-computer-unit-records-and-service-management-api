<?php

namespace App\Models;

use App\Models\Payroll\Employee;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $connection = 'mysql';
    protected $table = 'devices';

    protected $fillable = [
        'employeeid',
        'employee_name',
        'name',
        'type',
        'brand',
        'model',
        'serial_number',
        'status',
        'location',
        'description',

        'processor',
        'ram',
        'system_type',
        'operating_system',
        'storage',
        'mac_address',

        'created_by_employeeid',
        'updated_by_employeeid',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employeeid', 'employeeid');
    }

    public function histories(){
        return $this->hasMany(DeviceHistory::class);
    }
}
