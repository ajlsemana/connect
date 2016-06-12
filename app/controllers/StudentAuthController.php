<?php 

class StudentAuthController extends BaseController {
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

		if (Auth::attempt(array('username' => $username, 'password' => $password, 'status' => 1))) {
			Session::put('old_password', $password);
			
			if(Auth::user()->user_type == 3 || Auth::user()->user_type == 5) {
				return Redirect::to('trainee/dashboard');	
			} else if(Auth::user()->user_type == 2) {
				return Redirect::to('trainer/dashboard');
			} else if(Auth::user()->user_type == 1) {
				return Redirect::to('admin/dashboard');
			}		
		} else {
		    return Redirect::to('/#message')
			        ->with('error', 'Invalid username/password.')
			        ->withInput();
		}
	}

	public function getLogout() {
		Auth::logout();
		Session::flush();
		
		return Redirect::to('/#message')->with('message', 'Successfully signed out.');
	}
}