<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $data = [
        'name',
        "created_at",
        "updated_at",


    ];
    protected $fillable = ["name"];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }
}
