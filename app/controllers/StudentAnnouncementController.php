<?php 

class StudentAnnouncementController extends BaseController {
	private $data = array();
	private $allowed = array(3);	
	
	protected $layout = "layouts.student_main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->data['video_status'] = Student::checkVideoStatus(Auth::user()->id, Request::segment(3));

		if (!in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('student/logout');
		}
	}
	
	public function index() {					
		$this->getAnnouncements();		
	}

	protected function getAnnouncements() {	
		$this->data['announcement_notif'] = Announcement::getTodaysAnnouncement();
		$announcements = Announcement::getStudentAndFacultyAnnouncements();
		$array_announcement = array();

		if($announcements) {
			foreach($announcements as $announcement) {
				$subStr = substr($announcement->date_from, 5, 2);				
				$array_announcement[$subStr][] = date('M d, Y', strtotime($announcement->date_from)).' to '.date('M d, Y', strtotime($announcement->date_to)).'|<strong>'.$announcement->title.'</strong><br />'.$announcement->content;
			}
		} 

		$this->data['announcement'] = $array_announcement;
		$this->layout->content = View::make('student.announcement', $this->data);
	}
}