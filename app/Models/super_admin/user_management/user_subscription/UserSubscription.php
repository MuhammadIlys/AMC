<?php

namespace App\Models\super_admin\user_management\user_subscription;

use App\Models\super_admin\user_management\subscription\Subscription;
use App\Models\super_admin\user_management\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserSubscription extends Pivot
{

    use HasFactory;

    protected $table = 'user_subscription';
    protected $primaryKey = 'id';

    protected $fillable = [

        'user_id',
        'subscription_id',
        'activation_timestamp',
        'expiry_timestamp',
    ];


    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

}
