<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Model
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $table='teachers';
    protected  $guarded=[];

    public function courses(){
        return $this->hasMany(Course::class);
    }
    
}
