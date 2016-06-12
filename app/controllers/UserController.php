<?php 

class UserController extends BaseController {
	private $data = array();
	private $allowed = array(1);
	
	protected $layout = "layouts.main";
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));

		if (!in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('auth/logout');
		}
	}
	
	public function index() {
		$this->getList();
	}
	
	public function profileForm() {
		$this->getProfileForm();		
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
			return Redirect::to('user/profile')
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
			$allowed_img = array('JPG', 'jpg', 'jpeg', 'png');
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
					$message[] = 'Only jpg and png format for photo are allowed.';
				}
			}						
			
			if($message) {
				return Redirect::to('user/profile')
					->with('error', $message[0])
					->withInput();	
			} else {				
				$user = User::updateUser(Auth::id(), $arrParams);				

				return Redirect::to('user/profile')
					->with('success', 'Successfully updated!');
			}
		}
	}

	protected function ProfilePasswordForm() {
		$this->getProfilePasswordForm();
	}

	protected function getProfilePasswordForm() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('user/change_password'),
									'text'      => 'Change Password',
									'class'		=> 'active',
									'separator' => TRUE
   		);			

		$this->data['breadcrumbs'] = $this->breadcrumbs;	
		$this->data['heading_title_password'] = 'Change Password';	
		$this->data['url_cancel'] = URL::to('admin/dashboard');
		
		$this->layout->content = View::make('users.password', $this->data);
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
			return Redirect::to('user/change_password')
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
				return Redirect::to('user/change_password')
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
				return Redirect::to('user/change_password')
							->with('success', 'Successfully updated your password!');
			}
		}					
	}
	
	public function insertForm() {
		$this->getInsertForm();
	}
	
	public function insertData() {	
		$rules = array(
						#'username'			=> array('required', 'between:2,50', 'unique:users,username,NULL,id'),
						'first_name'		=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'last_name'			=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'company'			=> array('required', 'between:1,50'),
					    'position'			=> array('required', 'between:2,50'),
					    'primary_email_address'	=> array('required', 'email', 'between:2,100', 'unique:users'),
					    'secondary_email'	=> array('email', 'between:2,100', 'unique:users'),
					    'user_type'			=> array('required')
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/users/add' . $this->setURL())
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
							'company' 		=> Input::get('company'),
							'position' 		=> Input::get('position'),
							'user_type'		=> (Input::get('user_type') == 4 ? 3 : Input::get('user_type')),
							'password'		=> Hash::make($password),
							'status'		=> 1,
							'skills_map'	=> (Input::get('user_type') == 4 ? 1 : 0),
							'created_at'	=> date('Y-m-d H:i:s')
							);
			$user_id = User::addUser($arrParams);		

			#$to = Input::get('primary_email_address');
			$to = 'ayman.soliman@bluemena.com, liaqat.saeed@bluemena.com, amir.alasad@bluemena.com, joseph.semana@bluemena.com';

			$name = Input::get('first_name') . ' ' . Input::get('last_name');						
			$subject = 'blueConnect Account for '.$name;
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
			if(! $mail_submit) {
				return Redirect::to('admin/users/add' . $this->setURL())
				->with('error', 'Failed to send email message.')
				->withInput();		
			} else {
				return Redirect::to('admin/users' . $this->setURL())
				->with('success', 'Successfully created a new user!');
			}		
		}
	}
	
	public function confirmAttendance() {
		$arrParams = array(
			'attendance_status' => 'Confirmed',
			'change_status' => 'Confirmed'
		);					
		Attendees::updateStatus(Input::get('id'), $arrParams);				
		$to = Input::get('email');	
		$course = Input::get('course');						
		$subject = 'Attendance Status for the Training';				

		$from = 'blueConnect <info@bluemena.com>';
		$headers = "From: " .($from) . "\r\n";
        $headers .= "Reply-To: ".($from) . "\r\n";
        $headers .= "Return-Path: ".($from) . "\r\n";;
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP". phpversion() ."\r\n";							
        $msg = 'Your attendance has been confirmed for attending the <b>'.$course.'</b> course.';

		$mail_submit = mail($to, $subject, $msg, $headers);			

		#mail('joseph.semana@bluemena.com', 'Approved New Trainee - Ready to Attend', $headers);			

		return Redirect::to('admin/attendees/update?id='.Input::get('id'))
			->with('success', 'Successfully confirmed attendance!');		
	}

	public function updateForm() {
		$this->getUpdateForm();
	}
	
	public function updateData() {
		$rules = array(
						#'username'			=> array('required', 'between:2,25', 'unique:users,username,' . Input::get('id') . ',id'),
						'first_name'		=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
						'middle_name'		=> array('between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'last_name'			=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'primary_email_address'	=> array('required', 'email', 'between:2,100'),
					    'company'			=> array('required'),
					    'position'			=> array('required', 'between:2,50', "regex:/^[\\p{L} .'-]+$/"),
					    'user_type'			=> 'required',
					    'status'			=> 'required'
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/users/update' . $this->setURL() . '&id=' . Input::get('id'))
				->withErrors($validator)
				->withInput();
		} else {
			$utype = Input::get('user_type');			
			$skills = Input::get('skills_map');

			if($utype == 4) {
				$utype = 3;
				$skills = 1;
			} elseif($utype == 3) {
				$skills = 0;
			} elseif($utype == 5) {
				$skills = 1;
			}

			$arrParams = array(
							'username'	=> Input::get('primary_email_address'),
							'first_name'	=> Input::get('first_name'),
							'middle_name'	=> Input::get('middle_name'),
							'last_name'		=> Input::get('last_name'),
							'primary_email_address'	=> Input::get('primary_email_address'),
							'company'		=> Input::get('company'),
							'position'		=> Input::get('position'),
							'user_type'		=> $utype,
							'skills_map'	=> $skills,
							'status'		=> Input::get('status'),
							'updated_at'	=> date('Y-m-d H:i:s')
							);
			$message = '';
			$allowed_img = array('jpg', 'png', 'JPG', 'jpeg');
			$profile_pic = Input::get('profile_pic');

			if (Input::hasFile('image')) {				
				$new_photo = Input::file('image');
				if(in_array($new_photo->getClientOriginalExtension(), $allowed_img)) {			
					$explode_old_pic = explode('_', $profile_pic);
				    if(Input::get('id') == $explode_old_pic[0]) {
				    	$file = '\profile_pic\\'.$profile_pic;				
						$path = storage_path().''.$file;			
						@unlink($path);		
					}	

			    	$profile_pic_name = Input::get('id').'.'.$new_photo->getClientOriginalExtension();
			    	$destinationPath = storage_path() . '/profile_pic/';
					File::makeDirectory($destinationPath, 0777, true, true);											
            		Input::file('image')->move($destinationPath, $profile_pic_name);
            		$arrParams['profile_pic'] = $profile_pic_name;																    
				} else {
					$message .= 'Only jpg and png format for photo are allowed.';
				}
			}

			if($message != '') {
				return Redirect::to('admin/users/update?id='.Input::get('id'))
					->with('error', $message)
					->withInput();	
			} else {				
				User::updateUser(Input::get('id'), $arrParams);
			
				return Redirect::to('admin/users/update?id='.Input::get('id'))
					->with('success', 'Successfully updated user!');
			}		
		}
	}
	
	public function deleteData() {
		$rules = array(
						'selected'	=> 'required'
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/users');
		} else {			
			User::deleteUser(Input::get('selected'));
			
			return Redirect::to('admin/users' . $this->setURL())
				->with('success', 'Successfully deleted the selected users!');
		}
	}
	
	public function changePassword() {		
		$user = User::find(Input::get('id'));

		if ($user) {
			$password = Utils::generateCode(8);
			$arrParams = array(
							'skills_map'	=> $user->skills_map,
							'password'		=> Hash::make($password),
							'updated_at'	=> date('Y-m-d H:i:s')
							);
			User::updateUser(Input::get('id'), $arrParams);	

			$to = $user->primary_email_address;
			#$to = 'joseph.semana@bluemena.com';
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
				return Redirect::to('admin/users' . $this->setURL())
				->with('error', 'Failed to send email message.')
				->withInput();		
			} else {
				return Redirect::to('admin/users' . $this->setURL())
					->with('success', 'Successfully updated the password!');
			}
		}	
	}
	
	protected function getList() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/users'),
									'text'      => 'Users',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$url = $this->setURL();
		$this->data['url_insert'] = URL::to('admin/users/add' . $url);
		$this->data['url_update'] = URL::to('admin/users/update' . $url);
		$this->data['url_delete'] = URL::to('admin/users/delete' . $url);
		$this->data['url_change_password'] = URL::to('admin/users/changePassword' . $url);
		$this->data['url_search'] = URL::to('admin/users');
		
		// Options	
		$this->data['user_type_options'] = array(
													'' 	=> 'Please Select',
													#1	=> 'Admin',
													2	=> 'Trainer',
													3	=> 'Trainee',
													4	=> 'Engineer',
													5	=> 'Resource Manager'
												);

		$this->data['status_options'] = array(
												'' 	=> 'Please Select',
												'1'	=> 'Active',
												'0'	=> 'Inactive'
											);

		// Search Filters
		$filter_username = Input::get('filter_username', NULL);
		$filter_first_name = Input::get('filter_first_name', NULL);
		$filter_middle_name = Input::get('filter_middle_name', NULL);
		$filter_last_name = Input::get('filter_last_name', NULL);
		$filter_primary_email = Input::get('filter_primary_email', NULL);
		$filter_user_type = Input::get('filter_user_type', NULL);
		$filter_status = Input::get('filter_status', NULL);
		
		// Data
		$sort = Input::get('sort', 'username');
		$order = Input::get('order', 'ASC');
		$page = Input::get('page', 1);
		
		$arrParams = array(
							'filter_username'		=> $filter_username,
							'filter_first_name'		=> $filter_first_name,
							'filter_middle_name'	=> $filter_middle_name,
							'filter_last_name'		=> $filter_last_name,
							'filter_primary_email'	=> $filter_primary_email,
							'filter_user_type'		=> $filter_user_type,
							'filter_status'			=> $filter_status,
							'sort'					=> $sort,
							'order'					=> $order,
							'page'					=> $page,
							'limit'					=> 20
						);		
		$results = User::getUsers($arrParams);
		$results_total = User::getTotalUsers($arrParams);
		
		// Pagination
		$this->data['arrFilters'] = array(
										'filter_username'		=> $filter_username,
										'filter_first_name'		=> $filter_first_name,
										'filter_middle_name'	=> $filter_middle_name,
										'filter_last_name'		=> $filter_last_name,
										'filter_primary_email'	=> $filter_primary_email,
										'filter_user_type'		=> $filter_user_type,
										'filter_status'			=> $filter_status,
										'sort'					=> $sort,
										'order'					=> $order
									);
		
		$this->data['users'] = Paginator::make($results, $results_total, 20);
		$this->data['users_total'] = $results_total;

		$this->data['filter_username'] = $filter_username;
		$this->data['filter_first_name'] = $filter_first_name;
		$this->data['filter_middle_name'] = $filter_middle_name;
		$this->data['filter_last_name'] = $filter_last_name;
		$this->data['filter_primary_email'] = $filter_primary_email;
		$this->data['filter_user_type'] = $filter_user_type;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->data['page'] = $page;

		$url = '?filter_username=' . $filter_username . '&filter_first_name=' . $filter_first_name;		
		$url .= '&filter_primary_email=' . $filter_primary_email . '&filter_primary_email=' . $filter_primary_email;
		$url .= '&filter_user_type=' . $filter_user_type . '&filter_status=' . $filter_status;
		$url .= '&page=' . $page;
		
		$order_username = ($sort=='username' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_first_name = ($sort=='first_name' && $order=='ASC') ? 'DESC' : 'ASC';		
		$order_last_name = ($sort=='last_name' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_email_address = ($sort=='primary_email_address' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_user_type = ($sort=='user_type' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_status = ($sort=='status' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_date_added = ($sort=='created_at' && $order=='ASC') ? 'DESC' : 'ASC';
		
		$this->data['sort_username'] = URL::to('admin/users' . $url . '&sort=username&order=' . $order_username, NULL, FALSE);
		$this->data['sort_first_name'] = URL::to('admin/users' . $url . '&sort=first_name&order=' . $order_first_name, NULL, FALSE);		
		$this->data['sort_last_name'] = URL::to('admin/users' . $url . '&sort=last_name&order=' . $order_last_name, NULL, FALSE);
		$this->data['sort_primary_email'] = URL::to('admin/users' . $url . '&sort=primary_email_address&order=' . $order_email_address, NULL, FALSE);
		$this->data['sort_user_type'] = URL::to('admin/users' . $url . '&sort=user_type&order=' . $order_user_type, NULL, FALSE);
		$this->data['sort_status'] = URL::to('admin/users' . $url . '&sort=status&order=' . $order_status, NULL, FALSE);
		$this->data['sort_date_added'] = URL::to('admin/users' . $url . '&sort=created_at&order=' . $order_date_added, NULL, FALSE);
		
		$this->layout->content = View::make('users.list', $this->data);
	}
	
	protected function getInsertForm() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/users'),
									'text'      => 'Users',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/users' . $this->setURL());
		
		// Options	
		$this->data['user_type_options'] = array(
													'' 	=> 'Please Select',
													#1	=> 'Admin',
													2	=> 'Trainer',
													#3	=> 'Trainee',
													4	=> 'Engineer',
													5	=> 'Resource Manager'
												);

		$this->data['status_options'] = array(
												'' 	=> 'Please Select',
												'1'	=> 'Active',
												'0'	=> 'Inactive'
											);
		
		// Search Filters
		$this->data['filter_username'] = Input::get('filter_username', NULL);
		$this->data['filter_first_name'] = Input::get('filter_first_name', NULL);
		$this->data['filter_middle_name'] = Input::get('filter_middle_name', NULL);
		$this->data['filter_last_name'] = Input::get('filter_last_name', NULL);
		$this->data['filter_primary_email'] = Input::get('filter_primary_email', NULL);
		$this->data['filter_user_type'] = Input::get('filter_user_type', NULL);
		$this->data['filter_status'] = Input::get('filter_status', NULL);

		$this->data['sort'] = Input::get('sort', 'username');
		$this->data['order'] = Input::get('order', 'ASC');
		
		$companies = Companies::getCompanies();
		$comp_array = array();

		$comp_array[NULL] = '- Please Select -';
		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}

		$this->data['companies'] = $comp_array;

		$this->layout->content = View::make('users.insert', $this->data);
	}
	
	protected function getUpdateForm() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/users'),
									'text'      => 'Users',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/users' . $this->setURL());
		
		// Options	
		$this->data['user_type_options'] = array(
													'' 	=> 'Please Select',
													#1	=> 'Admin',
													2	=> 'Trainer',
													3	=> 'Trainee',
													4	=> 'Engineer',
													5	=> 'Resource Manager'
												);

		$this->data['status_options'] = array(
												'' 	=> 'Please Select',
												'1'	=> 'Active',
												'0'	=> 'Inactive'
											);
		
		// Search Filters
		$this->data['filter_username'] = Input::get('filter_username', NULL);
		$this->data['filter_first_name'] = Input::get('filter_first_name', NULL);
		$this->data['filter_middle_name'] = Input::get('filter_middle_name', NULL);
		$this->data['filter_last_name'] = Input::get('filter_last_name', NULL);
		$this->data['filter_primary_email'] = Input::get('filter_primary_email', NULL);
		$this->data['filter_user_type'] = Input::get('filter_user_type', NULL);
		$this->data['filter_status'] = Input::get('filter_status', NULL);

		$this->data['sort'] = Input::get('sort', 'username');
		$this->data['order'] = Input::get('order', 'ASC');
		$this->data['page'] = Input::get('page', 1);
		
		// Data
		$this->data['user'] = User::find(Input::get('id'));
		$companies = Companies::getCompanies();
		$comp_array = array();

		$comp_array[NULL] = '- Please Select -';
		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}
		$this->data['companies'] = $comp_array;

		$this->layout->content = View::make('users.update', $this->data);
	}

	protected function getProfileForm() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('user/profile'),
									'text'      => 'Profile',
									'class'		=> 'active',
									'separator' => TRUE
   		);
				
		// Data
		$this->data['user'] = User::find(Auth::id());

		$this->data['breadcrumbs'] = $this->breadcrumbs;	
		$this->data['heading_title_update'] = 'Update Profile';	
		$this->data['url_cancel'] = URL::to('admin/dashboard');
				
		$this->layout->content = View::make('users.profile', $this->data);	
	}
	
	protected function setURL() {
		// Search Filters
		$url = '?filter_username=' . Input::get('filter_username', NULL);
		$url .= '&filter_first_name=' . Input::get('filter_first_name', NULL);
		$url .= '&filter_middle_name=' . Input::get('filter_middle_name', NULL);
		$url .= '&filter_last_name=' . Input::get('filter_last_name', NULL);
		$url .= '&filter_primary_email' . Input::get('filter_primary_email', NULL);
		$url .= '&filter_user_type=' . Input::get('filter_user_type', NULL);
		$url .= '&filter_status=' . Input::get('filter_status', NULL);
		$url .= '&sort=' . Input::get('sort', 'username');
		$url .= '&order=' . Input::get('order', 'ASC');
		$url .= '&page=' . Input::get('page', 1);
		
		return $url;
	}
}