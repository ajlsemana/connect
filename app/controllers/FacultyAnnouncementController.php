<?php 

class FacultyAnnouncementController extends BaseController {
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
		$this->layout->content = View::make('faculty.announcement', $this->data);
	}
}