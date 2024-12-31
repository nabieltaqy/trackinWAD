<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'shift_start', 'shift_end'];

    public function absences()
    {
        return $this->hasMany(Absence::class, 'shift_id');
    }
}