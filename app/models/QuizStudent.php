<?php
class QuizStudent extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quizzes_students';

	public static function updateQuizStudent($id, $data = array()) {
		$query = DB::table('quizzes_students')->where('id', '=', $id);
		$query->update($data);	
	}

	public static function getItemsByQuizID($quiz_student_id) {
		$query = DB::table('quizzes_students_items')->where('quiz_student_id', '=', (int)$quiz_student_id);

		$result = $query->get();
				
		return $result;
	}

	public static function getQuizGradesByStudent($data = array()) {
		$query = DB::table('quizzes_students')->select(DB::raw('quizzes_students.*, quizzes.title, quizzes.points'))
											->join('quizzes', 'quizzes.id', '=', 'quizzes_students.quiz_id')
											->where('quizzes_students.class_id', '=', (int)$data['class_id'])
											->where('quizzes_students.student_id', '=', (int)$data['student_id'])
											->orderBy('quizzes.due_date', 'DESC');

		$result = $query->get();

		return $result;
	}

	public static function getQuizzesSubmissions($data = array()) {
		$query = DB::table('quizzes_students')->select(DB::raw('quizzes_students.id as qs_id, quizzes_students.grade, quizzes.points, users.*'))
											->join('users', 'users.id', '=', 'quizzes_students.student_id')
											->join('quizzes', 'quizzes.id', '=', 'quizzes_students.quiz_id')											
											->where('quizzes_students.quiz_id', '=', $data['quiz_id']);													
		
		$result = $query->get();
				
		return $result;
	}
	
	public static function getTotalQuizzesSubmissions($data = array()) {
		$query = DB::table('quizzes_students')->select(DB::raw('quizzes_students.id as qs_id, quizzes_students.grade, quizzes.points, users.*'))
											->join('users', 'users.id', '=', 'quizzes_students.student_id')
											->join('quizzes', 'quizzes.id', '=', 'quizzes_students.quiz_id')
											->where('quizzes_students.class_id', '=', $data['class_id'])
											->where('quizzes_students.quiz_id', '=', $data['quiz_id']);
				   
		return $query->count();
	}

	/* Student */
	public static function addQuizStudent($data = array()) {
		$id = DB::table('quizzes_students')->insertGetId($data);
		
		return $id;
	}
	
	public static function addQuizStudentItems($data = array()) {
		DB::table('quizzes_students_items')->insert($data);	
	}

	public static function getQuizByStudent($data = array()) {
		$query = DB::table('quizzes_students')->select(DB::raw('quizzes_students.*, users.first_name, users.last_name'))
									->join('users', 'users.id', '=', 'quizzes_students.student_id')
									->where('quizzes_students.class_id', '=', (int)$data['class_id'])
									->where('quizzes_students.quiz_id', '=', (int)$data['quiz_id'])
									->where('quizzes_students.student_id', '=', (int)$data['student_id']);

		return $query->first();
	}

	public static function getQuizzesStudent($data = array()) {		
		$query = DB::table('quizzes')->select(DB::raw('quizzes.*'))											
									->where('quizzes.cid', '=', $data['class_id'])
									->where('quizzes.visible', '=', 1);
		
		$result = $query->get();
				
		return $result;
	}
	
	public static function getQuizScores() {
		$query = DB::table('quizzes_students')->select(DB::raw('quizzes_students.quiz_id, quizzes_students.grade'))									
									->where('quizzes_students.student_id', '=', Auth::user()->id);
		
		$result = $query->get();
		$data = array();

		foreach($result as $value) {
			$data[$value->quiz_id] = $value->grade;
		}

		return $data;
	}

	public static function checkQuizzesDone() {
		$query = DB::table('quizzes_students')->select(DB::raw('quizzes_students.quiz_id'))									
									->where('quizzes_students.student_id', '=', Auth::user()->id);
		
		$result = $query->get();
		$data = array();

		foreach($result as $value) {
			$data[] = $value->quiz_id;
		}

		return $data;
	}

	public static function getTotalQuizzesStudent($data = array()) {
		$query = DB::table('quizzes')->select(DB::raw('quizzes.*, quizzes_students.id as quiz_student_id, quizzes_students.grade'))
									->leftJoin('quizzes_students', 'quizzes.id', '=', 'quizzes_students.quiz_id')
									->where('quizzes.class_id', '=', $data['class_id']);

		if( CommonHelper::hasValue($data['filter_title']) ) $query->where('title', 'LIKE', '%'.$data['filter_title'].'%');
		if( CommonHelper::hasValue($data['filter_date_from']) && CommonHelper::hasValue($data['filter_date_to'])) $query->whereBetween('due_date', array($data['filter_date_from'], $data['filter_date_to']));
		   								   
		return $query->count();
	}
}
