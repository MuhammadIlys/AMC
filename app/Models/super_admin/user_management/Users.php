<?php

namespace App\Models\super_admin\user_management;

use App\Models\super_admin\user_management\subscription\Subscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'country',
        'role','address','address2','city','phone',
        'receive_service_update', 'receive_promotion_update'
    ];



    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
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


}
