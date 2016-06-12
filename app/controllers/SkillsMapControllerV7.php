<?php 

class SkillsMapControllerV7 extends BaseController {
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
									'href'      => URL::to('admin/skills-map-v7'),
									'text'      => 'Skills Map',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$url = $this->setURL();		
		$this->data['url_update'] = URL::to('admin/skills-map-v7/update' . $url);		
		$this->data['url_search'] = URL::to('admin/skills-map-v7');
		
		// Options	
		$this->data['user_type_options'] = array(
													'' 	=> 'Please Select',
													#1	=> 'Admin',
													2	=> 'Trainer',
													3	=> 'Trainee'
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
		$results = SkillsMapV7::getUsers($arrParams);
		$results_total = SkillsMapV7::getTotalEngineers($arrParams);
		
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
		
		$this->data['sort_username'] = URL::to('admin/skills-map-v7' . $url . '&sort=username&order=' . $order_username, NULL, FALSE);
		$this->data['sort_first_name'] = URL::to('admin/skills-map-v7' . $url . '&sort=first_name&order=' . $order_first_name, NULL, FALSE);		
		$this->data['sort_last_name'] = URL::to('admin/skills-map-v7' . $url . '&sort=last_name&order=' . $order_last_name, NULL, FALSE);
		$this->data['sort_primary_email'] = URL::to('admin/skills-map-v7' . $url . '&sort=primary_email_address&order=' . $order_email_address, NULL, FALSE);
		$this->data['sort_user_type'] = URL::to('admin/skills-map-v7' . $url . '&sort=user_type&order=' . $order_user_type, NULL, FALSE);
		$this->data['sort_status'] = URL::to('admin/skills-map-v7' . $url . '&sort=status&order=' . $order_status, NULL, FALSE);
		$this->data['sort_date_added'] = URL::to('admin/skills-map-v7' . $url . '&sort=created_at&order=' . $order_date_added, NULL, FALSE);
		
		$companies = Companies::getCompanies();
		$comp_array = array();

		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}

		$this->data['company'] = $comp_array;
		$this->layout->content = View::make('users.skills_map', $this->data);
	}

	protected function updateMap() {	
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/skills-map-v7'),
									'text'      => 'Skills Map',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		$version_color = SkillsMapV7::getVersionColor(Input::get('id'));
		$this->data['colored_circle_cs'] = SkillsMapV7::colorStatus(Input::get('id'), $version_color);

		$this->data['skills'] = SkillsMapV7::getSkillsMap(Input::get('id'));
		$this->data['skill_history'] = SkillsMapV7::getSkillHistory(Input::get('id'));
		$this->data['colored_circle_cs'] = SkillsMapV7::colorStatus(Input::get('id'));
		$this->data['colored_circle_ce'] = SkillsMapV7::colorStatusCE(Input::get('id'));
		$this->data['customers'] = SkillsMap::customers();
		$this->data['no_of_feedbacks'] = SkillsMapV7::feedbackCtr(Input::get('id'));
		$this->data['customer_feedbacks'] = SkillsMapV7::getFeedback(Input::get('id'));
		$this->data['votc_average'] = SkillsMapV7::getFeedbackAverages(Input::get('id'));
		$this->data['allEngrCustomers'] = SkillsMapV7::getAllEngrCustomers(Input::get('id'));
		
		$companies = Companies::getCompanies();
		$comp_array = array();

		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}

		$this->data['company'] = $comp_array;
		if(Auth::user()->user_type == 1) {			
			$this->layout->content = View::make('users.skills_map_update', $this->data);		
		} else {
			if (SkillsMapV7::getUserMap() == NULL) {
				return Redirect::to('trainee/dashboard')
					->with('error', 'Only Engineer user types are allowed to view the skills map.');
			}			
			$this->layout->content = View::make('engineer.skills_map', $this->data);		
		}		
	}

	public function updateData() {				
		$rules = array();				

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('admin/skills-map-v7/update' .'?id=' . Input::get('id'))
				->withErrors($validator)
				->withInput();
		} else {		
			$arrParams = array(
							#'status' => Input::get('status'),
							#'status_update' => (Input::get('status') != Input::get('status_old') ? date('Y-m-d') : Input::get('status_update')),
							#'status_as_of' => Input::get('status_as_of'),
							'vbox' => Input::get('vbox'),
							'alcatel' => Input::get('alcatel'),
							'avaya' => Input::get('avaya'),
							'cisco' => Input::get('cisco'),
							'sql_server' => Input::get('sql_server'),

							'oracle' => Input::get('oracle'),						
							'altitude_routing' => Input::get('altitude_routing'),
							'altitude_dialer' => Input::get('altitude_dialer'),
							'altitude_voice' => Input::get('altitude_voice'),
							'altitude_email' => Input::get('altitude_email'),

							'altitude_chat' => Input::get('altitude_chat'),
							'social' => Input::get('social'),
							'altitude_desktop' => Input::get('altitude_desktop'),
							'altitude_ivr' => Input::get('altitude_ivr'),
							'altitude_express_routing' => Input::get('altitude_express_routing'),
					
							'altitude_integration' => Input::get('altitude_integration'),
							'altitude_workflow' => Input::get('altitude_workflow'),
							'uci_installation' => Input::get('uci_installation'),
							'uci_patch' => Input::get('uci_patch'),
							'sap' => Input::get('sap'),

							'siebel' => Input::get('siebel'),
							'ms_crm' => Input::get('ms_crm'),
							'teleopti' => Input::get('teleopti'),
							'supervisor' => Input::get('supervisor'),
							'administrator' => Input::get('administrator'),

							'developer' => Input::get('developer'),
							'updated_at'	=> date('Y-m-d H:i:s')
						);									
			SkillsMapV7::updateSkillsMap(Input::get('skill_id'), $arrParams, Input::get('id'));
			
			if( CommonHelper::hasValue(Input::get('cust_id_remarkV7')) ) {
				$arrParamsRemark = array(
					'cid'				=> Input::get('cust_id_remarkV7'),
					'uid'				=> Input::get('id'),
					'admin_id'			=> Auth::user()->id,
					'skill_name'		=> Input::get('skill_nameV7'),
					'skill_rate'		=> Input::get('skill_rateV7'),
					'old_skill_rate'	=> Input::get('old_skill_rateV7'),
					'remarks'	  		=> Input::get('remarksV7'),
					'created_at'		=> date('Y-m-d H:i:s')
				);

				SkillsMapV7::addSkillProficiency($arrParamsRemark);
			}
			
			return Redirect::to('admin/skills-map/update' .'?show=v7&id=' . Input::get('id').'#a-version7')
				->with('success', 'Successfully updated skills map!');
		}
	}

	protected function getEngineers() {				
		$results = User::getEngineers();
		$results_total = User::getTotalEngineers();
				
		$this->data['engineer_total'] = $results_total;		
		$this->data['engineers'] = $results;	

		$this->data['skills'] = SkillsMapV7::getSkillsMap(Input::get('id'));
		$this->data['skill_history'] = SkillsMapV7::getSkillHistory(Input::get('id'));

		$companies = Companies::getCompanies();
		$comp_array = array();

		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}
		$this->data['companies'] = $comp_array;

		$this->layout->content = View::make('engineer.list', $this->data);				
	}

	protected function getSkillEngineers() {
		// Breadcrumbs
		$this->breadcrumbs = array();

		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/dashboard'),
									'text'      => 'Dashboard',
									'class'		=> '',
						      		'separator' => FALSE
   		);
   		
		$this->breadcrumbs[] = array(
									'href'      => URL::to('admin/skills-map-v7'),
									'text'      => 'Skills Map',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		$version_color = SkillsMapV7::getVersionColor(Input::get('id'));			
		$this->data['colored_circle_cs'] = SkillsMapV7::colorStatus(Input::get('id'), $version_color);

		$this->data['skills'] = SkillsMapV7::getSkillsMap(Input::get('id'));
		$this->data['skill_history'] = SkillsMapV7::getSkillHistory(Input::get('id'));		
		$this->data['colored_circle_ce'] = SkillsMapV7::colorStatusCE(Input::get('id'));
		$this->data['customers'] = SkillsMap::customers();
		$this->data['no_of_feedbacks'] = SkillsMapV7::feedbackCtr(Input::get('id'));
		$this->data['customer_feedbacks'] = SkillsMapV7::getFeedback(Input::get('id'));
		$this->data['votc_average'] = SkillsMapV7::getFeedbackAverages(Input::get('id'));
		$this->data['allEngrCustomers'] = SkillsMapV7::getAllEngrCustomers(Input::get('id'));
		
		$companies = Companies::getCompanies();
		$comp_array = array();

		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}

		$this->data['company'] = $comp_array;			
		$this->layout->content = View::make('engineer.skills_map', $this->data);		
	}
	
	public function insertFeedback() {
		$arrParams = array(
						'cid'				=> Input::get('cust_id_feedback'),
						'uid'				=> Input::get('uid'),
						'admin_id'			=> Auth::user()->id,
						'communication'		=> Input::get('f_communication'),
						'commitment'		=> Input::get('f_commitment'),
						'analysis'			=> Input::get('f_analysis'),
						'delivery'			=> Input::get('f_delivery'),
						'productivity'		=> Input::get('f_productivity'),
						'fixing'			=> Input::get('f_fixing'),
						'presentability'	=> Input::get('f_presentability'),
						'recommendation'	=> Input::get('f_recommendation'),
						'remarks'			=> Input::get('feedback_remarks'),
						'created_at'		=> date('Y-m-d H:i:s')
					);
		SkillsMapV7::insertFeedback($arrParams);		

		return Redirect::to('admin/skills-map-v7/update?id=' . Input::get('uid').'#scroll-voc')
			->with('success', 'Successfully added new feedback!');		
	}

	public function deleteFeedback() {		
		SkillsMapV7::deleteFeedback(explode('|', Input::get('id')));

		return Redirect::to('admin/skills-map-v7/update?id=' . Input::get('uid').'#scroll-voc')
			->with('success', 'Successfully deleted customer feedback!');		
	}

	public function updateFeedback() {		
		foreach(Input::get('id') AS $key => $id) {
			$arrParams = array(
				#'admin_id' 			=> Auth::user()->id,
				'communication' 	=> Input::get('fu_communication')[$key],
				'commitment' 		=> Input::get('fu_commitment')[$key],
				'analysis' 			=> Input::get('fu_analysis')[$key],
				'delivery' 			=> Input::get('fu_delivery')[$key],
				'productivity' 		=> Input::get('fu_productivity')[$key],
				'fixing' 			=> Input::get('fu_fixing')[$key],
				'presentability' 	=> Input::get('fu_presentability')[$key],
				'recommendation' 	=> Input::get('fu_recommendation')[$key],
				'updated_at'		=> date('Y-m-d H:i:s')
			);
			SkillsMapV7::updateFeedback($arrParams, $id);		
		}
		
		if( CommonHelper::hasValue(Input::get('del-feedback')) ) {
			SkillsMapV7::deleteFeedback(explode('|', Input::get('del-feedback')));
		}

		return Redirect::to('admin/skills-map-v7/update?id=' . Input::get('uid').'#scroll-voc')
			->with('success', 'Successfully updated customer feedback!');		
	}	

	public function getSkillData() {
		$uid = Input::get('uid');
		$skill_name = Input::get('skill_name');

		if(Request::ajax()) {
		  $html = SkillsMapV7::getSkillProficiencyData($uid, $skill_name);	

		  return $html;
	    }
	}

	public function deleteSkill() {		
		SkillsMapV7::deleteSkill(Input::get('id'));

		return Redirect::to('admin/skills-map/update?show=v7&id=' . Input::get('uid').'#a-version7')
			->with('success', 'Successfully deleted skill proficiency!');		
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