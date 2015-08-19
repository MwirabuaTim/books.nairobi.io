<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	public function blog()
	{
		return View::make('template')
		->with('info', 'Coming Soon');
	}
	public function forum()
	{
		return Redirect::to('forums.'.$_SERVER['HTTP_HOST']);

		// return View::make('template')
		// ->with('info', 'Coming Soon');
	}

}