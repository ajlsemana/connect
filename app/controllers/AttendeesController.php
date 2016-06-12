<?php 

class AttendeesController extends BaseController {
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
									'href'      => URL::to('admin/attendees'),
									'text'      => 'Attendees',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$url = $this->setURL();
		$this->data['url_update'] = URL::to('admin/attendees/update' . $url);
		$this->data['url_upload_cert'] = URL::to('admin/attendees/certificate' . $url);	
		$this->data['url_insert'] = URL::to('admin/attendees/add' . $url);
		$this->data['url_delete'] = URL::to('admin/attendees/delete' . $url);
		$this->data['url_search'] = URL::to('admin/attendees');	

		// Search Filters
		$filter_company = Input::get('filter_company', NULL);
		$filter_first_name = Input::get('filter_first_name', NULL);
		$filter_last_name = Input::get('filter_last_name', NULL);
		$filter_primary_email = Input::get('filter_primary_email', NULL);
		$filter_courses = Input::get('filter_courses', NULL);
		$filter_status = Input::get('filter_status', NULL);

		// Data
		$sort = Input::get('sort', 'company');
		$order = Input::get('order', 'ASC');
		$page = Input::get('page', 1);

		$arrParams = array(
							'filter_company'		=> $filter_company,
							'filter_first_name'		=> $filter_first_name,							
							'filter_last_name'		=> $filter_last_name,
							'filter_primary_email'	=> $filter_primary_email,
							'filter_courses'		=> $filter_courses,
							'filter_status'			=> $filter_status,
							'sort'					=> $sort,
							'order'					=> $order,
							'page'					=> $page,
							'limit'					=> 100
						);	
		$results = Attendees::getAttendees($arrParams);		
		$results_total = Attendees::getTotalAttendees($arrParams);						
		
		// Pagination
		$this->data['arrFilters'] = array(
										'filter_company'		=> $filter_company,
										'filter_first_name'		=> $filter_first_name,										
										'filter_last_name'		=> $filter_last_name,
										'filter_primary_email'	=> $filter_primary_email,
										'filter_courses'		=> $filter_courses,
										'filter_status'			=> $filter_status,
										'sort'					=> $sort,
										'order'					=> $order
									);

		//Options
		$this->data['status_options'] = array(
										'' 	=> 'Please Select',
										'New' => 'New',
										'Proposal Sent' => 'Proposal Sent',
										'Proposal Received'	=> 'Proposal Received',
										'Invoice Sent'	=> 'Invoice Sent',
										'Partial Payment'	=> 'Partial Payment',
										'Confirmed'	=> 'Confirmed'
									);
		$this->data['company_options'] = Attendees::getCompanies();

		$this->data['users'] = Paginator::make($results, $results_total, 20);
		$this->data['users_total'] = $results_total;

		$this->data['filter_company'] = $filter_company;
		$this->data['filter_first_name'] = $filter_first_name;		
		$this->data['filter_last_name'] = $filter_last_name;
		$this->data['filter_primary_email'] = $filter_primary_email;
		$this->data['filter_courses'] = $filter_courses;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->data['page'] = $page;

		$url = '?filter_company=' . $filter_company . '&filter_first_name=' . $filter_first_name. '&filter_last_name=' . $filter_last_name;		
		$url .= '&filter_primary_email=' . $filter_primary_email . '&filter_primary_email=' . $filter_primary_email;
		$url .= '&filter_courses=' . $filter_courses . '&filter_status=' . $filter_status;
		$url .= '&filter_status=' . $filter_status . '&filter_status=' . $filter_status;		
		$url .= '&page=' . $page;

		$order_company = ($sort=='company' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_first_name = ($sort=='first_name' && $order=='ASC') ? 'DESC' : 'ASC';		
		$order_last_name = ($sort=='last_name' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_email_address = ($sort=='email' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_courses = ($sort=='course' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_status = ($sort=='attendance_status' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_date_added = ($sort=='created_at' && $order=='ASC') ? 'DESC' : 'ASC';
		
		$this->data['sort_company'] = URL::to('admin/attendees' . $url . '&sort=company&order=' . $order_company, NULL, FALSE);
		$this->data['sort_first_name'] = URL::to('admin/attendees' . $url . '&sort=first_name&order=' . $order_first_name, NULL, FALSE);		
		$this->data['sort_last_name'] = URL::to('admin/attendees' . $url . '&sort=last_name&order=' . $order_last_name, NULL, FALSE);
		$this->data['sort_primary_email'] = URL::to('admin/attendees' . $url . '&sort=email&order=' . $order_email_address, NULL, FALSE);
		$this->data['sort_courses'] = URL::to('admin/attendees' . $url . '&sort=course&order=' . $order_courses, NULL, FALSE);
		$this->data['sort_status'] = URL::to('admin/attendees' . $url . '&sort=attendance_status&order=' . $order_status, NULL, FALSE);
		$this->data['sort_date_added'] = URL::to('admin/attendees' . $url . '&sort=created_at&order=' . $order_date_added, NULL, FALSE);

		$this->data['course_options'] = Attendees::getDistinctCourses();	
		$companies = Companies::getCompanies();
		$comp_array = array();

		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}

		$this->data['company'] = $comp_array;
		$this->layout->content = View::make('users.attendees', $this->data);
	}

	public function deleteData() {
		$rules = array(
						'selected'	=> 'required'
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/attendees');
		} else {
			Attendees::deleteAttendees(Input::get('selected'));
			
			return Redirect::to('admin/attendees/temp-listings' . $this->setURL())
				->with('success', 'Successfully deleted the selected attendees!');
		}
	}

	public function insertForm() {
		$this->getInsertForm();
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
									#'href'      => URL::to('admin/attendees'),
									'href'      => URL::to('#'),
									'text'      => 'Attendee',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/attendees/temp-listings' . $this->setURL());
		
		// Options	
		$this->data['course_options'] = array(
												'Technical Administration' 	=> 'Technical Administration',
												'Script Development'	=> 'Script Development',
												'Inbound Floor Operations'	=> 'Inbound Floor Operations',
												'Outbound Floor Operations'	=> 'Outbound Floor Operations',
												'Introduction to Contact Center'	=> 'Introduction to Contact Center'
											);

		$this->data['status_options'] = array(
												'' => '- Please Select -',
												'New' 	=> 'New',
												'For review' => 'For review',
												'Pending'	=> 'Pending',
												'Processed'	=> 'Processed',
												'Rescheduled'	=> 'Rescheduled',
												'Cancelled'	=> 'Cancelled'
											);
		
		// Search Filters
		$this->data['filter_company'] = Input::get('filter_company', NULL);
		$this->data['filter_first_name'] = Input::get('filter_first_name', NULL);		
		$this->data['filter_last_name'] = Input::get('filter_last_name', NULL);
		$this->data['filter_primary_email'] = Input::get('filter_primary_email', NULL);
		$this->data['filter_courses'] = Input::get('filter_courses', NULL);
		$this->data['filter_status'] = Input::get('filter_status', NULL);

		$this->data['sort'] = Input::get('sort', 'username');
		$this->data['order'] = Input::get('order', 'ASC');
		
		$this->layout->content = View::make('users.insert_attendee', $this->data);
	}

	public function insertData() {	

		$rules = array(
							'first_name'	=> 'required',							
							'last_name'		=> 'required',
							'company' 		=> 'required',
							'contact_number'=> 'required|digits_between:10,15',
							'email'			=> 'required|email',
							'course'		=> 'required',
							'reference'		=> 'required'
						);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/attendees/add' . $this->setURL())
				->withErrors($validator)
				->withInput();
		} else {			
			for($ctr = 0; $ctr < count(Input::get('course')); $ctr++):
				$arrParams = array(
								'first_name'	=> Input::get('first_name'),							
								'last_name'		=> Input::get('last_name'),
								'company' 		=> Input::get('company'),
								'contact_number'=> Input::get('contact_number'),
								'email'			=> Input::get('email'),
								'course'		=> Input::get('course')[$ctr],
								'attendance_status'		=> Input::get('reference') == 'POP' ? 'Confirmed' : 'New',
								'remarks'		=> Input::get('remarks'),
								'reference'		=> Input::get('reference'),
								'created_at'	=> date('Y-m-d H:i:s')
							);
				$id = Attendees::addAttendee($arrParams);		
			endFor;

			return Redirect::to('admin/attendees/temp-listings' . $this->setURL())
			->with('success', 'Successfully registered new attendee!');	
		}
	}

	public function updateForm() {
		$this->getUpdateForm();
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
									'href'      => URL::to('admin/attendees'),
									'text'      => 'Attendees',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/attendees' . $this->setURL());
		
		// Options		
		$this->data['status_options'] = array(
												'' 	=> 'Please Select',
												'New' => 'New',
												'For review' => 'For review',
												'Pending'	=> 'Pending',
												'Processed'	=> 'Processed',
												'Rescheduled'	=> 'Rescheduled',
												'Cancelled'	=> 'Cancelled'
											);
		
		// Search Filters
		$this->data['filter_company'] = Input::get('filter_company', NULL);
		$this->data['filter_first_name'] = Input::get('filter_first_name', NULL);		
		$this->data['filter_last_name'] = Input::get('filter_last_name', NULL);
		$this->data['filter_primary_email'] = Input::get('filter_primary_email', NULL);
		$this->data['filter_courses'] = Input::get('filter_courses', NULL);
		$this->data['filter_status'] = Input::get('filter_status', NULL);
		
		$this->data['sort'] = Input::get('sort', 'status');
		$this->data['order'] = Input::get('order', 'ASC');
		$this->data['page'] = Input::get('page', 1);
		
		// Data
		$this->data['attendees'] = Attendees::getAttendee(Input::get('id'));
		$companies = Companies::getCompanies();
		$comp_array = array();

		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}

		$this->data['company'] = $comp_array;
		
		$this->layout->content = View::make('users.update_attendee', $this->data);		
	}

	protected function uploadCertificate() {			
		$file = Input::file('files');						  	  		  	  	
	  	$file_path = array();
		$message = '';
		$filename = '';
		$id = Input::get('id');
	
	  	if($file[0] != NULL) {	
					
				$f_type = Input::file('files')[0]->getClientOriginalExtension();

				if($f_type != 'pdf') {						
					$message .= 'Only PDF file type is allowed.';		

					return Redirect::to('admin/attendees/certificate'. $this->setURL().'&id='.$id)
						->with('error', $message)
						->withInput();	
	
					break;					
				} else {					
					$destinationPath = storage_path() . '/certificates/';
					File::makeDirectory($destinationPath, 0777, true, true);


					if(empty($message)) {						
						#$filename = 'Certificate_'.$id.'_'.Input::file('files')[0]->getClientOriginalName();
						$filename = 'Certificate_'.$id.'_'.Input::get('course').'.pdf';
						array_push($file_path, $filename);				
	            		Input::file('files')[0]->move($destinationPath, strtoupper($filename));						
					}
				}
			
			
		} else {
			$message = 'Choose a PDF file to upload.';
			return Redirect::to('admin/attendees/certificate'. $this->setURL().'&id='.$id)
					->with('error', $message)
					->withInput();	
		}		

		Attendees::uploadCertificate($id, array('certificate' => strtoupper($filename)));							

		return Redirect::to('admin/attendees/certificate'. $this->setURL().'&id='.$id)
			->with('success', 'File successfully uploaded!');		
	}

	protected function uploadCertificateForm() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/attendees'),
									'text'      => 'Certificate',
									'class'		=> 'active',
									'separator' => TRUE
   		);
		$this->data['url_cancel'] = URL::to('admin/attendees');
		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		$this->data['attendees'] = Attendees::getAttendee(Input::get('id'));
		$companies = Companies::getCompanies();
		$comp_array = array();

		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}

		$this->data['company'] = $comp_array;
		$this->layout->content = View::make('users.upload_certificate', $this->data);		
	}

	protected function getCostForm() {
		// Breadcrumbs
		$this->breadcrumbs = array();
		$course = Input::segment(4);

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('#'),
									'text'      => 'Training Cost',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;

		switch($course):
			case 'TA': $course_full = 'Technical Administration'; 
			break;
			case 'SD': $course_full = 'Script Development'; 
			break;
			case 'IFO': $course_full = 'Inbound Floor Operations'; 
			break;
			case 'OFO': $course_full = 'Outbound Floor Operations'; 
			break;
			case 'ITCC': $course_full = 'Introduction to Contact Center'; 
			break;
		endswitch;
		$this->data['full_course'] = $course_full;
		// URL
		$this->data['url_cancel'] = URL::to('admin/attendees/temp-listings' . $this->setURL());
		
		// Data
		$this->data['training_cost'] = Attendees::getTrainingCost($course);
		
		$this->layout->content = View::make('users.update_cost', $this->data);
	}

	public function updateData() {		
		$rules = array(					    
						'confirmed_date' => 'required',
						'reference' => 'required',
						'amount'=> 'digits_between:1,15',
						'discount'=> 'digits_between:1,3',
						'cash_received'=> 'digits_between:1,15'
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/attendees/update' . $this->setURL() . '&id=' . Input::get('id'))
				->withErrors($validator)
				->withInput();
		} else {	
			$status_current = 'New';

			if(Input::get('proposal_status_sent') == 'Sent') {
				$status_current = 'Proposal Sent';
			}

			if(Input::get('proposal_status_received') == 'Received') {
				$status_current = 'Proposal Received';
			}

			if(Input::get('invoice') == 'Sent') {
				$status_current = 'Invoice Sent';
			}

			if(Input::get('payment_status') != 'Not received') {
				if(Input::get('payment_status') == 'Partial') {
					$status_current = 'Partial Payment';
				} else {
					$status_current = 'Confirmed';
				}
				
			}

			if(Input::get('reference') == 'POP' || $status_current == 'Confirmed') {
				$to = Input::get('primary_email_address');	
				$course = Input::get('my_course');				
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
			}

			$arrParams = array(							
							'attendance_status'	=> (Input::get('reference') == 'POP' ? 'Confirmed' : $status_current),
							'remarks'		=> Input::get('remarks'),
							'reference'		=> Input::get('reference'),
							'amount'		=> Input::get('amount'),
							'discount'		=> Input::get('discount'),
							'proposal_status_sent'		=> Input::get('proposal_status_sent'),
							'po_date_sent'		=> Input::get('po_date_sent'),
							'proposal_status_received'		=> Input::get('proposal_status_received'),
							'po_date_received'		=> Input::get('po_date_received'),
							'invoice'		=> Input::get('invoice'),
							'invoice_date_sent'		=> Input::get('invoice_date_sent'),
							'payment_status'		=> Input::get('payment_status'),
							'cash_received'		=> Input::get('cash_received'),
							'profiling'		=> Input::get('profiling'),
							'confirmed_date'		=> Input::get('confirmed_date'),
							'change_status'		=> Input::get('change_status'),
							'updated_at'	=> date('Y-m-d H:i:s')
						);
			Attendees::updateStatus(Input::get('id'), $arrParams);
	
			return Redirect::to('admin/attendees/update' . $this->setURL().'&id='.Input::get('id'))
				->with('success', 'Successfully updated attendance status!');
		}
	}

	public function updateCost() {
		$rules = array(
					    'groceries'	=> 'digits_between:1,10',
					    'lunch'	=> 'digits_between:1,10',
					    'room'	=> 'digits_between:1,10',
					    'trainer'	=> 'digits_between:1,10',
					    'stationary'	=> 'digits_between:1,10',
					    'transportation'	=> 'digits_between:1,10',
					    'miscellaneous'	=> 'digits_between:1,10'
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/attendees/add-cost/'.Input::get('course') . $this->setURL() . '&id=' . Input::get('id'))
				->withErrors($validator)
				->withInput();
		} else {	
			$arrParams = array(
							'groceries'	=> Input::get('groceries'),
							'lunch'	=> Input::get('lunch'),
							'room'	=> Input::get('room'),
							'trainer'	=> Input::get('trainer'),
							'stationary'	=> Input::get('stationary'),
							'transportation'	=> Input::get('transportation'),
							'miscellaneous'	=> Input::get('miscellaneous'),
							'updated_at'	=> date('Y-m-d H:i:s')
						);
			Attendees::updateCost(Input::get('id'), $arrParams);
	
			return Redirect::to('admin/attendees/add-cost/'.Input::get('course') . $this->setURL())
				->with('success', 'Successfully updated training cost!');
		}
	}

	public function updateTempData() {
		$rules = array(
					    'first_name'	=> 'required',							
						'last_name'		=> 'required',
						'company' 		=> 'required',
						'contact_number'=> 'required|digits_between:10,15',
						'email'			=> 'required|email',
						'course'		=> 'required',
						'confirmed_date' => 'required',
						'amount'=> 'digits_between:1,15',
						'discount'=> 'digits_between:1,3',
						'cash_received'=> 'digits_between:1,15'
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/attendees/temp-update' . $this->setURL() . '&id=' . Input::get('id'))
				->withErrors($validator)
				->withInput();
		} else {	
			$status_current = 'New';

			if(Input::get('proposal_status_sent') == 'Sent') {
				$status_current = 'Proposal Sent';
			}

			if(Input::get('proposal_status_received') == 'Received') {
				$status_current = 'Proposal Received';
			}

			if(Input::get('invoice') == 'Sent') {
				$status_current = 'Invoice Sent';
			}

			if(Input::get('payment_status') != 'Not received') {
				if(Input::get('payment_status') == 'Partial') {
					$status_current = 'Partial Payment';
				} else {
					$status_current = 'Confirmed';
				}
				
			}			
			$arrParams = array(
							'first_name'	=> Input::get('first_name'),							
							'last_name'		=> Input::get('last_name'),
							'company' 		=> Input::get('company'),
							'contact_number'=> Input::get('contact_number'),
							'email'			=> Input::get('email'),
							'course'		=> Input::get('course'),
							'attendance_status'	=> $status_current,
							'remarks'		=> Input::get('remarks'),
							'reference'		=> Input::get('reference'),
							'amount'		=> Input::get('amount'),
							'discount'		=> Input::get('discount'),
							'proposal_status_sent'		=> Input::get('proposal_status_sent'),
							'po_date_sent'		=> Input::get('po_date_sent'),
							'proposal_status_received'		=> Input::get('proposal_status_received'),
							'po_date_received'		=> Input::get('po_date_received'),
							'invoice'		=> Input::get('invoice'),
							'invoice_date_sent'		=> Input::get('invoice_date_sent'),
							'payment_status'		=> Input::get('payment_status'),
							'cash_received'		=> Input::get('cash_received'),
							'profiling'		=> Input::get('profiling'),
							'confirmed_date'		=> Input::get('confirmed_date'),
							'change_status'		=> Input::get('change_status'),
							'updated_at'	=> date('Y-m-d H:i:s')
						);
			Attendees::updateTempStatus(Input::get('id'), $arrParams);
	
			return Redirect::to('admin/attendees/temp-update' . $this->setURL().'&id='.Input::get('id'))
				->with('success', 'Successfully updated attendance status!');
		}
	}
	
	public function updateTempForm() {
		$this->getUpdateTempForm();
	}

	protected function getTempListInfo() {
		// Breadcrumbs
		$this->breadcrumbs = array();	

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to(''),
									'text'      => 'Attendee Report',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$url = $this->setURL();

		// Data
		$arrParams = array(
							'id' => Input::segment(4),
						);	
		$this->data['user'] = Attendees::getTempAttendeeInfo($arrParams);		

		$this->layout->content = View::make('users.temp_attendee_info', $this->data);
	}

	protected function getListInfo() {
		// Breadcrumbs
		$this->breadcrumbs = array();	

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('#'),
									'text'      => 'Attendee Report',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$url = $this->setURL();

		// Data
		$arrParams = array(
							'id' => Input::segment(4),
						);	
		$this->data['user'] = Attendees::getAttendeeInfo($arrParams);		

		$this->layout->content = View::make('users.attendee_info', $this->data);
	}

	protected function getUpdateTempForm() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/attendees/temp-listings'),
									'text'      => 'Attendees',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/attendees/temp-listings' . $this->setURL());
		
		// Options
		$this->data['course_options'] = array(
												'' => '- Please Select -',
												'Technical Administration' 	=> 'Technical Administration',
												'Script Development'	=> 'Script Development',
												'Inbound Floor Operations'	=> 'Inbound Floor Operations',
												'Outbound Floor Operations'	=> 'Outbound Floor Operations',
												'Introduction to Contact Center'	=> 'Introduction to Contact Center'
											);

		$this->data['status_options'] = array(
												'' 	=> 'Please Select',
												'New' => 'New',
												'For review' => 'For review',
												'Pending'	=> 'Pending',
												'Processed'	=> 'Processed',
												'Rescheduled'	=> 'Rescheduled',
												'Cancelled'	=> 'Cancelled'
											);
		
		// Search Filters
		$this->data['filter_company'] = Input::get('filter_company', NULL);
		$this->data['filter_first_name'] = Input::get('filter_first_name', NULL);		
		$this->data['filter_last_name'] = Input::get('filter_last_name', NULL);
		$this->data['filter_primary_email'] = Input::get('filter_primary_email', NULL);
		$this->data['filter_courses'] = Input::get('filter_courses', NULL);
		$this->data['filter_status'] = Input::get('filter_status', NULL);
		
		$this->data['sort'] = Input::get('sort', 'status');
		$this->data['order'] = Input::get('order', 'ASC');
		$this->data['page'] = Input::get('page', 1);
		
		// Data
		$this->data['attendees'] = Attendees::getTempAttendee(Input::get('id'));

		$this->layout->content = View::make('users.update_temp_attendee', $this->data);
	}

	public function getTemp() {
		$this->getTempList();
	}

	protected function getTempList() {		
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/attendees/temp-listings'),
									'text'      => 'Attendees',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$url = $this->setURL();
		$this->data['url_update'] = URL::to('admin/attendees/temp-update' . $url);	
		$this->data['url_insert'] = URL::to('admin/attendees/add' . $url);
		$this->data['url_delete'] = URL::to('admin/attendees/delete' . $url);
		$this->data['url_search'] = URL::to('admin/attendees/temp-listings');	

		// Search Filters
		$filter_company = Input::get('filter_company', NULL);
		$filter_first_name = Input::get('filter_first_name', NULL);
		$filter_last_name = Input::get('filter_last_name', NULL);
		$filter_primary_email = Input::get('filter_primary_email', NULL);
		$filter_courses = Input::get('filter_courses', NULL);
		$filter_status = Input::get('filter_status', NULL);

		// Data
		$sort = Input::get('sort', 'attendance_status');
		$order = Input::get('order', 'ASC');
		$page = Input::get('page', 1);
		
		$arrParams = array(
							'filter_company'		=> $filter_company,
							'filter_first_name'		=> $filter_first_name,							
							'filter_last_name'		=> $filter_last_name,
							'filter_primary_email'	=> $filter_primary_email,
							'filter_courses'		=> $filter_courses,
							'filter_status'			=> $filter_status,
							'sort'					=> $sort,
							'order'					=> $order,
							'page'					=> $page,
							'limit'					=> 100
						);	
		$results = Attendees::getTempAttendees($arrParams);		
		$results_total = Attendees::getTempTotalAttendees($arrParams);						
		
		// Pagination
		$this->data['arrFilters'] = array(
										'filter_company'		=> $filter_company,
										'filter_first_name'		=> $filter_first_name,										
										'filter_last_name'		=> $filter_last_name,
										'filter_primary_email'	=> $filter_primary_email,
										'filter_courses'		=> $filter_courses,
										'filter_status'			=> $filter_status,
										'sort'					=> $sort,
										'order'					=> $order
									);

		//Options
		$this->data['status_options'] = array(
										'' 	=> 'Please Select',
										'New' => 'New',
										'Proposal Sent' => 'Proposal Sent',
										'Proposal Received'	=> 'Proposal Received',
										'Invoice Sent'	=> 'Invoice Sent',
										'Partial Payment'	=> 'Partial Payment',
										'Confirmed'	=> 'Confirmed'
									);

		$this->data['course_options'] = array(
												'' 	=> 'Please Select',
												'Technical Administration' 	=> 'Technical Administration',
												'Script Development'	=> 'Script Development',
												'Inbound Floor Operations'	=> 'Inbound Floor Operations',
												'Outbound Floor Operations'	=> 'Outbound Floor Operations',
												'Introduction to Contact Center'	=> 'Introduction to Contact Center'
											);

		$this->data['company_options'] = Attendees::getCompanies();

		$this->data['users'] = Paginator::make($results, $results_total, 20);
		$this->data['users_total'] = $results_total;

		$this->data['filter_company'] = $filter_company;
		$this->data['filter_first_name'] = $filter_first_name;		
		$this->data['filter_last_name'] = $filter_last_name;
		$this->data['filter_primary_email'] = $filter_primary_email;
		$this->data['filter_courses'] = $filter_courses;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->data['page'] = $page;

		$url = '?filter_company=' . $filter_company . '&filter_first_name=' . $filter_first_name. '&filter_last_name=' . $filter_last_name;		
		$url .= '&filter_primary_email=' . $filter_primary_email . '&filter_primary_email=' . $filter_primary_email;
		$url .= '&filter_courses=' . $filter_courses . '&filter_status=' . $filter_status;
		$url .= '&filter_status=' . $filter_status . '&filter_status=' . $filter_status;
		$url .= '&page=' . $page;
		
		$order_company = ($sort=='company' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_first_name = ($sort=='first_name' && $order=='ASC') ? 'DESC' : 'ASC';		
		$order_last_name = ($sort=='last_name' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_email_address = ($sort=='email' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_courses = ($sort=='course' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_status = ($sort=='attendance_status' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_date_added = ($sort=='created_at' && $order=='ASC') ? 'DESC' : 'ASC';
		
		$this->data['sort_company'] = URL::to('admin/attendees/temp-listings' . $url . '&sort=company&order=' . $order_company, NULL, FALSE);
		$this->data['sort_first_name'] = URL::to('admin/attendees/temp-listings' . $url . '&sort=first_name&order=' . $order_first_name, NULL, FALSE);		
		$this->data['sort_last_name'] = URL::to('admin/attendees/temp-listings' . $url . '&sort=last_name&order=' . $order_last_name, NULL, FALSE);
		$this->data['sort_primary_email'] = URL::to('admin/attendees/temp-listings' . $url . '&sort=email&order=' . $order_email_address, NULL, FALSE);
		$this->data['sort_courses'] = URL::to('admin/attendees/temp-listings' . $url . '&sort=course&order=' . $order_courses, NULL, FALSE);
		$this->data['sort_status'] = URL::to('admin/attendees/temp-listings' . $url . '&sort=attendance_status&order=' . $order_status, NULL, FALSE);
		$this->data['sort_date_added'] = URL::to('admin/attendees/temp-listings' . $url . '&sort=created_at&order=' . $order_date_added, NULL, FALSE);
		
		$this->layout->content = View::make('users.temp_attendees', $this->data);
	}

	protected function getTempListReport() {
		// Breadcrumbs
		$this->breadcrumbs = array();
		$course = Input::segment(4); //specific training course		

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/attendees/temp-listings'),
									'text'      => 'Business Report',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$url = $this->setURL();
		$this->data['specific_course'] = $course;

		switch($course):
			case 'TA': $course_full = 'Technical Administration'; 
			break;
			case 'SD': $course_full = 'Script Development'; 
			break;
			case 'IFO': $course_full = 'Inbound Floor Operations'; 
			break;
			case 'OFO': $course_full = 'Outbound Floor Operations'; 
			break;
			case 'ITCC': $course_full = 'Introduction to Contact Center'; 
			break;
		endswitch;
		$this->data['full_course'] = $course_full;

		$arrParams = array(
							'filter_courses'	=> $course_full,
							'min_course'		=> $course,
						);	
		$this->data['users'] = Attendees::getTempAttendeeReport($arrParams);
		$this->data['reference'] = Attendees::getTempAttendeeReportCtr($arrParams);		
		$this->data['total'] = Attendees::getTempAttendeeTotalReport($arrParams);

		$this->layout->content = View::make('users.temp_attendees_report', $this->data);
	}

	protected function getTempListSpecific() {	
		// Breadcrumbs
		$this->breadcrumbs = array();
		$course = Input::segment(4); //specific training course		

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/attendees/temp-listings'),
									'text'      => 'Attendees',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$url = $this->setURL();
		$this->data['url_update'] = URL::to('admin/attendees/temp-update' . $url);	
		$this->data['url_insert'] = URL::to('admin/attendees/add' . $url);
		$this->data['url_delete'] = URL::to('admin/attendees/delete' . $url);
		$this->data['url_search'] = URL::to('admin/attendees/temp-listings/'.$course);	
		$this->data['specific_course'] = $course;
		$this->data['url_insert_cost'] = URL::to('admin/attendees/add-cost/'.$course. $url);

		// Search Filters
		$filter_company = Input::get('filter_company', NULL);
		$filter_first_name = Input::get('filter_first_name', NULL);
		$filter_last_name = Input::get('filter_last_name', NULL);
		$filter_primary_email = Input::get('filter_primary_email', NULL);
		$filter_courses = Input::get('filter_courses', NULL);
		$filter_status = Input::get('filter_status', NULL);

		// Data
		$sort = Input::get('sort', 'attendance_status');
		$order = Input::get('order', 'ASC');
		$page = Input::get('page', 1);

		switch($course):
			case 'TA': $course_full = 'Technical Administration'; 
			break;
			case 'SD': $course_full = 'Script Development'; 
			break;
			case 'IFO': $course_full = 'Inbound Floor Operations'; 
			break;
			case 'OFO': $course_full = 'Outbound Floor Operations'; 
			break;
			case 'ITCC': $course_full = 'Introduction to Contact Center'; 
			break;
		endswitch;
		$this->data['full_course'] = $course_full;

		$arrParams = array(
							'filter_company'		=> $filter_company,
							'filter_first_name'		=> $filter_first_name,							
							'filter_last_name'		=> $filter_last_name,
							'filter_primary_email'	=> $filter_primary_email,
							#'filter_courses'		=> $filter_courses,
							'filter_courses'		=> $course_full,
							'filter_status'			=> $filter_status,
							'sort'					=> $sort,
							'order'					=> $order,
							'page'					=> $page,
							'limit'					=> 100
						);	
		$results = Attendees::getTempAttendees($arrParams);		
		$results_total = Attendees::getTempTotalAttendees($arrParams);						
		
		// Pagination
		$this->data['arrFilters'] = array(
										'filter_company'		=> $filter_company,
										'filter_first_name'		=> $filter_first_name,										
										'filter_last_name'		=> $filter_last_name,
										'filter_primary_email'	=> $filter_primary_email,
										'filter_courses'		=> $filter_courses,
										'filter_status'			=> $filter_status,
										'sort'					=> $sort,
										'order'					=> $order
									);

		//Options
		$this->data['status_options'] = array(
										'' 	=> 'Please Select',
										'New' => 'New',
										'Proposal Sent' => 'Proposal Sent',
										'Proposal Received'	=> 'Proposal Received',
										'Invoice Sent'	=> 'Invoice Sent',
										'Partial Payment'	=> 'Partial Payment',
										'Confirmed'	=> 'Confirmed'
									);

		$this->data['course_options'] = array(
												'' 	=> 'Please Select',
												'Technical Administration' 	=> 'Technical Administration',
												'Script Development'	=> 'Script Development',
												'Inbound Floor Operations'	=> 'Inbound Floor Operations',
												'Outbound Floor Operations'	=> 'Outbound Floor Operations',
												'Introduction to Contact Center'	=> 'Introduction to Contact Center'
											);

		$this->data['company_options'] = Attendees::getCompanies($course_full);

		$this->data['users'] = Paginator::make($results, $results_total, 20);
		$this->data['users_total'] = $results_total;

		$this->data['filter_company'] = $filter_company;
		$this->data['filter_first_name'] = $filter_first_name;		
		$this->data['filter_last_name'] = $filter_last_name;
		$this->data['filter_primary_email'] = $filter_primary_email;
		$this->data['filter_courses'] = $filter_courses;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->data['page'] = $page;

		$url = '?filter_company=' . $filter_company . '&filter_first_name=' . $filter_first_name. '&filter_last_name=' . $filter_last_name;		
		$url .= '&filter_primary_email=' . $filter_primary_email . '&filter_primary_email=' . $filter_primary_email;
		$url .= '&filter_courses=' . $filter_courses . '&filter_status=' . $filter_status;
		$url .= '&filter_status=' . $filter_status . '&filter_status=' . $filter_status;
		$url .= '&page=' . $page;
		
		$order_company = ($sort=='company' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_first_name = ($sort=='first_name' && $order=='ASC') ? 'DESC' : 'ASC';		
		$order_last_name = ($sort=='last_name' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_email_address = ($sort=='email' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_courses = ($sort=='course' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_status = ($sort=='attendance_status' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_date_added = ($sort=='created_at' && $order=='ASC') ? 'DESC' : 'ASC';
		
		$this->data['sort_company'] = URL::to('admin/attendees/temp-listings/'.$course . $url . '&sort=company&order=' . $order_company, NULL, FALSE);
		$this->data['sort_first_name'] = URL::to('admin/attendees/temp-listings/'.$course . $url . '&sort=first_name&order=' . $order_first_name, NULL, FALSE);		
		$this->data['sort_last_name'] = URL::to('admin/attendees/temp-listings/'.$course . $url . '&sort=last_name&order=' . $order_last_name, NULL, FALSE);
		$this->data['sort_primary_email'] = URL::to('admin/attendees/temp-listings/'.$course . $url . '&sort=email&order=' . $order_email_address, NULL, FALSE);
		$this->data['sort_courses'] = URL::to('admin/attendees/temp-listings/'.$course . $url . '&sort=course&order=' . $order_courses, NULL, FALSE);
		$this->data['sort_status'] = URL::to('admin/attendees/temp-listings/'.$course . $url . '&sort=attendance_status&order=' . $order_status, NULL, FALSE);
		$this->data['sort_date_added'] = URL::to('admin/attendees/temp-listings/'.$course . $url . '&sort=created_at&order=' . $order_date_added, NULL, FALSE);
		
		$this->layout->content = View::make('users.temp_attendees_specific', $this->data);
	}

	protected function setURL() {
		// Search Filters
		$url = '?filter_company=' . Input::get('filter_company', NULL);
		$url .= '&filter_first_name=' . Input::get('filter_first_name', NULL);
		$url .= '&filter_last_name=' . Input::get('filter_last_name', NULL);
		$url .= '&filter_primary_email=' . Input::get('filter_primary_email', NULL);
		$url .= '&filter_courses=' . Input::get('filter_courses', NULL);
		$url .= '&filter_status=' . Input::get('filter_status', NULL);
		$url .= '&sort=' . Input::get('sort', 'attendance_status');
		$url .= '&order=' . Input::get('order', 'ASC');
		$url .= '&page=' . Input::get('page', 1);
		
		return $url;
	}
}