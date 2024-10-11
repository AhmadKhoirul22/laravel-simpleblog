<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'keterangan',
        'id_kategori',
        'image'
    ];
    protected $table = 'contents';

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
