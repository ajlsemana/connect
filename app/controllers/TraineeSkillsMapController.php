<?php 

class TraineeSkillsMapController extends BaseController {
	private $data = array();
	private $allowed = array(3);
	
	protected $layout = "layouts.main";
	
	public function __construct() {
		$this->data['route'] = Route::getCurrentRoute()->getPath();	
		$this->beforeFilter('csrf', array('on' => 'post'));

		if (!in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('auth/logout');
		}
	}
	
	public function index() {
		$this->getList();
	}	
	
	protected function getList() {
		$this->data['skills'] = SkillsMap::getSkillsMap(Auth::user()->id);
		$this->layout->content = View::make('trainee.skills_map', $this->data);		
	}
}