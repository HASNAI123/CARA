<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class auditLog extends Model
{
    
   

    public $table = 'audits';

    protected $fillable = [
        'description',
        'subject_id',
        'subject_type',
        'user_id',
        'properties',
        'host',
    ];

    protected $casts = [
        'properties' => 'collection',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}