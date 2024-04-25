<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories';
    protected $primaryKey = 'id';

// public $dateFormat = 'U';

// public function getDateFormat (){
//     return 'U';
// }
    protected $data=[
        "created_at",
        "updated_at",
        "deleted_at",
        "published_at"
    ];
    protected $fillable =[
        'name','description' 
    ];
    public function getNameAttribute($value){
return ucfirst($value);
    }
    public function setNameAttribute($value) {
        $this->attributes['name'] = strtolower($value);
        return ucfirst($value);
    }
 protected $dates =[
        "created_at",
        "updated_at",
        "deleted_at",
        "published_at"
    ];
    
    public function posts(){
        return $this->hasMany('App\Models\Post');
    }
   
}
