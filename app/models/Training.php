<?php
class Training extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reservation';

	public static function registerProcess($data = array()) {
		$id = DB::table('reservation')->insertGetId($data);
		
		return $id;
	}
	
	public static function getCourses() {
		$query = DB::table('courses')->where('status', '=', 1)->orderBy('date_from', 'ASC');

		return $query->get();
	}

	public static function getReserved() {
		$query = DB::table('reservation')->where('uid', '=', Auth::id());

		return $query->get();
	}
}
