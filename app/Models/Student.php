<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table='students';
    protected  $guarded=[];

    public function job(){
        return $this->hasOne(Job::class);
    }
    public function wallet(){
        return $this->hasOne(Wallet::class);
    }
    public function courses(){
        return $this->hasMany(Course::class);
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    
}
