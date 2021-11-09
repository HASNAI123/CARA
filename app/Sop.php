<?php

namespace App;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\http\request;



class Sop extends Model 
{

   

    protected $table = 'Sop';

    public const STATUS_SELECT = [
        'Processing' => 'Processing',
        'Accepted'   => 'Accepted',
        'Declined'   => 'Declined',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $fillable = [
        'sop_title',
        'business_unit',
        'uploaded_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'Sop_file',
        'effective_date',
        'Modified_by',
        'Modified_date'
        
    ];

    

    
   


}

