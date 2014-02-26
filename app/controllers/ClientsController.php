<?php

class ClientsController extends BaseController {

    /**
     * Client Repository
     *
     * @var Client
     */
    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (!Session::get('clientmanager')) {
            return Redirect::to('login');
        } else {
            $clients = $this->client->all();
            $companies = Company::all();
            return View::make('clients.index', compact('clients'), compact('companies'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        // queries the companies db table, orders by name and lists name and id
        if (!Session::get('clientmanager')) {
            return Redirect::to('login');
        }
        $company_options = DB::table('companies')->orderBy('name', 'asc')->lists('name', 'id');

        return View::make('clients.create', array('company_options' => $company_options));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        if (!Session::get('clientmanager')) return Redirect::to('login');
        
        $input = Input::all();
        $validation = Validator::make($input, Client::$rules);
        if ($validation->passes()) {
            $this->client->create($input);

            return Redirect::route('clients.index');
        }

        return Redirect::route('clients.create')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if (!Session::get('clientmanager')) return Redirect::to('login');
        $client = $this->client->withTrashed()->findOrFail($id);

        return View::make('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        if (!Session::get('clientmanager')) return Redirect::to('login');
        $client = $this->client->find($id);
        $company_options = DB::table('companies')->orderBy('name', 'asc')->lists('name', 'id');
        if (is_null($client)) {
            return Redirect::route('clients.index');
        }

        return View::make('clients.edit', compact('client'), array('company_options' => $company_options));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        if (!Session::get('clientmanager')) return Redirect::to('login');
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Client::$rules);

        if ($validation->passes()) {
            $client = $this->client->find($id);
            $client->update($input);

            return Redirect::route('clients.show', $id);
        }

        return Redirect::route('clients.edit', $id)
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        if (!Session::get('clientmanager')) return Redirect::to('login');
        $this->client->find($id)->delete();

        return Redirect::route('clients.index');
    }


}
