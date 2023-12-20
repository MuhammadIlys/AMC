<?php

namespace App\Models\users\qbank_user\qbank_last_used_fetch_question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\super_admin\qbank\qbank_qbank\QbankQbank;
use App\Models\super_admin\qbank\qbank_system\QbankSystem;
use App\Models\super_admin\user_management\Users;

class LastUsedFetchedQuestion extends Model
{
    use HasFactory;

    protected $table = 'last_used_fetched_questions';

    protected $fillable = [
        'qbank_system_id',
        'qbank_id',
        'user_id',
        'last_fetched_question_id',
    ];


    public function qbankSystem()
    {
        return $this->belongsTo(QbankSystem::class, 'qbank_system_id');
    }

    public function qbankQbank()
    {
        return $this->belongsTo(QbankQbank::class, 'qbank_id');
    }

    public function qbankUser()
    {
        return $this->belongsTo(Users::class, 'id');
    }
}
