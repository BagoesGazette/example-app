<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    /**
     * image
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? url('/storage/image/' . $value) : null,
        );
    }
}

