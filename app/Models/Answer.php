<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table='answers';
    protected  $guarded=[];

    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function students(){
        return $this->belongsToMany(Student::class,'student_answer','student_id','answer_id');
    }
    
    
}
