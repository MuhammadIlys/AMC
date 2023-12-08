<?php

namespace App\Models\super_admin\recalls\recalls_Year;

use App\Models\super_admin\recalls\recalls_question\RecallsQuestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecallsYear extends Model
{
    use HasFactory;

    protected $table = 'recalls_years';
    protected $primaryKey = 'recalls_year_id';

    protected $fillable = [
        'year',
    ];


     // Relationship with RecallsQuestion model
     public function recallsQuestions()
     {
         return $this->hasMany(RecallsQuestion::class, 'recalls_year_id');
     }
}
