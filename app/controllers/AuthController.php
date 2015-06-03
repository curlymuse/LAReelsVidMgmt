<?php

class AuthController extends \BaseController {

	/**
	 * Login form (show)
	 *
	 * @return Response
	 */
	public function create() {

		return View::make('pages.auth.show');

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /auth
	 *
	 * @return Response
	 */
	public function store() {

		$data = Input::only(['email', 'password']);
		if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
			return Redirect::route('videos.index');

		$error = 'Incorrect login. Please try again.';
		return Redirect::route('login.show')->withError($error);

	}

	/**
	 * Display the specified resource.
	 * GET /auth/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /auth/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/*
	 * Update the specified resource in storage.
	 * PUT /auth/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {


	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /auth/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}