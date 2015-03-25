<?php namespace App\Http\Controllers;

class UptimeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

	public function check(){
		$input = \Input::all();
		return $this->get_http_response_code($input['url']);
	}

	private function get_http_response_code($theURL) {
	    $headers = get_headers($theURL);
	    return substr($headers[0], 9, 3);
	}

	public function send(){
		\Mail::raw('Uptime Status Error: Please check ' . \URL::to('/'), function($message)
		{
				$message->subject('Uptime Monitor');
		    $message->from(getenv('EMAIL_ADDRESS'), 'Uptime Monitor');

		    $message->to(getenv('EMAIL_ADDRESS'));
		});
	}

}
