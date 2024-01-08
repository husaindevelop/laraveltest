<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ai_images extends Model
{
    
    
protected $table='images';  
protected $primaryKey='img_id';  
protected $fillable = ['img_id','input'];

}
