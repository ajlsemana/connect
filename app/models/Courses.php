<?php
class Courses extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'courses';

	public static function addCourse($data = array()) {
		$id = DB::table('courses')->insertGetId($data);		

		return $id;
	}

	public static function addActivity($data = array()) {
		$id = DB::table('course_agenda')->insertGetId($data);		

		return $id;
	}

	public static function getActivity($cid = 0) {
		$query = DB::table('course_agenda')->where('cid', '=', (int) $cid)->orderBy('days', 'ASC')->orderBy('time_from', 'ASC');
		
		$result = $query->get();
				
		return $result;
	}	

	public static function getEnrolledCourses() {
		$query = DB::table('registrants')->where('uid', '=', (int) Auth::id());
		
		$result = $query->get();
		$data = array();
		foreach($result as $results) {
			$data[] = $results->course;
		}		

		return $data;
	}

	public static function getAssignedCourses() {
		$query = DB::table('courses')->where('trainer', '=', (int) Auth::id())->orderBy('name', 'ASC');
		
		$result = $query->get();	

		return $result;
	}

	public static function uploadMaterials($data = array()) {
		$id = DB::table('lecture_upload')->insertGetId($data);
		
		return $id;
	}
	
	public static function updateCourses($id, $data = array()) {
		$query = DB::table('courses')->where('id', '=', $id);
		$query->update($data);	
	}
	
	public static function deleteCourses($data = array()) {
		DB::table('courses')->whereIn('id', $data)->delete();
	}

	public static function deleteActivity($id) {
		DB::table('course_agenda')->where('id', '=', $id)->delete();
	}
	
	public static function getMaterials($post_id = 0) {
		$query = DB::table('lecture_upload')->where('post_id', '=', (int) $post_id);
		
		$result = $query->get();
				
		return $result;
	}

	public static function getTimeline($cid = 0) {
		$data = array();
		$query = DB::table('course_agenda')->where('cid', '=', (int) $cid)->orderBy('days', 'ASC')->orderBy('time_from', 'ASC');
		
		$result = $query->get();
		
        foreach($result as $results) {      
        	$time_from = explode(':', $results->time_from);
        	$time_to = explode(':', $results->time_to);  	
		 
        	$data[] = "[ 'Day ".$results->days."',   '".$results->agenda."',     new Date(0,0,0,".$time_from[0].",".(int)$time_from[1].",0), new Date(0,0,0,".$time_to[0].",".$time_to[1].",0) ]"; 
		}
		$r = implode(',', $data);

		return $r;
	}

	public static function deleteMaterial($id) {	
		$query = DB::table('lecture_upload')					
					->select(DB::raw('lecture_upload.upload_path'))													
					->where('lecture_upload.id', '=', $id);

		$result = $query->get();
		if(count($result) > 0) {
			foreach ($result as $key => $value) {	
				//Reminder: Change this path if you are online, make it dynamic depending on your server location		
				$file = '\\'.$value->upload_path;
				$path = 'E:\xampp\htdocs\tblsys\app\storage\lectures'.$file;			
				@unlink($path);
			}
		}
				
		DB::table('lecture_upload')->where('id', $id)->delete();
	}

	public static function getCourses($data = array()) {
		$query = DB::table('courses');
		
		if( CommonHelper::hasValue($data['filter_name']) ) $query->where('name', 'LIKE', '%'.$data['filter_name'].'%');
		
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
	
	public static function getTotalCourses($data = array()) {
		$query = DB::table('courses');

		if( CommonHelper::hasValue($data['filter_name']) ) $query->where('name', 'LIKE', '%'.$data['filter_name'].'%');
		 								   
		return $query->count();
	}

	public static function getOpenCourses() {
		$query = DB::table('courses')->where('status', '=', 1)->orderBy('date_from', 'ASC');		
		
		$result = $query->get();
		$data = array();

		foreach($result as $results) {
			$data[$results->name][$results->id] = $results->date_from.'-'.$results->date_to;
		}	

		return $data;
	}
}
