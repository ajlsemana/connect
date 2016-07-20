<?php 

class SkillsMapController extends BaseController {
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
									'href'      => URL::to('admin/skills-map'),
									'text'      => 'Engineer Profiles',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;
		
		// URL
		$url = $this->setURL();		
		$this->data['url_update'] = URL::to('admin/skills-map/update' . $url);		
		$this->data['url_update_v7'] = URL::to('admin/skills-map-v7/update' . $url);		
		$this->data['url_search'] = URL::to('admin/skills-map');
		
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
		$filter_company = Input::get('filter_company', NULL);
		$filter_v7 = Input::get('filter_v7', NULL);
		$filter_v8 = Input::get('filter_v8', NULL);
		$filter_user_type = Input::get('filter_user_type', NULL);
		$filter_status = Input::get('filter_status', NULL);

		// Data
		$sort = Input::get('sort', 'company');
		$order = Input::get('order', 'ASC');
		$page = Input::get('page', 1);
		
		$arrParams = array(
							'filter_username'		=> $filter_username,
							'filter_first_name'		=> $filter_first_name,
							'filter_middle_name'	=> $filter_middle_name,
							'filter_last_name'		=> $filter_last_name,
							'filter_primary_email'	=> $filter_primary_email,
							'filter_company'		=> $filter_company,
							'filter_v7'				=> $filter_v7,
							'filter_v8'				=> $filter_v8,
							'filter_user_type'		=> $filter_user_type,
							'filter_status'			=> $filter_status,
							'sort'					=> $sort,
							'order'					=> $order,
							'page'					=> $page,
							'limit'					=> 10
						);		
		$results = SkillsMap::getUsers($arrParams);
		$results_total = SkillsMap::getTotalEngineers($arrParams);
		
		// Pagination
		$this->data['arrFilters'] = array(
										'filter_username'		=> $filter_username,
										'filter_first_name'		=> $filter_first_name,
										'filter_middle_name'	=> $filter_middle_name,
										'filter_last_name'		=> $filter_last_name,
										'filter_primary_email'	=> $filter_primary_email,
										'filter_company'		=> $filter_company,
										'filter_v7'				=> $filter_v7,
										'filter_v8'				=> $filter_v8,
										'filter_user_type'		=> $filter_user_type,
										'filter_status'			=> $filter_status,
										'sort'					=> $sort,
										'order'					=> $order
									);
		
		#$this->data['users'] = Paginator::make($results, $results_total, 10);
		$this->data['users'] = $results;
		$this->data['users_total'] = $results_total;

		$this->data['filter_username'] = $filter_username;
		$this->data['filter_first_name'] = $filter_first_name;
		$this->data['filter_middle_name'] = $filter_middle_name;
		$this->data['filter_last_name'] = $filter_last_name;
		$this->data['filter_primary_email'] = $filter_primary_email;
		$this->data['filter_company'] = $filter_company;
		$this->data['filter_v7'] = $filter_v7;
		$this->data['filter_v8'] = $filter_v8;
		$this->data['filter_user_type'] = $filter_user_type;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->data['page'] = $page;

		$url = '?filter_username=' . $filter_username . '&filter_first_name=' . $filter_first_name;		
		$url .= '&filter_primary_email=' . $filter_primary_email . '&filter_company=' . $filter_company;		
		$url .= '&filter_v7=' . $filter_v7 . '&filter_v8=' . $filter_v8;		
		$url .= '&filter_user_type=' . $filter_user_type . '&filter_status=' . $filter_status;
		$url .= '&page=' . $page;

		$order_username = ($sort=='username' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_first_name = ($sort=='first_name' && $order=='ASC') ? 'DESC' : 'ASC';		
		$order_last_name = ($sort=='last_name' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_email_address = ($sort=='primary_email_address' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_user_type = ($sort=='user_type' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_status = ($sort=='status' && $order=='ASC') ? 'DESC' : 'ASC';
		$order_date_added = ($sort=='created_at' && $order=='ASC') ? 'DESC' : 'ASC';
		
		$this->data['sort_username'] = URL::to('admin/skills-map' . $url . '&sort=username&order=' . $order_username, NULL, FALSE);
		$this->data['sort_first_name'] = URL::to('admin/skills-map' . $url . '&sort=first_name&order=' . $order_first_name, NULL, FALSE);		
		$this->data['sort_last_name'] = URL::to('admin/skills-map' . $url . '&sort=last_name&order=' . $order_last_name, NULL, FALSE);
		$this->data['sort_primary_email'] = URL::to('admin/skills-map' . $url . '&sort=primary_email_address&order=' . $order_email_address, NULL, FALSE);
		$this->data['sort_user_type'] = URL::to('admin/skills-map' . $url . '&sort=user_type&order=' . $order_user_type, NULL, FALSE);
		$this->data['sort_status'] = URL::to('admin/skills-map' . $url . '&sort=status&order=' . $order_status, NULL, FALSE);
		$this->data['sort_date_added'] = URL::to('admin/skills-map' . $url . '&sort=created_at&order=' . $order_date_added, NULL, FALSE);
		
		$companies = Companies::getCompanies();
		$comp_array = array();
		$comp_opt = array();

		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}
		
		$comp_opt[''] = '- Please Select -';
		foreach($companies as $comp_names) {
			if($comp_names->category == 2) {
				$comp_opt[$comp_names->id] = $comp_names->company;
			}
		}
		$this->data['company_options'] = $comp_opt; 
		
		$this->data['enrolled_courses'] = SkillsMap::getEnrolledCourses();
		$this->data['ended_courses'] = SkillsMap::getEndedCourses();

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
									'href'      => URL::to('admin/skills-map'),
									'text'      => 'Skills Map',
									'class'		=> 'active',
									'separator' => TRUE
   		);

		$this->data['breadcrumbs'] = $this->breadcrumbs;

		//COMMON FOR BOTH V7 AND V8
		$this->data['customers'] = SkillsMap::customers();
		$this->data['votc_average'] = SkillsMap::getFeedbackAverages(Input::get('id'));
		$this->data['no_of_feedbacks'] = SkillsMap::feedbackCtr(Input::get('id'));
		$this->data['customer_feedbacks'] = SkillsMap::getFeedback(Input::get('id'));
		$this->data['skill_desc'] = SkillsMap::getSkillDescription();
		$this->data['customer_feedback_logo'] = SkillsMap::getFeedbackLogo(Input::get('id'));

		/*************************** START V8 ****************************/
		$version_color = SkillsMap::getVersionColor(Input::get('id'));				
		$this->data['colored_circle_cs'] = SkillsMap::colorStatus(Input::get('id'), $version_color);		
		$this->data['skills'] = SkillsMap::getSkillsMap(Input::get('id'));
		$this->data['skills_graph'] = SkillsMap::getSkillsMapGraph(Input::get('id'));
		$this->data['skill_history'] = SkillsMap::getSkillHistory(Input::get('id'));		
		$this->data['colored_circle_ce'] = SkillsMap::colorStatusCE(Input::get('id'));
		$this->data['allEngrCustomers'] = SkillsMap::getAllEngrCustomers(Input::get('id'));
		/**************************** END V8 ****************************/

		/*************************** START V7 ****************************/
		$version_color7 = SkillsMapV7::getVersionColor(Input::get('id'));
		$this->data['colored_circle_csV7'] = SkillsMapV7::colorStatus(Input::get('id'), $version_color);

		$this->data['skillsV7'] = SkillsMapV7::getSkillsMap(Input::get('id'));
		$this->data['skill_historyV7'] = SkillsMapV7::getSkillHistory(Input::get('id'));
		$this->data['colored_circle_csV7'] = SkillsMapV7::colorStatus(Input::get('id'));
		$this->data['colored_circle_ceV7'] = SkillsMapV7::colorStatusCE(Input::get('id'));
		$this->data['allEngrCustomersV7'] = SkillsMapV7::getAllEngrCustomers(Input::get('id'));
		/**************************** END V7 ****************************/
		
		$companies = Companies::getCompanies();
		$comp_array = array();

		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}

		$this->data['company'] = $comp_array;
		if(Auth::user()->user_type == 1) {			
			$this->layout->content = View::make('users.skills_map_update', $this->data);		
		} else {
			if (SkillsMap::getUserMap() == NULL) {
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
			return Redirect::to('admin/skills-map/update' .'?id=' . Input::get('id'))
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
							'reporting_framework' => Input::get('reporting_framework'),
							'sap' => Input::get('sap'),

							'siebel' => Input::get('siebel'),
							'ms_crm' => Input::get('ms_crm'),
							'teleopti' => Input::get('teleopti'),
							'strategy_manager' => Input::get('strategy_manager'),
							'enterprise_recorder' => Input::get('enterprise_recorder'),
							'otcs' => Input::get('otcs'),
							'mobile_dashboard' => Input::get('mobile_dashboard'),
							'supervisor' => Input::get('supervisor'),
							'administrator' => Input::get('administrator'),

							'developer' => Input::get('developer'),														
							'updated_at'	=> date('Y-m-d H:i:s')
						);						
			SkillsMap::updateSkillsMap(Input::get('skill_id'), $arrParams, Input::get('id'));

			if( CommonHelper::hasValue(Input::get('cust_id_remark')) ) {		
				$arrParamsRemark = array(
					'cid'				=> Input::get('cust_id_remark'),
					'uid'				=> Input::get('id'),
					'admin_id'			=> Auth::user()->id,
					'skill_name'		=> Input::get('skill_name'),
					'skill_rate'		=> Input::get('skill_rate'),
					'old_skill_rate'	=> Input::get('old_skill_rate'),
					'remarks'	  		=> Input::get('remarks'),
					'created_at'		=> date('Y-m-d H:i:s')
				);

				SkillsMap::addSkillProficiency($arrParamsRemark);
			}			

			return Redirect::to('admin/skills-map/update' .'?show=v8&id=' . Input::get('id').'#a-version8')
				->with('success', 'Successfully updated skills map!');
		}
	}

	public function updateSkill() {
		//trap
		if(Request::ajax()) {		
			$arrParamsRemark = array(
				'cid'				=> Input::get('cust_id_remark'),
				'uid'				=> Input::get('id'),
				'admin_id'			=> Auth::user()->id,
				'skill_name'		=> Input::get('skill_name'),
				'skill_rate'		=> Input::get('skill_rate'),
				'old_skill_rate'	=> Input::get('old_skill_rate'),
				'remarks'	  		=> Input::get('remarks'),
				'created_at'		=> date('Y-m-d H:i:s')
			);

			SkillsMap::addSkillProficiency($arrParamsRemark);
		}
	}

	protected function getEngineers() {				
		$results = User::getEngineers();
		$results_total = User::getTotalEngineers();
					
		$this->data['engineer_total'] = $results_total;		
		$this->data['users'] = $results;	

		$this->data['enrolled_courses'] = SkillsMap::getEnrolledCourses();
		$this->data['ended_courses'] = SkillsMap::getEndedCourses();

		$this->data['url_update'] = URL::to('trainee/engr-skills-map');
		$companies = Companies::getCompanies();
		$comp_array = array();
		$comp_opt = array();

		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}
		
		$comp_opt[''] = '- Please Select -';
		foreach($companies as $comp_names) {
			if($comp_names->category == 2) {
				$comp_opt[$comp_names->id] = $comp_names->company;
			}
		}
		$this->data['company_options'] = $comp_opt; 
		
		$this->data['enrolled_courses'] = SkillsMap::getEnrolledCourses();
		$this->data['ended_courses'] = SkillsMap::getEndedCourses();

		$this->data['company'] = $comp_array;

		$this->layout->content = View::make('engineer.list', $this->data);				
	}

	protected function getSkillEngineers() {
		// asdf
		//COMMON FOR BOTH V7 AND V8
		$this->data['customers'] = SkillsMap::customers();
		$this->data['votc_average'] = SkillsMap::getFeedbackAverages(Input::get('id'));
		$this->data['no_of_feedbacks'] = SkillsMap::feedbackCtr(Input::get('id'));
		$this->data['customer_feedbacks'] = SkillsMap::getFeedback(Input::get('id'));
		$this->data['skill_desc'] = SkillsMap::getSkillDescription();
		$this->data['customer_feedback_logo'] = SkillsMap::getFeedbackLogo(Input::get('id'));

		/*************************** START V8 ****************************/
		$version_color = SkillsMap::getVersionColor(Input::get('id'));				
		$this->data['colored_circle_cs'] = SkillsMap::colorStatus(Input::get('id'), $version_color);		
		$this->data['skills'] = SkillsMap::getSkillsMap(Input::get('id'));
		$this->data['skills_graph'] = SkillsMap::getSkillsMapGraph(Input::get('id'));
		$this->data['skill_history'] = SkillsMap::getSkillHistory(Input::get('id'));		
		$this->data['colored_circle_ce'] = SkillsMap::colorStatusCE(Input::get('id'));
		$this->data['allEngrCustomers'] = SkillsMap::getAllEngrCustomers(Input::get('id'));
		/**************************** END V8 ****************************/

		/*************************** START V7 ****************************/
		$version_color7 = SkillsMapV7::getVersionColor(Input::get('id'));
		$this->data['colored_circle_csV7'] = SkillsMapV7::colorStatus(Input::get('id'), $version_color);

		$this->data['skillsV7'] = SkillsMapV7::getSkillsMap(Input::get('id'));
		$this->data['skill_historyV7'] = SkillsMapV7::getSkillHistory(Input::get('id'));
		$this->data['colored_circle_csV7'] = SkillsMapV7::colorStatus(Input::get('id'));
		$this->data['colored_circle_ceV7'] = SkillsMapV7::colorStatusCE(Input::get('id'));
		$this->data['allEngrCustomersV7'] = SkillsMapV7::getAllEngrCustomers(Input::get('id'));
		/**************************** END V7 ****************************/
		
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
		SkillsMap::insertFeedback($arrParams);		

		return Redirect::to('admin/skills-map/update?show=voc&id=' . Input::get('uid').'#scroll-voc')
			->with('success', 'Successfully added new feedback!');		
	}
	
	public function deleteFeedback() {	
		if(Request::ajax()) {			
		  SkillsMap::deleteFeedback(array(Input::get('id')));
		  $votc_average = SkillsMap::getFeedbackAverages(Input::get('uid'));		  
		                                 
        $communication_avg = number_format($votc_average->communication_avg, 2);
        $commitment_avg = number_format($votc_average->commitment_avg, 2);
        $analysis_avg = number_format($votc_average->analysis_avg, 2);
        $delivery_avg = number_format($votc_average->delivery_avg, 2);
        $productivity_avg = number_format($votc_average->productivity_avg, 2);
        $fixing_avg = number_format($votc_average->fixing_avg, 2);
        $presentability_avg = number_format($votc_average->presentability_avg, 2);
        $recommendation_avg = number_format($votc_average->recommendation_avg, 2);
        $colored_circle_ce = SkillsMap::colorStatusCE(Input::get('uid'));

		$html = '';
		$html .= $colored_circle_ce;
		$html .= '
		|<tr>
              <td>Communication</td>
              <td><input type="text" value="'.$communication_avg.'" style="width: 40px;" readonly></td>
               </tr>
               <tr>
                  <td>Commitment</td>
                  <td><input type="text" value="'.$commitment_avg.'" style="width: 40px;" readonly></td>
               </tr>
               <tr>
                  <td>Analysis</td>
                  <td><input type="text" value="'.$analysis_avg.'" style="width: 40px;" readonly></td>
               </tr>
               <tr>
                  <td>Quality of Delivery</td>
                  <td><input type="text" value="'.$delivery_avg.'" style="width: 40px;" readonly></td>
               </tr>
               <tr>
                  <td>Productivity</td>
                  <td><input type="text" value="'.$productivity_avg.'" style="width: 40px;" readonly></td>
               </tr>
               <tr>
                  <td>Issues Fixing Quality</td>
                  <td><input type="text" value="'.$fixing_avg.'" style="width: 40px;" readonly></td>
               </tr>
               <tr>
                  <td>Company Presentability</td>
                  <td><input type="text" value="'.$presentability_avg.'" style="width: 40px;" readonly></td>
               </tr>
               <tr>
                  <td>Productivity</td>
                  <td><input type="text" value="'.$productivity_avg.'" style="width: 40px;" readonly></td>
               </tr>
               <tr>
                  <td>Overall Recommendation</td>
                  <td><input type="text" value="'.$recommendation_avg.'" style="width: 40px;" readonly></td>
               </tr>
		';

		  return $html;
	    }
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
			SkillsMap::updateFeedback($arrParams, $id);		
		}
		
		return Redirect::to('admin/skills-map/update?show=voc&id=' . Input::get('uid').'#scroll-voc')
			->with('success', 'Successfully updated customer feedback!');		
	}	

	public function getSkillData() {
		$uid = Input::get('uid');
		$skill_name = Input::get('skill_name');

		if(Request::ajax()) {
		  $html = SkillsMap::getSkillProficiencyData($uid, $skill_name);	

		  return $html;
	    }
	}

	public function getDescription() {		
		$skill_name = Input::get('skill_name');

		if(Request::ajax()) {
		  $html = SkillsMap::getSkillDescription($skill_name);	

		  return $html;
	    }
	}

	public function deleteSkill() {		
		SkillsMap::deleteSkill(Input::get('id'));

		return Redirect::to('admin/skills-map/update?show=v8&id=' . Input::get('uid').'#a-version8')
			->with('success', 'Successfully deleted skill proficiency!');
	}

	public function sendSurvey() {		
		$cust_id = Input::get('cust_id_feedback');	
		$to = Input::get('email_to');
		$body = Input::get('email_body');
		$survey_count = Input::get('survery_count');

		echo $survey_count;
		echo '<br><br>';
		echo $cust_id;
		echo '<br><br>';
		echo $to;
		echo '<br><br>';
		echo $body;

		die();
	}

	protected function setURL() {
		// Search Filters
		$url = '?filter_username=' . Input::get('filter_username', NULL);
		$url .= '&filter_first_name=' . Input::get('filter_first_name', NULL);
		$url .= '&filter_middle_name=' . Input::get('filter_middle_name', NULL);
		$url .= '&filter_last_name=' . Input::get('filter_last_name', NULL);
		$url .= '&filter_primary_email' . Input::get('filter_primary_email', NULL);
		$url .= '&filter_company' . Input::get('filter_company', NULL);
		$url .= '&filter_v7' . Input::get('filter_v7', NULL);
		$url .= '&filter_v8' . Input::get('filter_v8', NULL);
		$url .= '&filter_user_type=' . Input::get('filter_user_type', NULL);
		$url .= '&filter_status=' . Input::get('filter_status', NULL);
		$url .= '&sort=' . Input::get('sort', 'username');
		$url .= '&order=' . Input::get('order', 'ASC');
		$url .= '&page=' . Input::get('page', 1);
		
		return $url;
	}
}