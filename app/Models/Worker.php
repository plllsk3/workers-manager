<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function phone()
    {
        return $this->morphOne(Phone::class, 'phoneable');
    }
}
