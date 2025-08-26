<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table='courses';
    protected  $guarded=[];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function Exams(){
        return $this->hasMany(Exam::class);
    }
    public function difficulty(){
        return $this->belongsTo(Difficulty::class);
    }
    public function students(){
        return $this->belongsToMany(Student::class,'student_course','student_id','course_id');
    }
}
