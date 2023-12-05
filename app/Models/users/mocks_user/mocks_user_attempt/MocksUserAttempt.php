<?php

namespace App\Models\users\mocks_user\mocks_user_attempt;

use App\Models\super_admin\mocks\test\Test;
use App\Models\super_admin\user_management\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MocksUserAttempt extends Pivot
{
    use HasFactory;

    protected $table = 'mocks_user_attempt';
    protected $primaryKey = 'mocks_user_attempt_id';

    protected $fillable = [

        'user_id',   // Foreign key for User
        'test_id',  // Foreign key for for Test
        'remaining_attempts'


    ];


      // Define the many-to-many relationship with the Users model
      public function users()
      {
          return $this->belongsToMany(Users::class, 'mocks_user_attempt', 'test_id', 'user_id')
              ->withPivot('remaining_attempts'); // Add any additional pivot columns if needed
      }

      // Define the many-to-many relationship with the Test model
      public function tests()
      {
          return $this->belongsToMany(Test::class, 'mocks_user_attempt', 'user_id', 'test_id')
              ->withPivot('remaining_attempts'); // Add any additional pivot columns if needed
      }

}
