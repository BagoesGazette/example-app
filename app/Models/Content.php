<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'content',
        'image'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}

