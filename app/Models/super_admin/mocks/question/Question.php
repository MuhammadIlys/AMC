<?php

namespace App\Models\super_admin\mocks\question;

use App\Models\super_admin\mocks\speciality\Speciality;
use App\Models\super_admin\mocks\subject\Subject;
use App\Models\super_admin\mocks\test\Test;
use App\Models\super_admin\mocks\topic\Topic;
use App\Models\users\mocks_user\mocks_user_question_history\MocksUserQuestionHistory;
use App\Models\users\mocks_user\mocks_user_test_history\MocksUserTestHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'question';
    protected $primaryKey = 'question_id';

    protected $fillable = [
        'question_track_id',
        'subject_id',  // Foreign key for Subject
        'speciality_id', // Foreign key for Specialty
        'topic_id',  // Foreign key for Topic
        'question_text',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'correct_option',
        'question_type',
        'question_explanation',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }


       /**
     * Define the many-to-many relationship with MocksUserTestHistory through the pivot table.
     *
     */

    public function testHistories()
    {
        return $this->belongsToMany(MocksUserTestHistory::class, 'mocks_user_question_history', 'question_id', 'user_mocks_id')
            ->using(MocksUserQuestionHistory::class)
            ->withPivot(['choose_option', 'question_status', 'question_type', 'time_spent']);
    }



}
