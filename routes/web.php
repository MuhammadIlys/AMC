<?php

use App\Http\Controllers\login_registration\MainLoginRegistrationController;
use App\Http\Controllers\super_admin\user_management\subscription\MainSubscriptionController;
use App\Http\Controllers\super_admin\user_management\user\MainUserController;
use App\Http\Controllers\users\mocks_user\exam\MainExamController;
use App\Http\Controllers\users\mocks_user\graph\MainGraphController;
use App\Http\Controllers\users\mocks_user\help\MainHelpController;
use App\Http\Controllers\users\mocks_user\mocks_list\MainMocksListController;
use App\Http\Controllers\users\mocks_user\mocks_Result\MainMocksResultController;
use App\Http\Controllers\users\mocks_user\mocks_user_test_history\MainMocksUserTestHistoryController;
use App\Http\Controllers\users\mocks_user\MocksUserMainController;
use App\Http\Controllers\users\mocks_user\previous_mocks\MainPreviousMocksController;
use App\Http\Controllers\users\mocks_user\report\MainReportController;
use Illuminate\Support\Facades\Route;

// super-admin main controller
use App\Http\Controllers\super_admin\MainController;

// mocks controller
use App\Http\Controllers\super_admin\mocks\subject\MainSubjectController;
use App\Http\Controllers\super_admin\mocks\speciality\MainSpecialityController;
use App\Http\Controllers\super_admin\mocks\topic\MainTopicController;
use App\Http\Controllers\super_admin\mocks\question\MainQuestionController;
use App\Http\Controllers\super_admin\mocks\test\MainTestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//#################################  LOGIN AND REGISTRATION LOGIC HANDLER ROUTES ##################################################

// show main login page
Route::get('/', [MainLoginRegistrationController::class, 'showLogin']);

// logout function for super admin
Route::match(['get', 'post'],'/super_logout', [MainLoginRegistrationController::class, 'superAdminLogout'])
->middleware('superadmin');

// logout function for users
Route::match(['get', 'post'],'/user_logout', [MainLoginRegistrationController::class, 'userLogout'])
->middleware('user');


// Handle login form request
Route::post('/login', [MainLoginRegistrationController::class, 'login']);

// Handle registration form request
Route::post('/register', [MainLoginRegistrationController::class, 'register']);



//#################################  MAIN DASHBOARD FOR USER AND SUPER ADMIN ROUTES ##################################################


// super admin main route
Route::match(['get', 'post'],'/super_dashboard', [MainController::class,'superAdminView'])->middleware('superadmin');

// user main dashbaord
Route::match(['get', 'post'],'/user_dashboard', [MainController::class,'userAdminView'])
->middleware('user');


// update the user profile information main index page

Route::post('/update_user_profile_info', [MainController::class, 'updateUserProfileInfo'])
->middleware('user');

//

Route::post('/change_user_password', [MainController::class, 'updateUserPassword'])
->middleware('user');



//#################################  MOCK SUPER ADMIN ROUTES ##################################################


//subject routes
Route::match(['get', 'post'],'/subject_view', [MainSubjectController::class,'mainView'])->middleware('superadmin');
Route::match(['get', 'post'],'/subject_add', [MainSubjectController::class,'addView'])->middleware('superadmin');

// add the subject to the table route
Route::match(['get', 'post'], '/add_subject', [MainSubjectController::class, 'addSubject'])
->name('super_admin.add_subject')
->middleware('superadmin');

// load data to datatable
Route::match(['get', 'post'], '/load_subject', [MainSubjectController::class, 'getSubjectsForDataTable'])
->name('super_admin.load_subject')
->middleware('superadmin');

// delete subject from table
Route::delete('/delete_subject/{subjectId}', [MainSubjectController::class, 'deleteSubject'])
    ->name('super_admin.delete_subject')
    ->middleware('superadmin');

//load data to model of the subject

Route::get('/edit_subject/{subjectId}', [MainSubjectController::class, 'editSubject'])
->name('super_admin.edit_subject')
->middleware('superadmin');

//update the subject data in database
Route::put('/update_subject/{subjectId}', [MainSubjectController::class, 'updateSubject'])
    ->name('super_admin.update_subject')
    ->middleware('superadmin');


/// SPECIALITY SECTION  ////////////////////////////////////////////////////


Route::get('/speciality_view', [MainSpecialityController::class,'mainView'])
->middleware('superadmin');

Route::get('/speciality_add', [MainSpecialityController::class,'addView'])
->middleware('superadmin');



// add speciality to the database

Route::match(['get', 'post'],'/add_specialty', [MainSpecialityController::class, 'addSpeciality'])
->name('addSpeciality')
->middleware('superadmin');

// load speciality data into datatable

Route::get('/get_speciality_data', [MainSpecialityController::class, 'getSpecialityData'])
->middleware('superadmin');

// delete speciality from the table

Route::delete('/delete_speciality/{id}', [MainSpecialityController::class, 'deleteSpeciality'])
->middleware('superadmin');

// load data to model speciality for update

Route::get('/load_data_to_model/{specialityId}', [MainSpecialityController::class, 'loadDataToModel'])
->middleware('superadmin');

//pdate the speciality in the table

Route::put('/update_speciality/{id}', [MainSpecialityController::class, 'updateSpeciality'])
->middleware('superadmin');


//TOPIC SECTION ####################################################################################


Route::get('/topic_view', [MainTopicController::class,'mainView'])->middleware('superadmin');
Route::get('/topic_add', [MainTopicController::class,'addView'])->middleware('superadmin');

// fetch the subject to the select element

Route::get('/fetch_subjects', [MainTopicController::class, 'fetchSubjects'])
->middleware('superadmin');

// fetch speciality related to the subject to the form
Route::get('/load_specialities/{subjectId}', [MainTopicController::class, 'fetchSpecialities'])
    ->middleware('superadmin');

// add topic to the tables
Route::post('/add_topic', [MainTopicController::class, 'addTopic'])
->middleware('superadmin');

// load topic data into datatable

Route::get('/get_topic_data', [MainTopicController::class, 'getTopicData'])
->middleware('superadmin');


// delete speciality from the table

Route::delete('/delete_topic/{id}', [MainTopicController::class, 'deleteTopic'])
->middleware('superadmin');

//load the speciality related to subject

Route::post('/fetch_specialities', [MainTopicController::class, 'loadSpecialities'])
->middleware('superadmin');


// update the topic and assoication


Route::post('/update_topic/{topicId}', [MainTopicController::class, 'updateTopic'])
->middleware('superadmin');


//QUESTION SECTION ###########################################################################################

Route::get('/question_view', [MainQuestionController::class,'mainView'])
->middleware('superadmin');
Route::get('/question_add', [MainQuestionController::class,'addView'])
->middleware('superadmin');

// load the topic which is related to subject and speciality

Route::get('/load_topics/{subjectId}/{specialityId}', [MainQuestionController::class,'loadTopics'])
->middleware('superadmin');

// add question to the table

Route::post('/questions/create', [MainQuestionController::class,'questionStore'])
->name('questions.create')
->middleware('superadmin');


// load question to the datatable

Route::get('get_question_data', [MainQuestionController::class,'getQuestionData'])
->name('get_question_data')
->middleware('superadmin');

// delete question from table

Route::delete('/delete/question/{question_id}', [MainQuestionController::class, 'deleteQuestion'])
->name('questions.delete')
->middleware('superadmin');

// load the question data to model for edit

Route::get('/edit_question_loader/{questionId}', [MainQuestionController::class, 'editQuestionLoader'])
->name('question.update')
->middleware('superadmin');


//update the question

Route::post('/update-question', [MainQuestionController::class, 'updateQuestion'])
->name('question.update')
->middleware('superadmin');


//TEST SECTION ######################################################


Route::get('/test_view', [MainTestController::class,'mainView'])->middleware('superadmin');
Route::get('/test_add', [MainTestController::class,'addView'])->middleware('superadmin');


// load question to the datatable for selection

Route::get('/test/get_question_data', [MainTestController::class,'getQuestionData'])
->name('test.get_question_data')
->middleware('superadmin');

// create test

Route::post('/create_test',  [MainTestController::class,'createTest'])
->name('test.create')
->middleware('superadmin');

// load tests data into table
Route::get('/get_test_data',  [MainTestController::class,'getTestData'])
->name('get_test_data')
->middleware('superadmin');

// delete the test

Route::delete('/delete_test/{test_id}', [MainTestController::class,'deleteTest'])
->name('tests.destroy')
->middleware('superadmin');

// load edit test view

Route::get('/edit_test/{test_id}', [MainTestController::class,'editTest'])
->name('test.edit')
->middleware('superadmin');

// load the question relation to the test and also null question

Route::post('/edit_test_data', [MainTestController::class,'editQuestion'])
->name('test.edit_test_data')
->middleware('superadmin');

// load test data to the form

Route::get('/load_test_data/{test_id}', [MainTestController::class,'loadTestData'])
->name('test.load_test_data')
->middleware('superadmin');

// update question

Route::post('/test/update_test', [MainTestController::class,'updateTest'])
->name('test.update_test')
->middleware('superadmin');


//#################################  SUPER ADMIN USER MANAGEMENT ROUTES ##################################################

Route::get('/user_view', [MainUserController::class,'userView'])
->middleware('superadmin');

Route::get('/get_user_data', [MainUserController::class,'getUserData'])
->middleware('superadmin');


Route::get('/add_user_view', [MainUserController::class,'addUserView'])
->middleware('superadmin');


Route::post('/add_user', [MainUserController::class,'addUser'])
->middleware('superadmin');

// Define the route for deleting a user
Route::delete('/delete_user/{userId}', [MainUserController::class, 'deleteUser'])
->middleware('superadmin');


Route::post('/update_user', [MainUserController::class, 'updateUser'])
->middleware('superadmin');

// add subscription to the users

Route::get('/add_subscription_to_user', [MainUserController::class, 'addSubscriptionToUser'])
->middleware('superadmin');





//#################################  SUPER ADMIN USER SUBSCRIPTION ROUTES ##################################################




Route::get('/add_subsription_view', [MainSubscriptionController::class,'addSubscriptionView'])
->middleware('superadmin');

Route::post('/add_subscription', [MainSubscriptionController::class,'addSubscription'])
->middleware('superadmin');


Route::get('/subscription_view', [MainSubscriptionController::class,'subscriptionView'])
->middleware('superadmin');

Route::get('/get_subscription_data', [MainSubscriptionController::class,'getSubscriptionData'])
->middleware('superadmin');

Route::delete('/delete_subscription/{subscriptionId}',  [MainSubscriptionController::class,'deleteSubscription'])
->middleware('superadmin');

Route::post('/update_subscription', [MainSubscriptionController::class,'updateSubscription'])
->middleware('superadmin');

// add subscription to the users

Route::get('/get_subscription_names', [MainSubscriptionController::class,'getSubscriptions'])
->middleware('superadmin');

Route::post('/add_subscription_to_user', [MainSubscriptionController::class,'addSubscriptiontoUser'])
->middleware('superadmin');

Route::get('/load_subcription_data_to_table', [MainSubscriptionController::class,'getSubscriptionDatatoTable'])
->middleware('superadmin');

Route::delete('/delete_user_subscription/{subscriptionId}', [MainSubscriptionController::class,'deleteUserSubscription'])
->middleware('superadmin');

Route::post('/update_user_subscription_data', [MainSubscriptionController::class,'updateUserSubscription'])
->middleware('superadmin');



//#################################  MOCKS USERS ROUTES ##################################################

Route::get('/mocks_user_welcome/{subscription_id?}', [MocksUserMainController::class,'welcomeView'])
->middleware('subscription:MOCKS');


Route::get('/mocks_user_graph', [MainGraphController::class,'graphView'])
->middleware('subscription:MOCKS');

Route::get('/mocks_user_report', [MainReportController::class,'reportView'])
->middleware('subscription:MOCKS');
Route::get('/mocks_user_help', [MainHelpController::class,'helpView'])
->middleware('subscription:MOCKS');

// mocklist routes ########################################################
Route::get('/mocks_user_mocks_list', [MainMocksListController::class,'mocksListView'])
->middleware('subscription:MOCKS');

Route::get('/store_user_mocks_id', [MainMocksListController::class,'storeMocksId'])
->middleware('subscription:MOCKS');




Route::get('/mocks_user_previous_mocks', [MainPreviousMocksController::class,'previousMocksView'])
->middleware('subscription:MOCKS');

Route::get('/mocks_user_mocks_result/{custom_mocks_id}', [MainMocksResultController::class,'mocksResultView'])
->middleware('subscription:MOCKS');

Route::get('/mocks_user_mocks_analytics', [MainMocksResultController::class,'mocksAnalyticsView'])
->middleware('subscription:MOCKS');

//#################################  MOCKS EXAM LUNCH ROUTES ##################################################

Route::get('/mocks_lunch', [MainExamController::class,'mocksLunchMocks']);
Route::get('/mocks_terms', [MainExamController::class,'mocksTerms']);
Route::get('/mocks_start', [MainExamController::class,'mocksStart']);


// ###################################  MOCKS USER HISTORY ROUTES ##################

Route::post('/generate_user_mock_history', [MainMocksUserTestHistoryController::class,'generateMocksHistory']);











