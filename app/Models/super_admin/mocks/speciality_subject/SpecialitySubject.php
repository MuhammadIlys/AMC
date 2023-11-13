<?php

namespace App\Models\super_admin\mocks\speciality_subject;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialitySubject extends Model
{
    use HasFactory;

    protected $table = 'speciality_subject';
    protected $primaryKey = 'id';

    protected $fillable = [
        'speciality_id','subject_id',
    ];

}
