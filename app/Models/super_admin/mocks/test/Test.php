<?php

namespace App\Models\super_admin\mocks\test;

use App\Models\super_admin\mocks\question\Question;
use App\Models\users\mocks_user\mocks_user_test_history\MocksUserTestHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'test'; // The name of the database table associated with this model.
    protected $primaryKey = 'test_id'; // The primary key field name.

    // Define the fillable attributes.
    protected $fillable = [
        'test_name',
        'total_mark',
        'passing_score',
        'allow_attempt',
        'test_status',
    ];


    public function questions()
    {
        return $this->hasMany(Question::class, 'test_id');
    }

     // Define the one-to-many relationship with MocksUserTestHistory
     public function mockUserTestHistories()
     {
         return $this->hasMany(MocksUserTestHistory::class, 'test_id', 'test_id');
     }
}
