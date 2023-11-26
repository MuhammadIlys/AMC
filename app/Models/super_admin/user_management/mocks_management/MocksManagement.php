<?php

namespace App\Models\super_admin\user_management\mocks_management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MocksManagement extends Pivot
{
    use HasFactory;

    protected $table = 'mocks_management';
    protected $primaryKey = 'mocks_management_id';
    protected $fillable = ['user_id', 'test_id'];
}
