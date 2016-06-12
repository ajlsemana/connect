<?php 

class StudentTrainingController extends BaseController {
	private $data = array();
	private $allowed = array(3);	
	
	protected $layout = "layouts.student_main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->data['video_status'] = Student::checkVideoStatus(Auth::user()->id, Request::segment(3));

		if (! in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('student/logout');
		}
	}
	
	public function index() {
		$this->data['courses'] = Training::getCourses();	
		$this->data['attendees'] = Training::getReserved();	

		$this->layout->content = View::make('student.trainings', $this->data);		
	}

	public function registerStep1() {	
		$courses = Input::get('courses');	
		$this->data['courses'] = $courses;

		$this->layout->content = View::make('student.register_final', $this->data);		
	}

	public function registerStep2() {
		$expectations = Input::get('post_msg');	

		foreach($expectations as $key => $value):
			$arrParams = array(
								'uid'			=> Auth::user()->id,
								'courses'		=> Input::get('cid')[$key],
								'attendance_status'	=> 'New',
								'expectations'  => $value,			
								'created_at'	=> date('Y-m-d H:i:s'),
								'updated_at'	=> date('Y-m-d H:i:s')
						);

			$id = Training::registerProcess($arrParams);		
		endforeach;

		return Redirect::to('student/trainings')
			->with('success', 'Successfully registered! Please wait while we are processing your registration for attendance.');	
	}
}