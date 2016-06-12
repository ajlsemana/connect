<?php
class EnrolledCourses extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'registrants';
	
	public static function getEnrolledCourses() {		
		$query = DB::table('registrants')
			->select(DB::raw('courses.*, registrants.attendance_status'))
			->leftJoin('courses', 'courses.id', '=', 'registrants.course')
			->where('registrants.uid', '=', Auth::id())
			->where('courses.status', '=', 1)
			->orderBy('courses.date_from', 'ASC');			
		
		$result = $query->get();
				
		return $result;
	}

	public static function getEndedCourses() {		
		$query = DB::table('registrants')
			->select(DB::raw('courses.*, registrants.attendance_status'))
			->leftJoin('courses', 'courses.id', '=', 'registrants.course')
			->where('registrants.uid', '=', Auth::id())
			->where('courses.status', '=', 0)
			->orderBy('courses.date_from', 'ASC');			
		
		$result = $query->get();
				
		return $result;
	}

	public static function getCourseName($cid = 0) {		
		$query = DB::table('courses')
			->select(DB::raw('courses.name, courses.id AS cid, registrants.*'))
			->leftJoin('registrants', 'courses.id', '=', 'registrants.course')
			->where('courses.id', '=', $cid);
			
			if(Auth::user()->user_type != 1) {
				$query->where('registrants.uid', '=', Auth::id());					
			}
		
		$result = $query->first();
				
		return $result;
	}
}
