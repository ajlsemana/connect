<?php

class BaseController extends Controller {
	private $data = array();

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout() {
		$this->data['route'] = Route::getCurrentRoute()->getPath();	
		if ( ! is_null($this->layout)) {
			$this->data['enrolledCourses'] = NULL;
			
			if (Auth::check() &&  in_array(Auth::user()->user_type, array(3, 5))) {
				$this->data['enrolledCourses'] = EnrolledCourses::getEnrolledCourses();
				$this->data['endedCourses'] = EnrolledCourses::getEndedCourses();
				$this->data['profiling'] = User::getRegProfile();	
				$this->data['profiling_ctr'] = $this->data['profiling'];				
			} else if (Auth::check() && Auth::user()->user_type == 2) {
				$this->data['assigned_courses'] = Courses::getAssignedCourses();
			}

			$this->layout = View::make($this->layout, $this->data);
		}
	}

}
