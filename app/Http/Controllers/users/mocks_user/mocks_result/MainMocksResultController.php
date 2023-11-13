<?php

namespace App\Http\Controllers\users\mocks_user\mocks_Result;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainMocksResultController extends Controller
{
    // lunch the mocks result view
    public function mocksResultView(){
        $data = [
            'result' => '#test_results'

        ];
        return view("users.mocks_user.mocks_result.mocksResult",$data);
    }

    public function mocksAnalyticsView(){
        $data = [
            'result' => '#test_analytics'

        ];
        return view("users.mocks_user.mocks_result.mocksResult",$data);
    }
}
