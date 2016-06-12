<?php 

class AuthController extends BaseController {
	private $data = array();
	
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
	}
	
	public function getLogin() {		
		Auth::logout();

		$this->layout->content = View::make('auth.login', $this->data);
	}

	public function postLogin() {
		$username = Input::get('username');
		$password = Input::get('password');

		if (Auth::attempt(array('username' => $username, 'password' => $password, 'user_type' => 1, 'status' => 1))) {
			Session::put('old_password', $password);
			return Redirect::to('admin/dashboard');
		} else {
		    return Redirect::to('auth/login')
			        ->with('error', 'Invalid login credentials.')
			        ->withInput();
		}
	}

	public function getLogout() {		
		Auth::logout();
		Session::flush();
		
		return Redirect::to('auth/login')->with('message', 'Successfully logged out.');
	}
}