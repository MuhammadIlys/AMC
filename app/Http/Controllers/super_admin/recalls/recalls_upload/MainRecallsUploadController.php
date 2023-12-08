<?php

namespace App\Http\Controllers\super_admin\recalls\recalls_upload;

use App\Http\Controllers\Controller;
use App\Models\super_admin\recalls\recalls_upload\RecallsImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainRecallsUploadController extends Controller
{
    public function recallsUploadImagView(){

        return view('super_admin.amc_recalls.recalls_upload.recalls_upload_image');
    }


    public function uploadMocksImage(Request $request)
    {
        $image = $request->file('image_file');

        // Generate a unique filename
        $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();

        // Save the image directly to the public directory
        $image->move(public_path('super_admin_assets/recalls_upload'), $filename);

        $path='super_admin_assets/recalls_upload/' . $filename;

        $image_link='<span class="modal_image"
        style="font-family: inherit; font-size: 100%;
        cursor: pointer; color: blue;"
        onclick="openModal(event,\''.$path.'\')">'.$request->input('hyper_link_text').'</span>';

        // Create a new RecallsImageUpload model instance
        $imageData = RecallsImageUpload::create([
            'question_tracking_id' => $request->input('question_tracking_id'),
            'hyper_link_text' => $request->input('hyper_link_text'),
            'image_path' => 'super_admin_assets/recalls_upload/' . $filename,
            'image_link' => $image_link,
        ]);

        return response()->json(['success' => true, 'data' => $imageData]);
    }


    public function loadMocksImages()
    {
        // Fetch data from the model
        $data = RecallsImageUpload::all(); // You can customize this query as per your requirements

        // Prepare the response in the format expected by DataTables
        $response = [
            'data' => $data,
        ];

        return response()->json($response);
    }


    public function deleteMocksImage($image_id)
    {
        // Find the image record in the database
        $imageData = RecallsImageUpload::find($image_id);

        if (!$imageData) {
            // Image record not found
            return response()->json(['success' => false, 'message' => 'Image not found.']);
        }

        // Delete the image file from the folder
        $imagePath = public_path($imageData->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the file
        }

        // Delete the image record from the database
        $imageData->delete();

        return response()->json(['success' => true, 'message' => 'Image and record deleted successfully.']);
    }






    public function recallsUploadVideoView(){

        return view('super_admin.amc_recalls.recalls_upload.recalls_upload_video');
    }
}
