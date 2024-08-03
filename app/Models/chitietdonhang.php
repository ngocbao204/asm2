<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chitietdonhang extends Model
{
    use HasFactory;

    protected $fillable = [
        'sanpham_id','donhang_id','soluong','gia','ghichu'
    ];
}
