<?php 

class CustomersController extends BaseController {
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
	
	public function insertForm() {
		$this->getInsertForm();
	}
	
	public function insertData() {
		$rules = array(
					'company' => array('required', 'between:1,100'),						
				);
		$file = Input::file('files');						  	  		  	  		  	
		$message = '';
		$filename = '';

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/customers/add' . $this->setURL())
				->withErrors($validator)
				->withInput();
		} else {		
			$arrParams = array(
							'company'		=> Input::get('company'),										
							'created_at'	=> date('Y-m-d H:i:s')							
							);					
			
			if($file[0] != NULL) {	
				$allowed_img = array('JPG', 'jpg', 'jpeg', 'png');
				$f_type = Input::file('files')[0]->getClientOriginalExtension();
				
				if(! in_array($f_type, $allowed_img)) {						
					$message .= 'Only jpg and png file type is allowed.';		

					return Redirect::to('admin/customers/add')
						->with('error', $message)
						->withInput();	
					break;					
				} else {					
					$destinationPath = storage_path() . '/company_logo/';
					File::makeDirectory($destinationPath, 0777, true, true);

					if(empty($message)) {						
						$filename = Input::file('files')[0]->getClientOriginalName();						
						$arrParams['logo'] = $filename;
						
	            		Input::file('files')[0]->move($destinationPath, $filename);						
					}
				}
			}
			$id = Customers::addCompany($arrParams);
			
			return Redirect::to('admin/customers')
				->with('success', 'Successfully created new customer!');
		}									
	}
	
	public function updateForm() {
		$this->getUpdateForm();
	}
	
	public function updateData() {
		$rules = array(
						'company'			=> array('required', 'between:1,255')						
					);
		$validator = Validator::make(Input::all(), $rules);
		$file = Input::file('files');						  	  		  	  		  	
		$message = '';
		$filename = '';
		
		if ($validator->fails()) {
			return Redirect::to('admin/customers/update' . $this->setURL() . '&id=' . Input::get('id'))
				->withErrors($validator)
				->withInput();
		} else {
			$arrParams = array(
							'company'			=> Input::get('company'),				
							'updated_at'	=> date('Y-m-d H:i:s')
							);
			
			if($file[0] != NULL) {	
				$allowed_img = array('JPG', 'jpg', 'jpeg', 'png');
				$f_type = Input::file('files')[0]->getClientOriginalExtension();
				
				if(! in_array($f_type, $allowed_img)) {						
					$message .= 'Only jpg and png file type is allowed.';		

					return Redirect::to('admin/customers/update&id=' . Input::get('id'))
						->with('error', $message)
						->withInput();	
					break;					
				} else {
					$old_logo = Input::get('old_logo');					
					$destinationPath = storage_path() . '/company_logo/';
					@unlink($destinationPath.$old_logo);
	
					File::makeDirectory($destinationPath, 0777, true, true);

					if(empty($message)) {						
						$filename = Input::file('files')[0]->getClientOriginalName();						
						$arrParams['logo'] = $filename;
						
	            		Input::file('files')[0]->move($destinationPath, $filename);						
					}
				}						
			}
			Customers::updateCompany(Input::get('id'), $arrParams);
			
			return Redirect::to('admin/customers' . $this->setURL())
				->with('success', 'Successfully updated Customer!');
		}
	}
	
	public function deleteData() {
		$rules = array(
						'selected'	=> 'required'
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/customers');
		} else {
			Customers::deleteCompany(Input::get('selected'));
			
			return Redirect::to('admin/customers' . $this->setURL())
				->with('success', 'Successfully deleted the selected customers!');
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
									'href'      => URL::to('admin/customers'),
									'text'      => 'Customers',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
			
		$this->data['url_insert'] = URL::to('admin/customers/add');
		$this->data['url_update'] = URL::to('admin/customers/update');
		$this->data['url_delete'] = URL::to('admin/customers/delete');
		$this->data['url_search'] = URL::to('admin/customers');
		
		// Search Filters
		$filter_company = Input::get('filter_company', NULL);
		
		$sort = 'company';
		$order = 'ASC';

		$arrParams = array(
							'filter_company'	=> $filter_company,
							'sort'				=> 'company',
							'order'				=> 'ASC'
						);	

		$results = Customers::getServiceProviders($arrParams);
		$results_total = Customers::getTotalServiceProviders($arrParams);
			
		// Pagination
		$this->data['arrFilters'] = array(
										'filter_company'	=> $filter_company,
										'sort'				=> 'company',
										'order'				=> 'ASC'
									);
		
		$this->data['companies'] = $results;
		$this->data['company_total'] = $results_total;

		$this->data['filter_company'] = $filter_company;

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;	
		
		$companies = Customers::getCompanies($arrParams);
		$comp_opt = array();
		$comp_opt[''] = '- Please Select -';
		foreach($companies as $comp_names) {
				$comp_opt[$comp_names->id] = $comp_names->company;
		}
		$this->data['company_options'] = $comp_opt;
		
		$this->layout->content = View::make('customers.list', $this->data);
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
									'href'      => URL::to('admin/customers'),
									'text'      => 'Customers',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/customers');
		
		$this->layout->content = View::make('customers.insert', $this->data);
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
									'href'      => URL::to('admin/customers'),
									'text'      => 'Customers',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/customers' . $this->setURL());
		
		// Data
		$this->data['company'] = Customers::find(Input::get('id'));
		
		$this->layout->content = View::make('customers.update', $this->data);
	}
	
	protected function setURL() {
		// Search Filters
		$url = '?filter_company='.Input::get('filter_company', NULL);
		$url .= '&sort=' . Input::get('sort', 'company');
		$url .= '&order=' . Input::get('order', 'ASC');
		$url .= '&page=' . Input::get('page', 1);
		
		return $url;
	}
}