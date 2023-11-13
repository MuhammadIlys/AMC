<?php

namespace App\Models\super_admin\mocks\subject_speciality_topic;

use App\Models\super_admin\mocks\speciality\Speciality;
use App\Models\super_admin\mocks\subject\Subject;
use App\Models\super_admin\mocks\topic\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectSpecialityTopic extends Pivot
{
    use HasFactory;

    protected $table = 'subject_speciality_topic';
    protected $primaryKey = 'id';
    protected $fillable = ['topic_id', 'subject_id', 'speciality_id'];

    // Relationship with Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    // Relationship with Speciality
    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id', 'speciality_id');
    }

    // Relationship with Topic
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'topic_id');
    }



}
