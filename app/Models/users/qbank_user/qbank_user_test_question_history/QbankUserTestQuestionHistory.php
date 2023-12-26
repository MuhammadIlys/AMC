<?php

namespace App\Models\users\qbank_user\qbank_user_test_question_history;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class QbankUserTestQuestionHistory extends Pivot
{
    use HasFactory;

    protected $table = 'qbank_user_test_question_history';
    protected $primaryKey = 'question_history_id';

    protected $fillable = [
        'user_test_id',   // Foreign key for QbankUserTest
        'qbank_question_id',  // Foreign key for for QbankQuestion
        'choose_option',
        'question_status',
        'time_spent',

    ];
}
