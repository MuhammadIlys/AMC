<?php

namespace App\Models\super_admin\user_management;

use App\Models\super_admin\user_management\subscription\Subscription;
use App\Models\users\mocks_user\mocks_user_attempt\MocksUserAttempt;
use App\Models\users\mocks_user\mocks_user_test_history\MocksUserTestHistory;
use App\Models\users\qbank_user\qbank_corrects\QbankCorrects;
use App\Models\users\qbank_user\qbank_incorrects\QbankIncorrects;
use App\Models\users\qbank_user\qbank_marked\QbankMarked;
use App\Models\users\qbank_user\qbank_omitted\QbankOmitted;
use App\Models\users\qbank_user\qbank_unused\QbankUnused;
use App\Models\users\qbank_user\qbank_used\QbankUsed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\super_admin\mocks\test\Test;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'country',
        'role','address','address2','city','phone',
        'receive_service_update', 'receive_promotion_update','email_token',
        'email_status','reset_token','token_expires_at',
    ];



    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isEmailVerified()
    {
        return $this->email_status == 1;
    }

    public function isUser(){

        return $this->role === 'user';
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'user_subscription', 'user_id', 'subscription_id')
            ->withPivot('activation_timestamp', 'expiry_timestamp');
    }

    public function hasSubscription($subscriptionType)
    {
        // Check if the user has an active subscription of the specified type
        return $this->subscriptions->where('subscription_name', $subscriptionType)
        ->where('pivot.expiry_timestamp', '>', now()) // Check if the expiry_timestamp is in the future
        ->isNotEmpty();;
    }

     // Define the one-to-many relationship with MocksUserTestHistory
     public function mockUserTestHistories()
     {
         return $this->hasMany(MocksUserTestHistory::class, 'user_id', 'id');
     }


      // Define the many-to-many relationship with the Test model
    public function mocks_test_management()
    {
        return $this->belongsToMany(Test::class, 'mocks_management', 'user_id', 'test_id')
            ->withPivot('mocks_management_id'); // Add any additional pivot columns if needed
    }

     // Define the many-to-many relationship with the MocksUserAttempt model
     public function mocksUserAttempts()
     {
         return $this->belongsToMany(MocksUserAttempt::class, 'mocks_user_attempt', 'user_id', 'test_id')
             ->withPivot('remaining_attempts'); // Add any additional pivot columns if needed
     }


     // ##############################  QBANK RELATIONSHIP ###################################


     // Relationship with QbankCorrects model
    public function qbankCorrectQuestion()
    {
        return $this->hasMany(QbankCorrects::class, 'id');
    }

     // Relationship with QbankIncorrects model
     public function qbankIncorrectQuestion()
     {
         return $this->hasMany(QbankIncorrects::class, 'id');
     }

      // Relationship with QbankMarked model
      public function qbankMarkedQuestion()
      {
          return $this->hasMany(QbankMarked::class, 'id');
      }

      // Relationship with QbankOmitted model
      public function qbankOmittedQuestion()
      {
          return $this->hasMany(QbankOmitted::class, 'id');
      }

       // Relationship with QbankUsed model
       public function qbankUsedQuestion()
       {
           return $this->hasMany(QbankUsed::class, 'id');
       }

        // Relationship with QbankUnused model
        public function qbankUnusedQuestion()
        {
            return $this->hasMany(QbankUnused::class, 'id');
        }


}
