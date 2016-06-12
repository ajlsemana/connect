<?php 

class FacultyLectureWallController extends BaseController {
	private $data = array();
	private $allowed = array(2);
	private $allowedTypes = array('zip', 'rar', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'txt');
	
	protected $layout = "layouts.main";
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));

		if (! in_array(Auth::user()->user_type, $this->allowed)) {
			return Redirect::to('auth/logout');
		}
	}
	
	public function index() {
		$this->getForm();
	}
	
	protected function getForm() {	
		$sid = Input::segment(3);
		$allPost = FacultyLectureWall::getAllPost($sid);
		$html = '';
		$this->data['course'] = FacultyLectureWall::getCourse($sid);	
		
		foreach ($allPost as $post):							
			$getThreads = $this->getThreads($post->id);		
			$img_path = Config::get('app.url_storage') . '/profile_pic/no-photo.jpg';					
			if(!empty($post->profile_pic)) {
				$img_path = Config::get('app.url_storage') . '/profile_pic/'.$post->profile_pic;			
			}

			$myname = 'Me';
			if($post->uid != Auth::user()->id) {
				$myname = $post->first_name.' '.$post->last_name;
			}					

			$html .= '<div class="row">
				<div class="span11 div-post-wrapper" id="div-post-wrapper-'.$post->id.'">
					<div class="post-content">	
						<div class="row">									
							<div class="span12"><img style="border: 1px solid #b5b8ff;" width="32" height="32" src="'.$img_path.'" class="img-responsives" alt="picture" /></div>
						</div>
						<div class="row post-name">						
						<div class="span11"> <a href="#" class="a-threads">'.$myname.'</a> 
						<span class="gray-font">posted on our training wall.</span>
						<span title="post settings" id="top-icon-setting-'.$post->id.'" style="display: '.($post->uid != Auth::user()->id ? 'none' : '').'" class="wall-post-setting wall-post-settings icon-cog"></span>
						</div>
						</div>
						<div class="row"><div class="span wall-time">'.$post->created_at.'</div>
						<div class="span"><div class="a-post-setting" id="top-post-setting-'.$post->id.'" style="display: none;"><a href="" id="top-wall-update-'.$post->id.'" class="top-wall-update"><span class="icon-edit" title="edit"></span></a> <a href="" id="top-wall-delete-'.$post->id.'" class="top-wall-delete"><span title="delete" class="icon-trash"></span></a></div></div></div>						
						<div style="display: none;" id="div-post-update-'.$post->id.'" class="alert alert-warning" role="alert"><button class="close" data-dismiss="alert" type="button">&times;</button>Your post message is required.</div>
						<div class="post-msg" id="post-msg-'.$post->id.'">'.nl2br(htmlentities($post->post_msg)).'</div>
						
						<div class="post-download">';			
							if(! empty($post->uploaded_path)):	
								$html .= 'Download Attachments:<br />';
								$explode_path = explode('|', $post->uploaded_path);					
								foreach($explode_path as $files):
									$path = Config::get('app.url_storage') . '/lectures/' . $files;
									$item = '<span class="glyphicon glyphicon-download"></span> <a href="' . $path . '">' . $files . '</a>';
									$html .= '<div class="row-file row-file-'.$post->id.'">';
										$html .= $item;
									$html .= '</div>';
								endforeach;
							endif;	

							$html .= '<div id="box-comment-'.$post->id.'">';												
							if(! empty($getThreads)) {
								$html .=  '<div class="all-threads">'.$getThreads.'</div>';							
							}
							$html .= '</div>';

							$html .= '<div class="reply-wrapper">
								<a class="a-reply" id="reply-'.$post->id.'" href=""><span class="wall-post-settings glyphicon glyphicon-comment"></span> Reply</a>
							</div>';
							$html .= '<form id="form-'.$post->id.'">';							
							$html .= '<div class="comment-txt" id="comment-txt-'.$post->id.'" style="display: none;">
								<div class="span10"><textarea style="width: 600px;" rows="2" cols="20" placeholder="Type a reply..." class="form-control" id="txt-comment-'.$post->id.'" name="txt-comment['.$post->id.']"></textarea></div>
								<div class="span2"><button type="button" id="btn-reply-'.$post->id.'" class="btn-reply btn btn-sm btn-default">Reply</button></div>
							</div>';
							$html .= '</div>							
							<input type="hidden" value="0" class="hideShow" id="hideShow-'.$post->id.'">
							</form>
						</div>
					</div>
				</div>';
		endforeach;		

		$postFiles = FacultyLectureWall::getAllPostUploads($sid);
			
		$this->data['allPost'] = $allPost;
		$this->data['postContent'] = $html;	
		$this->data['postFiles'] = $postFiles;			
		$this->data['url_cancel'] = URL::to('');			
		$this->data['subjects'] = array();		
	
		$this->layout->content = View::make('faculty.class_wall', $this->data);
	}

	private function getThreads($post_id = 0) {
		$threads = FacultyLectureWall::getAllThreads();		
		$html = '';		

		if($threads) {
			if (array_key_exists($post_id, $threads)) {				
				foreach ($threads[$post_id] as $key => $value) {					
					$html .= $value;																	
				}								
			}
		}
	
		return $html;
	}

	public function addComment() {	
		$arr = array();		

		if (Request::isMethod('get')) {
			$pid =Input::get('pid');					
			$res = FacultyLectureWall::addComment($pid, array(
				'post_id' => Input::get('pid'),
				'uid' => Auth::user()->id,
				'wall_comment' => Input::get('msg')
			));			

			if($res) {							
				$arr['html'] = '						
						'.$res['data'].'</div>';							

				$arr['pid'] = TRUE;
			} else {
				$arr['pid'] = FALSE;
			}					
		}
		
		return Response::json($arr);				
	}

	public function updatePost() {	
		$arr = array();		

		if (Request::isMethod('get')) {						
			$res = FacultyLectureWall::updatePost(array(							
				'post_msg' => Input::get('myPost')
			), Input::get('pid'));

			if($res) {							
				$arr['html'] = '<div class="row all-threads all-threads-'.Input::get('pid').'"><div class="span11">'.$res['data'].'</div>
					<div class="span1" align="right"><span title="post settings" class="wall-post-settings glyphicon glyphicon-cog"></span></div>
				</div>';	

				$arr['pid'] = TRUE;
			} else {
				$arr['pid'] = FALSE;
			}					
		}
		
		return Response::json($arr);				
	}

	public function updateComment() {	
		$arr = array();		

		if (Request::isMethod('get')) {						
			$res = FacultyLectureWall::updateComment(array(							
				'wall_comment' => Input::get('myComment')
			), Input::get('cid'));

			if($res) {											
				$arr['cid'] = TRUE;
			} else {
				$arr['cid'] = FALSE;
			}					
		}
		
		return Response::json($arr);				
	}

	public function deletePost() {	
		$arr = array();				
		
		if (Request::isMethod('get')) {				
			$pid = Input::get('pid');		
			$res = FacultyLectureWall::deletePost($pid);
			
			if($res) {											
				$arr['pid'] = TRUE;
			} else {
				$arr['pid'] = FALSE;
			}					
		}
		
		return Response::json($arr);				
	}

	public function deleteComment() {	
		$arr = array();				
		
		if (Request::isMethod('get')) {				
			$cid = Input::get('cid');		
			$res = FacultyLectureWall::deleteComment($cid);
			
			if($res) {											
				$arr['cid'] = TRUE;
			} else {
				$arr['cid'] = FALSE;
			}					
		}
		
		return Response::json($arr);				
	}

	public function postIt() {		
		$message = '';										
	  	$post_msg = Input::get('post_msg');	  		  		  	
	  	$sid = Input::get('sid');	
	    $course_name = Input::get('course_name');
	  	
	  	if($post_msg == '') {
	  		$message .= 'Post message is required.<br />';
	  	}	
				
		if (! empty($message)) {			
			return Redirect::to('trainer/wall-announcement/'.$sid)
					->with('error', $message)
					->withInput();	
		} else {
			$uid = Auth::user()->id;
			$arrParams_post = array(	
							'uid'	=> $uid,
							'sid' => $sid,																														
							'post_msg'	=> $post_msg												
						);						
			$headers = 'Content-type:text/html;charset=UTF-8';							
			$emails = User::getPrimaryEmail($sid);

			foreach($emails as $email) {
				$subject = 'New Announcement Posted for '.$course_name;
				$body = Auth::user()->first_name.' '.Auth::user()->last_name.' posted on our training wall.<br><br>';
				$body .= $post_msg;
				#$body .= '<br><br><a href="'.URL::to('trainer/wall-announcement/' . $sid).'">View Announcement</a>';
				$mail_submit = mail($email, $subject, $body, $headers);			
			}

			$uploadNow = FacultyLectureWall::addMsgAndUpload($arrParams_post);							

			return Redirect::to('trainer/wall-announcement/' . $sid)
				->with('success', 'Successfully posted!');
		}
	}
}