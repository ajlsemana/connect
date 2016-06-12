<?php 

class ErrorController extends BaseController {
	private $data = array();
	
	protected $layout = "layouts.default";

	public function __construct() {
		
	}
	
	public function getPagenotfound() {
		$this->data['heading_title'] = 'Page Not Found';
		
		$this->data['error_404'] = 'Page Not Found';

		$this->data['link_login'] = 'Go back to login page';
				
		$this->layout->content = View::make('error.404', $this->data);
	}
}