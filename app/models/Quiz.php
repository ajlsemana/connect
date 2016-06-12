<?php
class Quiz extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quizzes';

	public static function addQuiz($data = array()) {
		$id = DB::table('quizzes')->insertGetId($data);
		
		return $id;
	}
	
	public static function addQuizItems($data = array()) {
		DB::table('quizzes_items')->insert($data);	
	}

	public static function updateQuiz($id, $data = array()) {
		$query = DB::table('quizzes')->where('id', '=', $id);
		$query->update($data);	
	}
	
	public static function deleteQuiz($id) {
		DB::table('quizzes')->where('id', $id)->delete();
		DB::table('quizzes_items')->where('quiz_id', $id)->delete();
	}

	public static function deleteQuizItems($id) {
		DB::table('quizzes_items')->where('quiz_id', $id)->delete();
	}

	public static function getItemsByQuizID($quiz_id) {
		$query = DB::table('quizzes_items')->where('quiz_id', '=', (int)$quiz_id)
										   ->orderBy('id', 'ASC');

		$result = $query->get();
				
		return $result;
	}

	public static function getItemsByQuizIDStudent($quiz_id) {
		$query = DB::table('quizzes_items')->where('quiz_id', '=', (int)$quiz_id)
										   ->orderBy(DB::raw('RAND()'));

		$result = $query->get();
				
		return $result;
	}
	
	public static function getQuizzes($data = array()) {
		$query = DB::table('quizzes')
				->where('cid', '=', $data['cid'])
				->where('faculty_id', '=', $data['faculty_id']);	
		
		$result = $query->get();
				
		return $result;
	}
	
	public static function getTotalQuizzes($data = array()) {
		$query = DB::table('quizzes')->where('class_id', '=', $data['class_id'])
										->where('faculty_id', '=', $data['faculty_id']);

		if( CommonHelper::hasValue($data['filter_title']) ) $query->where('title', 'LIKE', '%'.$data['filter_title'].'%');
		if( CommonHelper::hasValue($data['filter_time_limit']) ) $query->where('time_limit', 'LIKE', '%'.$data['filter_time_limit'].'%');
		if( CommonHelper::hasValue($data['filter_date_from']) && CommonHelper::hasValue($data['filter_date_to'])) $query->whereBetween('due_date', array($data['filter_date_from'], $data['filter_date_to']));
		   								   
		return $query->count();
	}
}
