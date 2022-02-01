<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

 protected $guarded = [];
 public  static function  getColumnLang(){
 	 	$columes=[
 	 	'name'=>['النوع',1,false,false,[]],
 	 	   'actions'=>['الخيارات',0,true,false,['edit','delete']],
 	 	];
 	 	 return $columes;
  }


 	 	 
}