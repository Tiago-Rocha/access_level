<?php

class ServicereportsController extends BaseController {

    /**
     * Servicereport Repository
     *
     * @var Servicereport
     */
    protected $servicereport;

    public function __construct(Servicereport $servicereport) {
        $this->servicereport = $servicereport;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (!Auth::check()) {
            return Redirect::to('login');
        } else {
         $servicereports = Servicereport::withTrashed()->where('state', 'submitted')->get();
            $company_options = Company::all();
            return View::make('servicereports.index', compact('servicereports'), compact('company_options'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('servicereports.create', array(
                    'company_options' => Company::all()->lists('name', 'id'),
                    'utilizador_options' => Utilizador::all()->lists('name', 'id')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $input = Input::all();
        $validation = Validator::make($input, Servicereport::$rules);

        if ($validation->passes()) {
            $this->servicereport->create($input);


            return Redirect::route('servicereports.index');
        } else {
            return Redirect::route('servicereports.create')
                            ->withInput()
                            ->withErrors($validation)
                            ->with('message', 'There were validation errors.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $servicereport = $this->servicereport->findOrFail($id);

        return View::make('servicereports.show', compact('servicereport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return View::make('servicereports.edit', array(
                    'company_options' => Company::lists('name', 'id'),
                    'utilizador_options' => Utilizador::lists('name', 'id'),
                    'servicereport' => Servicereport::find($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        if (!Session::get('servicereport'))
            return Redirect::to('login');
        $input = array_except(Input::all(), '_method');

        $validation = Validator::make($input, Servicereport::$rules);

        if ($validation->passes()) {
            $servicereport = $this->servicereport->find($id);
            $servicereport->update($input);

            return Redirect::route('servicereports.show', $id);
        }

        return Redirect::route('servicereports.edit', $id)
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
        $this->servicereport->find($id)->forceDelete();

        return Redirect::route('servicereports.index');
    }

    /**
     * Update Technician Role
     * 
     * @param type $id
     * @return type
     */
    public function changeState() {
        $input = Input::all();
        $servicereport = Servicereport::find($input['id']);

        $servicereport->state = $input['op'];
        $servicereport->save();
        if ($servicereport->free)
            return Redirect::route('servicereports.index');

        $contract = Contract::find($servicereport->contract_id);
        $contract->hoursleft = $contract->hoursleft - $servicereport->duration / 60 . '</br>';
        $contract->save();
        return Redirect::route('servicereports.index');
    }

    public function searchpastservices() {
        $input = Input::all();
        $servicereports_search = Servicereport::withtrashed()->where('company_id', $input['id'])->whereBetween('start', array($input['start'] . ' 00:01:00', $input['end'] . ' 23:59:00'))->get();
        if($servicereports_search->count() === 0) {
            $this->index();
        }
        $company_options = Company::all();
        return View::make('servicereports.index', compact('servicereports_search'), compact('company_options'));
    }

}
