<?php
class UniversityCalendar extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'university_calendar';

	public static function addActivity($data = array()) {
		$id = DB::table('university_calendar')->insertGetId($data);
		
		return $id;
	}
	
	public static function updateActivity($id, $data = array()) {
		$query = DB::table('university_calendar')->where('id', '=', $id);
		$query->update($data);	
	}
	
	public static function deleteActivity($data = array()) {
		DB::table('university_calendar')->whereIn('id', $data)->delete();
	}
	
	public static function getActivities($data = array()) {
		$query = DB::table('university_calendar');

		if( CommonHelper::hasValue($data['filter_title']) ) $query->where('title', 'LIKE', '%'.$data['filter_title'].'%');
		if( CommonHelper::hasValue($data['filter_date_from']) && CommonHelper::hasValue($data['filter_date_to'])) $query->whereBetween('date_from', array($data['filter_date_from'], $data['filter_date_to']));
		
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

	public static function getUnivCalendar() {
		$query = DB::table('university_calendar')	
				->orderBy('date_from', 'ASC');

		$result = $query->get();
				
		return $result;
	}
	
	public static function getTotalActivities($data = array()) {
		$query = DB::table('university_calendar');

		if( CommonHelper::hasValue($data['filter_title']) ) $query->where('title', 'LIKE', '%'.$data['filter_title'].'%');
		if( CommonHelper::hasValue($data['filter_date_from']) && CommonHelper::hasValue($data['filter_date_to'])) $query->whereBetween('date_from', array($data['filter_date_from'], $data['filter_date_to']));
		   								   
		return $query->count();
	}

	public static function getTodaysActivity($data = array()) {		
		$query = DB::table('university_calendar')
			->where('date_from', 'LIKE', date('Y-m-d'));
		
		$result = $query->get();
				
		return $result;
	}
}
