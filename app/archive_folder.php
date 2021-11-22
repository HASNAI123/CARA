<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class archive_folder extends Model
{
    use HasFactory;

    protected $fillable = ['title','password','created_by'];

    
}
