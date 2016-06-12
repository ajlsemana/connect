<?php 

class DashboardController extends BaseController {
	private $data = array();
	private $allowed = array(1, 2, 3);
	
	protected $layout = "layouts.main";

	public function __construct() {
		$this->data['route'] = Route::getCurrentRoute()->getPath();	
		$this->beforeFilter('csrf', array('on' => 'post'));

		if (!in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('auth/logout');
		}
	}
	
	public function index() {	
		$results = User::getNewlyRegistered();
		$this->data['total'] = User::getTotalPopulation();		
		$this->data['users'] = $results;

		if(Auth::user()->user_type == 1) {
			$this->layout->content = View::make('dashboard.index', $this->data);
		} elseif(Auth::user()->user_type == 2) {
			$this->data['announcements'] = Announcement::getAllAnnouncements();
			$this->data['course_options'] = Courses::getOpenCourses();			
			
			$this->layout->content = View::make('dashboard.trainer_index', $this->data);
		} elseif(Auth::user()->user_type == 3) {						
			$this->data['announcements'] = Announcement::getAllAnnouncements();
			$this->data['course_options'] = Courses::getOpenCourses();
			$this->data['enrolled_courses'] = Courses::getEnrolledCourses();			
			$this->data['profiling'] = User::getRegProfile();						
			$this->data['profiling_ctr'] = count($this->data['profiling']);	
				
			$this->layout->content = View::make('dashboard.trainee_index', $this->data);			
		} elseif(Auth::user()->user_type == 5) {				
			$this->data['announcements'] = Announcement::getAllAnnouncements();
			$this->data['course_options'] = Courses::getOpenCourses();
			$this->data['enrolled_courses'] = Courses::getEnrolledCourses();
			
			$this->layout->content = View::make('dashboard.trainee_index', $this->data);
		}
	}

	public function getUserInfo() {	
		$results = User::getInfo((int) Request::segment(3));
		$this->data['total'] = User::getTotalPopulation();	
		$this->data['users'] = $results;

		$this->layout->content = View::make('dashboard.index', $this->data);
	}	
}