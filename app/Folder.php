<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Folder
 *
 * @package App
 * @property string $name
 * @property string $created_by
*/
class Folder extends Model
{
    use SoftDeletes ;

    protected $fillable = ['title'];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    // public function setCreatedByIdAttribute($input)
    // {
    //     $this->attributes['created_by_id'] = $input ? $input : null;
    // }
    
     public function file_owner()
     {
         return $this->hasMany(Generatesop::class);
     }
    
}
