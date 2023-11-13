<?php

namespace App\Models\super_admin\mocks\subject;

use App\Models\super_admin\mocks\question\Question;
use App\Models\super_admin\mocks\speciality\Speciality;
use App\Models\super_admin\mocks\subject_speciality_topic\SubjectSpecialityTopic;
use App\Models\super_admin\mocks\topic\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subject';
    protected $primaryKey = 'subject_id';

    protected $fillable = [
        'subject_name',
    ];
      // define the relationship between subject and speciality
    public function specialties()
    {
        return $this->belongsToMany(Speciality::class, 'speciality_subject', 'subject_id', 'speciality_id');
    }



    // In Subject model
        public function topics()
    {
        return $this->belongsToMany(Topic::class, 'subject_speciality_topic', 'subject_id', 'topic_id')
                    ->using(SubjectSpecialityTopic::class)
                    ->withPivot(['speciality_id']);
    }

    public function specialitiess()
    {
        return $this->belongsToMany(Speciality::class, 'subject_speciality_topic', 'subject_id', 'speciality_id')
                    ->using(SubjectSpecialityTopic::class)
                    ->withPivot(['topic_id']);
    }


    public function questions()
    {
        return $this->hasMany(Question::class);
    }


}
