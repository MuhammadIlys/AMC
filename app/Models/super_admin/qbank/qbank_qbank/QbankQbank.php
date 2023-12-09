<?php

namespace App\Models\super_admin\qbank\qbank_qbank;

use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
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
}
