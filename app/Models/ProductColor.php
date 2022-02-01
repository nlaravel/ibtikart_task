<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends=['image_url'];

    public function getImageUrlAttribute(){
        return asset('storage/product/'.$this->image);

    }
}
