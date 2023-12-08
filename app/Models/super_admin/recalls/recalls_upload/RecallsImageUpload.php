<?php

namespace App\Models\super_admin\recalls\recalls_upload;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecallsImageUpload extends Model
{
    use HasFactory;

    protected $table = 'recalls_image_upload';
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'question_tracking_id',
        'hyper_link_text',
        'image_path',
        'image_link',
    ];
}
