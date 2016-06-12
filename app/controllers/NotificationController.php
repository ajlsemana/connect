<?php 

class NotificationController extends BaseController {
	private $data = array();
	private $allowed = array(2, 3);
	
	protected $layout = "layouts.main";
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));

		if (!in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('auth/logout');
		}
	}
	
	public function index() {
		$arr = array();		

		if (Request::isMethod('get')) {	
			$today_cal = Notification::calendarToday();	
			$month_cal = Notification::calendarMonth();	
			$month_announcement = Notification::announcementMonth();	
			$announcement_cal = Notification::announcementToday();	

			$arr['announcement_today'] = $announcement_cal;
			$arr['announcement_month'] = $month_announcement;
			$arr['calendar_today'] = $today_cal;
			$arr['calendar_month'] = $month_cal;

			$arr['total'] = ($today_cal + $month_cal + $announcement_cal + $month_announcement);
		}
		
		return Response::json($arr);
	}

	public function facultyNotification() {
		$arr = array();		

		if (Request::isMethod('get')) {	
			$today_cal = Notification::calendarToday();	
			$month_cal = Notification::calendarMonth();	
			$month_announcement = Notification::announcementMonth();	
			$announcement_cal = Notification::announcementToday();	
			$pending_stud = Notification::getFacultySubjects();
			$pending_array = array();
			$html = '';

			foreach ($pending_stud as $pending) {
				array_push($pending_array, $pending->subject_id);
			}

			$pending_count = Notification::getFacultyPendingStudentsTotal( $pending_array );
			$pending_students = Notification::getFacultyPendingStudents( $pending_array );			

			foreach($pending_students as $pendings) {
				$url_to = URL::to('faculty/class/'.$pendings->id.'/'.$pendings->group_code.'/students');
				$html .= '<li><a href="'.$url_to.'">'.$pendings->subject_names.' / '.$pendings->section_code.'</a></li>';				
			}

			$arr['announcement_today'] = $announcement_cal;
			$arr['announcement_month'] = $month_announcement;
			$arr['calendar_today'] = $today_cal;
			$arr['calendar_month'] = $month_cal;

			$arr['pending_count'] = $pending_count;
			$arr['pending_result'] = $html;

			$arr['total'] = ($today_cal + $month_cal + $announcement_cal + $month_announcement);
		}
		
		return Response::json($arr);	
	}	
}