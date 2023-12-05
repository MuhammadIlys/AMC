<?php

namespace App\Http\Controllers\users\mocks_user\demo;

use App\Http\Controllers\Controller;
use App\Models\super_admin\mocks\demo\MocksDemoQuestion;
use Illuminate\Http\Request;

class MainMocksDemoController extends Controller
{

    public function lunchMocksDemo(){

        return view('users.mocks_user.demo.lunch_mocks_demo');
    }

    public function mocksListDemo(){

        return view('users.mocks_user.demo.mocks_list.mocks_demo_list');
    }

    public function mocksPreviousDemo(){

        return view('users.mocks_user.demo.previous_mocks.mocks_demo_previous');
    }

    public function mocksResultDemo(){

        $result='#test_results';

        return view('users.mocks_user.demo.mocks_result.mocks_demo_result',['result'=>$result]);
    }

    public function mocksAnalyticsDemo(){
        $result='#test_analytics';

        return view('users.mocks_user.demo.mocks_result.mocks_demo_result',['result'=>$result]);
    }
    public function mocksPreviewDemo(){

        return view('users.mocks_user.demo.mocks_result.mocks_demo_result');
    }

    public function mocksReportDemo(){

        return view('users.mocks_user.demo.report.mocks_demo_report');
    }

    public function mocksGraphDemo(){

        return view('users.mocks_user.demo.graph.mocks_demo_graph');
    }

    public function mocksAccountResetDemo(){

        return view('users.mocks_user.demo.account_reset.mocks_demo_account_reset');
    }


    public function mocksDemoExamLunch(){

        return view('users.mocks_user.demo.demo_exam.mocks_demo_lunch');
    }

    public function mocksDemoBeforeExam(){

        return view('users.mocks_user.demo.demo_exam.mocks_demo_before_exam');
    }

    public function mocksDemoStartExam(){

        $questions=MocksDemoQuestion::all();

        return view('users.mocks_user.demo.demo_exam.mocks_demo_start_real_exam',[
         'questions'=>$questions

        ]);
    }



}
