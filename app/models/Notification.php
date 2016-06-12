<?php
class Notification extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */	
	public static function calendarToday() {
		$date = date('Y-m-d');
		$query = DB::table('university_calendar')
			->where('date_from', '=', $date);
		
		return $query->count();
	}

	public static function calendarMonth() {
		$date = date('Y-m');
		$query = DB::table('university_calendar')
			->where('date_from', 'LIKE', $date.'%');
		
		return $query->count();
	}

	public static function announcementToday() {
		$date = date('Y-m-d');
		$query = DB::table('announcements')
			->where('date_from', '=', $date);
		
		return $query->count();
	}

	public static function announcementMonth() {
		$date = date('Y-m');
		$query = DB::table('announcements')
			->where('date_from', 'LIKE', $date.'%');
		
		return $query->count();
	}

	public static function getFacultyPendingStudents( $class_id ) {
		$result = FALSE;
		if($class_id) {		
			$query = DB::table('class_students')
						->select(DB::raw('subject_section.*, semester.sem_name AS sem_name, courses.name as subject_names, courses.id as subject_code, sections.code as section_code, sections.school_year_from, sections.school_year_to, sections.semester'))
						->join('subject_section', 'subject_section.id', '=', 'class_students.class_id')
						->join('courses', 'subject_section.subject_id', '=', 'courses.id')
						->join('sections', 'subject_section.section_id', '=', 'sections.id')						
						->join('semester', 'sections.semester', '=', 'semester.id')
						->where('class_students.status', '=', 0);

						$query->whereIn('class_students.class_id', $class_id);	
						$query->groupBy('class_students.class_id');												
						$query->orderBy('courses.id', 'ASC');
					
			$result = $query->get();
		}
				
		return $result;
	}
	
	public static function getFacultyPendingStudentsTotal( $class_id ) {
		$result = 0;
		if($class_id):
			$query = DB::table('class_students');										
			$query->whereIn('class_students.class_id', $class_id);											
			$query->where('class_students.status', '=', 0);									
									
			$result = $query->count();
		endif;
				
		return $result;
	}

	public static function getFacultycourses() {
		$query = DB::table('faculty_subject')
					->select(DB::raw('faculty_subject.subject_id'))					
					->where('faculty_subject.faculty_id', '=', Auth::user()->id);				
								
		$result = $query->get();
				
		return $result;
	}
}
