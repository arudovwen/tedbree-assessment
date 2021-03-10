<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
   
    protected $fillable = ['job_id','first_name','last_name','email','phone','phone','location','cv'];
}
