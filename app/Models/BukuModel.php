<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuModel extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $id = 'id';
    protected $fillable = [
        'judul_buku',
        'penulis',
        'deskripsi',
        'file_buku',
        'cover',
        'category'
    ];

    public function change_kategori()
    {
        return $this->belongsTo(Kategori::class, 'category', 'id');
    }
}
