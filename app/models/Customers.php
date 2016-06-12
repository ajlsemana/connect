<?php
class Customers extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customers';

	public static function addCompany($data = array()) {
		$id = DB::table('customers')->insertGetId($data);
		
		return $id;
	}
	
	public static function updateCompany($id, $data = array()) {
		$query = DB::table('customers')->where('id', '=', $id);
		$query->update($data);	
	}
	
	public static function deleteCompany($data = array()) {
		$query = DB::table('customers')->whereIn('id', $data);
		$result = $query->get();		
		$destinationPath = storage_path() . '/company_logo/';
		
		foreach($result as $row) {
			@unlink($destinationPath.$row->logo);
		}
		
		DB::table('customers')->whereIn('id', $data)->delete();
	}
	
	public static function getCompanies($data = array()) {
		$query = DB::table('customers');

		#if( CommonHelper::hasValue($data['filter_company']) ) $query->where('company', 'LIKE', '%'.$data['filter_company'].'%');		
		
		$result = $query->get();
				
		return $result;
	}
	
	public static function getServiceProviders($data = array()) {
		$query = DB::table('customers');
				
		if( CommonHelper::hasValue($data['filter_company']) ) $query->where('id', '=', $data['filter_company']);		
		
		$query->orderBy('company', 'ASC');
		$result = $query->get();
				
		return $result;
	}
	
	public static function getEngineerCtr() {
		$array = array();

		$query_total_eng = DB::table('customers')->select(DB::raw('companies.id, COUNT(companies.company) AS total_eng'))
			->join('users', 'users.company', '=', 'companies.id')
			->where('users.user_type', '=', 3)
			->where('users.skills_map', '=', 1)
			->groupBy('companies.id')
			->orderBy('companies.company', 'ASC');	
		
		$query_done_v8 = DB::table('customers')->select(DB::raw('companies.id, COUNT(companies.company) AS completed_v8'))
			->join('users', 'users.company', '=', 'companies.id')
			->join('skills_map', 'skills_map.uid', '=', 'users.id')
			->where('users.user_type', '=', 3)
			->where('users.skills_map', '=', 1)
			->where('skills_map.status', '=', 100)
			->groupBy('companies.id')
			->orderBy('companies.company', 'ASC');

		$query_done_v7 = DB::table('customers')->select(DB::raw('companies.id, COUNT(companies.company) AS completed_v7'))
			->join('users', 'users.company', '=', 'companies.id')
			->join('skills_map_v7', 'skills_map_v7.uid', '=', 'users.id')
			->where('users.user_type', '=', 3)
			->where('users.skills_map', '=', 1)
			->where('skills_map_v7.status', '=', 100)
			->groupBy('companies.id')
			->orderBy('companies.company', 'ASC');
			
		$qry_all = $query_total_eng->get();		
		$qry_v8 = $query_done_v8->get();
		$qry_v7 = $query_done_v7->get();
		
		foreach($qry_all as $row1) {
			$array[$row1->id]['total_eng'] = $row1->total_eng;
		}
		
		foreach($qry_v8 as $row2) {
			$array[$row2->id]['completed_v8'] = $row2->completed_v8;
		}
		
		foreach($qry_v7 as $row3) {
			$array[$row3->id]['completed_v7'] = $row3->completed_v7;
		}
		
		return $array;
	}

	public static function getAllAnnouncements() {
		$query = DB::table('customers')->orderBy('date_from', 'ASC');
	
		$result = $query->get();
				
		return $result;
	}
	
	public static function getStudentAndFacultyAnnouncements() {
		$query = DB::table('customers')
			->orderBy('date_from', 'DESC');				
			
		$result = $query->get();
				
		return $result;
	}
	
	public static function getTotalServiceProviders($data = array()) {
		$query = DB::table('customers');

		if( CommonHelper::hasValue($data['filter_company']) ) $query->where('company', 'LIKE', '%'.$data['filter_company'].'%');		
				
		return $query->count();
	}

	public static function getTodaysAnnouncement($data = array()) {		
		$query = DB::table('customers')
			->where('date_from', 'LIKE', date('Y-m-d'));
		
		$result = $query->get();
				
		return $result;
	}
}
