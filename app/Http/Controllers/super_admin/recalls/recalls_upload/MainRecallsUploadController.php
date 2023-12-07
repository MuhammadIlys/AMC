<?php

namespace App\Http\Controllers\super_admin\recalls\recalls_upload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainRecallsUploadController extends Controller
{
    public function recallsUploadImagView(){

        return view('super_admin.amc_recalls.recalls_upload.recalls_upload_image');
    }

    public function recallsUploadVideoView(){

        return view('super_admin.amc_recalls.recalls_upload.recalls_upload_video');
    }
}
