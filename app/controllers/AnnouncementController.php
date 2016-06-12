<?php 

class AnnouncementController extends BaseController {
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
						'title'			=> array('required', 'between:1,255'),
						'content'		=> array('required'),
					    'date_from'		=> array('required', 'date'),
					    'date_to'		=> array('required_without:same_day', 'date', 'after:date_from')
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/announcements/add' . $this->setURL())
				->withErrors($validator)
				->withInput();
		} else {
			$date_to = (Input::get('same_day')) ? Input::get('date_from') : Input::get('date_to');

			$arrParams = array(
							'title'			=> Input::get('title'),
							'content'		=> Input::get('content'),
							'date_from'		=> Input::get('date_from'),
							'date_to'		=> $date_to,
							'created_at'	=> date('Y-m-d H:i:s'),
							'updated_at'	=> date('Y-m-d H:i:s')
							);
			$id = Announcement::addAnnouncement($arrParams);		

			return Redirect::to('admin/announcements' . $this->setURL())
				->with('success', 'Successfully created a new announcement!');
		}
	}
	
	public function updateForm() {
		$this->getUpdateForm();
	}
	
	public function updateData() {
		$rules = array(
						'title'			=> array('required', 'between:1,255'),
						'content'		=> array('required'),
					    'date_from'		=> array('required', 'date'),
					    'date_to'		=> array('required_without:same_day', 'date', 'after:date_from')
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/announcements/update' . $this->setURL() . '&id=' . Input::get('id'))
				->withErrors($validator)
				->withInput();
		} else {
			$date_to = (Input::get('same_day')) ? Input::get('date_from') : Input::get('date_to');

			$arrParams = array(
							'title'			=> Input::get('title'),
							'content'		=> Input::get('content'),
							'date_from'		=> Input::get('date_from'),
							'date_to'		=> $date_to,
							'updated_at'	=> date('Y-m-d H:i:s')
							);
			Announcement::updateAnnouncement(Input::get('id'), $arrParams);
			
			return Redirect::to('admin/announcements' . $this->setURL())
				->with('success', 'Successfully updated the announcement!');
		}
	}
	
	public function deleteData() {
		$rules = array(
						'selected'	=> 'required'
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/announcements');
		} else {
			Announcement::deleteAnnouncement(Input::get('selected'));
			
			return Redirect::to('admin/announcements' . $this->setURL())
				->with('success', 'Successfully deleted the selected announcements!');
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
									'href'      => URL::to('admin/announcements'),
									'text'      => 'Announcements',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$url = $this->setURL();
		$this->data['url_insert'] = URL::to('admin/announcements/add' . $url);
		$this->data['url_update'] = URL::to('admin/announcements/update' . $url);
		$this->data['url_delete'] = URL::to('admin/announcements/delete' . $url);
		$this->data['url_search'] = URL::to('admin/announcements');
		
		// Search Filters
		$filter_title = Input::get('filter_title', NULL);
		$filter_date_from = Input::get('filter_date_from', NULL);
		$filter_date_to = Input::get('filter_date_to', NULL);

		// Data
		$sort = Input::get('sort', 'date_from');
		$order = Input::get('order', 'ASC');
		$page = Input::get('page', 1);

		// Errors
		$arrDateError = array();
		if (($filter_date_from!='' && $filter_date_to=='') || ($filter_date_from=='' && $filter_date_to!='')) {
			$filter_date_from = NULL;
			$filter_date_to = NULL;
			array_push($arrDateError, 'Dates are required.');
		} elseif (strtotime($filter_date_from) > strtotime($filter_date_to)) {
			array_push($arrDateError, 'Invalid date range.');
		}
		
		$filter_date_from = ($filter_date_from!=NULL) ? date('Y-m-d 00:00:00', strtotime($filter_date_from)) : NULL;
		$filter_date_to = ($filter_date_to!=NULL) ? date('Y-m-d 23:59:59', strtotime($filter_date_to)) : NULL;
		
		$this->data['error_date'] = '';
		if (!empty($arrDateError)) {
			$this->data['error_date'] = implode('<br />', $arrDateError);
		}
		
		$arrParams = array(
							'filter_title'		=> $filter_title,
							'filter_date_from'	=> $filter_date_from,
							'filter_date_to'	=> $filter_date_to,
							'sort'				=> $sort,
							'order'				=> $order,
							'page'				=> $page,
							'limit'				=> 20
						);		
		$results = Announcement::getAnnouncements($arrParams);
		$results_total = Announcement::getTotalAnnouncements($arrParams);
		
		// Pagination
		$this->data['arrFilters'] = array(
										'filter_title'		=> $filter_title,
										'filter_date_from'	=> $filter_date_from,
										'filter_date_to'	=> $filter_date_to,
										'sort'				=> $sort,
										'order'				=> $order
									);
		
		$this->data['announcements'] = Paginator::make($results, $results_total, 20);
		$this->data['announcements_total'] = $results_total;

		$filter_date_from = ($filter_date_from!=NULL) ? date('Y-m-d', strtotime($filter_date_from)) : '';
		$filter_date_to = ($filter_date_to!=NULL) ? date('Y-m-d', strtotime($filter_date_to)) : '';

		$this->data['filter_title'] = $filter_title;
		$this->data['filter_date_from'] = $filter_date_from;
		$this->data['filter_date_to'] = $filter_date_to;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->data['page'] = $page;

		$url = '?filter_title=' . $filter_title . '&filter_date_from=' . $filter_date_from;
		$url .= '&filter_date_to=' . $filter_date_to;
		$url .= '&page=' . $page;
		
		$order_title = ($sort=='title' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_date_from = ($sort=='date_from' && $order=='ASC') ? 'DESC' : 'ASC';
		
		$this->data['sort_title'] = URL::to('admin/announcements' . $url . '&sort=title&order=' . $order_title, NULL, FALSE);
		$this->data['sort_date_from'] = URL::to('admin/announcements' . $url . '&sort=date_from&order=' . $order_date_from, NULL, FALSE);
		
		$this->layout->content = View::make('announcements.list', $this->data);
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
									'href'      => URL::to('admin/announcements'),
									'text'      => 'Announcements',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/announcements' . $this->setURL());
				
		// Search Filters
		$this->data['filter_title'] = Input::get('filter_title', NULL);
		$this->data['filter_date_from'] = Input::get('filter_date_from', NULL);
		$this->data['filter_date_to'] = Input::get('filter_date_to', NULL);

		$this->data['sort'] = Input::get('sort', 'date_from');
		$this->data['order'] = Input::get('order', 'ASC');
		
		$this->layout->content = View::make('announcements.insert', $this->data);
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
									'href'      => URL::to('admin/announcements'),
									'text'      => 'Announcements',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/announcements' . $this->setURL());
		
		// Search Filters
		$this->data['filter_title'] = Input::get('filter_title', NULL);
		$this->data['filter_date_from'] = Input::get('filter_date_from', NULL);
		$this->data['filter_date_to'] = Input::get('filter_date_to', NULL);

		$this->data['sort'] = Input::get('sort', 'date_from');
		$this->data['order'] = Input::get('order', 'ASC');
		
		// Data
		$this->data['announcement'] = Announcement::find(Input::get('id'));
		
		$this->layout->content = View::make('announcements.update', $this->data);
	}
	
	protected function setURL() {
		// Search Filters
		$url = '?filter_title=' . Input::get('filter_title', NULL);
		$url .= '&filter_date_from=' . Input::get('filter_date_from', NULL);
		$url .= '&filter_date_to=' . Input::get('filter_date_to', NULL);
		$url .= '&sort=' . Input::get('sort', 'date_from');
		$url .= '&order=' . Input::get('order', 'ASC');
		$url .= '&page=' . Input::get('page', 1);
		
		return $url;
	}
}