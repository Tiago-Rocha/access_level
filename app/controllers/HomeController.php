<?php

class HomeController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function showWelcome() {
        return View::make('hello');
    }

    public function getIndex() {
        if (!Auth::check())
            return Redirect::to('login');
        
            return Redirect::to('dashboard');
    }

    public function getDashboard() {
        if (!Auth::check())
            return Redirect::to('login');

        $start = date("Y-m-d", strtotime("-4 months"));
        $end = date("Y-m-d", strtotime("+1 days"));
        $servicereports = Servicereport::withTrashed()->where('utilizador_id', Auth::user()->id)->whereBetween('start', array($start . ' 00:00:00', $end . ' 23:59:00'))->get();
        return View::make('layouts.dashboard', compact('servicereports'));
    }

    public function getLogin() {
        if (Auth::check()) {
            return Redirect::to('user');
        }
        return View::make('home.login');
    }

    public function getPainel() {
        return View::make('layouts.admin');
    }

    public function postLogin() {
        $input = Input::all();
        $user = Utilizador::where('name', '=', $input['name'])->first();
        $rules = array('name' => 'required', 'password' => 'required');
        $v = Validator::make($input, $rules);
        if (Auth::check()) {
            $this->getIndex();
        }
        if ($v->fails()) {
            return Redirect::to('login')->withErrors($v);
        } else {
            $credentials = array('name' => $input['name'], 'password' => $input['password']);
            
            if (Auth::attempt($credentials)) {
                Session::put('name', Auth::user()->name);
                Session::put('humanresource', Auth::user()->humanresource);
                Session::put('servicereport', Auth::user()->servicereport);
                Session::put('clientmanager', Auth::user()->clientmanager);
                Session::put('contractmanager', Auth::user()->contractmanager);
                Session::put('networkmanager', Auth::user()->networkmanager);
                Session::put('admin', Auth::user()->admin);
                return Redirect::to('/');
            } else {
                return Redirect::to('login');
            }
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect::to('/');
    }

    public function getRegister() {
        return View::make('home.register');
    }

    public function postRegister() {
        $input = Input::all();
        $rules = array('name' => 'required|unique:users', 'password' => 'required');
        $v = Validator::make($input, $rules);
        if ($v->passes()) {
            $password = $input['password'];
            $password = Hash::make($password);
            $user = new User();
            $user->name = $input['name'];
            $user->password = $password;
            $user->save();
            return Redirect::to('login');
        } else {
            return Redirect::to('register')->withInput()->withErrors($v);
        }
    }

}
