<?php

class HomeController extends BaseController {
	private $data = array();

	protected $layout = "layouts.homepage";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->data['route'] = Route::getCurrentRoute()->getPath();
	}
	
	public function showIndex() {
		if(Auth::check()) 
		{
			return Redirect::to('dashboard');
		}
		else {
			return $this->homepage();
		}
	}

	public function forgotPassword() {
		$rules = array(
					    'primary_email_address'	=> array('required', 'email', 'between:2,100')				    
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/#message')
				->withErrors($validator)
				->withInput();
		} else {
			$user = User::getByEmailInfo(Input::get('primary_email_address'));				

			if ($user) {
				$password = Utils::generateCode(8);
				$arrParams = array(
								'skills_map'	=> $user->skills_map,
								'password'		=> Hash::make($password),
								'updated_at'	=> date('Y-m-d H:i:s')
								);
				User::updateUser($user->id, $arrParams);	

				$to = $user->primary_email_address;
				$name = $user->first_name . ' ' . $user->last_name;						
				$subject = 'Reset Password of '.$name;
				
				$arrData = array(
									'password'	=> $password
								);
				$from = 'blueConnect <info@bluemena.com>';
				$headers = "From: " .($from) . "\r\n";
	            $headers .= "Reply-To: ".($from) . "\r\n";
	            $headers .= "Return-Path: ".($from) . "\r\n";;
	            $headers .= "MIME-Version: 1.0\r\n";
	            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	            $headers .= "X-Priority: 3\r\n";
	            $headers .= "X-Mailer: PHP". phpversion() ."\r\n";		

				$mail_submit = mail($to, $subject, 'Your new password is: <strong>'.$password.'</strong>', $headers);						

				if(! $mail_submit) {
					return Redirect::to('/#message')
					->with('error', 'Failed to send email message for your new password.')
					->withInput();		
				} else {
					return Redirect::to('/#message')
						->with('success', 'Successfully sent new password on your email.');
				}
			} else {
				return Redirect::to('/#message')
					->with('error', 'Your email is not registered.')
					->withInput();	
			}
		}	
	}

	public function getContactUs() {
		$this->layout->content = View::make('homepage.contact_us', $this->data);
	}

	public function getAbout() {
		$this->layout->content = View::make('homepage.about', $this->data);
	}
	
	public function getHistory() {
		$this->layout->content = View::make('homepage.history', $this->data);
	}
	
	public function getChairman() {
		$this->layout->content = View::make('homepage.chairman', $this->data);
	}

	public function getServices() {
		$this->layout->content = View::make('homepage.services', $this->data);
	}

	public function getConsultancy() {
		$this->layout->content = View::make('homepage.consultancy', $this->data);
	}

	public function getTechnology() {
		$this->layout->content = View::make('homepage.technology', $this->data);
	}

	public function getExecution() {
		$this->layout->content = View::make('homepage.execution', $this->data);
	}

	public function getTraining() {
		$this->layout->content = View::make('homepage.training', $this->data);
	}

	public function getOutsourcing() {
		$this->layout->content = View::make('homepage.outsourcing', $this->data);
	}

	public function getTechnical() {
		$this->layout->content = View::make('homepage.technical', $this->data);
	}

	public function getScript() {
		$this->layout->content = View::make('homepage.script', $this->data);
	}

	public function getInbound() {
		$this->layout->content = View::make('homepage.inbound', $this->data);
	}

	public function getOutbound() {
		$this->layout->content = View::make('homepage.outbound', $this->data);
	}

	public function getContactCenter() {
		$this->layout->content = View::make('homepage.contact_center', $this->data);
	}
	
	public function getWorkshop() {
		$this->layout->content = View::make('homepage.workshops', $this->data);
	}

	public function registerForm() {
		$this->getRegisterForm();
	}

	public function getRegisterForm() {
		$this->data['course_options'] = Courses::getOpenCourses();
		$this->layout->content = View::make('homepage.registration', $this->data);
	}

	public function getLoginForm() {
		$this->layout->content = View::make('homepage.login', $this->data);
	}

	public function SendContactMsg() {
		$rules = array(						
						'first_name'		=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'last_name'			=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'company'			=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'email'				=> array('required', 'email', 'between:2,100'),
					    'phone_number'		=> array('required', 'digits_between:8,15'),
					    'country'			=> array('required', 'between:2,100', "regex:/^[\\p{L} .'-]+$/"),
					    'message'	=> 		array('required', 'between:2,10000')	
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('contact_us')
				->withErrors($validator)
				->withInput();
		} else {			
			// Always set content-type when sending HTML email			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			$html = '
			<html>
			<head>
			<title>Blue Mena Group</title>
			</head>
			<body>
			<h2>Contact Information</h2>
			<table border="0">
				<tr>
					<td><b>First Name:</b></td>
					<td>'.ucwords(Input::get('first_name')).'<td>
				</tr>
				<tr>
					<td><b>Last Name:</b></td>
					<td>'.ucwords(Input::get('last_name')).'<td>
				</tr>
				<tr>
					<td><b>Company:</b></td>
					<td>'.ucwords(Input::get('company')).'<td>
				</tr>
				<tr>
					<td><b>Email:</b></td>
					<td>'.Input::get('email').'<td>
				</tr>
				<tr>
					<td><b>Phone No:</b></td>
					<td>'.Input::get('phone_number').'<td>
				</tr>
				<tr>
					<td><b>Country:</b></td>
					<td>'.Input::get('country').'<td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;<td>
				</tr>
				<tr>
					<td><b>Message:</b></td>
					<td>'.Input::get('message').'<td>
				</tr>
			</table>
			</body>
			</html>
			';
			
			$to = 'michelle.rodriguez@bluemena.com';									
			$subject = 'Blue Mena Group Inquiry';
										
			$mail_submit = mail($to, $subject, $html, $headers);			
			if(! $mail_submit) {
				return Redirect::to('contact_us')
				->with('error', 'Failed to send email message.')
				->withInput();		
			} else {
				return Redirect::to('contact_us')
				->with('success', 'Message successfully sent.');
			}
		}
	}

	public function registerProcess() {		
		$rules = array(						
						'first_name'		=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'last_name'			=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'company'			=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'position'			=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'contact_number'	=> array('required', 'between:7,20'),
					    'primary_email_address'	=> array('required', 'email', 'between:2,100', 'unique:users'),
					    'secondary_email'	=> array('email', 'between:2,100', 'unique:users'),
					    'course'		=> 'required'
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('registration')
				->withErrors($validator)
				->withInput();
		} else {
			$password = Utils::generateCode(8);			

			$arrParams = array(
							'username'		=> Input::get('primary_email_address'),
							'first_name'	=> Input::get('first_name'),							
							'last_name'		=> Input::get('last_name'),
							'primary_email_address'	=> Input::get('primary_email_address'),
							'secondary_email'=> Input::get('secondary_email'),
							'contact_number'=> Input::get('contact_number'),
							'company' 		=> Input::get('company'),
							'position' 		=> Input::get('position'),
							'user_type'		=> Input::get('user_type'),
							'password'		=> Hash::make($password),
							'status'		=> 1,
							'created_at'	=> date('Y-m-d H:i:s'),
							'updated_at'	=> date('Y-m-d H:i:s')
						);
			$user_id = User::addRegistrant($arrParams);

			for($ctr = 0; $ctr < count(Input::get('course')); $ctr++):
				$info = array(
						'uid' => $user_id,
						'course' => Input::get('course')[$ctr],
						'attendance_status' => 'New'
					);			
				Registrants::addAttendee($info);
			endfor;											

			$to = Input::get('primary_email_address');
			$name = Input::get('first_name') . ' ' . Input::get('last_name');						
			$subject = 'blueConnect: Welcome, '.$name;
			$link = '<br><br><a target="_blank" href="'.URL::to('/').'">Click here</a> to log in to blueConnect.';

			$arrData = array(
								'password'	=> $password
							);

			$from = 'blueConnect <info@bluemena.com>';
			$headers = "From: " .($from) . "\r\n";
            $headers .= "Reply-To: ".($from) . "\r\n";
            $headers .= "Return-Path: ".($from) . "\r\n";;
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP". phpversion() ."\r\n";							
			$mail_submit = mail($to, $subject, 'Username: <strong>'.Input::get('primary_email_address').'</strong><br>Password: <strong>'.$password.'</strong>'.$link, $headers);			
			mail('michelle.rodriguez@bluemena.com, joseph.semana@bluemena.com', 'New Registered Trainee', $name.' is interested to join the training.<br>Please check on your blueConnect admin.', $headers);			
			if(! $mail_submit) {
				return Redirect::to('registration')
				->with('error', 'Failed to send email message.')
				->withInput();		
			} else {
				return Redirect::to('registration')
				->with('success', 'We have received your registration request and will shortly contact you.<br>Your account is created successfully.<br>Kindly check your primary email for your <b>password</b>.');
			}		
		}
	}

	protected function homepage() {	
		$this->layout->content = View::make('homepage.main', $this->data);
	}
}
