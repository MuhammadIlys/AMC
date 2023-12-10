<?php

namespace App\Models\super_admin\qbank\qbank_upload;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QbankUpload extends Model
{
    use HasFactory;

    protected $table = 'qbank_image_upload';
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'question_tracking_id',
        'hyper_link_text',
        'image_path',
        'image_link',
    ];
}
