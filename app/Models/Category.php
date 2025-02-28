<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // protected $primaryKey = 'id'; // Default primary key di Laravel
    // public $incrementing = true; // Pastikan auto-increment
    // protected $keyType = 'int';
    
    protected $fillable = [
        'user_id',
        'name',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
