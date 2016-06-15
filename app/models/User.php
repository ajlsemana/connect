<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function addUser($data = array()) {
		$id = DB::table('users')->insertGetId($data);
		
		// Engineers only
		if($data['skills_map'] == 1) {
			$skills_map = array(
				'uid' => $id
			);

			$sid = DB::table('skills_map')->insertGetId($skills_map);
			$skills_update = DB::table('skills_map_update')->insertGetId($skills_map);
			
			$sid_v7 = DB::table('skills_map_v7')->insertGetId($skills_map);
			$skills_update_v7 = DB::table('skills_map_update_v7')->insertGetId($skills_map);

			$cert_color_v7 = DB::table('certification_color_v7')->insertGetId($skills_map);
			$cert_color_v8 = DB::table('certification_color_v8')->insertGetId($skills_map);
		}

		return $id;
	}

	public static function addRegistrant($data = array()) {
		$id = DB::table('users')->insertGetId($data);

		return $id;
	}

	public static function getTrainer() {
		$query = DB::table('users')
			->where('user_type', '=', 2)
			->orderBy('first_name', 'ASC');
		$data = array();

		$result = $query->get();
		
		$data[NULL] = '- Please Select -';
		foreach($result as $info):
			$data[$info->id] = $info->first_name.' '.$info->last_name; 
		endforeach;		

		return $data;
	}

	public static function getEngineers() {
		$query = DB::table('users')			
			->where('skills_map', '=', 1)
			->where('id', '!=', Auth::id())
			->where('company', '=', Auth::user()->company)
			->orderBy('first_name', 'ASC');

		$result = $query->get();

		return $result;
	}

	public static function getTotalEngineers() {
		$query = DB::table('users')			
			->where('skills_map', '=', 1)
			->where('company', '=', Auth::user()->company)
			->orderBy('first_name', 'ASC');

		$result = $query->count();

		return $result;
	}
	
	public static function updateUser($id, $data = array()) {
		$query = DB::table('users')->where('id', '=', $id);
		$check_id = DB::table('skills_map')->where('uid', '=', $id);		
		
		// Engineers and Resource Managers		
		if($data['skills_map'] == 1 && $check_id->count() == 0) { 
			$skills_map = array(
				'uid' => $id
			);

			DB::table('skills_map')->insertGetId($skills_map);
			DB::table('skills_map_update')->insertGetId($skills_map);
			
			DB::table('skills_map_v7')->insertGetId($skills_map);
			DB::table('skills_map_update_v7')->insertGetId($skills_map);

			DB::table('certification_color_v7')->insertGetId($skills_map);
			DB::table('certification_color_v8')->insertGetId($skills_map);
		}
		
		$query->update($data);	
	}
	
	public static function deleteUser($data = array()) {
		DB::table('registrants')->whereIn('uid', $data)->delete();
		DB::table('lecture_post_message')->whereIn('uid', $data)->delete();
		DB::table('lecture_wall_threads')->whereIn('uid', $data)->delete();
		DB::table('quizzes_students')->whereIn('student_id', $data)->delete();			
		DB::table('quizzes_students_items')->whereIn('quiz_student_id', $data)->delete();
		DB::table('users')->whereIn('id', $data)->delete();

		DB::table('skills_map')->whereIn('uid', $data)->delete();
		DB::table('skills_map_v7')->whereIn('uid', $data)->delete();
		DB::table('skills_map_update')->whereIn('uid', $data)->delete();
		DB::table('skills_map_update_v7')->whereIn('uid', $data)->delete();
		DB::table('skills_proficiency_v7')->whereIn('uid', $data)->delete();
		DB::table('skills_proficiency_v8')->whereIn('uid', $data)->delete();
		DB::table('certification_color_v7')->whereIn('uid', $data)->delete();
		DB::table('certification_color_v8')->whereIn('uid', $data)->delete();
		DB::table('customers_feedback_v7')->whereIn('uid', $data)->delete();
		DB::table('customers_feedback_v8')->whereIn('uid', $data)->delete();
	}
	
	public static function getUsers($data = array()) {
		$query = DB::table('users')
			->where('id', '!=', Auth::id())
			->where('user_type', '!=', 1);

		if( CommonHelper::hasValue($data['filter_username']) ) $query->where('username', 'LIKE', '%'.$data['filter_username'].'%');
		if( CommonHelper::hasValue($data['filter_first_name']) ) $query->where('first_name', 'LIKE', '%'.$data['filter_first_name'].'%');
		if( CommonHelper::hasValue($data['filter_middle_name']) ) $query->where('middle_name', 'LIKE', '%'.$data['filter_middle_name'].'%');
		if( CommonHelper::hasValue($data['filter_last_name']) ) $query->where('last_name', 'LIKE', '%'.$data['filter_last_name'].'%');
		if( CommonHelper::hasValue($data['filter_primary_email']) ) $query->where('primary_email_address', 'LIKE', '%'.$data['filter_primary_email'].'%');
		if( CommonHelper::hasValue($data['filter_user_type']) ) {			
			if($data['filter_user_type'] == 4) {					
				$query->where('user_type', '=', 3);		
				$query->where('skills_map', '=', 1);
			} else if($data['filter_user_type'] == 3) { 
				$query->where('user_type', '=', 3);		
				$query->where('skills_map', '=', 0);
			} else {
				$query->where('user_type', '=', $data['filter_user_type']);
			}		 	
		}
		
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
	
	public static function getUserOptions() {
		$query = DB::table('users')->orderBy('first_name', 'ASC');
		
		$result = $query->get();
				
		return $result;
	}

	public static function getFacultyOptions() {
		$query = DB::table('users')
			->where('user_type', '=', 2)
			->orderBy('first_name', 'ASC');
		
		$result = $query->get();
				
		return $result;
	}

	public static function getNewlyRegistered() {
		$query = DB::table('users')->select(DB::raw('registrants.id AS rid, users.*, registrants.created_at AS cat, courses.name'))
		->leftJoin('registrants', 'registrants.uid', '=', 'users.id')
		->leftJoin('courses', 'courses.id', '=', 'registrants.course')
		->where('users.user_type', '=', 3)
		->where('users.skills_map', '=', 0)
		->where('users.created_at', 'LIKE', date('Y-m-d').'%')
		->orWhere('registrants.created_at', 'LIKE', date('Y-m-d').'%')
		->orderBy('users.created_at', 'DESC');	

		$result = $query->get();
				
		return $result;
	}

	public static function getInfo($uid = 0) {
		$query = DB::table('users')
			->where('user_type', '=', 3)
			->where('id', '=', $uid);
		
		$result = $query->get();
				
		return $result;
	}

	public static function getByEmailInfo($email = '') {
		$query = DB::table('users')
			->where('primary_email_address', '=', $email);
		
		$result = $query->first();
				
		return $result;
	}

	public static function getTotalPopulation() {
		$query = DB::table('users')->select(DB::raw('(SELECT COUNT(user_type) FROM users WHERE user_type=2) AS trainers, (SELECT COUNT(user_type) FROM users WHERE user_type=5) AS managers, (SELECT COUNT(user_type) FROM users WHERE user_type=3 AND skills_map=0) AS trainees, (SELECT COUNT(user_type) FROM users WHERE user_type=3 AND skills_map=1) AS engineers'))				
				->skip(0)
				->take(1);									

		$result = $query->get();

		return $result;
	}

	public static function getPrimaryEmail($sid) {
		$query = DB::table('users')->select(DB::raw('users.primary_email_address'))
			->leftJoin('lecture_post_message', 'lecture_post_message.uid', '=', 'users.id')
			->where('lecture_post_message.sid', '=', $sid)
			->groupBy('lecture_post_message.uid');
		$data = array();

		$result = $query->get();
				
		foreach($result as $info):
			$data[] = $info->primary_email_address; 
		endforeach;		

		return $data;
	}
	
	public static function getRegProfile() {
		$result = FALSE;
		$query = DB::table('registrants')->select(DB::raw('registrants.*, courses.name'))
			->leftJoin('courses', 'registrants.course', '=', 'courses.id')
			->where('registrants.uid', '=', Auth::user()->id)
			->where('registrants.profiling', '=', 0)
			->orderBy('registrants.id', 'DESC')
			->skip(0)->take(1);
		
		$ctr = $query->count();
		if($ctr > 0) {
			$result = $query->first();
		}
				
		return $result;
	}
}
