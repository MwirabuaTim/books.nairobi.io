<?php

class UserController extends AuthorizedController
{
	/**
	 * Let's whitelist all the methods we want to allow guests to visit!
	 *
	 * @access   protected
	 * @var      array
	 */
	protected $whitelist = array(
		'getLogin',
		'postLogin',
		'getRegister',
		'postRegister'
	);
	//public $restfull = true;

	/**
	 * Main user page.
	 *
	 * @access   public
	 * @return   View
	 */
	public function getIndex()
	{
		// Show the page.
		//

		if (Auth::check())
		{
			return Redirect::to('user/'.Auth::user()->id);

		}
		else
		{
			return Redirect::to('user/login');
		}
	}

	public function account($id)
    {
		// $courses = Course::all();

		if (User::find($id)):
			$user =  User::find($id);
			// $user = Auth::user();

	        if(!DB::table('courselists')->where('userid', $id)->first()){
		        return View::make('user/account')
		        	->with('user', $user)
					->with('info', "You have not added a course yet.");
	        };
	        $courses = DB::table('courselists')->where('userid', $id)->get();
	        // var_dump($courses);

			return View::make('user/account', compact('courses'))
				->with('user', $user);
		else:
			return View::make('template');
		endif;
    }

	/**
	 * Login form page.
	 *
	 * @access   public
	 * @return   View
	 */
	public function getLogin()
	{
		// Are we logged in?
		//
		if (Auth::check())
		{
			return Redirect::to('user/' . Auth::user()->id);
		}

		// Show the page.
		//
		return View::make('user/login');
	}

	/**
	 * Login form processing.
	 *
	 * @access   public
	 * @return   Redirect
	 */
	public function postLogin()
	{
		// Declare the rules for the form validation.
		//
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required'
		);

		// Get all the inputs.
		//
		$email    = Input::get('email');
		$password = Input::get('password');

		// Validate the inputs.
		//
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success.
		//
		if ($validator->passes())
		{
			// Try to log the user in.
			//
			if (Auth::attempt(array('email' => $email, 'password' => $password)))
			{
				// Redirect to the user page.
				//
				return Redirect::to('user')->with('success', 'You have logged in successfully');
			}
			else
			{
				// Redirect to the login page.
				//
				return Redirect::to('user/login')->with('error', 'Email/password invalid.');
			}
		}

		// Something went wrong.
		//
		return Redirect::to('user/login')->withErrors($validator);
	}

	/**
	 * User account creation form page.
	 *
	 * @access   public
	 * @return   View
	 */
	public function getRegister()
	{
		// Are we logged in?
		//
		if (Auth::check())
		{
			return Redirect::to('user');
		}

		// Show the page.
		//
		return View::make('user/register');
	}

	/**
	 * User account creation form processing.
	 *
	 * @access   public
	 * @return   Redirect
	 */
	public function postRegister()
	{
		// Declare the rules for the form validation.
		//
		// return Response::json(Input::all());

		$rules = array(
			'firstname'            => 'required',
			'lastname'             => 'required',
			'email'                 => 'required|email|unique:users',
			'contacts'              => 'required|unique:users',
			'password'              => 'required|confirmed',
			'password_confirmation' => 'required',
			'college'				=> 'required|exists:colleges,name',
			'terms'		=>	'accepted'
		);

		// Validate the inputs.
		//
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success.
		//
		if ($validator->passes())
		{
			// Create the user.
			//
			$user = new User;
			$user->firstname = Input::get('firstname');
			$user->lastname  = Input::get('lastname');
			$user->email     = Input::get('email');
			$user->contacts  = Input::get('contacts');
			$user->password  = Hash::make(Input::get('password'));
			
			$collegearray = DB::table('colleges')->where('name', 'like', Input::get('college'))->get();
			//var_dump($college);
			$user->collegeid   = $collegearray['0']->id;

			$user->save();

			// Redirect to the register page.			
			return Redirect::to('user/login')->with('success', 'Account created with success!');
		}

		// Something went wrong.
		//
		return Redirect::to('user/register')->withInput()->withErrors($validator);
	}

	/**
	 * Logout page.
	 *
	 * @access   public
	 * @return   Redirect
	 */
	public function getLogout()
	{
		// Log the user out.
		//
		Auth::logout();

		// Redirect to the user page.
		//
		return Redirect::to('user/login')->with('success', 'Logged out with success!');
	}


	public function getEdit($id)
	{
		// Show the page.
		//
		
		if(Auth::user()->id == $id ){
			//$user =  User::find($id);
			$user =  User::find(Auth::user()->id);
			// var_dump($user);
			return View::make('user/edit')->with('user', $user);
		}
		else{
			$id = Auth::user()->id;
			$user =  User::find($id);

			return Redirect::to('user/'.$id.'/edit')->with('user', $user);
		};
	}


	/**
	 *
	 *
	 * @access   public
	 * @return   Redirect
	 */
	public function postEdit()
	{
		// Declare the rules for the form validation.
		//
		$rules = array(
			'firstname' =>	'Required',
			'lastname'  =>	'Required',
			'email'     =>	'Required|Email|Unique:users,email,' . Auth::user()->email . ',email',
			'contacts'  =>	'Required',
			'oldpass'	=>	'Required|passcheck',
			'password'	=>	'Confirmed', //by password_confirmation'
			'college'	=>	'Required|exists:colleges,name',
			'terms'		=>	'accepted'
		);

		// if(!DB::table('colleges')->where('name', Input::get('college'))->first()){
		// 	//return college validation error
		// }

		$messages = array(
			'passcheck' => 'Your old password was incorrect',
			'accepted' => 'You have to accept the terms of service!',
		    //'exists' => 'Please type and pick a college from the dropdown',
		);

		// Validator::extend('accepted', function($attribute, $value, $parameters)
		// {
		// 	if(Input::get('terms') == 0){
		// 		return false;
		// 	}
		// 	else{
		// 		return true;
		// 	};
		// });

		Validator::extend('passcheck', function($attribute, $value, $parameters)
		{
			// if(DB::table('users')->where('password', Hash::make(Input::get('oldpass')))->first()){
			// 	return true;
			// }
			// else{
			// 	return false;
			// };

			$user =  User::find(Auth::user()->id);
			if (Hash::check(Input::get('oldpass'), $user->password)) {
			    // The passwords match...
			    return true;
			}
			else {
			    return false;
			}
		});


		// Get all the inputs.
		//
		$inputs = Input::all();

		
		// Validate the inputs.
		//
		$validator = Validator::make($inputs, $rules, $messages);


		// Check if the form validates with success.
		//



		
		//if (Auth::attempt(array('email' => $email, 'password' => $password)))


		if ($validator->passes())
		{
			// Edit the user.
			//
			$user =  User::find(Auth::user()->id);
			$id =  $user->id;
			$user->firstname = Input::get('firstname');
			$user->lastname  = Input::get('lastname');
			$user->email     = Input::get('email');
			$user->contacts  = Input::get('contacts');

			$collegearray = DB::table('colleges')->where('name', 'like', Input::get('college'))->get();
			//var_dump($college);
			$user->collegeid   = $collegearray['0']->id;

			if (Input::get('password') !== '')
			{
				$user->password = Hash::make(Input::get('password'));
			}

			$user->save();


			return Redirect::to('user/'.$id)->with('success', 'Account updated with success!');

		}

		// Something went wrong.
		//
		$user =  User::find(Auth::user()->id);
		$id =  $user->id;
		return Redirect::to('user/'.$id.'/edit')
						->withInput($inputs)
						->withErrors($validator->messages());

	}

}
