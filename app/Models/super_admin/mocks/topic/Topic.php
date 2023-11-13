<?php

namespace App\Models\super_admin\mocks\topic;

use App\Models\super_admin\mocks\question\Question;
use App\Models\super_admin\mocks\speciality\Speciality;
use App\Models\super_admin\mocks\subject\Subject;
use App\Models\super_admin\mocks\subject_speciality_topic\SubjectSpecialityTopic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topic';
    protected $primaryKey = 'topic_id';

    protected $fillable = [
        'topic_name',
    ];

    // In Topic model
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_speciality_topic', 'topic_id', 'subject_id')
                    ->using(SubjectSpecialityTopic::class)
                     ->withPivot(['speciality_id']);

    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class, 'subject_speciality_topic', 'topic_id', 'speciality_id')
                    ->using(SubjectSpecialityTopic::class)
                    ->withPivot(['subject_id']);

    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
