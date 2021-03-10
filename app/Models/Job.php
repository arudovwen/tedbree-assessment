<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'description', 'company', 'company_logo', 'category', 'benefits', 'location', 'work_condition', 'salary', 'type'];
}
