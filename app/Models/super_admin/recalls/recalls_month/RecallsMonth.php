<?php

namespace App\Models\super_admin\recalls\recalls_month;

use App\Models\super_admin\recalls\recalls_question\RecallsQuestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecallsMonth extends Model
{
    use HasFactory;

    protected $table = 'recalls_months';
    protected $primaryKey = 'recalls_month_id';

    protected $fillable = [
        'month_name',
    ];

      // Relationship with RecallsQuestion model
      public function recallsQuestions()
      {
          return $this->hasMany(RecallsQuestion::class, 'recalls_month_id');
      }
}
