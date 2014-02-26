<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoiceLineController
 *
 * @author trocha
 */
class InvoiceLinesController extends BaseController {

    /**
     * Contract Repository
     *
     * @var Contract
     */
    protected $contentline;

    public function __construct(InvoiceLine $contentline) {
        $this->contentline = $contentline;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $input = Input::all();
        $invoice = Invoice::find($input['id']);

        if (is_null($invoice)) {
            return Redirect::route('invoices.index');
        }
        $contentlines = $invoice->InvoiceLines()->get();
        return View::make('invoiceslines.index', compact('contentlines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $line = $this->contentline->find($id);

        if (is_null($line)) {
            return Redirect::route('invoiceslines.index');
        }
        return View::make('invoiceslines.edit', compact('line'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $input = array_except(Input::all(), '_method');

        $validation = Validator::make($input, InvoiceLine::$rules);

        if ($validation->passes()) {
            $line = $this->contentline->find($id);
            $line->update($input);
            invoiceHelper::updateTotals();
            $invoice = Invoice::find($input['invoice_id']);
            $contentlines = $invoice->InvoiceLines()->get();
        return View::make('invoiceslines.index', compact('contentlines'));
        }

        return Redirect::route('invoiceslines.edit', $id)
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
        $this->contentline->find($id)->forceDelete();

        return Redirect::route('contracts.index');
    }

}
