<?php 

class TrainerAuthController extends BaseController {
	private $data = array();
	
	protected $layout = "layouts.login";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	public function index() {
		Auth::logout();

		$this->layout->content = View::make('student.login', $this->data);
	}	
	
	public function getLogin() {		
		Auth::logout();

		$this->layout->content = View::make('student.login', $this->data);
	}

	public function postLogin() {		
		$username = Input::get('username');
		$password = Input::get('password');

		if (Auth::attempt(array('username' => $username, 'password' => $password, 'user_type' => 2, 'status' => 1))) {
			Session::put('old_password', $password);
			return Redirect::to('trainer/dashboard');
		} else {
		    return Redirect::to('blueconnect')
			        ->with('error', 'Invalid username/password.')
			        ->withInput();
		}
	}

	public function getLogout() {
		Auth::logout();
		Session::flush();
		
		return Redirect::to('/')->with('message', 'Successfully signed out.');
	}
}