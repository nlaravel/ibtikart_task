<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

 protected $guarded = [];



    protected $appends=['image_url'];

    public function getImageUrlAttribute(){
        return asset('storage/product/'.$this->image);



    }
 public  static function  getColumnLang(){
 	 	$columes=[
 	 	'title'=>['العنوان' ,1,true,false,[]],
 	 	'price'=>['السعر' ,1,true,false,[]],
 	 	'description'=>['hg,wt' ,1,false,false,[]],
 	 	   'actions'=>['الخيارات',2,true,false,['edit','delete']],
 	 	];
 	 	 return $columes;
  }

 	 	 
}