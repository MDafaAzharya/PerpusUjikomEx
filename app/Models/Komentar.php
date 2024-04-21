<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $table='komentar';
    protected $id = 'id';
    protected $fillable = [
        'id_user',
        'id_buku',
        'komentar',
    ];

    public function change_user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
