<?php

namespace App\Models\super_admin\qbank\qbank_qbank;

use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
use App\Models\users\qbank_user\qbank_corrects\QbankCorrects;
use App\Models\users\qbank_user\qbank_incorrects\QbankIncorrects;
use App\Models\users\qbank_user\qbank_marked\QbankMarked;
use App\Models\users\qbank_user\qbank_notes\QbankNote;
use App\Models\users\qbank_user\qbank_omitted\QbankOmitted;
use App\Models\users\qbank_user\qbank_unused\QbankUnused;
use App\Models\users\qbank_user\qbank_used\QbankUsed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QbankQbank extends Model
{
    use HasFactory;

    protected $table = 'qbank_qbanks';
    protected $primaryKey = 'qbank_id';

    protected $fillable = [
        'qbank_name',
    ];

    // Relationship with QbankQuestion model
    public function qbankQuestion()
    {
        return $this->hasMany(QbankQuestion::class, 'qbank_id');
    }


    // ##############################  QBANK RELATIONSHIP ###################################

     // Relationship with QbankCorrects model
     public function qbankCorrectQuestion()
     {
         return $this->hasMany(QbankCorrects::class, 'qbank_id');
     }

      // Relationship with QbankIncorrects model
      public function qbankIncorrectQuestion()
      {
          return $this->hasMany(QbankIncorrects::class, 'qbank_id');
      }

      // Relationship with QbankMarked model
      public function qbankMarkedQuestion()
      {
          return $this->hasMany(QbankMarked::class, 'qbank_id');
      }

      // Relationship with QbankOmitted model
      public function qbankOmittedQuestion()
      {
          return $this->hasMany(QbankOmitted::class, 'qbank_id');
      }

      // Relationship with QbankUsed model
      public function qbankUsedQuestion()
      {
          return $this->hasMany(QbankUsed::class, 'qbank_id');
      }

      // Relationship with QbankUnused model
      public function qbankUnusedQuestion()
      {
          return $this->hasMany(QbankUnused::class, 'qbank_id');
      }

       // Relationship with QbankNotemodel
       public function qbankNoteQuestion()
       {
           return $this->hasMany(QbankNote::class, 'qbank_id');
       }

}
