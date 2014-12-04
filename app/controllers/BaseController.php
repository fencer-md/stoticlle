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

	public function __construct()
	{
	    // Run the 'csrf' filter on all post, put, patch and delete requests.
	    $this->beforeFilter('csrf', ['on' => ['post', 'put', 'patch', 'delete']]);
	}

}
