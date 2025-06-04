<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alumno;

class Sede extends Model
{
    protected $fillable = ['name'];

    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }
}
