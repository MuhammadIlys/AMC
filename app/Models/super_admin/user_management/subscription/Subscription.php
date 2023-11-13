<?php

namespace App\Models\super_admin\user_management\subscription;

use App\Models\super_admin\user_management\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscription';
    protected $primaryKey = 'subscription_id';

    protected $fillable = [

        'subscription_name',
        'demo_link',
        'lunch_link',
        'renewal_link',
    ];

    public function users()
    {
        return $this->belongsToMany(Users::class, 'user_subscription', 'subscription_id', 'user_id')
            ->withPivot('activation_timestamp', 'expiry_timestamp');
    }

}
