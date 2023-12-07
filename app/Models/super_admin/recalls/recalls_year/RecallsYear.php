<?php

namespace App\Models\super_admin\recalls\recalls_Year;

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
}
