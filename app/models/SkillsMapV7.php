<?php
class SkillsMapV7 extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'skills_map_v7';

	public static function getUsers($data = array()) {
		$query = DB::table('users')
			->select(DB::raw('skills_map_v7.*, skills_map_v7.status AS status_rate, users.*'))		
			->leftjoin('skills_map_v7', 'users.id', '=', 'skills_map_v7.uid')
			->where('users.id', '!=', Auth::id())
			->where('users.skills_map', '=', 1);			

		if( CommonHelper::hasValue($data['filter_username']) ) $query->where('username', 'LIKE', '%'.$data['filter_username'].'%');
		if( CommonHelper::hasValue($data['filter_first_name']) ) $query->where('first_name', 'LIKE', '%'.$data['filter_first_name'].'%');
		if( CommonHelper::hasValue($data['filter_middle_name']) ) $query->where('middle_name', 'LIKE', '%'.$data['filter_middle_name'].'%');
		if( CommonHelper::hasValue($data['filter_last_name']) ) $query->where('last_name', 'LIKE', '%'.$data['filter_last_name'].'%');
		if( CommonHelper::hasValue($data['filter_primary_email']) ) $query->where('primary_email_address', 'LIKE', '%'.$data['filter_primary_email'].'%');
		if( CommonHelper::hasValue($data['filter_user_type']) ) $query->where('user_type', '=', $data['filter_user_type']);
		
		if (isset($data['filter_status'])) {
			if (in_array($data['filter_status'], array('0', '1'))) {
				$query->where('status', '=', $data['filter_status']);
			}
		}

		if( CommonHelper::hasValue($data['sort']) && CommonHelper::hasValue($data['order']))  {
			$query->orderBy($data['sort'], $data['order']);
		}
		
		if( CommonHelper::hasValue($data['limit']) && CommonHelper::hasValue($data['page']))  {
			$query->skip($data['limit'] * ($data['page'] - 1))
		          ->take($data['limit']);
		}
		
		$result = $query->get();
				
		return $result;
	}
	
	public static function getTotalUsers($data = array()) {
		$query = DB::table('users');

		if( CommonHelper::hasValue($data['filter_username']) ) $query->where('username', 'LIKE', '%'.$data['filter_username'].'%');
		if( CommonHelper::hasValue($data['filter_first_name']) ) $query->where('first_name', 'LIKE', '%'.$data['filter_first_name'].'%');
		if( CommonHelper::hasValue($data['filter_middle_name']) ) $query->where('middle_name', 'LIKE', '%'.$data['filter_middle_name'].'%');
		if( CommonHelper::hasValue($data['filter_last_name']) ) $query->where('last_name', 'LIKE', '%'.$data['filter_last_name'].'%');
		if( CommonHelper::hasValue($data['filter_primary_email']) ) $query->where('primary_email_address', 'LIKE', '%'.$data['filter_primary_email'].'%');
		if( CommonHelper::hasValue($data['filter_user_type']) ) $query->where('user_type', '=', $data['filter_user_type']);
		
		if (isset($data['filter_status'])) {
			if (in_array($data['filter_status'], array('0', '1'))) {
				$query->where('status', '=', $data['filter_status']);
			}
		}
		   								   
		return $query->count();
	}

	public static function getTotalEngineers($data = array()) {
		$query = DB::table('users');

		if( CommonHelper::hasValue($data['filter_username']) ) $query->where('username', 'LIKE', '%'.$data['filter_username'].'%');
		if( CommonHelper::hasValue($data['filter_first_name']) ) $query->where('first_name', 'LIKE', '%'.$data['filter_first_name'].'%');
		if( CommonHelper::hasValue($data['filter_middle_name']) ) $query->where('middle_name', 'LIKE', '%'.$data['filter_middle_name'].'%');
		if( CommonHelper::hasValue($data['filter_last_name']) ) $query->where('last_name', 'LIKE', '%'.$data['filter_last_name'].'%');
		if( CommonHelper::hasValue($data['filter_primary_email']) ) $query->where('primary_email_address', 'LIKE', '%'.$data['filter_primary_email'].'%');
		if( CommonHelper::hasValue($data['filter_user_type']) ) $query->where('user_type', '=', $data['filter_user_type']);
		
		if (isset($data['filter_status'])) {
			if (in_array($data['filter_status'], array('0', '1'))) {
				$query->where('status', '=', $data['filter_status']);
			}
		}
		$query->where('skills_map', '=', 1);
		   								   
		return $query->count();
	}

	public static function getSkillsMap($uid = 0) {
		$query = DB::table('skills_map_v7')
			->select(DB::raw('skills_map_v7.*, users.position, users.company, users.profile_pic, CONCAT(users.first_name, " ", users.last_name) AS fullname'))		
			->leftjoin('users', 'users.id', '=', 'skills_map_v7.uid')
			->where('users.id', '=', $uid);			

		$result = $query->first();
				
		return $result;
	}

	public static function getUserMap() {
		$query = DB::table('skills_map_v7')			
			->where('uid', '=', Auth::user()->id);			

		$result = $query->first();
				
		return $result;
	}

	public static function getEngineerSkillMap() {
		$query = DB::table('skills_map_v7')			
			->where('uid', '=', Auth::user()->id);			

		$result = $query->first();
				
		return $result;
	}

	public static function updateSkillsMap($id, $data = array(), $uid) {	
		$param = array();
		#$now = date('Y-m-d H:i:s');
		$by = Auth::user()->first_name.' '.Auth::user()->last_name;		

		$query_history = DB::table('skills_map_update_v7')->where('uid', '=', $uid);		
		$result_history = $query_history->first();

		$query_orig= DB::table('skills_map_v7')->where('id', '=', $id);		
		$result_orig = $query_orig->first();

		/*
		if($result_history->status != $data['status']) {
			$param['status'] = $data['status'];
			$param['status_update'] = date('Y-m-d H:i:s');	
			$param['status_by'] = $by;		
		}
		
		if($data['status_as_of'] != '') {
			$explode_history = explode(' ', $result_history->status_as_of);
			$explode_orig = explode(' ', $data['status_as_of']);
			if($explode_history[0] != $explode_orig[0]) {
				$param['status_as_of'] = $data['status_as_of'];
				$param['status_as_of_date'] = date('Y-m-d H:i:s');	
				$param['status_as_of_by'] = $by;		
			}
		}
		*/
		
		if($result_history->vbox != $data['vbox']) {			
			$param['vbox'] = $data['vbox'];
			$param['vbox_date'] = date('Y-m-d H:i:s');	
			$param['vbox_by'] = $by;		
		}		

		if($result_history->alcatel != $data['alcatel']) {
			$param['alcatel'] = $data['alcatel'];
			$param['alcatel_date'] = date('Y-m-d H:i:s'); 
			$param['alcatel_by'] = $by;
		}

		if($result_history->avaya != $data['avaya']) {
			$param['avaya'] = $data['avaya'];
			$param['avaya_date'] = date('Y-m-d H:i:s'); 
			$param['avaya_by'] = $by;
		}

		if($result_history->cisco != $data['cisco']) {
			$param['cisco'] = $data['cisco'];
			$param['cisco_date'] = date('Y-m-d H:i:s'); 
			$param['cisco_by'] = $by;
		}

		if($result_history->sql_server != $data['sql_server']) {
			$param['sql_server'] = $data['sql_server'];
			$param['sql_date'] = date('Y-m-d H:i:s'); 
			$param['sql_server_by'] = $by;
		}

		if($result_history->oracle != $data['oracle']) {
			$param['oracle'] = $data['oracle'];
			$param['oracle_date'] = date('Y-m-d H:i:s'); 
			$param['oracle_by'] = $by;
		}		

		if($result_history->altitude_routing != $data['altitude_routing']) {
			$param['altitude_routing'] = $data['altitude_routing'];
			$param['altitude_routing_date'] = date('Y-m-d H:i:s'); 
			$param['altitude_routing_by'] = $by;
		}

		if($result_history->altitude_dialer != $data['altitude_dialer']) {
			$param['altitude_dialer'] = $data['altitude_dialer'];
			$param['altitude_dialer_date'] = date('Y-m-d H:i:s');
			$param['altitude_dialer_by'] = $by; 
		}

		if($result_history->altitude_voice != $data['altitude_voice']) {
			$param['altitude_voice'] = $data['altitude_voice'];
			$param['altitude_voice_date'] = date('Y-m-d H:i:s'); 
			$param['altitude_voice_by'] = $by;
		}

		if($result_history->altitude_email != $data['altitude_email']) {
			$param['altitude_email'] = $data['altitude_email'];
			$param['altitude_email_date'] = date('Y-m-d H:i:s'); 
			$param['altitude_email_by'] = $by;
		}

		if($result_history->altitude_chat != $data['altitude_chat']) {
			$param['altitude_chat'] = $data['altitude_chat'];
			$param['altitude_chat_date'] = date('Y-m-d H:i:s'); 
			$param['altitude_chat_by'] = $by;
		}

		if($result_history->social != $data['social']) {
			$param['social'] = $data['social'];
			$param['social_date'] = date('Y-m-d H:i:s'); 
			$param['social_by'] = $by;
		}

		if($result_history->altitude_desktop != $data['altitude_desktop']) {
			$param['altitude_desktop'] = $data['altitude_desktop'];
			$param['altitude_desktop_date'] = date('Y-m-d H:i:s');
			$param['altitude_desktop_by'] = $by; 
		}

		if($result_history->altitude_ivr != $data['altitude_ivr']) {
			$param['altitude_ivr'] = $data['altitude_ivr'];
			$param['altitude_ivr_date'] = date('Y-m-d H:i:s'); 
			$param['altitude_ivr_by'] = $by;
		}
		if($result_history->altitude_express_routing != $data['altitude_express_routing']) {
			$param['altitude_express_routing'] = $data['altitude_express_routing'];
			$param['altitude_express_routing_date'] = date('Y-m-d H:i:s');
			$param['altitude_express_routing_by'] = $by; 
		}

		if($result_history->altitude_integration != $data['altitude_integration']) {
			$param['altitude_integration'] = $data['altitude_integration'];
			$param['altitude_integration_date'] = date('Y-m-d H:i:s'); 
			$param['altitude_integration_by'] = $by;
		}

		if($result_history->altitude_workflow != $data['altitude_workflow']) {
			$param['altitude_workflow'] = $data['altitude_workflow'];
			$param['altitude_workflow_date'] = date('Y-m-d H:i:s'); 
			$param['altitude_workflow_by'] = $by;
		}

		if($result_history->uci_installation != $data['uci_installation']) {
			$param['uci_installation'] = $data['uci_installation'];
			$param['uci_installation_date'] = date('Y-m-d H:i:s'); 
			$param['uci_installation_by'] = $by;
		}

		if($result_history->uci_patch != $data['uci_patch']) {
			$param['uci_patch'] = $data['uci_patch'];
			$param['uci_patch_date'] = date('Y-m-d H:i:s'); 
			$param['uci_patch_by'] = $by;
		}

		if($result_history->sap != $data['sap']) {
			$param['sap'] = $data['sap'];
			$param['sap_date'] = date('Y-m-d H:i:s'); 
			$param['sap_by'] = $by;
		}

		if($result_history->siebel != $data['siebel']) {
			$param['siebel'] = $data['siebel'];
			$param['siebel_date'] = date('Y-m-d H:i:s'); 
			$param['siebel_by'] = $by;
		}

		if($result_history->ms_crm != $data['ms_crm']) {
			$param['ms_crm'] = $data['ms_crm'];
			$param['ms_crm_date'] = date('Y-m-d H:i:s'); 
			$param['ms_crm_by'] = $by;
		}

		if($result_history->teleopti != $data['teleopti']) {
			$param['teleopti'] = $data['teleopti'];
			$param['teleopti_date'] = date('Y-m-d H:i:s'); 
			$param['teleopti_by'] = $by;
		}

		if($result_history->supervisor != $data['supervisor']) {
			$param['supervisor'] = $data['supervisor'];
			$param['supervisor_date'] = date('Y-m-d H:i:s'); 
			$param['supervisor_by'] = $by;
		}

		if($result_history->administrator != $data['administrator']) {
			$param['administrator'] = $data['administrator'];
			$param['administrator_date'] = date('Y-m-d H:i:s'); 
			$param['administrator_by'] = $by;
		}

		if($result_history->developer != $data['developer']) {
			$param['developer'] = $data['developer'];
			$param['developer_date'] = date('Y-m-d H:i:s'); 
			$param['developer_by'] = $by;
		}		

		$param['updated_at'] = date('Y-m-d H:i:s');				

		$query_old = DB::table('skills_map_update_v7')->where('uid', '=', $uid);
		$query_old->update($param);	

		$query = DB::table('skills_map_v7')->where('id', '=', $id);
		$query->update($data);
	}

	public static function getSkillHistory($uid) {
		$query_history = DB::table('skills_map_update_v7')->where('uid', '=', $uid);		
		$result_history = $query_history->first();

		return $result_history;
	}
	
	public static function colorStatus($uid = 0, $current_color = 'red') {
		$query = DB::table('skills_map_v7')					
			->where('uid', '=', $uid);

		$data = $query->first();

		$new_color = 'red';		
		/***************************** - START DETERMINE IF -********************************/			
		if(
			($data->vbox >= 3 || $data->alcatel >= 3 || $data->avaya >= 3 || $data->cisco >= 3)
			&& ($data->sql_server >= 3 || $data->oracle >= 3)
			&& ($data->altitude_routing >= 3 || $data->altitude_dialer >= 3)
			&& ($data->altitude_voice >= 3 || $data->altitude_email >= 3 || $data->altitude_chat >= 3)
			&& ($data->altitude_desktop >= 3 || $data->altitude_ivr >= 3 || $data->altitude_integration >= 3)
			&& ($data->uci_installation >= 3)
			&& ($data->uci_patch >= 3)
		) {		
				$layer1_explode = explode('|', $data->vbox.'|'.$data->alcatel.'|'.$data->avaya.'|'.$data->cisco);
				$layer2_explode = explode('|', $data->sql_server.'|'.$data->oracle);
				$layer3_explode = explode('|', $data->altitude_routing.'|'.$data->altitude_dialer);
				$layer4_explode = explode('|', $data->altitude_voice.'|'.$data->altitude_email.'|'.$data->altitude_chat);
				$layer5_explode = explode('|', $data->altitude_desktop.'|'.$data->altitude_ivr.'|'.$data->altitude_integration); 

				rsort($layer1_explode);
				rsort($layer2_explode);
				rsort($layer3_explode);
				rsort($layer4_explode);
				rsort($layer5_explode);
				
				$layer6 = $data->uci_installation;
				$layer7 = $data->uci_patch;

				$average = ($layer1_explode[0] + $layer2_explode[0] + $layer3_explode[0] + $layer4_explode[0] + $layer5_explode[0] + $layer6 + $layer7) / 7;

				if($average >= 3 && $average < 4) {
					$new_color = 'green';
					$result = HTML::image('resources/img/green_circle.png', 'circle', array('width' => '32', 'height' => '32', 'class' => 'img-responsive'));
				} else if($average >= 4 && $average < 4.5) {
					$new_color = 'yellow';
					$result = HTML::image('resources/img/yellow_circle.png', 'circle', array('width' => '32', 'height' => '32', 'class' => 'img-responsive'));
				} else if($average >= 4.5) {
					$new_color = 'blue';
					$result = HTML::image('resources/img/blue_circle.png', 'circle', array('width' => '32', 'height' => '32', 'class' => 'img-responsive'));
				}
		} else {			
			$result = HTML::image('resources/img/red_circle.png', 'circle', array('width' => '32', 'height' => '32', 'class' => 'img-responsive'));			
		}

		if($current_color != $new_color) {
			$query_color = DB::table('certification_color_v7')->where('uid', '=', $uid);
			$query_color->update(array('color' => $new_color));
		}
		/*****************************- END DETERMINE IF -********************************/
				
		return $new_color;
	}
	
	public static function colorStatusCE($uid = 0) {
		$query = DB::table('customers_feedback')		
			->select(DB::raw('
					AVG(communication) AS communication_avg,
					AVG(commitment) AS commitment_avg,
					AVG(analysis) AS analysis_avg,
					AVG(delivery) AS delivery_avg,
					AVG(productivity) AS productivity_avg,
					AVG(fixing) AS fixing_avg,
					AVG(presentability) AS presentability_avg,
					AVG(recommendation) AS recommendation_avg
				'))
			->where('uid', '=', $uid);

		$data = $query->first();
		/***************************** - START DETERMINE IF -********************************/		
		$result = HTML::image('resources/img/red_circle.png', 'circle', array('width' => '32', 'height' => '32', 'class' => 'img-responsive'));
		
		if($data->communication_avg >= 3 && $data->commitment_avg >= 3 && $data->analysis_avg >= 3 && 
			$data->delivery_avg >= 3 && $data->productivity_avg >= 3 && $data->fixing_avg >= 3 && 
			$data->presentability_avg >= 3 && $data->recommendation_avg) {
				
			$average = ($data->communication_avg + $data->commitment_avg + $data->analysis_avg + 
					$data->delivery_avg + $data->productivity_avg + $data->fixing_avg + 
					$data->presentability_avg + $data->recommendation_avg) / 8;
			
			if($average < 4) {
				$result = HTML::image('resources/img/green_circle.png', 'circle', array('width' => '32', 'height' => '32', 'class' => 'img-responsive'));
			} else if($average >= 4 && $average < 4.5) {
				$result = HTML::image('resources/img/yellow_circle.png', 'circle', array('width' => '32', 'height' => '32', 'class' => 'img-responsive'));
			} else if($average >= 4.5) {
				$result = HTML::image('resources/img/blue_circle.png', 'circle', array('width' => '32', 'height' => '32', 'class' => 'img-responsive'));
			}
		}	
		/*****************************- END DETERMINE IF -********************************/

		return $result;				
	}
	
	public static function customers() {
		$query = DB::table('customers')			
			->orderBy('company', 'ASC');			

		$result = $query->get();
				
		return $result;
	}
	
	public static function getFeedback($uid = 0) {
		$query = DB::table('customers_feedback')		
			->select(DB::raw('CONCAT(users.first_name, " ", users.last_name) AS admin, customers_feedback.*, customers.logo, customers.company'))		
			->leftjoin('customers', 'customers.id', '=', 'customers_feedback.cid')
			->leftjoin('users', 'users.id', '=', 'customers_feedback.admin_id')
			->where('customers_feedback.uid', '=', $uid)
			->orderBy('customers.company', 'ASC');			

		$result = $query->get();
				
		return $result;
	}
	
	public static function feedbackCtr($uid = 0) {
		$query = DB::table('customers_feedback')			
			->where('uid', '=', $uid);			

		$result = $query->count();
				
		return $result;
	}
	
	public static function insertFeedback($data = array()) {
		$id = DB::table('customers_feedback')->insertGetId($data);
		
		return $id;
	}

	public static function deleteFeedback($id = array()) {
		$query = DB::table('customers_feedback')->whereIn('id', $id)->delete();
	}

	public static function updateFeedback($data = array(), $id) {
		$query = DB::table('customers_feedback')->where('id', '=', $id);
		$query->update($data);
	}

	public static function getFeedbackAverages($uid = 0) {
		$query = DB::table('customers_feedback')		
			->select(DB::raw('
					AVG(communication) AS communication_avg,
					AVG(commitment) AS commitment_avg,
					AVG(analysis) AS analysis_avg,
					AVG(delivery) AS delivery_avg,
					AVG(productivity) AS productivity_avg,
					AVG(fixing) AS fixing_avg,
					AVG(presentability) AS presentability_avg,
					AVG(recommendation) AS recommendation_avg
				'))
			->where('uid', '=', $uid);

		$result = $query->first();
				
		return $result;
	}

	public static function addSkillProficiency($data = array()) {
		$id = DB::table('skills_proficiency_v7')->insertGetId($data);
		
		return $id;
	}

	public static function getSkillProficiencyData($uid = 0, $skill_name = '') {
		$query = DB::table('skills_proficiency_v7')		
			->select(DB::raw('
					skills_proficiency_v7.*, customers.logo	, customers.company, CONCAT(users.first_name, " ", users.last_name) AS updated_by									
				'))
			->leftjoin('customers', 'customers.id', '=', 'skills_proficiency_v7.cid')
			->leftjoin('users', 'users.id', '=', 'skills_proficiency_v7.admin_id')			
			->where('skills_proficiency_v7.skill_name', '=', $skill_name)
			->where('skills_proficiency_v7.uid', '=', $uid)
			->orderBy('skills_proficiency_v7.created_at', 'ASC');

		$query_user = DB::table('users')		
			->select(DB::raw('
					created_at AS date_created
				'))
			->where('id', '=', $uid);

		$ctr = $query->count();
		
		$row = $query_user->first();
		$html = '';

		$date_utc = '';
		$date_array = array(
			'01' => 0, '02' => 1, '03' => 2, '04' => 3,
			'05' => 4, '06' => 5, '07' => 6, '08' => 7,
			'09' => 8, '10' => 9, '11' => 10, '12' => 11
		);

		$img_array = array(
			'vbox' => HTML::image('resources/img/skills-map/infrastructure/vbox.png', 'logo', array('width' => '55', 'height' => '27', 'class' => 'img-responsive')),
			'alcatel' => HTML::image('resources/img/skills-map/infrastructure/alcatel.png', 'logo', array('width' => '96', 'height' => '27', 'class' => 'img-responsive')),
			'avaya' => HTML::image('resources/img/skills-map/infrastructure/avaya.png', 'logo', array('width' => '53', 'height' => '17', 'class' => 'img-responsive')),
			'cisco' => HTML::image('resources/img/skills-map/infrastructure/cisco.png', 'logo', array('width' => '49', 'height' => '20', 'class' => 'img-responsive')),
			'sql_server' => HTML::image('resources/img/skills-map/infrastructure/sql.png', 'logo', array('width' => '80', 'height' => '23', 'class' => 'img-responsive')),
			'oracle' => HTML::image('resources/img/skills-map/infrastructure/oracle.jpg', 'logo', array('width' => '83', 'height' => '19', 'class' => 'img-responsive')),

			'altitude_routing' => HTML::image('resources/img/skills-map/pacing/altitude_routing.png', 'logo', array('width' => '104', 'height' => '28', 'class' => 'img-responsive')),
			'altitude_dialer' => HTML::image('resources/img/skills-map/pacing/altitude_dialer.png', 'logo', array('width' => '89', 'height' => '24', 'class' => 'img-responsive')),

			'altitude_voice' => HTML::image('resources/img/skills-map/channels/altitude_voice.png', 'logo', array('width' => '75', 'height' => '25', 'class' => 'img-responsive')),
			'altitude_email' => HTML::image('resources/img/skills-map/channels/altitude_email.png', 'logo', array('width' => '67', 'height' => '21', 'class' => 'img-responsive')),
			'altitude_chat' => HTML::image('resources/img/skills-map/channels/altitude_chat.png', 'logo', array('width' => '62', 'height' => '24', 'class' => 'img-responsive')),

			'social' => HTML::image('resources/img/skills-map/channels/social.PNG', 'logo', array('width' => '50', 'height' => '23', 'class' => 'img-responsive')),
			'altitude_desktop' => HTML::image('resources/img/skills-map/development/altitude_desktop.png', 'logo', array('width' => '87', 'height' => '23', 'class' => 'img-responsive')),
			'altitude_ivr' => HTML::image('resources/img/skills-map/development/altitude_ivr.png', 'logo', array('width' => '84', 'height' => '24', 'class' => 'img-responsive')),
			'altitude_express_routing' => HTML::image('resources/img/skills-map/development/altitude_express_routing.png', 'logo', array('width' => '83', 'height' => '28', 'class' => 'img-responsive')),
			'altitude_integration' => HTML::image('resources/img/skills-map/development/altitude_integration.png', 'logo', array('width' => '67', 'height' => '24', 'class' => 'img-responsive')),
			'altitude_workflow' => HTML::image('resources/img/skills-map/development/altitude_workflow.png', 'logo', array('width' => '56', 'height' => '25', 'class' => 'img-responsive')),

			'uci_installation' => HTML::image('resources/img/skills-map/installation/uci_installation.png', 'logo', array('width' => '104', 'height' => '28', 'class' => 'img-responsive')),
			'uci_patch' => HTML::image('resources/img/skills-map/installation/uci_patch.PNG', 'logo', array('width' => '89', 'height' => '24', 'class' => 'img-responsive')),

			'sap' => HTML::image('resources/img/skills-map/connectors/sap.png', 'logo', array('width' => '48', 'height' => '24', 'class' => 'img-responsive')),
			'siebel' => HTML::image('resources/img/skills-map/connectors/siebel.png', 'logo', array('width' => '77', 'height' => '19', 'class' => 'img-responsive')),
			'ms_crm' => HTML::image('resources/img/skills-map/connectors/ms_crm.png', 'logo', array('width' => '120', 'height' => '25', 'class' => 'img-responsive')),
			'teleopti' => HTML::image('resources/img/skills-map/connectors/teleopti.png', 'logo', array('width' => '64', 'height' => '22', 'class' => 'img-responsive'))
		);
		
		//START: Created date of the engineer; default it to 0
		$date_formatted = date_create($row->date_created);				
		$date_created = explode('-', date_format($date_formatted, "Y-m-d"));
		$c_date = $date_created[0].', '.$date_array[$date_created[1]].', '.$date_created[2];
					
		$date_utc .= "[Date.UTC(".$c_date."), 0],";
		//END: Created date of the engineer; default it to 0

		if(! in_array($skill_name, array('supervisor', 'administrator', 'developer'))) {			
			$html .= '<span id="span-skill-img">'.$img_array[$skill_name].'</span><br>';		
		} else {
			$html .= '<span id="span-skill-img"><b>'.strtoupper($skill_name).'</b></span>';
		}

		$html .= '<div id="container-remarks"></div>';
		if($ctr > 0) {
			$data = $query->get();			

			foreach($data as $rate) {
				$date_format = date_create($rate->created_at);				
				$created_at = explode('-', date_format($date_format, "Y-m-d"));
				$all_dates = $created_at[0].', '.$date_array[$created_at[1]].', '.$created_at[2];
				
				$date_utc .= '[Date.UTC('.$all_dates.'), '.$rate->skill_rate.'],';
			}

			$html .= '<br><span style="cursor: pointer; color: #00649A;" onclick="toggleRemarks();" id="span-history"><i class="icon-large icon-plus" title="show history"></i></span>';
			$html .= '<div id="div-remarks" style="display: none;">';	
			#$html .= '<b>Total:</b> '.$ctr;
			$html .= '<table class="table" style="border: #ddd;" border="1" id="tblRemarks">';
			$html .= '<tr align="center" style="font-weight: bold;">';
			$html .= '<td>Date/Time</td>';
			$html .= '<td>Proficiency</td>';
			$html .= '<td>Customer</td>';
			$html .= '<td>Remarks</td>';
			$html .= '<td>Updated By</td>';
			if(Auth::user()->user_type == 1) {
				$html .= '<td>&nbsp;</td>';
			}
			$html .= '</tr>';

			foreach($data as $row) {
				$cust_photo = $row->logo;
                if($row->logo == '') {
                  $cust_photo = 'no-photo.jpg';
                }
				$img_src = Config::get('app.url_storage') . '/company_logo/'.$cust_photo;
				$html .= '<tr id="tr-skill-'.$row->id.'">';
				$html .= '<td>'.$row->created_at.'</td>';
				$html .= '<td>from '.$row->old_skill_rate.' to '.$row->skill_rate.'</td>';			
				$html .= '<td align="center"><img title="'.$row->company.'" style="margin-left:12px;width:75px;" src="'.$img_src.'" width="120" alt="customer logo"></td>';
				$html .= '<td>'.nl2br($row->remarks).'</td>';
				$html .= '<td>'.$row->updated_by.'</td>';
				if(Auth::user()->user_type == 1) {
					$html .= '<td><a style="cursor: pointer;" onclick="deleteSkillProficiencyV7('.$row->id.');"><i class="icon-trash"></i></a></td>';
				}
				$html .= '</tr>';
			}
			$html .= '</table>';
			$html .= '</div>';
		}

		$script = "
				<script>
				$(function () {
					$('#container-remarks').highcharts({
					        chart: {
					            height: 200,					            
					            type: 'line'
					        },
					        title: {
					            text: 'Skill History Updates'
					        },
					        xAxis: {					        	
					            type: 'datetime',					            
            					minTickInterval: 3600*24*30*1000,//time in milliseconds
    							minRange: 3600*24*30*1000
					        },
					        yAxis: {
					            title: {
					                text: 'Proficiency'
					            },					            
					            plotLines: [{
					                value: 0,
					                width: 1,
					                color: '#808080'
					            }],		
					            categories: [0, 1, 2, 3, 4, 5],
					            min: 0,
    							max: 5
					        },
					        pane: {
					            size: '80%'
					        },

					        tooltip: {
					            shared: true					            
					        },

					        series: [{
					        	name: 'Proficiency',
					        	showInLegend: false,    
					            //Date.UTC(Year, Month, Day) 0-11 is month
					            data: [".$date_utc."]
					        }]
					    });
					});
					</script>
			";
			$html .= $script;

			return $html;
	}

	public static function getAllEngrCustomers($uid) {
		$query = DB::table('skills_proficiency_v7')		
			->select(DB::raw('
					customers.logo, customers.company
				'))
			->leftjoin('customers', 'customers.id', '=', 'skills_proficiency_v7.cid')
			->where('skills_proficiency_v7.uid', '=', $uid)
			->groupBy('skills_proficiency_v7.cid')
			->orderBy('skills_proficiency_v7.created_at', 'DESC');

		$result = $query->get();
				
		return $result;
	}

	public static function getVersionColor($uid) {
		$query = DB::table('certification_color_v7')			
			->where('uid', '=', $uid);			

		$result = $query->first();
				
		return $result->color;
	}

	public static function deleteSkill($id) {
		$query = DB::table('skills_proficiency_v7')->where('id', $id)->delete();
	}	
}
