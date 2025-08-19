<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $table='students';
    protected  $guarded=[];

    public function job(){
        return $this->hasOne(Job::class);
    }
    public function wallet(){
        return $this->hasOne(Wallet::class);
    }
    public function courses(){
        return $this->belongsToMany(Course::class);
    }
    public function answers(){
        return $this->belongsToMany(Answer::class);
    }
    
}
