<?php

namespace App\Models\super_admin\recalls\recalls_system;

use App\Models\super_admin\recalls\recalls_question\RecallsQuestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecallsSystem extends Model
{
    use HasFactory;

    protected $table = 'recalls_systems';
    protected $primaryKey = 'recalls_system_id';

    protected $fillable = [
        'system_name',
    ];

     // Relationship with RecallsQuestion model
     public function recallsQuestions()
     {
         return $this->hasMany(RecallsQuestion::class, 'recalls_system_id');
     }
}
