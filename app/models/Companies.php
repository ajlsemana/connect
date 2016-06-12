<?php
class Companies extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'companies';

	public static function getCompanies() {
		$query = DB::table('companies')->orderBy('company', 'ASC');
		$result = $query->get();
		
		return $result;
	}	
}
