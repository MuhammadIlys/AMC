<?php

namespace App\Models\super_admin\qbank\qbank_demo;

use App\Models\super_admin\qbank\qbank_qbank\QbankQbank;
use App\Models\super_admin\qbank\qbank_system\QbankSystem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QbankDemoQuestion extends Model
{
    use HasFactory;


    protected $table = 'qbank_demo_questions';
    protected $primaryKey = 'qbank_question_id';

    protected $fillable = [

        'qbank_id', // foreign key of table qbank_qbanks
        'qbank_system_id', // foreign key of table qbank_systems
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




    // Relationship with QbankSystem model
    public function qbankSystem()
    {
        return $this->belongsTo(QbankSystem::class, 'qbank_system_id');
    }

    // Relationship with QbankQbank model
    public function qbankQbank()
    {
        return $this->belongsTo(QbankQbank::class, 'qbank_id');
    }

}
