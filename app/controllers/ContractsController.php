<?php

class ContractsController extends BaseController {

    /**
     * Contract Repository
     *
     * @var Contract
     */
    protected $contract;

    public function __construct(Contract $contract) {
        $this->contract = $contract;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (!Session::get('humanresource')) {
            return Redirect::to('login');
        } else {
            $contracts = Contract::orderBy('hoursleft', 'ASC')->get();
            $colors = array();
            foreach ($contracts as $contract) {
                $color = ($contract->type == 'regie') ? 'Lavender' : $this->percentage($contract->hoursleft, $contract->hourstotal);
                $colors[$contract->id] = $color;          
            }
            return View::make('contracts.index', compact('contracts'), compact('colors'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        // queries the companies db table, orders by name and lists name and id
        $client_options = Client::orderBy('name', 'asc')->lists('name', 'id');

        return View::make('contracts.create', array('client_options' => $client_options));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $input = Input::all();
        $validation = Validator::make($input, Contract::$rules);
        if ($validation->passes()) {
            $this->contract->create($input);
            return Redirect::route('contracts.index');
        }
        return Redirect::route('contracts.create')
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
        $contract = $this->contract->findOrFail($id);

        return View::make('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $contract = $this->contract->find($id);

        if (is_null($contract)) {
            return Redirect::route('contracts.index');
        }

        return View::make('contracts.edit', compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Contract::$rules);

        if ($validation->passes()) {
            $contract = $this->contract->find($id);
            $contract->update($input);

            return Redirect::route('contracts.show', $id);
        }

        return Redirect::route('contracts.edit', $id)
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
        $this->contract->find($id)->delete();

        return Redirect::route('contracts.index');
    }

    /*
     * Function to calculate the usage percentage of a contract and will return the respective color
     * +50%       -> Green
     *  35%<->50% -> Yellow
     *  10%<->30% -> Orange
     * -10%       ->red
     */

    public function percentage($hoursleft, $totalhours) {
        $res = round(($hoursleft / $totalhours) * 100, 2);
        $color = null;
        switch ($res) {
            case ($res <= 20):
                return 'Tomato';
                break;

            case ($res <= 40):
                return 'LightSalmon';
                break;

            case ($res <= 60):
                return '#F8BA40';
                break;

            case ($res > 60):
                return '#86B32D';
                break;
        }
    }

}
