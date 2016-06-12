<?php
class Announcement extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'announcements';

	public static function addAnnouncement($data = array()) {
		$id = DB::table('announcements')->insertGetId($data);
		
		return $id;
	}
	
	public static function updateAnnouncement($id, $data = array()) {
		$query = DB::table('announcements')->where('id', '=', $id);
		$query->update($data);	
	}
	
	public static function deleteAnnouncement($data = array()) {
		DB::table('announcements')->whereIn('id', $data)->delete();
	}
	
	public static function getAnnouncements($data = array()) {
		$query = DB::table('announcements');

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

	public static function getAllAnnouncements() {
		$query = DB::table('announcements')->orderBy('date_from', 'ASC');
	
		$result = $query->get();
				
		return $result;
	}
	
	public static function getStudentAndFacultyAnnouncements() {
		$query = DB::table('announcements')
			->orderBy('date_from', 'DESC');				
			
		$result = $query->get();
				
		return $result;
	}
	
	public static function getTotalAnnouncements($data = array()) {
		$query = DB::table('announcements');

		if( CommonHelper::hasValue($data['filter_title']) ) $query->where('title', 'LIKE', '%'.$data['filter_title'].'%');
		if( CommonHelper::hasValue($data['filter_date_from']) && CommonHelper::hasValue($data['filter_date_to'])) $query->whereBetween('date_from', array($data['filter_date_from'], $data['filter_date_to']));
		   								   
		return $query->count();
	}

	public static function getTodaysAnnouncement($data = array()) {		
		$query = DB::table('announcements')
			->where('date_from', 'LIKE', date('Y-m-d'));
		
		$result = $query->get();
				
		return $result;
	}
}
