<?php

namespace App\Models\users\qbank_user\qbank_account_reset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\super_admin\user_management\Users;
use App\Models\super_admin\qbank\qbank_qbank\QbankQbank;

class QbankAccountReset extends Model
{
    use HasFactory;

    protected $table = 'qbank_account_reset';
    protected $primaryKey = 'account_reset_id';

    protected $fillable = [

        'id', // foreign key of table users
        'qbank_id', // foreign key of table qbank_qbanks
        'reset_type',
        'reset_count',
    ];


    // Relationship with Users model
      public function qbankUser()
      {
          return $this->belongsTo(Users::class, 'id');
      }

      // Relationship with QbankQbank model
      public function qbankQbank()
      {
          return $this->belongsTo(QbankQbank::class, 'qbank_id');
      }
}
