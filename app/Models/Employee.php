<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'no_telp', 'address'];

    public function vacations()
    {
        return $this->hasMany(Vacation::class, 'id_employee');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'id_karyawan');
    }
}
