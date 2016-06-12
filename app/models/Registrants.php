<?php

class Registrants extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'registrants';

	public static function addAttendee($data = array()) {
		$id = DB::table('registrants')->insertGetId($data);
		
		return $id;
	}
	
	public static function addProfile($data = array(), $id) {		
		$query = DB::table('registrants')->where('id', '=', $id);
		$query->update(array('profiling' => '1', 'updated_at' => date('Y-m-d H:i:s')));	
		
		$ids = DB::table('profiling')->insertGetId($data);
		
		return $ids;
	}
}
