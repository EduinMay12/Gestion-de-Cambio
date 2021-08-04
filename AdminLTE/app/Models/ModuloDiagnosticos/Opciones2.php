<?php

namespace App\Models\ModuloDiagnosticos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opciones2 extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pregunta(){
        return $this->belongsTo('App\Models\ModuloDiagnosticos\Preguntas3');
    }
}
