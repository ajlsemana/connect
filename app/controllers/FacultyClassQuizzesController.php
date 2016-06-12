<?php 

class FacultyClassQuizzesController extends BaseController {
	private $data = array();
	private $allowed = array(2);
	
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		
		if (! in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('trainer/logout');
		}
	}
	
	public function index() {		
		$this->getList(Input::segment(3));
	}

	public function addQuizForm() {
		$this->getForm();
	}

	public function updateQuizForm() {
		if (Quiz::find(Input::segment(4)) == NULL) {
			return Redirect::to('trainer/quizzes/'.Input::segment(4));
		}

		$this->getFormUpdate(Input::segment(4));
	}

	public function viewQuiz() {
		if (Quiz::find(Request::segment(4)) == NULL) {
			return Redirect::to('trainer/quizzes/' . Request::segment(4));
		}

		$this->getFormView(Request::segment(4), Request::segment(5));
	}

	public function addQuiz() {
		$cid = Input::get('cid');

		$messages = array(
							'due_date.date_format'	=> 'Due date must be in this format: yyyy-mm-dd'
						);

		$hideShow = Input::get('show_hide');

		$rules = array(
						'title'				=> array('required'),
						'description'		=> array('required'),
						'time_limit'		=> array('required', 'numeric'),
						'due_date'			=> array('required', 'date_format:Y-m-d')
					);
		$validator = Validator::make(Input::all(), $rules, $messages);

		// Validate Items
		$error_message = '';
		// Validate Items

		$arrQuestion = array();
		$arrOption = array();
		$arrAnswer = array();
		$counter = 0;

		$questions = Input::get('question');
		$options = Input::get('option');
		$answers = Input::get('answer');
		foreach ($questions as $key => $question) {
			$arrQuestion[$counter] = $question;
			$arrAnswer[$counter] = $answers[$key];
			$arrOption[$counter] = array(
										'a'	=> $options[$key]['a'],
										'b'	=> $options[$key]['b'],
										'c'	=> $options[$key]['c'],
										'd'	=> $options[$key]['d']
									);
			$counter++;
		}

		Input::replace(array(
							'title' 		=> Input::get('title'),
							'description' 	=> Input::get('description'),
							'time_limit' 	=> Input::get('time_limit'),
							'due_date' 		=> Input::get('due_date'),
							'visible'		=> $hideShow,
							'question' 		=> $arrQuestion,
							'option' 		=> $arrOption,
							'answer' 		=> $arrAnswer,
							'count' 		=> Input::get('count'),
							'cid'			=> $cid
						));

		if ($validator->fails()) {
			return Redirect::to('trainer/quizzes/add/'.$cid)
				->withErrors($validator)
				->withInput();
		} else if ($error_message) {
			return Redirect::to('trainer/quizzes/add/'.$cid)
						->with('error', $error_message)
						->withInput();	
		} else {			
			$arrParams = array(							
							'title'			=> Input::get('title'),
							'description'	=> Input::get('description'),
							'time_limit'	=> Input::get('time_limit'),
							'due_date'		=> Input::get('due_date'),
							'visible'		=> (isset($hideShow) ? 1 : 0),
							'points'		=> count($questions),
							'faculty_id'	=> Auth::user()->id,
							'cid' 			=> $cid						
							);										
			$quiz_id = Quiz::addQuiz($arrParams);

			foreach ($questions as $key => $question) {
				$arrParams = array(							
								'quiz_id'		=> $quiz_id,
								'question'		=> $question,
								'option_a'		=> $options[$key]['a'],
								'option_b'		=> $options[$key]['b'],
								'option_c'		=> $options[$key]['c'],
								'option_d'		=> $options[$key]['d'],
								'answer'		=> $answers[$key]
								);			
				Quiz::addQuizItems($arrParams);
			}

			return Redirect::to('trainer/quizzes/'.$cid)
				->with('success', 'Successfully added new assignment!');
		}
	}

	public function updateQuiz() {
		$messages = array(
							'due_date.date_format'	=> 'Due date must be in this format: yyyy-mm-dd'
						);

		$rules = array(
						'title'				=> array('required'),
						'description'		=> array('required'),
						'time_limit'		=> array('required', 'numeric'),
						'due_date'			=> array('required', 'date_format:Y-m-d'),
						'question'			=> array('required'),
						'option'			=> array('required')
					);
		$validator = Validator::make(Input::all(), $rules, $messages);

		$hideShow = Input::get('show_hide');

		// Validate Items
		$error_message = '';
		// Validate Items

		$arrQuestion = array();
		$arrOption = array();
		$arrAnswer = array();
		$counter = 0;

		$questions = Input::get('question');
		$options = Input::get('option');
		$answers = Input::get('answer');
		foreach ($questions as $key => $question) {
			$arrQuestion[$counter] = $question;
			$arrAnswer[$counter] = $answers[$key];
			$arrOption[$counter] = array(
										'a'	=> $options[$key]['a'],
										'b'	=> $options[$key]['b'],
										'c'	=> $options[$key]['c'],
										'd'	=> $options[$key]['d']
									);
			$counter++;
		}

		Input::replace(array(
							'title' 		=> Input::get('title'),
							'description' 	=> Input::get('description'),
							'time_limit' 	=> Input::get('time_limit'),
							'due_date' 		=> Input::get('due_date'),
							'visible' 		=> $hideShow,
							'question' 		=> $arrQuestion,
							'option' 		=> $arrOption,
							'answer' 		=> $arrAnswer,
							'count' 		=> Input::get('count'),
							'id' 			=> Input::get('id'),							
							'group_code' 	=> Input::get('group_code')
						));

		if ($validator->fails()) {
			return Redirect::to('trainer/quizzes/update/' . Input::get('id'))
				->withErrors($validator)
				->withInput();
		} else if ($error_message) {
			return Redirect::to('trainer/quizzes/update/' . Input::get('id'))
						->with('error', $error_message)
						->withInput();	
		} else {
			$arrParams = array(							
							'title'			=> Input::get('title'),
							'description'	=> Input::get('description'),
							'time_limit'	=> Input::get('time_limit'),
							'due_date'		=> Input::get('due_date'),
							'visible' 		=> (isset($hideShow) ? 1 : 0),
							'points'		=> count($questions),
							'faculty_id'	=> Auth::user()->id							
							);			
			Quiz::updateQuiz(Input::get('id'), $arrParams);

			Quiz::deleteQuizItems(Input::get('id'), $arrParams);

			foreach ($questions as $key => $question) {
				$arrParams = array(							
								'quiz_id'		=> Input::get('id'),
								'question'		=> $question,
								'option_a'		=> $options[$key]['a'],
								'option_b'		=> $options[$key]['b'],
								'option_c'		=> $options[$key]['c'],
								'option_d'		=> $options[$key]['d'],
								'answer'		=> $answers[$key]
								);			
				Quiz::addQuizItems($arrParams);
			}

			return Redirect::to('trainer/quizzes/update/'. Input::get('id'))
				->with('success', 'Successfully updated!');
		}
	}

	public function deleteQuiz() {
		Quiz::deleteQuiz(Input::segment(4));
		
		return Redirect::to('trainer/quizzes/'.Input::segment(5))
			->with('success', 'Successfully deleted!');
	}

	public function getQuizDetails () {
		if (Request::isMethod('get')) {	
			$quiz = QuizStudent::find(Request::segment(4));

			$quiz_info = Quiz::find($quiz->quiz_id);
			$quiz->quiz = $quiz_info->title;

			$student = User::find($quiz->student_id);
			$quiz->student = $student->first_name . ' ' . $student->last_name;

			$answers = QuizStudent::getItemsByQuizID(Request::segment(4));

			$arrAnswers = array();
			foreach ($answers  as $item) {
				$arrAnswers[$item->question_id] = $item->answer;
			}

			$quiz_items = Quiz::getItemsByQuizID($quiz->quiz_id);
			$arrItems = array();
			foreach ($quiz_items as $item) {
				$answer = (isset($arrAnswers[$item->id])) ? $arrAnswers[$item->id] : '';

				switch ($answer) {
					case 'a' :	$ans = $item->option_a;
							break;
					case 'b' :	$ans = $item->option_b;
							break;
					case 'c' :	$ans = $item->option_c;
							break;
					case 'd' :	$ans = $item->option_d;
							break;
					default: $ans = '';
				}

				$comment = '';
				if (isset($arrAnswers[$item->id]) && $item->answer==$arrAnswers[$item->id]) {
					$comment = '<span style="color: #005AB0;"><strong><em>(Correct)</em></strong></span>';
				}

				array_push($arrItems, '<strong>'.$item->question . '</strong><br />Answer: ' . htmlentities($ans) . ' ' . $comment);
			}
			$quiz->answers = implode('<br /><br />', $arrItems);
		} else {
			$quiz = array();
		}
	
		return Response::json($quiz);	
	}

	public function getStudents() {				
		$this->getStudentList(Input::segment(4));
	}

	protected function getList($cid = 0) {	
		$this->data['course'] = FacultyLectureWall::getCourse($cid);
		$arrParams = array(							
							'faculty_id'		=> Auth::user()->id,
							'cid'		=> $cid					
						);		
		$results = Quiz::getQuizzes($arrParams);		
		
		$this->data['quizzes'] = $results;

		$this->layout->content = View::make('faculty.class_quizzes', $this->data);
	}
	
	protected function getForm() {			
		$this->data['course'] = FacultyLectureWall::getCourse(Input::segment(4));
		$this->data['url_back'] = 'trainer/quizzes/'.Input::segment(4);
		
		$this->layout->content = View::make('faculty.class_quizzes_insert', $this->data);		
	}

	protected function getFormUpdate($id) {	
		$this->data['quiz'] = Quiz::find($id);
		$this->data['quiz_items'] = Quiz::getItemsByQuizID($id);
		$this->data['url_back'] = 'trainer/quizzes/'.$this->data['quiz']->cid;
						
		$this->layout->content = View::make('faculty.class_quizzes_update', $this->data);		
	}

	protected function getFormView($id, $cid) {
		$this->data['course'] = FacultyLectureWall::getCourse($cid);
		$this->data['quiz'] = Quiz::find($id);
		$this->data['quiz_items'] = Quiz::getItemsByQuizID($id);				
		$this->data['url_back'] = 'trainer/quizzes/'.$this->data['quiz']->cid;

		$this->layout->content = View::make('faculty.class_quizzes_view', $this->data);		
	}

	protected function getStudentList($id) {		
		$this->data['quiz_id'] = $id;
				
		// Data
		$sort = Input::get('sort', 'last_name');
		$order = Input::get('order', 'ASC');
		$page = Input::get('page', 1);

		$arrParams = array(							
							'faculty_id'	=> Auth::user()->id,
							'quiz_id'		=> Request::segment(4),
							'sort'			=> 'first_name',
							'order'			=> 'ASC',
							'page'			=> 1,
							'limit'			=> 50
						);		
		$this->data['students'] = QuizStudent::getQuizzesSubmissions($arrParams);
		
		$this->layout->content = View::make('faculty.class_quizzes_students', $this->data);
	}

	protected function setURL() {
		// Search Filters
		$url = '?filter_title=' . Input::get('filter_title', NULL);
		$url .= '&filter_time_limit=' . Input::get('filter_time_limit', NULL);
		$url .= '&filter_date_from=' . Input::get('filter_date_from', NULL);
		$url .= '&filter_date_to=' . Input::get('filter_date_to', NULL);
		$url .= '&sort=' . Input::get('sort', 'due_date');
		$url .= '&order=' . Input::get('order', 'DESC');
		$url .= '&page=' . Input::get('page', 1);
		
		return $url;
	}
}