<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    // protected $fillable = ['start_date', 'end_date', 'reason', 'status', 'id_employee', 'edit_by'];

    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'edit_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'edit_by');
    }
}
