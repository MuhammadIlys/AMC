<?php

namespace App\Models\users\qbank_user\qbank_marked;

use App\Models\super_admin\qbank\qbank_qbank\QbankQbank;
use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
use App\Models\super_admin\user_management\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QbankMarked extends Model
{
    use HasFactory;

    protected $table = 'qbank_marked';
    protected $primaryKey = 'marked_question_id';

    protected $fillable = [

        'qbank_question_id', // foreign key of table qbank_questions
        'id', // foreign key of table users
        'qbank_id', // foreign key of table qbank_qbanks
    ];

    // Relationship with QbankQuestion model
    public function qbankQuestion()
    {
        return $this->belongsTo(QbankQuestion::class, 'qbank_question_id');
    }

    // Relationship with Users model
    public function qbankUser()
    {
        return $this->belongsTo(Users::class, 'id');
    }

    // Relationship with QbankQbank model
    public function qbankQbank()
    {
        return $this->belongsTo(QbankQbank::class, 'qbank_id');
    }
}
