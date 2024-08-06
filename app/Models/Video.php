<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'url',
        'name',
        'description',
        'user_id',
        'videoable_type',
        'videoable_id',
    ];

    // Definir la relación polimórfica
    public function videoable()
    {
        return $this->morphTo();
    }

    // Definir la relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
