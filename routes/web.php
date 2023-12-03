<?php

use App\Http\Controllers\login_registration\MainLoginRegistrationController;
use App\Http\Controllers\super_admin\user_management\subscription\MainSubscriptionController;
use App\Http\Controllers\super_admin\user_management\user\MainUserController;
use App\Http\Controllers\super_admin\user_management\mocks_management\MainMocksManagementController;
use App\Http\Controllers\users\mocks_user\account_reset\MainAccountResetController;
use App\Http\Controllers\users\mocks_user\demo\MainMocksDemoController;
use App\Http\Controllers\users\mocks_user\exam\MainExamController;
use App\Http\Controllers\users\mocks_user\graph\MainGraphController;
use App\Http\Controllers\users\mocks_user\help\MainHelpController;
use App\Http\Controllers\users\mocks_user\mocks_list\MainMocksListController;
use App\Http\Controllers\users\mocks_user\mocks_Result\MainMocksResultController;
use App\Http\Controllers\users\mocks_user\mocks_user_test_history\MainMocksUserTestHistoryController;
use App\Http\Controllers\users\mocks_user\MocksUserMainController;
use App\Http\Controllers\users\mocks_user\previous_mocks\MainPreviousMocksController;
use App\Http\Controllers\users\mocks_user\question_preview\MainQuestionPreviewController;
use App\Http\Controllers\users\mocks_user\report\MainReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\super_admin\mocks\question_preview\MainQuestionPreview2Controller;
use App\Http\Controllers\super_admin\mocks\demo\MainMocksDemoController2;


// super-admin main controller
use App\Http\Controllers\super_admin\MainController;

// mocks controller
use App\Http\Controllers\super_admin\mocks\subject\MainSubjectController;
use App\Http\Controllers\super_admin\mocks\speciality\MainSpecialityController;
use App\Http\Controllers\super_admin\mocks\topic\MainTopicController;
use App\Http\Controllers\super_admin\mocks\question\MainQuestionController;
use App\Http\Controllers\super_admin\mocks\test\MainTestController;
use App\Http\Controllers\super_admin\mocks\upload\MainMocksUploadController;

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

// Handle login form request
Route::post('/login', [MainLoginRegistrationController::class, 'login']);

// Handle registration form request
Route::post('/register', [MainLoginRegistrationController::class, 'register']);

//#################################  EMAIL SENDING ROUTES ##################################################

Route::get('/email_verification/{token}', [MainLoginRegistrationController::class, 'emailVerification'])->name('email.verification');

Route::post('/forgot_password', [MainLoginRegistrationController::class, 'forgotPassword'])->name('forgot.password');

Route::post('/change_password', [MainLoginRegistrationController::class, 'changePassword'])->name('change.password');

Route::get('/reset_password/{token}', [MainLoginRegistrationController::class, 'passwordRest'])->name('password.reset');

Route::post('/contact_us', [MainLoginRegistrationController::class, 'ContactUs'])->name('contact.us');



//#################################  MAIN DASHBOARD FOR  SUPER ADMIN ROUTES ##################################################

Route::middleware('superadmin')->group(function () {
    // Super admin main route
    Route::match(['get', 'post'], '/super_dashboard', [MainController::class, 'superAdminView']);

    // logout function for super admin
    Route::match(['get', 'post'],'/super_logout', [MainLoginRegistrationController::class, 'superAdminLogout']);
});

//#################################  MAIN DASHBOARD FOR USER ROUTES ##################################################

Route::middleware('user')->group(function () {
    // User main dashboard
    Route::match(['get', 'post'], '/user_dashboard', [MainController::class, 'userAdminView']);

    // Update the user profile information on the main index page
    Route::post('/update_user_profile_info', [MainController::class, 'updateUserProfileInfo']);

    // Change user password
    Route::post('/change_user_password', [MainController::class, 'updateUserPassword']);

    // logout function for users
    Route::match(['get', 'post'],'/user_logout', [MainLoginRegistrationController::class, 'userLogout']);
});


//#################################  MOCK SUPER ADMIN UPLOAD IMAGES AND VIDEO ROUTES ##################################################

Route::middleware('superadmin')->group(function () {

    // upload images view
    Route::get('/show_mocks_image_view', [MainMocksUploadController::class, 'showMocksImageView']);
    // upload mocks image
    Route::post('/upload_mocks_image', [MainMocksUploadController::class, 'uploadMocksImage']);

    // load image data to datatable
    Route::get('/load_mocks_images', [MainMocksUploadController::class, 'loadMocksImages']);

    // delete mocks image
    Route::delete('/delete_mocks_image/{image_id}', [MainMocksUploadController::class, 'deleteMocksImage']);






});


//#################################  MOCK SUPER ADMIN ROUTES ##################################################

Route::middleware('superadmin')->group(function () {
    // Subject routes
    Route::match(['get', 'post'], '/subject_view', [MainSubjectController::class, 'mainView']);

    Route::match(['get', 'post'], '/subject_add', [MainSubjectController::class, 'addView']);

    // Add the subject to the table route
    Route::match(['get', 'post'], '/add_subject', [MainSubjectController::class, 'addSubject'])
        ->name('super_admin.add_subject');

    // Load data to datatable
    Route::match(['get', 'post'], '/load_subject', [MainSubjectController::class, 'getSubjectsForDataTable'])
        ->name('super_admin.load_subject');

    // Delete subject from the table
    Route::delete('/delete_subject/{subjectId}', [MainSubjectController::class, 'deleteSubject'])
        ->name('super_admin.delete_subject');

    // Load data to model of the subject
    Route::get('/edit_subject/{subjectId}', [MainSubjectController::class, 'editSubject'])
        ->name('super_admin.edit_subject');

    // Update the subject data in the database
    Route::put('/update_subject/{subjectId}', [MainSubjectController::class, 'updateSubject'])
        ->name('super_admin.update_subject');
});


/// SPECIALITY SECTION  ////////////////////////////////////////////////////

Route::middleware('superadmin')->group(function () {
    // Speciality routes
    Route::get('/speciality_view', [MainSpecialityController::class, 'mainView']);

    Route::get('/speciality_add', [MainSpecialityController::class, 'addView']);

    // Add speciality to the database
    Route::match(['get', 'post'], '/add_specialty', [MainSpecialityController::class, 'addSpeciality'])
        ->name('addSpeciality');

    // Load speciality data into datatable
    Route::get('/get_speciality_data', [MainSpecialityController::class, 'getSpecialityData']);

    // Delete speciality from the table
    Route::delete('/delete_speciality/{id}', [MainSpecialityController::class, 'deleteSpeciality']);

    // Load data to model speciality for update
    Route::get('/load_data_to_model/{specialityId}', [MainSpecialityController::class, 'loadDataToModel']);

    // Update the speciality in the table
    Route::put('/update_speciality/{id}', [MainSpecialityController::class, 'updateSpeciality']);
});


//TOPIC SECTION ####################################################################################

Route::middleware('superadmin')->group(function () {
    // Topic routes
    Route::get('/topic_view', [MainTopicController::class, 'mainView']);

    Route::get('/topic_add', [MainTopicController::class, 'addView']);

    // Fetch the subject to the select element
    Route::get('/fetch_subjects', [MainTopicController::class, 'fetchSubjects']);

    // Fetch speciality related to the subject to the form
    Route::get('/load_specialities/{subjectId}', [MainTopicController::class, 'fetchSpecialities']);

    // Add topic to the tables
    Route::post('/add_topic', [MainTopicController::class, 'addTopic']);

    // Load topic data into the datatable
    Route::get('/get_topic_data', [MainTopicController::class, 'getTopicData']);

    // Delete speciality from the table
    Route::delete('/delete_topic/{id}', [MainTopicController::class, 'deleteTopic']);

    // Load the speciality related to the subject
    Route::post('/fetch_specialities', [MainTopicController::class, 'loadSpecialities']);

    // Update the topic and association
    Route::post('/update_topic/{topicId}', [MainTopicController::class, 'updateTopic']);
});


//QUESTION SECTION ###########################################################################################

Route::middleware('superadmin')->group(function () {
    // Question routes
    Route::get('/question_view', [MainQuestionController::class, 'mainView']);

    Route::get('/question_add', [MainQuestionController::class, 'addView']);

    // Load the topic which is related to subject and speciality
    Route::get('/load_topics/{subjectId}/{specialityId}', [MainQuestionController::class, 'loadTopics']);

    // Add question to the table
    Route::post('/questions/create', [MainQuestionController::class, 'questionStore'])
        ->name('questions.create');

    // Load question to the datatable
    Route::get('get_question_data', [MainQuestionController::class, 'getQuestionData'])
        ->name('get_question_data');

    // Delete question from the table
    Route::delete('/delete/question/{question_id}', [MainQuestionController::class, 'deleteQuestion'])
        ->name('questions.delete');

    // Load the question data to the model for edit
    Route::get('/edit_question_loader/{questionId}', [MainQuestionController::class, 'editQuestionLoader'])
        ->name('question.update');

    // Update the question
    Route::post('/update-question', [MainQuestionController::class, 'updateQuestion'])
        ->name('question.update');

    // Show question preview
    Route::get('/question_preview/{question_id}', [MainQuestionPreview2Controller::class, 'showQuestionPreview']);
});




//TEST SECTION ######################################################

Route::middleware('superadmin')->group(function () {
    // Test routes
    Route::get('/test_view', [MainTestController::class, 'mainView']);

    Route::get('/test_add', [MainTestController::class, 'addView']);

    // Load question to the datatable for selection
    Route::get('/test/get_question_data', [MainTestController::class, 'getQuestionData'])
        ->name('test.get_question_data');

    // Create test
    Route::post('/create_test', [MainTestController::class, 'createTest'])
        ->name('test.create');

    // Load tests data into table
    Route::get('/get_test_data', [MainTestController::class, 'getTestData'])
        ->name('get_test_data');

    // Delete the test
    Route::delete('/delete_test/{test_id}', [MainTestController::class, 'deleteTest'])
        ->name('tests.destroy');

    // Load edit test view
    Route::get('/edit_test/{test_id}', [MainTestController::class, 'editTest'])
        ->name('test.edit');

    // Load the question relation to the test and also null question
    Route::post('/edit_test_data', [MainTestController::class, 'editQuestion'])
        ->name('test.edit_test_data');

    // Load test data to the form
    Route::get('/load_test_data/{test_id}', [MainTestController::class, 'loadTestData'])
        ->name('test.load_test_data');

    // Update question
    Route::post('/test/update_test', [MainTestController::class, 'updateTest'])
        ->name('test.update_test');
});


//#################################  SUPER ADMIN USER MANAGEMENT ROUTES ##################################################

Route::middleware('superadmin')->group(function () {
    // User routes
    Route::get('/user_view', [MainUserController::class, 'userView']);

    Route::get('/get_user_data', [MainUserController::class, 'getUserData']);

    Route::get('/add_user_view', [MainUserController::class, 'addUserView']);

    Route::post('/add_user', [MainUserController::class, 'addUser']);

    // Define the route for deleting a user
    Route::delete('/delete_user/{userId}', [MainUserController::class, 'deleteUser']);

    Route::post('/update_user', [MainUserController::class, 'updateUser']);

    // Add subscription to users
    Route::get('/add_subscription_to_user', [MainUserController::class, 'addSubscriptionToUser']);
});




//#################################  SUPER ADMIN USER SUBSCRIPTION ROUTES ##################################################

Route::middleware('superadmin')->group(function () {
    // Subscription routes
    Route::get('/add_subsription_view', [MainSubscriptionController::class, 'addSubscriptionView']);

    Route::post('/add_subscription', [MainSubscriptionController::class, 'addSubscription']);

    Route::get('/subscription_view', [MainSubscriptionController::class, 'subscriptionView']);

    Route::get('/get_subscription_data', [MainSubscriptionController::class, 'getSubscriptionData']);

    Route::delete('/delete_subscription/{subscriptionId}', [MainSubscriptionController::class, 'deleteSubscription']);

    Route::post('/update_subscription', [MainSubscriptionController::class, 'updateSubscription']);

    // Add subscription to users
    Route::get('/get_subscription_names', [MainSubscriptionController::class, 'getSubscriptions']);

    Route::post('/add_subscription_to_user', [MainSubscriptionController::class, 'addSubscriptiontoUser']);

    Route::get('/load_subcription_data_to_table', [MainSubscriptionController::class, 'getSubscriptionDatatoTable']);

    Route::delete('/delete_user_subscription/{subscriptionId}', [MainSubscriptionController::class, 'deleteUserSubscription']);

    Route::post('/update_user_subscription_data', [MainSubscriptionController::class, 'updateUserSubscription']);

    // Manage mocks for different users routes
    Route::get('/mocks_user_view', [MainMocksManagementController::class, 'mocksUserView']);

    // Load mocks subscribe user
    Route::get('/get_mocks_user_data', [MainMocksManagementController::class, 'getMocksUserData']);

    // Add mocks to test to the user
    Route::get('/add_mocks_to_mocks_user_view/{user_id}', [MainMocksManagementController::class, 'loadAddMocksUserView']);

    Route::post('/save-mocks-to-user', [MainMocksManagementController::class, 'saveMocksToUser'])
        ->name('save-mocks-to-user');
});


//#################################  SUPER ADMIN MOCKS DEMO ROUTES ##################################################

Route::middleware('superadmin')->group(function () {

    Route::get('/show_add_mocks_demo_question_view', [MainMocksDemoController2::class, 'showAddMocksDemoQuestionView']);

    Route::post('/add_mocks_demo_question', [MainMocksDemoController2::class, 'addMocksDemoQuestion']);

    Route::get('/mocks_demo_question_view', [MainMocksDemoController2::class, 'showDemoQuestionView']);

    Route::get('/mocks_demo_question_load', [MainMocksDemoController2::class, 'showDemoQuestionInTable']);

    Route::delete('/delete_mocks_demo_question/{question_id}', [MainMocksDemoController2::class, 'deleteMocksDemoQuestion']);

    Route::get('/load_mocks_demo_question/{questionId}', [MainMocksDemoController2::class, 'editQuestionLoader']);

    Route::post('/updat_mocks_demo_question', [MainMocksDemoController2::class, 'updateMocksDemoQuestion']);

    Route::get('/mocks_demo_question_preview/{questionId}', [MainMocksDemoController2::class, 'showMocksDemoQuestionPreview']);
});

//#################################  MOCKS USERS ROUTES ##################################################

Route::middleware('subscription:MOCKS')->group(function () {

    Route::get('/mocks_user_welcome/{subscription_id?}', [MocksUserMainController::class, 'welcomeView']);

    Route::get('/mocks_user_graph', [MainGraphController::class, 'graphView']);

    Route::get('/mocks_user_report', [MainReportController::class, 'reportView']);

    Route::get('/mocks_user_help', [MainHelpController::class, 'helpView']);

    // mocklist routes ########################################################
    Route::get('/mocks_user_mocks_list', [MainMocksListController::class, 'mocksListView']);

    Route::get('/store_user_mocks_id', [MainMocksListController::class, 'storeMocksId']);

    Route::get('/mocks_user_previous_mocks', [MainPreviousMocksController::class, 'previousMocksView']);

    Route::get('/mocks_user_mocks_result/{custom_mocks_id}', [MainMocksResultController::class, 'mocksResultView']);

    Route::get('/mocks_user_mocks_analytics/{custom_mocks_id}', [MainMocksResultController::class, 'mocksAnalyticsView']);

    //#################################  MOCKS EXAM LUNCH ROUTES ##################################################
    Route::get('/mocks_lunch', [MainExamController::class, 'mocksLunchMocks']);

    Route::get('/mocks_terms', [MainExamController::class, 'mocksTerms']);

    Route::get('/mocks_start', [MainExamController::class, 'mocksStart']);

    // ###################################  MOCKS USER HISTORY ROUTES ##################
    Route::post('/generate_user_mock_history', [MainMocksUserTestHistoryController::class, 'generateMocksHistory']);

    // ###################################  MOCKS USER ACCOUNT RESET ROUTES ##################
    Route::get('/account_reset_view', [MainAccountResetController::class, 'showAccountResetView']);

    Route::get('/mocks_user_account_reset', [MainAccountResetController::class, 'mocksUserAccountReset']);

    // ###################################  MOCKS USER  QUESTION PREVIEW ROUTES ##################
    Route::get('/show_mocks_user_question_preview/{user_mocks_id}/{question_id?}', [MainQuestionPreviewController::class, 'showQuestionPreviewView']);
});

// ###################################  MOCKS USER DEMO ROUTES ##################

Route::middleware('user')->group(function () {

    Route::get('/lunch_mocks_demo', [MainMocksDemoController::class, 'lunchMocksDemo']);

    Route::get('/mocks_list_demo', [MainMocksDemoController::class, 'mocksListDemo']);

    Route::get('/mocks_previous_demo', [MainMocksDemoController::class, 'mocksPreviousDemo']);

    Route::get('/mocks_result_demo', [MainMocksDemoController::class, 'mocksResultDemo']);

    Route::get('/mocks_analytics_demo', [MainMocksDemoController::class, 'mocksAnalyticsDemo']);

    Route::get('/mocks_preview_demo', [MainMocksDemoController::class, 'mocksPreviewDemo']);

    Route::get('/mocks_report_demo', [MainMocksDemoController::class, 'mocksReportDemo']);

    Route::get('/mocks_graph_demo', [MainMocksDemoController::class, 'mocksGraphDemo']);

    Route::get('/mocks_account_reset_demo', [MainMocksDemoController::class, 'mocksAccountResetDemo']);

    Route::get('/mocks_demo_exam_lunch', [MainMocksDemoController::class, 'mocksDemoExamLunch']);

    Route::get('/mocks_demo_before_exam', [MainMocksDemoController::class, 'mocksDemoBeforeExam']);

    Route::get('/mocks_demo_start_exam', [MainMocksDemoController::class, 'mocksDemoStartExam']);

});














