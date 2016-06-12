<?php 

class StudentProfileController extends BaseController {
	private $data = array();
	private $allowed = array(3, 4, 5);
	
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));

		if (!in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('trainee/logout');
		}
	}
	
	public function index() {
		$this->getSubjectInfo();
	}

	public function profileForm() {
		$this->getProfileForm();
	}

	public function ProfilePasswordForm() {
		$this->getProfilePasswordForm();
	}

	public function updateUserInfo() {	
		$rules = array(						
						'first_name'		=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
						'middle_name'		=> array('between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'last_name'			=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'primary_email_address'	=> array('required', 'email', 'between:2,100'),
					    'secondary_email'	=> array('email', 'between:2,100'),
					    'company'			=> array('required'),
					    'position'			=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/")				    
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {	
			return Redirect::to('trainee/profile')
				->withErrors($validator)
				->withInput();
		} else {			
			$arrParams = array(	
							'username'		=> Input::get('primary_email_address'),						
							'first_name'	=> Input::get('first_name'),
							'middle_name'	=> Input::get('middle_name'),
							'last_name'		=> Input::get('last_name'),
							'primary_email_address'	=> Input::get('primary_email_address'),							
							'secondary_email'	=> Input::get('secondary_email'),							
							'company'		=> Input::get('company'),
							'skills_map'	=> Auth::user()->skills_map,
							'contact_number'=> Input::get('contact_number'),
							'position'		=> Input::get('position'),
							'updated_at'	=> date('Y-m-d H:i:s')
							);
			$message = array();
			$allowed_img = array('jpg', 'jpeg', 'png', 'gif');
			$profile_pic = Input::get('profile_pic');

			if (Input::hasFile('image')) {	
				$new_photo = Input::file('image');
				if(in_array($new_photo->getClientOriginalExtension(), $allowed_img)) {			
					$explode_old_pic = explode('_', $profile_pic);
				    if(Auth::id() == $explode_old_pic[0]) {
				    	$file = '\profile_pic\\'.$profile_pic;				
						$path = storage_path().''.$file;			
						@unlink($path);		
					}	

			    	$profile_pic_name = Auth::id().'.'.$new_photo->getClientOriginalExtension();				    	
			    	$destinationPath = storage_path() . '/profile_pic/';
					File::makeDirectory($destinationPath, 0777, true, true);											
            		Input::file('image')->move($destinationPath, $profile_pic_name);
            		$arrParams['profile_pic'] = $profile_pic_name;																    
				} else {
					$message[] = 'Only jpg, png and gif format for photo is allowed.';
				}
			}						
			
			if($message) {
				return Redirect::to('trainee/profile')
					->with('error', $message[0])
					->withInput();	
			} else {				
				$user = User::updateUser(Auth::id(), $arrParams);				

				return Redirect::to('trainee/profile')
					->with('success', 'Successfully updated!');
			}
		}
	}

	public function updateProfilePasswordData() {		
		$hash_password = Hash::make(Input::get('old_password'));								
		$valid_password = TRUE;

		$old = Input::get('old_password');	
		$new = Input::get('new_password');	
		$con = Input::get('password_confirmation');	

		if(empty($old) AND empty($new) AND empty($con)) {			
			$valid_password = FALSE;				
			$message = 'All fields are required.';						
			return Redirect::to('trainee/change_password')
					->with('error', $message)
					->withInput();	
		} else {
			if(! Hash::check(Session::get('old_password'), $hash_password)) {						
				$valid_password = FALSE;				
				$message = 'Old Password is incorrect.';						
			} else if (! preg_match("#.*^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", Input::get('new_password'))){
			  	$valid_password = FALSE;
			   	$message = 'New Password must be at least 8 characters including a minimum of one uppercase letter, one lowercase letter, one number and one punctuation symbol.';
			} elseif (! preg_match("#.*^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", Input::get('password_confirmation'))) {
			  	$valid_password = FALSE;
			   	$message = 'Confirm Password must be at least 8 characters including a minimum of one uppercase letter, one lowercase letter, one number and one punctuation symbol.';
			} elseif (Input::get('new_password') != Input::get('password_confirmation')) {
				$valid_password = FALSE;
			   	$message = 'New Password and Confirm Password did not match.';
			}

			if (! $valid_password) {									
				return Redirect::to('trainee/change_password')
					->with('error', $message)
					->withInput();					
			} else {
				$arrParams = array(
								'skills_map' 		=> Auth::user()->skills_map,
								'password'			=> Hash::make(Input::get('new_password')),
								'updated_at'		=> date('Y-m-d H:i:s')
								);
				User::updateUser(Auth::user()->id, $arrParams);
				Session::put('old_password', Input::get('new_password'));
				return Redirect::to('trainee/change_password')
							->with('success', 'Successfully updated your password!');
			}
		}					
	}

	protected function getProfilePasswordForm() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('trainee/calendar'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('trainee/change_password'),
									'text'      => 'Change Password',
									'class'		=> 'active',
									'separator' => TRUE
   		);			

		$this->data['breadcrumbs'] = $this->breadcrumbs;			
		$this->data['url_cancel'] = URL::to('trainee/dashboard');
		
		$this->layout->content = View::make('student.password', $this->data);
	}

	protected function getProfileForm() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('trainee/calendar'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('trainee/profile'),
									'text'      => 'Profile',
									'class'		=> 'active',
									'separator' => TRUE
   		);
				
		// Data
		$this->data['user'] = User::find(Auth::id());

		$this->data['breadcrumbs'] = $this->breadcrumbs;	
		$this->data['heading_title_update'] = 'Update Profile';	
		$this->data['url_cancel'] = URL::to('trainee/dashboard');
		
		$companies = Companies::getCompanies();
		$comp_array = array();

		$comp_array[NULL] = '- Please Select -';
		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}

		$this->data['companies'] = $comp_array;

		$this->layout->content = View::make('student.profile', $this->data);			
	}

	public function send_email() {
		$rules = array(						
						'subject'		=> array('required'),				
					    'regarding'			=> array('required'),
					    'message'			=> array('required')
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {	
			return Redirect::to('trainee/dashboard')
				->withErrors($validator)
				->withInput();
		} else {
			$to = 'joseph.semana@bluemena.com';				
			$subject = strtoupper(Input::get('regarding')).': '.Input::get('subject');
			$message = nl2br(Input::get('message'));
			$message = str_replace('<br>', "\n", $message);

			$from = Auth::user()->primary_email_address;
			$headers = "From: " .($from) . "\r\n";
	        $headers .= "Reply-To: ".($from) . "\r\n";
	        $headers .= "Return-Path: ".($from) . "\r\n";;
	        $headers .= "MIME-Version: 1.0\r\n";
	        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	        $headers .= "X-Priority: 3\r\n";
	        $headers .= "X-Mailer: PHP". phpversion() ."\r\n";							
				
			mail($to, $subject, $message, $headers);

			return Redirect::to('trainee/dashboard')
							->with('success', 'Successfully sent message!');
		}			
	}
}