<?php 

class CoursesController extends BaseController {
	private $data = array();
	private $allowed = array(1);
	private $allowedTypes = array('zip', 'rar', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'txt');

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
	
	public function getTimeline() {
		$this->data['results'] = Courses::getTimeline(Input::segment(4));
		$this->data['course'] = EnrolledCourses::getCourseName(Input::segment(4));
		$this->data['module'] = 'Timeline View';
		$this->data['menu'] = '<a href="'.URL::to('admin/training-courses/add-activity?id='.Input::segment(4)).'">[ Go Back ]</a>';

		$this->layout->content = View::make('courses.timeline', $this->data);
	}

	public function insertForm() {
		$this->getInsertForm();
	}
	
	public function insertData() {
		$rules = array(						
						'course_name'	=> array('required', 'between:1,100'),						
						'date_from'		=> array('required'),
						'date_to'		=> array('required'),
						'duration'		=> array('required'),
						'time_from'		=> array('required'),
						'time_to'		=> array('required')			
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/training-courses/add' . $this->setURL())
				->withErrors($validator)
				->withInput();
		} else {
			$message = '';			
			$file = Input::file('files');
		  	$file_path = array();
		  	$ctr = 0;
			
			if($file[0] != NULL) {	
				$ctr = 0;
				foreach ($file as $key => $value) {		
					$f_type = Input::file('files')[$ctr]->getClientOriginalExtension();
					if(! in_array($f_type, $this->allowedTypes)) {
						$message .= 'Only pdf, zip, rar, doc, docx, ppt, pptx, xls, xlsx and txt extensions are allowed.<br />';					
						break;
					} else {					
						$destinationPath = storage_path() . '/lectures/';
						File::makeDirectory($destinationPath, 0777, true, true);


						if(empty($message)) {
							$filename = date('YmdHis') . '_' .Input::file('files')[$ctr]->getClientOriginalName();
							array_push($file_path, $filename);				
		            		Input::file('files')[$ctr]->move($destinationPath, $filename);						
						}
					}
					
					$ctr++;
				}
			}

			if (! empty($message)) {			
				return Redirect::to('admin/training-courses/add' . $this->setURL())
						->with('error', $message)
						->withInput();	
			} else {
				$arrParams = array(
					'name'			=> Input::get('course_name'),					
					'date_from'	=> Input::get('date_from'),
					'date_to'	=> Input::get('date_to'),
					'duration'	=> Input::get('duration'),
					'time'	=> Input::get('time_from').'-'.Input::get('time_to'),
					'status'	=> Input::get('status')
				);

				$course_id = Courses::addCourse($arrParams);

				if(count($file_path) > 0) {
					foreach($file_path as $file_name) {
						$file_param = array(
							'post_id' => $course_id,
							'upload_path' => $file_name
						);
						Courses::uploadMaterials($file_param);				
					}	
				}			

				return Redirect::to('admin/training-courses' . $this->setURL())
					->with('success', 'Successfully created a new training course!');
			}
		}
	}
	
	public function updateForm() {		
		$this->getUpdateForm();
	}
	
	public function updateData() {		
		$rules = array(						
						'name'			=> array('required', 'between:1,100'),						
						'date_from'		=> array('required'),
						'date_to'		=> array('required'),
						'duration'		=> array('required'),
						'time_from'		=> array('required'),
						'time_to'		=> array('required')						
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/training-courses/update' . $this->setURL() . '&id=' . Input::get('id'))
				->withErrors($validator)
				->withInput();
		} else {
			$arrParams = array(
							'name'			=> Input::get('name'),							
							'date_from'	=> Input::get('date_from'),
							'date_to'	=> Input::get('date_to'),
							'duration'	=> Input::get('duration'),
							'time'	=> Input::get('time_from').'-'.Input::get('time_to'),
							'status'	=> Input::get('status'),
							'trainer'	=> Input::get('trainer'),
							'updated_at'	=> date('Y-m-d H:i:s')
						);
			
			Courses::updateCourses(Input::get('id'), $arrParams);
			
			#$upload_file = 
			return Redirect::to('admin/training-courses/update' .'?id='.Input::get('id') )
				->with('success', 'Successfully updated training course!');
		}
	}
	
	public function deleteData() {
		$rules = array(
						'selected'	=> 'required'
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/training-courses');
		} else {			
			Courses::deleteCourses(Input::get('selected'));
			
			return Redirect::to('admin/training-courses' . $this->setURL())
				->with('success', 'Successfully deleted the selected training courses!');
		}
	}

	public function deleteActivity() {
		Courses::deleteActivity(Input::segment(5));
		
		return Redirect::to('admin/training-courses/add-activity?id=' . Input::segment('4'))
			->with('success', 'Successfully deleted the selected training courses!');
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
									'href'      => URL::to('admin/training-courses'),
									'text'      => 'Training Courses',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$url = $this->setURL();
		$this->data['url_insert'] = URL::to('admin/training-courses/add' . $url);
		$this->data['url_update'] = URL::to('admin/training-courses/update' . $url);
		$this->data['url_delete'] = URL::to('admin/training-courses/delete' . $url);
		$this->data['url_search'] = URL::to('admin/training-courses');

		// Search Filters
		$filter_name = Input::get('filter_name', NULL);

		// Data
		$sort = Input::get('sort', 'name');
		$order = Input::get('order', 'ASC');
		$page = Input::get('page', 1);
		
		$arrParams = array(
							'filter_name'		=> $filter_name,
							'sort'				=> $sort,
							'order'				=> $order,
							'page'				=> $page,
							'limit'				=> 20
						);		
		$results = Courses::getCourses($arrParams);
		$results_total = Courses::getTotalCourses($arrParams);
		
		// Pagination
		$this->data['arrFilters'] = array(
										'filter_name'		=> $filter_name,
										'sort'				=> $sort,
										'order'				=> $order
									);
		
		$this->data['courses'] = Paginator::make($results, $results_total, 20);
		$this->data['course_total'] = $results_total;

		$this->data['filter_name'] = $filter_name;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->data['page'] = $page;

		$url = '?filter_name=' . $filter_name;
		$url .= '&page=' . $page;

		$order_name = ($sort=='name' && $order=='ASC') ? 'DESC' : 'ASC';
				
		$this->data['sort_name'] = URL::to('admin/training-courses' . $url . '&sort=name&order=' . $order_name, NULL, FALSE);
		
		$this->layout->content = View::make('courses.list', $this->data);
	}

	public function deleteFile() {	
		$arr = array();				
		
		if (Request::isMethod('get')) {			
			$pid = Request::segment(4);		
			$result = Courses::deleteMaterial($pid);				
		}

		return Redirect::to('admin/training-courses/update' . $this->setURL().'&id='.Request::segment(5))
				->with('success', 'Training material was deleted!');				
	}
	
	protected function getInsertForm() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/training-courses'),
									'text'      => 'Training Courses',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/training-courses' . $this->setURL());
				
		// Search Filters
		$this->data['filter_name'] = Input::get('filter_name', NULL);

		$this->data['sort'] = Input::get('sort', 'name');
		$this->data['order'] = Input::get('order', 'ASC');
		
		$this->layout->content = View::make('courses.insert', $this->data);
	}
	
	protected function getUpdateForm() {		
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/training-courses'),
									'text'      => 'Training Courses',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/training-courses' . $this->setURL());
		
		// Search Filters		
		$this->data['filter_name'] = Input::get('filter_name', NULL);

		$this->data['sort'] = Input::get('sort', 'name');
		$this->data['order'] = Input::get('order', 'ASC');
		
		// Data
		$this->data['courses'] = Courses::find(Input::get('id'));
		$this->data['assigned_trainer'] = User::getTrainer();
		$this->data['course_materials'] = Courses::getMaterials(Input::get('id'));

		//$path = Config::get('app.url_storage') . '/lectures/' . $files;
		$this->layout->content = View::make('courses.update', $this->data);
	}
	
	public function insertActivity() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/training-courses'),
									'text'      => 'Training Activity',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$this->data['url_cancel'] = URL::to('admin/training-courses' . $this->setURL());
		
		// Search Filters		
		$this->data['filter_name'] = Input::get('filter_name', NULL);

		$this->data['sort'] = Input::get('sort', 'name');
		$this->data['order'] = Input::get('order', 'ASC');
		
		// Data
		$this->data['courses'] = Courses::find(Input::get('id'));
		$this->data['activity'] = Courses::getActivity(Input::get('id'));				
		$this->layout->content = View::make('courses.insert_agenda', $this->data);
	}

	public function addActivity() {
		$day = Input::get('day');	
		$cid = Input::get('cid');	

		$arrParams = array(
			'cid'		=> $cid,
			'days'		=> $day,
			'agenda'	=> Input::get('activity'),
			'time_from'	=> Input::get('hours-from').':'.Input::get('minutes-from'),
			'time_to'	=> Input::get('hours-to').':'.Input::get('minutes-to'),
		);

		Courses::addActivity($arrParams);

		return Redirect::to('admin/training-courses/add-activity?id=' . $cid)
			->with('success', 'Successfully created new training activity!');		
	}

	protected function setURL() {
		// Search Filters		
		$url = '?filter_name=' . Input::get('filter_name', NULL);
		$url .= '&sort=' . Input::get('sort', 'name');
		$url .= '&order=' . Input::get('order', 'ASC');
		$url .= '&page=' . Input::get('page', 1);
		
		return $url;
	}
}