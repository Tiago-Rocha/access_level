<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GlobalvarsController
 *
 * @author trocha
 */
class GlobalvarsController extends BaseController{
    
    protected $globalvar;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (!Auth::check()) return Redirect::to('login');
       
        $var = GlobalVar::find(1);
            return View::make('globalvars.index', compact('var'));
        }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, GlobalVar::$rules);

        if ($validation->passes()) {
            $var = GlobalVar::find($id);
            $var->update($input);
            return Redirect::route('globalvars.index', compact('var'));
        }

        return Redirect::route('globalvars.index', compact('var'))
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
    }
}
