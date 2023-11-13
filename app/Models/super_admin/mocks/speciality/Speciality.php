<?php

namespace App\Models\super_admin\mocks\speciality;

use App\Models\super_admin\mocks\question\Question;
use App\Models\super_admin\mocks\subject\Subject;
use App\Models\super_admin\mocks\subject_speciality_topic\SubjectSpecialityTopic;
use App\Models\super_admin\mocks\topic\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $table = 'speciality';
    protected $primaryKey = 'speciality_id';
    protected $fillable = ['speciality_name'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'speciality_subject', 'speciality_id', 'subject_id');
    }

    // In Speciality model
    public function subjectss()
    {
        return $this->belongsToMany(Subject::class, 'subject_speciality_topic', 'speciality_id', 'subject_id')
                    ->using(SubjectSpecialityTopic::class)
                    ->withPivot(['topic_id']);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'subject_speciality_topic', 'speciality_id', 'topic_id')
                    ->using(SubjectSpecialityTopic::class)
                    ->withPivot(['subject_id']);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
