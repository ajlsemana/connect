<?php 

class FacultyDashboardController extends BaseController {
	private $data = array();
	private $allowed = array(2);
	
	protected $layout = "layouts.faculty_main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));

		if (!in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('faculty/logout');
		}
	}
	
	public function index() {
		$univ_calendars = UniversityCalendar::getUnivCalendar();
		$array_cal = array();

		if($univ_calendars) {
			foreach($univ_calendars as $univ_calendar) {
				$subStr = substr($univ_calendar->date_from, 5, 2);
				$array_cal[$subStr][] = date('M d, Y', strtotime($univ_calendar->date_from)).' to '.date('M d, Y', strtotime($univ_calendar->date_to)).'|<strong>'.$univ_calendar->title.'</strong><br />'.$univ_calendar->content;
			}
		} 

		$this->data['univ_calendar'] = $array_cal;		
		$this->layout->content = View::make('faculty.dashboard', $this->data);
	}	
}