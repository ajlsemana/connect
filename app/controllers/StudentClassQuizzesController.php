<?php 

class StudentClassQuizzesController extends BaseController {
	private $data = array();
	private $allowed = array(3);
	
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->data['route'] = Route::getCurrentRoute()->getPath();	
		
		if (!in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('student/logout');
		}
	}
	
	public function index() {
		$this->getList();
	}

	public function takeQuizForm() {	
		if (Quiz::find(Request::segment(4)) == NULL) {			
			return Redirect::to('trainee/quizzes/' . Request::segment(5));
		}

		$arrParams = array(
							'class_id'		=> Request::segment(5),
							'student_id'	=> Auth::user()->id,
							'quiz_id'		=> Request::segment(4)
						);
		$quiz_student = QuizStudent::getQuizByStudent($arrParams);

		if ($quiz_student) {
			return Redirect::to('trainee/quizzes/' . Request::segment(5))
							->with('error', 'Quiz has been taken already');
		}

		$arrParams2 = array(						
						'student_id'	=> Auth::user()->id,
						'class_id'		=> Request::segment(5),
						'quiz_id'		=> Request::segment(4)
						);			
		$this->data['quiz_student_id'] = QuizStudent::addQuizStudent($arrParams2);

		$this->getForm();
	}

	public function submitQuiz() {
		$quiz_items = Quiz::getItemsByQuizID(Input::get('id'));

		$arrQuestions = array();

		foreach ($quiz_items as $item) {
			$arrQuestions[$item->id] = $item->answer;
		}

		$correct = 0;
		if(Input::get('answer')) {
			foreach (Input::get('answer') as $question_id => $answer) {
				$arrParams = array(							
									'quiz_student_id'	=> Input::get('quiz_student_id'),
									'question_id'		=> $question_id,
									'answer'			=> $answer
								);			
				QuizStudent::addQuizStudentItems($arrParams);

				if ($answer == $arrQuestions[$question_id]) {
					$correct++;
				}
			}
		}	

		$arrParams = array(						
						'grade'	=> $correct
						);			
		QuizStudent::updateQuizStudent(Input::get('quiz_student_id'), $arrParams);

		$status = '';

		if(Input::has('status')) {			
			$status = '?status=attended';
		}

		return Redirect::to('trainee/quizzes/' .Input::get('course_id').$status)
			->with('success', 'You successfully submitted your assignment!');
	}

	protected function getList() {
		$id = Request::segment(3);

		$arrParams = array(							
							'class_id'			=> $id,
							'student_id'		=> Auth::user()->id,
							'sort'				=> 'due_date',
							'order'				=> 'DESC'
						);		
		$this->data['quizzes'] = QuizStudent::getQuizzesStudent($arrParams);		
		
		$this->data['done_quizzes'] = QuizStudent::checkQuizzesDone();
		$this->data['quiz_grade'] = QuizStudent::getQuizScores();

		$this->data['course'] = EnrolledCourses::getCourseName($id);	
		$this->data['module'] = 'Assignments';
		$this->data['menu'] = View::make('student.menu_tabs', $this->data);

		$this->layout->content = View::make('student.class_quizzes', $this->data);
	}
	
	protected function getForm() {		
		$this->data['quiz'] = Quiz::find(Request::segment(4));

		$this->data['quiz_items'] = Quiz::getItemsByQuizIDStudent(Request::segment(4));
		$this->data['course'] = EnrolledCourses::getCourseName(Request::segment(5));	
		$this->data['module'] = 'Assignments';

		$this->layout->content = View::make('student.class_quizzes_submit', $this->data);		
	}

	protected function setURL() {
		// Search Filters
		$url = '?filter_title=' . Input::get('filter_title', NULL);
		$url .= '&filter_date_from=' . Input::get('filter_date_from', NULL);
		$url .= '&filter_date_to=' . Input::get('filter_date_to', NULL);
		$url .= '&sort=' . Input::get('sort', 'due_date');
		$url .= '&order=' . Input::get('order', 'DESC');
		$url .= '&page=' . Input::get('page', 1);
		
		return $url;
	}
}