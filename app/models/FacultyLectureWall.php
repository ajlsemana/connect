<?php
class FacultyLectureWall extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */	
	public static function addMsgAndUpload($param = array()) {
		$post_id = DB::table('lecture_post_message')->insertGetId($param);

		return $post_id;
	}
	
	public static function getCourse($id = 0) {
		$query = DB::table('courses')->where('id', '=', $id);

		$result = $query->first();

		return $result;
	}

	public static function getAllPost($sid = 0) {
		$query = DB::table('lecture_post_message')
					->select(DB::raw('lecture_post_message.*, users.id AS uid, users.first_name, users.last_name, users.profile_pic, GROUP_CONCAT(lecture_upload.upload_path SEPARATOR "|") AS uploaded_path'))		
					->join('users', 'lecture_post_message.uid', '=', 'users.id')
					->leftjoin('lecture_upload', 'lecture_post_message.id', '=', 'lecture_upload.post_id')																
					->where('lecture_post_message.sid', '=', (int) $sid)					
					->groupBy('lecture_post_message.id')
					->orderBy('lecture_post_message.created_at', 'DESC');
				
		$result = $query->get();
				
		return $result;
	}

	public static function getAllPostUploads($sid = 0) {
		$query = DB::table('lecture_post_message')					
					->select(DB::raw('lecture_post_message.*, lecture_upload.upload_path'))								
					->join('lecture_upload', 'lecture_post_message.id', '=', 'lecture_upload.post_id')																
					->where('lecture_post_message.sid', '=', (int) $sid);					
				
		$result = $query->get();
				
		return $result;
	}

	public static function addComment($pid = 0, $param = array()) {
		$data = array();
		$post_id = DB::table('lecture_wall_threads')->insertGetId($param);		
		$query = DB::table('lecture_wall_threads')					
					->select(DB::raw('lecture_wall_threads.*, users.profile_pic, CONCAT(users.first_name, " ", users.last_name) AS fullname'))																							
					->join('users', 'lecture_wall_threads.uid', '=', 'users.id')					
					->where('lecture_wall_threads.id', '=', $post_id);
		$html = '';	
		$result = $query->get();
		foreach ($result as $key => $value) {
			$img = 'no-photo.jpg';
			if(! empty($value->profile_pic)) {
				$img = $value->profile_pic;
			}
			$img_path = Config::get('app.url_storage') . '/profile_pic/'.$img;
			$html .= '<div id="all-threads-'.$post_id.'" class="row all-threads all-threads-'.$pid.'">';
			$html .= '<div class="span9" style="margin-top: 4px;"><img width="25" height="25" src="'.$img_path.'" class="img-responsives" alt="picture" />';
			$html .= '&nbsp;<a href="" class="a-threads" onclick="return false;">Me</a><br><span class="wall-time">'.$value->created_at.'</span><br><span class="span-comments" id="span-txt-comments-'.$post_id.'">'.htmlentities($value->wall_comment).'</span> <br /></div><div class="span3 a-bottom-setting"><a onclick="updateThread(this.id);" id="bottom-wall-update-'.$value->id.'" class="bottom-wall-update"><span class="icon-edit" title="edit"></span></a> <a onclick="deleteThread(this.id);" id="bottom-wall-delete-'.$value->id.'" class="bottom-wall-delete"><span class="icon-trash" title="delete"></span></a></div>'; 
			$data['data'] = $html;			
		}	

		return $data;		
	}

	public static function getAllThreads() {
		$data = array();
		$query = DB::table('lecture_wall_threads')					
					->select(DB::raw('lecture_wall_threads.*, users.profile_pic, CONCAT(users.first_name, " ", users.last_name) AS fullname'))																							
					->join('users', 'lecture_wall_threads.uid', '=', 'users.id')
					->leftjoin('lecture_post_message', 'lecture_wall_threads.post_id', '=', 'lecture_post_message.id')										
					->orderBy('lecture_wall_threads.created_at', 'ASC');
				
		$result = $query->get();
		$html = '';

		foreach ($result as $key => $value) {
			$img_path = Config::get('app.url_storage') . '/profile_pic/no-photo.jpg';			
			if(! empty($value->profile_pic)) {
				$img_path = Config::get('app.url_storage') . '/profile_pic/'.$value->profile_pic;			
			}

			$myname = 'Me';
			if($value->uid != Auth::id()) {
				$myname = $value->fullname;
			}
			
			$data[$value->post_id][] = '<div id="all-threads-'.$value->id.'" class="row all-threads all-threads-'.$value->post_id.'"><div class="span9" style="margin-top: 4px;"><img style="border: 1px solid #b5b8ff;" width="25" height="25" src="'.$img_path.'" class="img-responsives" alt="picture" />&nbsp;<a href="" class="a-threads" onclick="return false;">'.$myname.'</a><br><span class="wall-time">'.$value->created_at.'</span><br><div style="display: none;" id="div-comment-update-'.$value->id.'" class="alert alert-warning" role="alert"><button class="close" data-dismiss="alert" type="button">&times;</button>Your comment is required to update.</div><span id="span-txt-comments-'.$value->id.'" class="span-txt-comments">'.htmlentities($value->wall_comment).'</span><br /></div>'.(Auth::id() == $value->uid ? '<div class="span3 a-bottom-setting" align=""><a href="" id="bottom-wall-update-'.$value->id.'" class="bottom-wall-update"><span class="icon-edit" title="edit"></span></a> <a href="" id="bottom-wall-delete-'.$value->id.'" class="bottom-wall-delete"><span class="icon-trash" title="delete"></span></a></div>' : '').'</div>'; 				
		}			

		return $data;
	}	

	public static function updatePost($data = array(), $id) {
		$query = DB::table('lecture_post_message')->where('id', '=', $id);
		return $query->update($data);	
	}

	public static function updateComment($data = array(), $id) {
		$query = DB::table('lecture_wall_threads')->where('id', '=', $id);
		return $query->update($data);	
	}

	public static function deletePost($id) {
		$qry1 = DB::table('lecture_post_message')->where('id', $id)->delete();		
		$qry2 = DB::table('lecture_wall_threads')->where('post_id', $id)->delete();

		$query = DB::table('lecture_upload')					
					->select(DB::raw('lecture_upload.upload_path'))													
					->where('lecture_upload.post_id', '=', $id);				
		$result = $query->get();

		if(count($result) > 0) {
			foreach ($result as $key => $value) {	
				//Reminder: Change this path if you are online, make it dynamic depending on your server location		
				$file = '\\'.$value->upload_path;
				$path = 'H:\xampp\htdocs\tblsys\app\storage\lectures'.$file;			
				@unlink($path);
			}
		}		

		DB::table('lecture_upload')->where('post_id', $id)->delete();
		
		return $qry1;
	}

	public static function deleteComment($id) {
		$query = DB::table('lecture_wall_threads')->where('id', $id)->delete();				
		
		return $query;
	}
}