<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class generatesop_history extends Model
{
    use HasFactory;
    public $table = 'generatesop_history';
     public $timestamps=true;

    protected $fillable = [
            'title',
            'empployee_name',
           'empployee_id',
            'selection_one',
            'selection_two'
        ];
}
