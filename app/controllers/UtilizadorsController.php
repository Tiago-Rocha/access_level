<?php

class UtilizadorsController extends BaseController {

	/**
	 * Utilizador Repository
	 *
	 * @var Utilizador
	 */
	protected $utilizador;

	public function __construct(Utilizador $utilizador)
	{
		$this->utilizador = $utilizador;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            
            if(!Session::get('humanresource')){
                    return Redirect::to('login');
            }  else {
		$utilizadors = $this->utilizador->all();

		return View::make('utilizadors.index', compact('utilizadors'));
	}
        

	}
        

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('utilizadors.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Utilizador::$rules);
                if ($validation->passes())
		{
                        $input['password'] = Hash::make($input['password']);
			$this->utilizador->create($input);

			return Redirect::route('utilizadors.index');
		}

		return Redirect::route('utilizadors.create')
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
	public function show($id)
	{
		$utilizador = $this->utilizador->findOrFail($id);

		return View::make('utilizadors.show', compact('utilizador'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$utilizador = $this->utilizador->find($id);

		if (is_null($utilizador))
		{
			return Redirect::route('utilizadors.index');
		}

		return View::make('utilizadors.edit', compact('utilizador'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Utilizador::$rules);
                var_dump($input);
		if ($validation->passes()){
			$utilizador = $this->utilizador->find($id);
			$utilizador->update($input);
			return Redirect::route('utilizadors.show', $id)
                        ->with('input' , $input);
		}
		return Redirect::route('utilizadors.edit', $id)->withInput()->withErrors($validation)->with('message', 'There were validation errors.');
	}
        /**
         * Update Technician Role
         * 
         * @param type $id
         * @return type
         */
        public function changeState(){
            $input = Input::all();
            $utilizador = $this->utilizador->find($input['id']);
            // Ir ah BD, alterar o estador e voltar aos users
            
            
            if ($utilizador->$input['op'] == 1){
                    Utilizador::where('id','=',$input['id'])->update(array($input['op']=> 0));
                            }else {
                    Utilizador::where('id','=',$input['id'])->update(array($input['op']=> 1));
            }       	
		return Redirect::route('utilizadors.index');
        }
     
  
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->utilizador->find($id)->delete();

		return Redirect::route('utilizadors.index');
	}
        

}
