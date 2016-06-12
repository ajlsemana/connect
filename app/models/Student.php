<?php
class Student extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'class_students';

	public static function addClass($data = array()) {
		$id = DB::table('class_students')->insertGetId($data);
		
		return $id;
	}

	public static function updateClassStudent($id, $data = array()) {
		$query = DB::table('class_students')->where('id', '=', $id);
		$query->update($data);	
	}
	
	public static function updateVideoConferenceStatus($id, $data = array()) {
		$query = DB::table('class_students')->where('id', '=', $id);
		$query->update($data);
	}

	public static function deleteClassStudent($id) {
		DB::table('class_students')->where('id', $id)->delete();
	}

	public static function validateClass($student_id, $class_id) {
		$query = DB::table('class_students')
								->where('student_id', '=', $student_id)
								->where('class_id', '=', $class_id);

		return ($query->count()>0) ? TRUE : FALSE;
	}

	public static function getClassStudents($data = array()) {
		$query = DB::table('class_students')
								->select(DB::raw('class_students.status as class_status, subjects.*, subject_section.group_code, sections.code as section_code, sections.name as section_name, sections.school_year_from, sections.school_year_to, sections.semester'))
								->join('subject_section', 'class_students.class_id', '=', 'subject_section.id')
								->join('subjects', 'subject_section.subject_id', '=', 'subjects.id')
								->join('sections', 'subject_section.section_id', '=', 'sections.id')
								->where('class_students.student_id', '=', $data['student_id'])
								->whereIn('class_students.status', array(0,1));

		if( CommonHelper::hasValue($data['sort']) && CommonHelper::hasValue($data['order']))  {
			$data['sort'] = ($data['sort']=='group_code') ? 'subject_section.group_code' : $data['sort'];
			$data['sort'] = ($data['sort']=='subject') ? 'subjects.name' : $data['sort'];
			$data['sort'] = ($data['sort']=='section') ? 'sections.name' : $data['sort'];
			$data['sort'] = ($data['sort']=='status') ? 'class_students.status' : $data['sort'];

			$query->orderBy($data['sort'], $data['order']);
		}
		
		if( CommonHelper::hasValue($data['limit']) && CommonHelper::hasValue($data['page']))  {
			$query->skip($data['limit'] * ($data['page'] - 1))
		          ->take($data['limit']);
		}
		
		$result = $query->get();
				
		return $result;
	}
	
	public static function getTotalClassStudents($data = array()) {
		$query = DB::table('class_students')
								->select(DB::raw('subjects.*, subject_section.group_code, sections.code as section_code, sections.name as section_name, sections.school_year_from, sections.school_year_to, sections.semester'))
								->join('subject_section', 'class_students.class_id', '=', 'subject_section.id')
								->join('subjects', 'subject_section.subject_id', '=', 'subjects.id')
								->join('sections', 'subject_section.section_id', '=', 'sections.id')
								->where('class_students.student_id', '=', $data['student_id'])
								->whereIn('class_students.status', array(0,1));
		   								   
		return $query->count();
	}

	public static function getEnrolledTraining($trainee_id) {
		$query = DB::table('reservation')
								->select(DB::raw('reservation.*, courses.*'))
								->join('courses', 'courses.id', '=', 'reservation.courses')			
								->where('reservation.uid', '=', (int)$trainee_id)
								->where('reservation.attendance_status', '=', 'Processed')
								->orderBy('courses.name', 'ASC');

		$result = $query->get();
				
		return $result;
	}

	public static function getSpecificCourseTrainee($data = array()) {
		$query = DB::table('reservation')
					->select(DB::raw('reservation.*, courses.*'))
					->join('courses', 'courses.id', '=', 'reservation.courses')					
					->where('courses.id', '=', (int)$data['course_id'])
					->where('reservation.uid', '=', (int)$data['trainee_id'])
					->where('reservation.attendance_status', '=', 'Processed');

		$result = $query->first();
		
		return $result;
	}

	// Faculty
	public static function getClassStudentsFaculty($data = array()) {
		$query = DB::table('class_students')
								->select(DB::raw('class_students.id as student_id, class_students.video_conf_status as video_status, class_students.status as class_status, users.*'))
								->join('faculty_subject', 'class_students.class_id', '=', 'faculty_subject.subject_id')
								->join('subject_section', 'faculty_subject.subject_id', '=', 'subject_section.id')
								->join('subjects', 'subject_section.subject_id', '=', 'subjects.id')
								->join('sections', 'subject_section.section_id', '=', 'sections.id')
								->join('users', 'class_students.student_id', '=', 'users.id')
								->where('faculty_subject.faculty_id', '=', (int)$data['faculty_id'])
								->where('class_students.class_id', '=', (int)$data['class_id']);

		if( CommonHelper::hasValue($data['sort']) && CommonHelper::hasValue($data['order']))  {
			$data['sort'] = ($data['sort']=='student') ? 'users.first_name' : $data['sort'];
			$data['sort'] = ($data['sort']=='status') ? 'class_students.status' : $data['sort'];

			$query->orderBy($data['sort'], $data['order']);
		}
		
		if( CommonHelper::hasValue($data['limit']) && CommonHelper::hasValue($data['page']))  {
			$query->skip($data['limit'] * ($data['page'] - 1))
		          ->take($data['limit']);
		}
		
		$result = $query->get();
				
		return $result;
	}
	
	public static function getTotalClassStudentsFaculty($data = array()) {
		$query = DB::table('class_students')
								->select(DB::raw('class_students.id as student_id, class_students.status as class_status, users.*'))
								->join('faculty_subject', 'class_students.class_id', '=', 'faculty_subject.subject_id')
								->join('subject_section', 'faculty_subject.subject_id', '=', 'subject_section.id')
								->join('subjects', 'subject_section.subject_id', '=', 'subjects.id')
								->join('sections', 'subject_section.section_id', '=', 'sections.id')
								->join('users', 'class_students.student_id', '=', 'users.id')
								->where('faculty_subject.faculty_id', '=', (int)$data['faculty_id'])
								->where('class_students.class_id', '=', (int)$data['class_id']);
		   								   
		return $query->count();
	}

	public static function checkVideoStatus($uid = 0, $class_id = 0) {
		$query = DB::table('class_students')								
								->where('class_id', '=', (int) $class_id)
								->where('student_id', '=', (int) $uid)
								->where('video_conf_status', '=', 1)
								->where('status', '=', 1);
		   								   
		return $query->count();
	}
}
