<?php

namespace App\Http\Controllers\users\qbank_user\qbank_notes;

use App\Http\Controllers\Controller;
use App\Models\users\qbank_user\qbank_notes\QbankNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainQbankNoteController extends Controller
{

  public function lunchUserQbankNotes(){

    $user_id = Session::get('user')->id;
    $qbank_id = Session::get('qbank_id');

    // Fetch notes data for the user and qbank
    $notes = QbankNote::where('id', $user_id)
                      ->where('qbank_id', $qbank_id)
                      ->get();

    // Format the data for DataTables
    $dataSet = $notes->map(function ($note) {
        $question = $note->qbankQuestion;
        $system = $question->qbankSystem;

        return [
            'html' => '<div class="card nt-card" id="card' . $note->note_question_id. '">
                           <div class="card-header nc-header">
                               <div class=\'savc d-none\'>
                                   <span class="float-end text-secondary cursor-pointer" onclick=\'cancelFunc("card' . $note->note_question_id . '", "content' . $note->note_question_id . '" , "' . $note->note_question_id . '")\'>Cancel</span>
                                   <span class="float-end text-secondary cursor-pointer" onclick=\'saveFunc("card' . $note->note_question_id . '","content' . $note->note_question_id . '" , "' . $note->note_question_id . '")\'>Save | </span>
                               </div>
                               <div class=\'edt\'>
                                   <span class="float-end text-secondary"><i onclick=\'deleteFunc("card' . $note->note_question_id . '", "content' . $note->note_question_id . '", "' . $note->note_question_id . '")\' class="la la-trash fs-22 cursor-pointer"></i></span>
                                   <span class="float-end text-secondary"><i onclick=\'editFunc("card' . $note->note_question_id . '", "content' . $note->note_question_id . '", "' . $note->note_question_id . '")\' class="la la-edit fs-22 cursor-pointer"></i></span>
                               </div>
                               <h6 class="card-title" style="margin: unset;">Question ID: ' . $question->qbank_question_id . ' ' . $system->system_name . '</h6>
                           </div>
                           <div class="card-body" id="editDocument' . $note->note_question_id . '">
                               <p id="content' . $note->note_question_id . '">' . $note->note . '</p>
                           </div>
                       </div>',
        ];
    });


    // Pass the dataset to the view
    return view('users.qbank_user.qbank_notes.qbank_notes', ['dataSet' => $dataSet]);



  }


  public function saveUserQbankNotes(Request $request)
  {
      try {
          // Validate the request data
          $request->validate([
              'noteId' => 'required', // Add any validation rules as needed
              'content' => 'required',
          ]);

          // Find the QbankNote model by note_question_id
          $qbankNote = QbankNote::find($request->noteId);

          if (!$qbankNote) {
              return response()->json(['error' => 'Note not found'], 404);
          }

          // Update the note content
          $qbankNote->note = $request->content;
          $qbankNote->save();

          // Return a success response
          return response()->json(['success' => 'Note updated successfully']);
      } catch (\Exception $e) {
          // Handle any exceptions or errors
          return response()->json(['error' => $e->getMessage()], 500);
      }
  }

  public function deleteUserQbankNotes(Request $request){

    try {
        // Validate the request data
        $request->validate([
            'noteId' => 'required',
        ]);

        // Find the QbankNote model by note_question_id
        $qbankNote = QbankNote::find($request->noteId);

        if (!$qbankNote) {
            return response()->json(['error' => 'Note not found'], 404);
        }


        $qbankNote->delete();

        // Return a success response
        return response()->json(['success' => 'Note Delete successfully']);
    } catch (\Exception $e) {
        // Handle any exceptions or errors
        return response()->json(['error' => $e->getMessage()], 500);
    }


  }


}
