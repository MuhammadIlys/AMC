<?php

namespace App\Models\users\qbank_user\qbank_user_tests;

use App\Models\super_admin\qbank\qbank_qbank\QbankQbank;
use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
use App\Models\super_admin\user_management\Users;
use App\Models\users\qbank_user\qbank_user_test_question_history\QbankUserTestQuestionHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QbankUserTest extends Model
{
    use HasFactory;

    protected $table = 'qbank_user_tests';
    protected $primaryKey = 'user_test_id';

    protected $fillable = [
        'user_id',   // Foreign key for Users
        'qbank_id',  // Foreign key for QbankQbank
        'score',
        'correct',
        'incorrect',
        'omitted',
        'perscent',
        'test_status',

    ];


       // Define the relationship with the Users model (one-to-many)
       public function user()
       {
           return $this->belongsTo(Users::class, 'user_id', 'id');
       }

       // Define the relationship with the QbankQbank model (one-to-many)
       public function qbankQbank()
       {
           return $this->belongsTo(QbankQbank::class, 'qbank_id', 'qbank_id');
       }


     // Define the many-to-many relationship with QbankQuestion through the pivot table.



     public function testQuestions()
     {
         return $this->belongsToMany(QbankQuestion::class, 'qbank_user_test_question_history', 'user_test_id', 'qbank_question_id')
             ->using(QbankUserTestQuestionHistory::class);
     }

     public function testQuestionswithPivot()
     {
         return $this->belongsToMany(QbankQuestion::class, 'qbank_user_test_question_history', 'user_test_id', 'qbank_question_id')
             ->using(QbankUserTestQuestionHistory::class)
             ->withPivot(['choose_option', 'question_status', 'time_spent']);
     }

}
