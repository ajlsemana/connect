<?php 

class TraineeController extends BaseController {
	private $data = array();
	private $allowed = array(3);
	
	protected $layout = "layouts.main";
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->data['route'] = Route::getCurrentRoute()->getPath();	
		
		if (!in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('auth/logout');
		}
	}
	
	public function index() {
		$this->getList();
	}
	
	protected function profiling() {
		$ans = Input::get('answer1').'|'.Input::get('answer2').'|'.Input::get('rate');
		$birth = Input::get('birth');
		$cid = Input::get('course');

		$info = array(
			'uid' => Auth::user()->id,
			'cid' => $cid,
			'birthday' => $birth,
			'outcomes' => $ans
		);
		Registrants::addProfile($info, Input::get('id'));

		return Redirect::to('trainee/dashboard')
		->with('success', 'Successfully completed your profile.');														
	}
	
	protected function registerProcess() {
		$rules = array('course' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('trainee/dashboard')
				->withErrors($validator)
				->withInput();
		} else {
			for($ctr = 0; $ctr < count(Input::get('course')); $ctr++):
				$info = array(
						'uid' => Auth::id(),
						'course' => Input::get('course')[$ctr],
						'attendance_status' => 'New'
					);			
				Registrants::addAttendee($info);
			endfor;

			return Redirect::to('trainee/dashboard')
			->with('success', 'Successfully registered for the training course.');														
		}	
	}

	public function enrolledTraining() {				
		$this->data['course'] = EnrolledCourses::getCourseName(Input::segment(3));
		
		$this->data['menu'] = View::make('student.menu_tabs', $this->data);
		$this->data['module'] = '';

		$this->layout->content = View::make('trainee.enrolled_courses', $this->data);
	}

	public function timelineView() {		
		$this->data['results'] = Courses::getTimeline(Input::segment(3));
		$this->data['course'] = EnrolledCourses::getCourseName(Input::segment(3));
		$this->data['menu'] = View::make('student.menu_tabs', $this->data);	
		$this->data['module'] = 'Calendar';

		$this->layout->content = View::make('courses.timeline', $this->data);
	}
}