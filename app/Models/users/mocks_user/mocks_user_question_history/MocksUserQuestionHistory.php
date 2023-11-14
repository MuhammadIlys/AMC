<?php

namespace App\Models\users\mocks_user\mocks_user_question_history;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MocksUserQuestionHistory extends Pivot
{
    use HasFactory;

    protected $table = 'mocks_user_question_history';
    protected $primaryKey = 'question_history_id';

    protected $fillable = [
        'user_mocks_id',   // Foreign key for mocks_user_test_history
        'question_id',  // Foreign key for for question
        'choose_option',
        'question_status',
        'question_type',
        'time_spent',

    ];


}
