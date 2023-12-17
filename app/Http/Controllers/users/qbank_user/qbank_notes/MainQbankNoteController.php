<?php

namespace App\Http\Controllers\users\qbank_user\qbank_notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainQbankNoteController extends Controller
{

  public function lunchUserQbankNotes(){

    return view('users.qbank_user.qbank_notes.qbank_notes');


  }
}
