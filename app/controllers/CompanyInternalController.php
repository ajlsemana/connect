<?php 

class CompanyInternalController extends BaseController {
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
			return Redirect::to('admin/company-internal/add' . $this->setURL())
				->withErrors($validator)
				->withInput();
		} else {		
			$arrParams = array(
							'company'		=> Input::get('company'),						
							'category'		=> 1,						
							'created_at'	=> date('Y-m-d H:i:s')							
							);					
			
			if($file[0] != NULL) {	
				$allowed_img = array('JPG', 'jpg', 'jpeg', 'png');
				$f_type = Input::file('files')[0]->getClientOriginalExtension();
				
				if(! in_array($f_type, $allowed_img)) {						
					$message .= 'Only jpg and png file type is allowed.';		

					return Redirect::to('admin/company-internal/add')
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
			$id = CompanyInternal::addCompany($arrParams);
			
			return Redirect::to('admin/company-internal')
				->with('success', 'Successfully created a new company!');
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
			return Redirect::to('admin/company-internal/update' . $this->setURL() . '&id=' . Input::get('id'))
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

					return Redirect::to('admin/company-internal/update&id=' . Input::get('id'))
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
			CompanyInternal::updateCompany(Input::get('id'), $arrParams);
			
			return Redirect::to('admin/company-internal' . $this->setURL())
				->with('success', 'Successfully updated company!');
		}
	}
	
	public function deleteData() {
		$rules = array(
						'selected'	=> 'required'
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/company-internal');
		} else {
			CompanyInternal::deleteCompany(Input::get('selected'));
			
			return Redirect::to('admin/company-internal' . $this->setURL())
				->with('success', 'Successfully deleted the selected companies!');
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
									'href'      => URL::to('admin/company-internal'),
									'text'      => 'Company Internal',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
			
		$this->data['url_insert'] = URL::to('admin/company-internal/add');
		$this->data['url_update'] = URL::to('admin/company-internal/update');
		$this->data['url_delete'] = URL::to('admin/company-internal/delete');
		$this->data['url_search'] = URL::to('admin/company-internal');
		
		// Search Filters
		$filter_company = Input::get('filter_company', NULL);
		
		$sort = 'company';
		$order = 'ASC';

		$arrParams = array(
							'filter_company'	=> $filter_company,
							'sort'				=> 'company',
							'order'				=> 'ASC'
						);	

		$results = CompanyInternal::getServiceProviders($arrParams);
		$results_total = CompanyInternal::getTotalServiceProviders($arrParams);
		
		$this->data['total_data'] = CompanyInternal::getEngineerCtr();
			
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
		
		$companies = Companies::getCompanies();
		$comp_opt = array();
		$comp_opt[''] = '- Please Select -';
		foreach($companies as $comp_names) {
			if($comp_names->category == 1) {
				$comp_opt[$comp_names->id] = $comp_names->company;
			}
		}
		$this->data['company_options'] = $comp_opt;
		
		$this->layout->content = View::make('company_internal.list', $this->data);
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
									'href'      => URL::to('admin/company-internal'),
									'text'      => 'Company Business',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/company-internal');
		
		$this->layout->content = View::make('company_internal.insert', $this->data);
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
									'href'      => URL::to('admin/company-internal'),
									'text'      => 'Company Business',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/company-internal' . $this->setURL());
		
		// Data
		$this->data['company'] = CompanyInternal::find(Input::get('id'));
		
		$this->layout->content = View::make('company_internal.update', $this->data);
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