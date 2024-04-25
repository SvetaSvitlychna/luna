<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;


class Profile extends Model
{
    use HasFactory;
    protected $fillable =[
             'user_id',
            'first_name',
            'last_name',
            'phone',
    ];
    public function getFullNameAttribute(){
        return $this->first_name." ".$this->last_name;
    }
public function user(){
    return $this->belongsTo('App\Models\User');
}

}
