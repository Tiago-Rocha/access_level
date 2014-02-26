<?php

class CompaniesController extends BaseController {

    /**
     * Company Repository
     *
     * @var Company
     */
    protected $company;

    public function __construct(Company $company) {
        $this->company = $company;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (!Session::get('clientmanager'))  return Redirect::to('login');
            $companies = $this->company->all();
            $clients = Client::all();
            return View::make('clients.index', compact('companies'), compact('clients'));
        }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        if (!Session::get('clientmanager'))  return Redirect::to('login');
        return View::make('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        if (!Session::get('clientmanager'))  return Redirect::to('login');
        $input = Input::all();
        $validation = Validator::make($input, Company::$rules);

        if ($validation->passes()) {
            $this->company->create($input);

            return Redirect::route('companies.index');
        }

        return Redirect::route('companies.create')
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
        if (!Session::get('clientmanager'))  return Redirect::to('login');
        $company = $this->company->withTrashed()->findOrFail($id);

        return View::make('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        if (!Session::get('clientmanager'))  return Redirect::to('login');
        $company = $this->company->find($id);

        if (is_null($company)) {
            return Redirect::route('companies.index');
        }

        return View::make('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        if (!Session::get('clientmanager'))  return Redirect::to('login');
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Company::$rules);

        if ($validation->passes()) {
            $company = $this->company->find($id);
            $company->update($input);

            return Redirect::route('companies.show', $id);
        }

        return Redirect::route('companies.edit', $id)
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
        if (!Session::get('clientmanager'))  return Redirect::to('login');
        $company = Company::find($id);
        
        $clients = $company->clients()->get();
        

        foreach ($clients as $client) {
            $client->Contracts()->delete();
        }

        $company->Clients()->delete();
        $company->Servicereports()->delete();
        $company->delete();
        
        return Redirect::route('companies.index');
    }

}
