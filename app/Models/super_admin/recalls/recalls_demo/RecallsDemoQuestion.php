<?php

namespace App\Models\super_admin\recalls\recalls_demo;

use App\Models\super_admin\recalls\recalls_month\RecallsMonth;
use App\Models\super_admin\recalls\recalls_system\RecallsSystem;
use App\Models\super_admin\recalls\recalls_Year\RecallsYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecallsDemoQuestion extends Model
{
    use HasFactory;


    protected $table = 'recalls_demo_questions';
    protected $primaryKey = 'recalls_question_id';

    protected $fillable = [

        'recalls_year_id', // foreign key of table recalls_years
        'recalls_month_id', // foreign key of table recalls_months
        'recalls_system_id', // foreign key of table recalls_systems
        'question_track_id',
        'question_text',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'correct_option',
        'question_explanation',
    ];


     // Validation rules
     public static $rules = [

        'question_track_id'=>'required|numeric',
        'recalls_year_id' => 'required|exists:recalls_years,recalls_year_id',
        'recalls_month_id' => 'required|exists:recalls_months,recalls_month_id',
        'recalls_system_id' => 'required|exists:recalls_systems,recalls_system_id',
        'question_text' => 'required|string',
        'option1' => 'required|string',
        'option2' => 'required|string',
        'option3' => 'required|string',
        'option4' => 'required|string',
        'option5' => 'required|string',
        'correct_option' => 'required|integer|between:1,5',
        'question_explanation' => 'required|string',
    ];


        // Relationship with RecallsYear model
        public function recallsYear()
        {
            return $this->belongsTo(RecallsYear::class, 'recalls_year_id');
        }

        // Relationship with RecallsMonth model
        public function recallsMonth()
        {
            return $this->belongsTo(RecallsMonth::class, 'recalls_month_id');
        }

        // Relationship with RecallsSystem model
        public function recallsSystem()
        {
            return $this->belongsTo(RecallsSystem::class, 'recalls_system_id');
        }
}
