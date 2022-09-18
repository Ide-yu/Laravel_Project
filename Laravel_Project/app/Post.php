<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  public function favorite(){
   return $this->hasMany('App\Favorite', 'id', 'post_id');
  }
  public function area(){
   return $this->belongsTo('App\Area', 'area_id', 'id');
 }

  protected $fillable = ['image_path', 'area_id', 'comment', 'date', 'address'
  ];
    //
}
