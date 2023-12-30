<?php

namespace App\Models\super_admin\qbank\qbank_question;

use App\Models\super_admin\qbank\qbank_qbank\QbankQbank;
use App\Models\super_admin\qbank\qbank_system\QbankSystem;
use App\Models\users\qbank_user\qbank_corrects\QbankCorrects;
use App\Models\users\qbank_user\qbank_highlights\QbankHighlight;
use App\Models\users\qbank_user\qbank_incorrects\QbankIncorrects;
use App\Models\users\qbank_user\qbank_marked\QbankMarked;
use App\Models\users\qbank_user\qbank_notes\QbankNote;
use App\Models\users\qbank_user\qbank_omitted\QbankOmitted;
use App\Models\users\qbank_user\qbank_unused\QbankUnused;
use App\Models\users\qbank_user\qbank_used\QbankUsed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QbankQuestion extends Model
{
    use HasFactory;


    protected $table = 'qbank_questions';
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


    // ##############################  QBANK RELATIONSHIP ###################################

      // Relationship with QbankCorrects model
    public function qbankCorrectQuestion()
    {
        return $this->hasMany(QbankCorrects::class, 'qbank_question_id');
    }

      // Relationship with QbankIncorrects model
      public function qbankIcorrectQuestion()
      {
          return $this->hasMany(QbankIncorrects::class, 'qbank_question_id');
      }

    // Relationship with QbankMarked model
    public function qbankMarkedQuestion()
    {
        return $this->hasMany(QbankMarked::class, 'qbank_question_id');
    }

    // Relationship with QbankOmitted model
    public function qbankOmittedQuestion()
    {
        return $this->hasMany(QbankOmitted::class, 'qbank_question_id');
    }

    // Relationship with QbankUsed model
    public function qbankUsedQuestion()
    {
        return $this->hasMany(QbankUsed::class, 'qbank_question_id');
    }

    // Relationship with QbankUnused model
    public function qbankUnusedQuestion()
    {
        return $this->hasMany(QbankUnused::class, 'qbank_question_id');
    }

    // Relationship with QbankNote model
    public function qbankNoteQuestion()
    {
        return $this->hasMany(QbankNote::class, 'qbank_question_id');
    }

     // Relationship with QbankHighlight model
     public function qbankHighlightQuestion()
     {
         return $this->hasMany(QbankHighlight::class, 'qbank_question_id');
     }


}
