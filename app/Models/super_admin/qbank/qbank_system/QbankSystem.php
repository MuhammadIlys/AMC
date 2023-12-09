<?php

namespace App\Models\super_admin\qbank\qbank_system;

use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QbankSystem extends Model
{
    use HasFactory;

    protected $table = 'qbank_systems';
    protected $primaryKey = 'qbank_system_id';

    protected $fillable = [
        'system_name',
    ];


    // Relationship with QbankQuestion model
    public function qbankQuestion()
    {
        return $this->hasMany(QbankQuestion::class, 'qbank_system_id');
    }
}
