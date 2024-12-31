<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function absences()
    {
        return $this->hasMany(Absence::class, 'current_division');
    }
    public function lastDivision()
    {
        return $this->hasMany(Absence::class, 'last_division');
    }
}
