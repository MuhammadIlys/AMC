<?php

namespace App\Models\users\mocks_user\mocks_user_test_history;

use App\Models\super_admin\mocks\question\Question;
use App\Models\super_admin\mocks\test\Test;
use App\Models\super_admin\user_management\Users;
use App\Models\users\mocks_user\mocks_user_question_history\MocksUserQuestionHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MocksUserTestHistory extends Model
{
    use HasFactory;

    protected $table = 'mocks_user_test_history';
    protected $primaryKey = 'user_mocks_id';

    protected $fillable = [
        'user_id',   // Foreign key for user
        'test_id',  // Foreign key for test
        'score',
        'correct',
        'incorrect',
        'omitted',
        'perscent',
    ];


       // Define the relationship with the Users model (one-to-many)
       public function user()
       {
           return $this->belongsTo(Users::class, 'user_id', 'id');
       }

       // Define the relationship with the Test model (one-to-many)
       public function test()
       {
           return $this->belongsTo(Test::class, 'test_id', 'test_id');
       }


     // Define the many-to-many relationship with Question through the pivot table.


       public function questions()
       {
           return $this->belongsToMany(Question::class, 'mocks_user_question_history', 'user_mocks_id', 'question_id')
               ->using(MocksUserQuestionHistory::class)
               ->withPivot(['choose_option', 'question_status', 'question_type', 'time_spent']);
       }


}
