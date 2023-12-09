<?php

namespace App\Http\Controllers\super_admin\qbank\qbank_upload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainQbankUploadController extends Controller
{
    public function qbankUploadImagView(){

        return view('super_admin.amc_qbank.qbank_upload.qbank_upload_image');
    }
}
