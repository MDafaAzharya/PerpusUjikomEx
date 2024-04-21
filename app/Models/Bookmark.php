<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;
    protected $table = 'bookmark';
    protected $id = 'id';
    protected $fillable = [
        'id_user',
        'id_buku'
    ];

    public function buku()
    {
        return $this->belongsTo(BukuModel::class, 'id_buku', 'id');
    }
}
