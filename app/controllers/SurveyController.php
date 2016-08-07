<?php

class SurveyController extends BaseController {
	private $data = array();	
	protected $layout = "layouts.main";
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	 
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->data['route'] = Route::getCurrentRoute()->getPath();
	}
	
	public function surveyForm() {
		$email = Input::get('to');		
		$key = explode('_', Input::get('key'));

		$arrParams = array(
				'to' => $email,
				'key' => $key[0],
				'uid' => $key[1]
			);
		$this->data['data'] = SkillsMap::getSurveyData($arrParams);		
		$this->data['total_survey'] = SkillsMap::totalSurvey($arrParams);
		$this->data['total_survey_done'] = SkillsMap::totalSurveyDone($arrParams);

		$companies = Companies::getCompanies();
		$comp_array = array();

		foreach($companies as $comp_name) {
			$comp_array[$comp_name->id] = $comp_name->company;
		}
		$this->data['uid'] = $key[1];
		$this->data['company'] = $comp_array;
		
		$this->layout->content = View::make('users.survey_form', $this->data);
	}
	
	public function updateFeedback() {	
		$arrParams = array(
				#'admin_id' 			=> Auth::user()->id,
				'communication' 	=> Input::get('f_communication'),
				'commitment' 		=> Input::get('f_commitment'),
				'analysis' 			=> Input::get('f_analysis'),
				'delivery' 			=> Input::get('f_delivery'),
				'productivity' 		=> Input::get('f_productivity'),
				'fixing' 			=> Input::get('f_fixing'),
				'presentability' 	=> Input::get('f_presentability'),
				'recommendation' 	=> Input::get('f_recommendation'),
				'remarks' 			=> Input::get('remarks'),
				'survey_status' 	=> 1,
				'updated_at'		=> date('Y-m-d H:i:s')
			);
		
		SkillsMap::updateFeedback($arrParams, Input::get('id'));		
		
		return Redirect::to('survey?key='.Input::get('key').'&to='.Input::get('to'))
			->with('success', 'Successfully saved customer feedback!');		
	}
}
