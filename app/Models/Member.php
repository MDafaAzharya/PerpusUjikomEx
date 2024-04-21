<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'member';
    protected $id = 'id';
    protected $fillable = [
        'nama',
        'username',
        'email',
        'no_telepon',
        'alamat',
        'id_user'
    ];
}
