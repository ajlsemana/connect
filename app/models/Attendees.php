<?php

class Attendees extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'registrants';

	public static function addAttendee($data = array()) {
		$id = DB::table('temp_registration')->insertGetId($data);
		
		return $id;
	}

	public static function updateStatus($id, $data = array()) {
		$query = DB::table('registrants')->where('id', '=', $id);
		$query->update($data);	
	}	
	
	public static function deleteAttendees($data = array()) {
		DB::table('temp_registration')->whereIn('id', $data)->delete();
	}

	public static function getAttendees($data = array()) {		
		$query = DB::table('registrants')->select(DB::raw('registrants.*, users.*, courses.*, registrants.id AS rid, registrants.created_at AS c_at'))
									->leftJoin('courses', 'courses.id', '=', 'registrants.course')
									->leftJoin('users', 'users.id', '=', 'registrants.uid');									

		if( CommonHelper::hasValue($data['filter_company']) ) $query->where('users.company', 'LIKE', '%'.$data['filter_company'].'%');
		if( CommonHelper::hasValue($data['filter_first_name']) ) $query->where('users.first_name', 'LIKE', '%'.$data['filter_first_name'].'%');		
		if( CommonHelper::hasValue($data['filter_last_name']) ) $query->where('users.last_name', 'LIKE', '%'.$data['filter_last_name'].'%');
		if( CommonHelper::hasValue($data['filter_primary_email']) ) $query->where('users.primary_email_address', 'LIKE', '%'.$data['filter_primary_email'].'%');
		if( CommonHelper::hasValue($data['filter_courses']) ) $query->where('courses.name', 'LIKE', '%'.$data['filter_courses'].'%');
		if( CommonHelper::hasValue($data['filter_status']) ) $query->where('registrants.attendance_status', '=', $data['filter_status']);				
		
		if (isset($data['filter_status'])) {
			if (in_array($data['filter_status'], array('0', '1'))) {
				$query->where('registrants.attendance_status', '=', $data['filter_status']);
			}
		}
		$query->where('users.user_type', '=', 3);

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

	public static function getAttendee($rid = 0) {
		$query = DB::table('registrants')->select(DB::raw('registrants.*, users.*, registrants.id AS rid, courses.*'))
									->leftJoin('users', 'users.id', '=', 'registrants.uid')
									->leftJoin('courses', 'courses.id', '=', 'registrants.course')
									->where('registrants.id', '=', $rid);																	

		$result = $query->get();
				
		return $result;
	}

	public static function getDistinctCourses($rid = 0) {
		$query = DB::table('courses')									
				->groupby('name')
				->orderBy('name', 'ASC');																	

		$result = $query->get();
		$data = array();

		$data[''] = '- Please Select -';
		foreach($result as $results) {
			$data[$results->name] = $results->name;
		}		

		return $data;
	}

	public static function getOpenCourses($rid = 0) {
		$query = DB::table('registrants')->select(DB::raw('registrants.*, users.*, registrants.id AS rid, courses.*'))
									->leftJoin('users', 'users.id', '=', 'registrants.uid')
									->leftJoin('courses', 'courses.id', '=', 'registrants.course')
									->where('registrants.id', '=', $rid);																	

		$result = $query->get();
				
		return $result;
	}

	public static function getTrainingCost($course = '') {
		$query = DB::table('profit_loss')
			->where('course', '=', $course);									

		$result = $query->first();
				
		return $result;
	}
	
	public static function getTotalAttendees($data = array()) {
		$query = DB::table('registrants')->leftJoin('users', 'users.id', '=', 'registrants.uid');

		if( CommonHelper::hasValue($data['filter_company']) ) $query->where('users.company', 'LIKE', '%'.$data['filter_company'].'%');
		if( CommonHelper::hasValue($data['filter_first_name']) ) $query->where('users.first_name', 'LIKE', '%'.$data['filter_first_name'].'%');		
		if( CommonHelper::hasValue($data['filter_last_name']) ) $query->where('users.last_name', 'LIKE', '%'.$data['filter_last_name'].'%');
		if( CommonHelper::hasValue($data['filter_primary_email']) ) $query->where('users.primary_email_address', 'LIKE', '%'.$data['filter_primary_email'].'%');
		if( CommonHelper::hasValue($data['filter_courses']) ) $query->where('registrants.course', 'LIKE', '%'.$data['filter_courses'].'%');
		if( CommonHelper::hasValue($data['filter_status']) ) $query->where('registrants.attendance_status', '=', $data['filter_status']);
		
		if (isset($data['filter_status'])) {
			if (in_array($data['filter_status'], array('0', '1'))) {
				$query->where('attendance_status', '=', $data['filter_status']);
			}
		}
		   								   
		return $query->count();
	}

	public static function getTempAttendees($data = array()) {
		$query = DB::table('temp_registration');									

		if( CommonHelper::hasValue($data['filter_company']) ) $query->where('company', 'LIKE', '%'.$data['filter_company'].'%');
		if( CommonHelper::hasValue($data['filter_first_name']) ) $query->where('first_name', 'LIKE', '%'.$data['filter_first_name'].'%');		
		if( CommonHelper::hasValue($data['filter_last_name']) ) $query->where('last_name', 'LIKE', '%'.$data['filter_last_name'].'%');
		if( CommonHelper::hasValue($data['filter_primary_email']) ) $query->where('email', 'LIKE', '%'.$data['filter_primary_email'].'%');
		if( CommonHelper::hasValue($data['filter_courses']) ) $query->where('course', 'LIKE', '%'.$data['filter_courses'].'%');
		if( CommonHelper::hasValue($data['filter_status']) ) $query->where('attendance_status', '=', $data['filter_status']);
		
		if (isset($data['filter_status'])) {
			if (in_array($data['filter_status'], array('0', '1'))) {
				$query->where('attendance_status', '=', $data['filter_status']);
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

	public static function getTempAttendeeReport($data = array()) {
		$query = DB::table('temp_registration')->where('course', '=', $data['filter_courses']);									

		$result = $query->first();
				
		return $result;
	}

	public static function getTempAttendeeReportCtr($data = array()) {
		$info = array();
		$query_pop = DB::table('temp_registration')
					->where('course', '=', $data['filter_courses'])
					->where('reference', '=', 'POP');

		$query_with_po = DB::table('temp_registration')
					->where('course', '=', $data['filter_courses'])
					->where('reference', '=', 'with PO');	

		$query_billed_sum = DB::table('temp_registration')
					->select(DB::raw('SUM(amount - (amount * (discount / 100))) AS billed_amount'))
					->where('course', '=', $data['filter_courses'])
					->where('reference', '=', 'with PO');

		$query_unbilled_sum = DB::table('temp_registration')
					->where('course', '=', $data['filter_courses'])
					->where('reference', '=', 'POP')
					->sum('amount');

		$query_payment_received = DB::table('temp_registration')
					->where('course', '=', $data['filter_courses'])
					->where('reference', '=', 'with PO')
					->sum('cash_received');

		$query_cost = DB::table('profit_loss')
					->select(DB::raw('(groceries + room + lunch + trainer + stationary + transportation + miscellaneous) as cost'))
					->where('course', '=', $data['min_course']);
		
		$info['pop_count'] = $query_pop->count();
		$info['with_po_count'] = $query_with_po->count();
		$info['unbilled_amount_pop'] = $query_unbilled_sum;
		$info['payment_received'] = $query_payment_received;
		$info['billed_amount_po'] = $query_billed_sum->first();
		$info['training_cost'] = $query_cost->first();

		return $info;
	}

	public static function getTempAttendeeTotalReport($data = array()) {
		$query = DB::table('temp_registration')->where('course', '=', $data['filter_courses']);									

		$result = $query->count();
				
		return $result;
	}

	public static function getTempAttendeeInfo($data = array()) {
		$query = DB::table('temp_registration')->where('id', '=', $data['id']);									
		
		$result = $query->first();
				
		return $result;
	}

	public static function getAttendeeInfo($data = array()) {
		$query = DB::table('registrants')->select(DB::raw('registrants.*, users.*, registrants.id AS rid, courses.*'))
							->leftJoin('users', 'users.id', '=', 'registrants.uid')
							->leftJoin('courses', 'courses.id', '=', 'registrants.course')
							->where('registrants.id', '=', $data['id']);									
		
		$result = $query->first();
				
		return $result;
	}

	public static function getTempTotalAttendees($data = array()) {
		$query = DB::table('temp_registration');

		if( CommonHelper::hasValue($data['filter_company']) ) $query->where('company', 'LIKE', '%'.$data['filter_company'].'%');
		if( CommonHelper::hasValue($data['filter_first_name']) ) $query->where('first_name', 'LIKE', '%'.$data['filter_first_name'].'%');		
		if( CommonHelper::hasValue($data['filter_last_name']) ) $query->where('last_name', 'LIKE', '%'.$data['filter_last_name'].'%');
		if( CommonHelper::hasValue($data['filter_primary_email']) ) $query->where('email', 'LIKE', '%'.$data['filter_primary_email'].'%');
		if( CommonHelper::hasValue($data['filter_courses']) ) $query->where('course', 'LIKE', '%'.$data['filter_courses'].'%');
		if( CommonHelper::hasValue($data['filter_status']) ) $query->where('attendance_status', '=', $data['filter_status']);
		
		if (isset($data['filter_status'])) {
			if (in_array($data['filter_status'], array('0', '1'))) {
				$query->where('attendance_status', '=', $data['filter_status']);
			}
		}
		   								   
		return $query->count();
	}

	public static function getTempAttendee($rid = 0) {
		$query = DB::table('temp_registration')
									->where('id', '=', $rid);									

		$result = $query->get();
				
		return $result;
	}

	public static function uploadCertificate($id, $data = array()) {
		//Start: Change file, path variable on live
		$file = '\\'.$data['certificate'];
		$path = 'H:\xampp\htdocs\tblsys\app\storage\certificates'.$file;			
		//End: Change file, path variable on live
		
		@unlink($path);
		$query = DB::table('registrants')->where('id', '=', $id);
		$query->update($data);	
	}

	public static function updateTempStatus($id, $data = array()) {
		$query = DB::table('temp_registration')->where('id', '=', $id);
		$query->update($data);	
	}

	public static function updateCost($id, $data = array()) {
		$query = DB::table('profit_loss')->where('id', '=', $id);
		$query->update($data);	
	}	

	public static function getCompanies($course = '') {
		$query = DB::table('temp_registration')
					->groupby('company')->orderBy('company', 'ASC');
					
		if($course != '' ) {
			$query = DB::table('temp_registration')
					->where('course', '=', $course)
					->groupby('company')->orderBy('company', 'ASC');	
		}							

		$result = $query->get();
		
		$array = array();

		$array[''] = 'Please Select';
		foreach($result as $value) {
			$array[$value->company] = $value->company;
		}	
			
		return $array;
	}
}
