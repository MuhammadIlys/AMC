<?php

namespace App\Models\super_admin\recalls\recalls_system;

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
}
