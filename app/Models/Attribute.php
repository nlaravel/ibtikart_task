<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

 protected $guarded = [];
 public  static function  getColumnLang(){
 	 	$columes=[
 	 	'name'=>['الاسم' ,1,true,false,[]],
 	 	   'actions'=>['الخيارات',0,true,false,['edit','delete']],
 	 	];
 	 	 return $columes;
  }

 	 	 
}