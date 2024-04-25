<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
     use Sluggable;
    protected $table='posts';

    protected $data=[
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    protected $fillable =[
        'title', 'status', 'category_id', 'user_id', 'content','cover'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function getShortAttribute(){
        return substr($this->content, 0,70)."...";
    }
}
