<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//Route::controller('auth', 'AuthController');

//Client or Trainees
Route::get('/', 'BlueConnectController@getLoginForm'); 
Route::post('forgot-password', 'HomeController@forgotPassword');
Route::get('registration', 'HomeController@registerForm');   	
Route::post('registration_process', 'HomeController@registerProcess'); 

Route::get('home', 'HomeController@showIndex');
//Pages
Route::get('about_us', 'HomeController@getAbout'); 
Route::get('history', 'HomeController@getHistory'); 
Route::get('chairman', 'HomeController@getChairman'); 
Route::get('services', 'HomeController@getServices'); 
Route::get('contact_us', 'HomeController@getContactUs'); 
Route::post('contact_send', 'HomeController@SendContactMsg'); 

//Services
Route::get('consultancy', 'HomeController@getConsultancy'); 
Route::get('technology', 'HomeController@getTechnology'); 
Route::get('execution', 'HomeController@getExecution'); 
Route::get('training', 'HomeController@getTraining'); 
Route::get('outsourcing', 'HomeController@getOutsourcing'); 

//Courses
Route::get('technical', 'HomeController@getTechnical'); 
Route::get('script', 'HomeController@getScript'); 
Route::get('inbound', 'HomeController@getInbound'); 
Route::get('outbound', 'HomeController@getOutbound'); 
Route::get('contact_center', 'HomeController@getContactCenter'); 
Route::get('workshops', 'HomeController@getWorkshop'); 

Route::get('survey', 'SurveyController@surveyForm'); 
Route::post('update-feedback', 'SurveyController@updateFeedback'); 
Route::group(array('before' => 'auth.basic'), function()
{
	Route::group(array('prefix' => 'user'), function() { 
		Route::get('profile', 'UserController@profileForm');
	 	Route::post('updateProfile', 'UserController@updateUserInfo');
	 	Route::get('change_password', 'UserController@profilePasswordForm');
	 	Route::post('updatePassword', 'UserController@updateProfilePasswordData');
 	});

	Route::group(array('prefix' => 'admin'), function() {
		Route::get('dashboard', 'DashboardController@index');
		Route::get('dashboard_trainee/{id}', 'DashboardController@getUserInfo');

		Route::get('users', 'UserController@index');
	 	Route::group(array('prefix' => 'users'), function() {
			Route::get('add', 'UserController@insertForm');
		 	Route::post('addData', 'UserController@insertData');
		 	Route::get('update', 'UserController@updateForm');
		 	Route::get('confirmAttendance', 'UserController@confirmAttendance');
		 	Route::post('updateData', 'UserController@updateData');
		 	Route::post('delete', 'UserController@deleteData'); 
		 	Route::post('changePassword', 'UserController@changePassword');
		});
		
		Route::get('survey', 'SkillsMapController@surveyForm');
		//Skills Map v8
		Route::get('skills-map', 'SkillsMapController@index');
	 	Route::group(array('prefix' => 'skills-map'), function() {
			Route::get('add', 'SkillsMapController@insertForm');
			Route::post('add-feedback', 'SkillsMapController@insertFeedback');
		 	Route::post('addData', 'SkillsMapController@insertData');
		 	Route::get('update', 'SkillsMapController@updateMap');
		 	Route::post('updateData', 'SkillsMapController@updateData');
		 	Route::get('delete-feedback', 'SkillsMapController@deleteFeedback'); 	
		 	Route::post('update-feedback', 'SkillsMapController@updateFeedback'); 	
		 	Route::get('getSkillData', 'SkillsMapController@getSkillData');
		 	Route::get('deleteSkill', 'SkillsMapController@deleteSkill');	
		 	Route::post('updateSkill', 'SkillsMapController@updateSkill');		
		 	Route::get('getDescription', 'SkillsMapController@getDescription'); 
		 	Route::get('survey', 'SkillsMapController@surveyForm'); 
		 	Route::post('send-survey', 'SkillsMapController@sendSurvey');			
		});
		
		//Skills Map v7
		Route::get('skills-map-v7', 'SkillsMapControllerV7@index');
		Route::group(array('prefix' => 'skills-map-v7'), function() {
			Route::get('add', 'SkillsMapControllerV7@insertForm');
			Route::post('add-feedback', 'SkillsMapControllerV7@insertFeedback');
		 	Route::post('addData', 'SkillsMapControllerV7@insertData');
		 	Route::get('update', 'SkillsMapControllerV7@updateMap');
		 	Route::post('updateData', 'SkillsMapControllerV7@updateData');
		 	Route::get('delete-feedback', 'SkillsMapControllerV7@deleteFeedback'); 		
		 	Route::post('update-feedback', 'SkillsMapControllerV7@updateFeedback');
		 	Route::get('getSkillData', 'SkillsMapControllerV7@getSkillData'); 
		 	Route::get('deleteSkill', 'SkillsMapControllerV7@deleteSkill');	
		 	Route::post('updateSkill', 'SkillsMapControllerV7@updateSkill');	
		});

		Route::get('attendees', 'AttendeesController@index');
	 	Route::group(array('prefix' => 'attendees'), function() {
		 	Route::get('update', 'AttendeesController@updateForm');
		 	Route::post('delete', 'AttendeesController@deleteData');
		 	Route::post('updateData', 'AttendeesController@updateData');
		 	Route::get('add', 'AttendeesController@insertForm');	
		 	Route::post('addData', 'AttendeesController@insertData');
		 	Route::get('listing-info/{id}', 'AttendeesController@getListInfo');
		 	Route::get('certificate', 'AttendeesController@uploadCertificateForm');
		 	Route::post('upload-certificate', 'AttendeesController@uploadCertificate');

		 	Route::get('temp-listings', 'AttendeesController@getTempList');
		 	Route::get('temp-listings/{course}/report', 'AttendeesController@getTempListReport');
		 	Route::get('temp-listings/{course}', 'AttendeesController@getTempListSpecific');	 
		 	Route::get('temp-update', 'AttendeesController@updateTempForm');	
		 	Route::post('temp-updateData', 'AttendeesController@updateTempData');
		 	Route::get('temp-listings/export', 'AttendeesController@getTempList');
		 	Route::get('temp-listings-info/{id}', 'AttendeesController@getTempListInfo');
		 	Route::get('add-cost/{course}', 'AttendeesController@getCostForm');
		 	Route::post('update-cost', 'AttendeesController@updateCost');
		});

		Route::get('announcements', 'AnnouncementController@index');
	 	Route::group(array('prefix' => 'announcements'), function() {
			Route::get('add', 'AnnouncementController@insertForm');
		 	Route::post('addData', 'AnnouncementController@insertData');
		 	Route::get('update', 'AnnouncementController@updateForm');
		 	Route::post('updateData', 'AnnouncementController@updateData');
		 	Route::post('delete', 'AnnouncementController@deleteData'); 
		});

		Route::get('company', 'CompanyController@index');
	 	Route::group(array('prefix' => 'company'), function() {
			Route::get('add', 'CompanyController@insertForm');
		 	Route::post('addData', 'CompanyController@insertData');
		 	Route::get('update', 'CompanyController@updateForm');
		 	Route::post('updateData', 'CompanyController@updateData');
		 	Route::post('delete', 'CompanyController@deleteData'); 
		});
		
		Route::get('customers', 'CustomersController@index');
	 	Route::group(array('prefix' => 'customers'), function() {
			Route::get('add', 'CustomersController@insertForm');
		 	Route::post('addData', 'CustomersController@insertData');
		 	Route::get('update', 'CustomersController@updateForm');
		 	Route::post('updateData', 'CustomersController@updateData');
		 	Route::post('delete', 'CustomersController@deleteData'); 
		});
		
		Route::get('company-internal', 'CompanyInternalController@index');
	 	Route::group(array('prefix' => 'company-internal'), function() {
			Route::get('add', 'CompanyInternalController@insertForm');
		 	Route::post('addData', 'CompanyInternalController@insertData');
		 	Route::get('update', 'CompanyInternalController@updateForm');
		 	Route::post('updateData', 'CompanyInternalController@updateData');
		 	Route::post('delete', 'CompanyInternalController@deleteData'); 
		});

		Route::get('training-courses', 'CoursesController@index');
	 	Route::group(array('prefix' => 'training-courses'), function() {
			Route::get('add', 'CoursesController@insertForm');
		 	Route::post('addData', 'CoursesController@insertData');
		 	Route::get('update', 'CoursesController@updateForm');
		 	Route::get('view-timeline/{cid}', 'CoursesController@getTimeline');
		 	Route::get('delete-activity/{cid}/{id}', 'CoursesController@deleteActivity'); 
		 	Route::get('add-activity', 'CoursesController@insertActivity');
		 	Route::post('insert-activity', 'CoursesController@addActivity');
		 	Route::post('updateData', 'CoursesController@updateData');
		 	Route::post('delete', 'CoursesController@deleteData');
		 	Route::get('delete-file/{fid}/{id}', 'CoursesController@deleteFile'); 
		});
	 });

});

// Trainer or Faculty
Route::post('trainer/login', 'TrainerAuthController@postLogin');
Route::get('trainer/logout', 'TrainerAuthController@getLogout');

Route::group(array('before' => 'auth.faculty'), function()
{
	Route::group(array('prefix' => 'trainer'), function() {
		Route::get('dashboard', 'DashboardController@index');

		Route::get('quizzes/{id}', 'FacultyClassQuizzesController@index');
		Route::get('quizzes/add/{id}', 'FacultyClassQuizzesController@addQuizForm');
		Route::post('quizzes/addQuiz', 'FacultyClassQuizzesController@addQuiz');
		Route::get('quizzes/delete/{id}/{cid}', 'FacultyClassQuizzesController@deleteQuiz');
		Route::get('quizzes/update/{id}', 'FacultyClassQuizzesController@updateQuizForm');
		Route::post('updateQuiz', 'FacultyClassQuizzesController@updateQuiz');
		Route::get('quizzes/students/{id}', 'FacultyClassQuizzesController@getStudents');
		Route::get('quizzes/getDetails/{id}', 'FacultyClassQuizzesController@getQuizDetails');
		Route::get('quizzes/view/{id}/{cid}', 'FacultyClassQuizzesController@viewQuiz');

		Route::get('wall-announcement/{course_id}', 'FacultyLectureWallController@index');		
		Route::get('addComment', 'FacultyLectureWallController@addComment');	
		Route::get('updateComment', 'FacultyLectureWallController@updateComment');
		Route::get('deletePost', 'FacultyLectureWallController@deletePost');
		Route::get('deleteComment', 'FacultyLectureWallController@deleteComment');
		Route::get('updatePost', 'FacultyLectureWallController@updatePost');	
		Route::post('lectureWall', 'FacultyLectureWallController@postIt');	

		Route::get('profile', 'FacultyProfileController@profileForm');
	 	Route::post('updateProfile', 'FacultyProfileController@updateUserInfo');
	 	Route::get('change_password', 'FacultyProfileController@profilePasswordForm');
	 	Route::post('updatePassword', 'FacultyProfileController@updateProfilePasswordData');

		Route::get('calendar', 'FacultyDashboardController@index');

		// Announcements
		Route::get('announcements', 'FacultyAnnouncementController@index');

		// Quizzes
		Route::get('class/{id}/{group_code}/quizzes', 'FacultyClassQuizzesController@index');
		
		// Lecture Wall

		// Get Notification
		Route::get('notification', 'NotificationController@index');
		Route::get('faculty_notification', 'NotificationController@facultyNotification');
	});
});

// Trainee or Student
Route::post('trainee/login', 'StudentAuthController@postLogin');
Route::get('trainee/logout', 'StudentAuthController@getLogout');

Route::group(array('before' => 'auth.student'), function()
{
	Route::group(array('prefix' => 'trainee'), function() {				
		Route::get('certificate', 'AttendeesController@getCertificate');
		Route::get('enrolled-training/{id}', 'TraineeController@enrolledTraining');
		Route::get('calendar/{id}', 'TraineeController@timelineView');
		#Route::get('skills-map', 'TraineeSkillsMapController@index');
		Route::post('registration_process', 'TraineeController@registerProcess');
		Route::post('profiling', 'TraineeController@profiling');

		Route::get('wall-announcement/{course_id}', 'StudentLectureWallController@index');		
		Route::get('addComment', 'StudentLectureWallController@addComment');	
		Route::get('updateComment', 'StudentLectureWallController@updateComment');
		Route::get('deletePost', 'StudentLectureWallController@deletePost');
		Route::get('deleteComment', 'StudentLectureWallController@deleteComment');
		Route::get('updatePost', 'StudentLectureWallController@updatePost');	
		Route::post('lectureWall', 'StudentLectureWallController@postIt');	
		
		Route::get('skills-map', 'SkillsMapController@updateMap');		
		Route::get('skills-map-v7', 'SkillsMapControllerV7@updateMap');	

		Route::group(array('prefix' => 'skills-map'), function() {
			Route::get('getSkillData', 'SkillsMapController@getSkillData');		 	
		});

		Route::group(array('prefix' => 'skills-map-v7'), function() {
			Route::get('getSkillData', 'SkillsMapControllerV7@getSkillData');		 	
		});

		Route::get('engineers', 'SkillsMapController@getEngineers');
		Route::get('engr-skills-map', 'SkillsMapController@getSkillEngineers');
		Route::get('engr-skills-map-v7', 'SkillsMapControllerV7@getSkillEngineers');

		Route::get('dashboard', 'DashboardController@index');
		Route::get('profile', 'StudentProfileController@profileForm');
		Route::post('send-mail', 'StudentProfileController@send_email');
	 	Route::post('updateProfile', 'StudentProfileController@updateUserInfo');
	 	Route::get('change_password', 'StudentProfileController@profilePasswordForm');
	 	Route::post('updatePassword', 'StudentProfileController@updateProfilePasswordData');

		//Enrolled Training
		#Route::get('enrolled-training/{id}', 'StudentLectureWallController@index');	
		Route::get('enrolled-training/{id}/quizzes', 'StudentClassQuizzesController@index');
		Route::post('enrolled-training/{id}/lectureWall', 'StudentLectureWallController@postIt');	
		Route::get('enrolled-training/{id}/addComment', 'StudentLectureWallController@addComment');	
		Route::get('enrolled-training/{id}/deletePost', 'StudentLectureWallController@deletePost');
		Route::get('enrolled-training/{id}/deleteComment', 'StudentLectureWallController@deleteComment');
		Route::get('enrolled-training/{id}/updatePost', 'StudentLectureWallController@updatePost');	
		Route::get('enrolled-training/{id}/updateComment', 'StudentLectureWallController@updateComment');

		Route::get('quizzes/{id}', 'StudentClassQuizzesController@index');
		Route::get('quizzes/take/{id}/{cid}', 'StudentClassQuizzesController@takeQuizForm');
		Route::post('quizzes/submitQuiz', 'StudentClassQuizzesController@submitQuiz');

		// Announcements
		Route::get('announcements', 'StudentAnnouncementController@index');
		
		// Trainings
		Route::get('trainings', 'StudentTrainingController@index');
		Route::post('learning-expectations', 'StudentTrainingController@registerStep1');
		Route::post('register-final-step', 'StudentTrainingController@registerStep2');

		// Quizzes

		// Get Notification
		Route::get('notification', 'NotificationController@index');
	});
});

/* Error */
Route::controller('error', 'ErrorController');

App::missing(function(){
	return Redirect::to('error/pagenotfound');
});