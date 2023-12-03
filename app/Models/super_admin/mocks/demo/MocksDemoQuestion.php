<?php

namespace App\Models\super_admin\mocks\demo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MocksDemoQuestion extends Model
{
    use HasFactory;

    protected $table = 'mocks_demo_questions';
    protected $primaryKey = 'question_id';

    protected $fillable = [
        'question_text',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'correct_option',
        'question_explanation',
    ];
}
