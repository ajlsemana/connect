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
		$rules = array(
						'communication' 	=> array('required', 'numeric', 'min:0', 'max:5'),
						'commitment' 		=> array('required', 'numeric', 'min:0', 'max:5'),
						'analysis' 			=> array('required', 'numeric', 'min:0', 'max:5'),
						'delivery' 			=> array('required', 'numeric', 'min:0', 'max:5'),
						'productivity' 		=> array('required', 'numeric', 'min:0', 'max:5'),
						'fixing' 			=> array('required', 'numeric', 'min:0', 'max:5'),
						'presentability' 	=> array('required', 'numeric', 'min:0', 'max:5'),
						'recommendation' 	=> array('required', 'numeric', 'min:0', 'max:5')
					);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('survey?key='.Input::get('key').'&to='.Input::get('to'))
				->withErrors($validator)
				->withInput();
		} else {

			$arrParams = array(
					#'admin_id' 			=> Auth::user()->id,
					'communication' 	=> Input::get('communication'),
					'commitment' 		=> Input::get('commitment'),
					'analysis' 			=> Input::get('analysis'),
					'delivery' 			=> Input::get('delivery'),
					'productivity' 		=> Input::get('productivity'),
					'fixing' 			=> Input::get('fixing'),
					'presentability' 	=> Input::get('presentability'),
					'recommendation' 	=> Input::get('recommendation'),
					'remarks' 			=> Input::get('remarks'),
					'survey_status' 	=> 1,
					'updated_at'		=> date('Y-m-d H:i:s')
				);
			
			SkillsMap::updateFeedback($arrParams, Input::get('id'));		
			
			return Redirect::to('survey?key='.Input::get('key').'&to='.Input::get('to'))
				->withInput()
				->with('success', 'Successfully saved customer feedback!');		
		}
	}
}
