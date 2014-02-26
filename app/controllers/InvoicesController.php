<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoicesController
 *
 * @author trocha
 */
class InvoicesController extends BaseController {

    /**
     * Invoice Repository
     *
     * @var invoice
     */
    protected $invoice;
    protected $invoicecontentline;

    public function __construct(Invoice $invoice, InvoiceLine $invoicecontentline) {
        $this->invoice = $invoice;
        $this->invoicecontentline = $invoicecontentline;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (!Session::get('admin')) {
            return Redirect::to('login');
        } else {
            $invoices = Invoice::where('state', 'created')->orwhere('state', 'archived')->get();
            return View::make('invoices.index', compact('invoices'));
        }
    }

    /**
     * 
     * @return string
     */
    public function structureNumber() {
        $time = time();
        $first_number = date("s", $time) . date("w", $time);
        $second_number = date("m", $time) . date("y", $time);
        //Create a random 3digits number
        $third_number = str_pad(rand(0, pow(10, 3) - 1), 3, '0', STR_PAD_LEFT);
        //Concact the 3 numbers and cast it to INT
        $number = $first_number . $second_number . $third_number;
        //Concact numbers with '+++' and '/'
        $structured_number = '+++' . $first_number . '/' . $second_number . '/' . $third_number . $this->modulo($number) . '+++';
        //Check if the structured number dont exist
        $invoices = Invoice::withtrashed()->get();
        
        foreach ($invoices as $invoice) {
            if ($structured_number == $invoice['structure'])
                $this->structure_number();
        }
        return $structured_number;
    }

    public function srsearch() {
        // Check if input is coming with valluable info (has to be checked on view :clientside)
        if (!Input::all()) {
            return View::make('invoices.index');
        } else {
            // Retrieving data to create invoices
            $input = Input::all();
            $servicereports = Servicereport::where('state', '=', 'validated')->whereBetween('start', array($input['start'] . ' 00:01:00', $input['end'] . ' 23:59:00'))->get();

            $companies = Company::all();
            // Cycle all companies                    
            foreach ($companies as $company) {
                $new_invoice = new Invoice;
                $new_invoice->start = $input['start'];
                $new_invoice->end = $input['end'];
                $new_invoice->date = date('Y-m-d', time());
                $new_invoice->due_date = date('Y-m-d', strtotime(Carbon::today() . ' + ' . $company['due_days'] . ' days'));
                $new_invoice->structure = $this->structureNumber();
                $new_invoice->tva = $company['tva_rate'];
                $new_invoice->company_id = $company['id'];
                $new_invoice->state = 'created';
                $new_invoice->save();

                // Vars to save number of hours
                $it_assist = null;
                $regie = null;
                $project = null;
                $external = null;
                // Cycle service reports
                foreach ($servicereports as $servicereport) {

                    if ($servicereport['company_id'] == $company['id']) {

                        $type = Contract::find($servicereport['contract_id'])->type;

                        // Check Contract Type of service report and add respective number of hours
                        switch ($type) {
                            case 'it assist':
                                $it_assist += $servicereport['duration'];
                                break;
                            case 'regie':
                                $regie += $servicereport['duration'];
                                $regiepricehour = Contract::find($servicereport['contract_id'])->hourprice;
                                break;
                            case 'project':
                                $project += $servicereport['duration'];
                                break;
                        }

                        // Check if service is external
                        // If it is create new invoice_component_line only with the travel expense
                        if ($servicereport['internal'] == '0') {
                            ++$external;
                            $new_invoiceline = new InvoiceLine;
                            $new_invoiceline->code = 'external';
                            $new_invoiceline->description = 'Frais de déplacement du ' . date("d-m-Y", strtotime($servicereport['start'])) . ' / ID ' . $servicereport['id'];
                            $new_invoiceline->quantity = 1;
                            $new_invoiceline->price_unit = Contract::find($servicereport['contract_id'])->travelprice;
                            $new_invoiceline->invoice_id = $new_invoice['id'];
                            $new_invoiceline->save();
                        }
                    }
                    $servicereport->delete();
                }
                if ($it_assist != null) {
                    $new_invoiceline = new InvoiceLine;
                    $new_invoiceline->code = 'it assist';
                    $new_invoiceline->description = 'IT Consultance details en annexe ';
                    $duration = $it_assist / 60;
                    $duration = number_format($duration, 2);
                    $new_invoiceline->quantity = $duration;
                    $new_invoiceline->price_unit = 0;
                    $new_invoiceline->invoice_id = $new_invoice->id;
                    $new_invoiceline->save();
                }
                if ($project != null) {
                    $new_invoiceline = new InvoiceLine;
                    $new_invoiceline->code = 'project';
                    $new_invoiceline->description = 'Project details en annexe ';
                    $duration = $project / 60;
                    $duration = number_format($duration, 2);
                    $new_invoiceline->quantity = $duration;
                    $new_invoiceline->price_unit = 0;
                    $new_invoiceline->invoice_id = $new_invoice->id;
                    $new_invoiceline->save();
                }
                if ($regie != null) {
                    $new_invoiceline = new InvoiceLine;
                    $new_invoiceline->code = 'regie';
                    $new_invoiceline->description = 'Regie details en annexe';
                    $duration = $regie / 60;
                    $duration = number_format($duration, 2);
                    $new_invoiceline->quantity = $duration;
                    $new_invoiceline->price_unit = $regiepricehour;
                    $new_invoiceline->invoice_id = $new_invoice->id;
                    $new_invoiceline->save();
                }
            }
            $this->deleteEmpty();
            $invoices = Invoice::where('state', 'created')->orwhere('state', 'archived')->get();

            return View::make('invoices.index', compact('invoices'));
        }
    }

    public function deleteEmpty() {
        $invoices = Invoice::where('state', '=', 'created')->get();
        foreach ($invoices as $invoice) {
            $lines = InvoiceLine::where('invoice_id', '=', $invoice['id'])->get();

            if ($lines->count() === 0) {
                $this->destroy($invoice->id);
            }
        }
        invoiceHelper::updateTotals();
    }



    public function modulo($number) {
        $div = intval($number / 97);
        $times = $div * 97;
        $final = $number - $times;
        if (strlen($final) < 2) {
            return $final = '0' . $final;
        }
        return $final;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $input = Input::all();
        $validation = Validator::make($input, Invoice::$rules);
        if ($validation->passes()) {
            $this->invoice->create($input);
            return Redirect::route('invoices.index');
        } else {
            return Redirect::route('invoices.create')
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
        $invoice = Invoice::find($id);
        $html = $this->invoiceToPdf($invoice);
        return PDF::load($html, 'A4', 'portrait')->show();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function previewList() {

        $input = Input::all();
        $invoice = Invoice::find($input['id']);
        $servicereports = Servicereport::onlyTrashed()->where('company_id', $invoice->company_id)->whereBetween('start', array($invoice['start'] . ' 00:00:00', $invoice['end'] . ' 23:59:00'))->orderBy('start', 'asc')->get();
        $invoiced_minutes = Servicereport::onlyTrashed()->where('company_id', $invoice->company_id)->where('free', '0')->whereBetween('start', array($invoice['start'] . ' 00:00:00', $invoice['end'] . ' 23:59:00'))->sum('duration');
        $free_minutes = Servicereport::onlyTrashed()->where('company_id', $invoice->company_id)->where('free', '1')->whereBetween('start', array($invoice['start'] . ' 00:00:00', $invoice['end'] . ' 23:59:00'))->sum('duration');
        $free_minutes = ($free_minutes != 0) ? 'Free: ' . timeHelper::toHoursMinutes($free_minutes) .' - ' : '';
        $prestations = $this->getPrestations($servicereports);

        $header = '<!DOCTYPE html>
            <html dir="ltr" lang="en" class="js">
            <head><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <body>
            <div id="liste" style="position:relative;">
            <table style="border-style: dashed; border-width:1px; border-color: #999999; color:#999999; font-size:9px;  width:100%;"> 
				<tr>
					<td>
					<img src="C:\wamp\www\access_level\public\images\mini-logo.png">
					</td>
					<td class="header-text">UNS SCRL | Adresse : Rue du serment, 37 1070 Bruxelles. | Numéro de TVA : BE:0895317522<br />
							Téléphone : +32 (0)2 880 70 40 | Fax : +32 (0)2 880 70 49 | Site Web : http://www.uns.be</td>
                                        <td><p style="font-style:bold; font-size:12px; color:#000000;">' . Company::find($invoice->company_id)->name . '</p></td>                
				  </tr>
			</table>
                        <center><p style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;"><u>Liste des prestations</u></p></center>
                        
                        <br/>
                        <div style="background-color:#e3e3e3; border: 1px solid black;font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
        <center><strong>Liste des prestations entre le ' . date("d-m-Y", strtotime($invoice->start)) . ' et le ' . date("d-m-Y", strtotime($invoice->end)) . '</strong></center>
                </div>
                <br/><br/>
		<table style="width:100%;align:center; border:0; cellspacing;0; cellpadding:0; border-collapse: collapse;">
		  <tr style="padding-bottom:1em;font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
		    <td style="width:7%; align:center;border-bottom:0.5pt solid black;"><u>ID</u></td>
		    <td style="width:14%;border-bottom:0.5pt solid black;"><u>Date</u></td>
		    <td style="width:47%;border-bottom:0.5pt solid black;"><u>Subject</u></td>
		    <td style="width:10%;border-bottom:0.5pt solid black;"><u>H.Début</u></td>
		    <td style="width:10%;border-bottom:0.5pt solid black;"><u>H.Fin</u></td>
		    <td style="width:12%;border-bottom:0.5pt solid black;"><u>Temps</u></td>';

        $footer = '</table>
                <div style="position:absolute; bottom:0; width:100%;border:0.5px solid black; text-align:right; padding-right:30px;font-family: Arial, Helvetica, sans-serif; font-size: 14px;color: #333333;">
                '. $free_minutes .' <b> Temps Total Invoiced: ' . timeHelper::toHoursMinutes($invoiced_minutes) .'</b>
                </div>
                </div>
                </body></html>';
        $html = $header . $prestations . $footer;
        return PDF::load($html, 'A4', 'portrait')->show();
    }

    public function getPrestations($servicereports) {

        $prestations = null;
        foreach ($servicereports as $servicereport) {
            $external = ($servicereport->internal) ? '' : '***External';
            $free = ($servicereport->free) ? ' ***FREE'  : '';
            $duration = ($servicereport->free) ? '<strike>' .timeHelper::toHoursMinutes($servicereport->duration).'</strike>'  : timeHelper::toHoursMinutes($servicereport->duration);
            $backgroundcolor = ($servicereport->free) ? "background-color: #eaeaea;": "";
                    
	
            $prestations = $prestations . ' <tr style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;color: #333333;">
                                <td style="vertical-align:top; border-bottom:0.5pt solid black;'.$backgroundcolor.'"><b>' . $servicereport->id . '</b>'. $free .' '. $external .'</td>
                                <td style="vertical-align:top;border-bottom:0.5pt solid black;'.$backgroundcolor.'">' . date("d-m-Y", strtotime($servicereport->start)) . '</td>
                                <td style="border-bottom:0.5pt solid black;'.$backgroundcolor.'">
                                    <i><b>  '.  Utilizador::find($servicereport->utilizador_id)->name .'</b></i> - <u>' . $servicereport->subject . '</u><br/> 
                                    <p style="font-size:10px;">' . $servicereport->comment . '
                                 </td>
                                <td style="vertical-align:top;border-bottom:0.5pt solid black;'.$backgroundcolor.'">' . date("G:i", strtotime($servicereport->start)) . '</td>
                                <td style="vertical-align:top;border-bottom:0.5pt solid black;'.$backgroundcolor.'">' . date("G:i", strtotime($servicereport->end)) . '</td>
                                <td style="vertical-align:top;border-bottom:0.5pt solid black;'.$backgroundcolor.'">' . $duration. '</td>
                              </tr>';
        }
        return $prestations;
    }



    public function invoiceToPdf(Invoice $invoice) {
        $lines = $invoice->InvoiceLines()->get();
        $rate = ($invoice->tva * $invoice->total) / 100;
        $final_total = $invoice->total + $rate;
        $company = Company::find($invoice->company_id);
        $items = $this->getLines($lines);
        $header = '<!DOCTYPE html>
            <html dir="ltr" lang="en" class="js">
            <head><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Preview Invoice</title>
            </head>
            <body>
            <div id="invoice" style="position:relative;">
                       <div id="header">
                    <img src="C:\wamp\www\access_level\public\images\inv_logo.gif">
                <div id="addresses" style = "float: left; width: 100%; margin-top : 0.5cm;">
                    <table  width="100%" >
                       <tr>
                          <td style="background-color: #f5f5f5; font-size: 10pt;padding:10px; font-family:Arial;">
                            $uns->name<br/>
                            TVA . $uns->tva  <br/>
                            $uns->address
                          </td>
                          <td style="background-color: #FFFFFF"></td>      
                          <td style="background-color: #f5f5f5; font-size: 10pt;padding:10px; font-family:Arial;">';
        if ($company->address1 != null) {
            $header = $header . $company->name . '<br/>'
                    . $company->address1 . '<br/>'
                    . $company->address . '<br/>'
                    . $company->zip_code . ' ' . $company->city . '-' . $company->country . '<br/>
                            </td>';
        } else {
            $header = $header . $company->name . '<br/>'
                    . $company->address . '<br/>'
                    . $company->zip_code . ' ' . $company->city . ' - ' . $company->country . '<br/>
                            </td>';
        }
        
       $header = $header . '</tr></table></div></div>
            <div id="content" style="float:left; width:100%; margin-bottom: 0.4cm; margin-top: 0.4cm;">
                <div class="datagrid1">
                    <table style="width: 100%">
                    <thead>
                        <tr>
                            <th style="background-color:#295a8c;">Invoice</th>
                            <th style="background-color:#295a8c; text-align:left;">N° TVA</th>
                            <th style="background-color:#295a8c;">Date</th>
                            <th style="background-color:#295a8c;">Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color:#f5f5f5;">
                            <td align="center">' . $invoice->id . '</td>
                            <td>' . $company->vat_number . '</td>
                            <td align="center">' . date("d-m-Y", strtotime($invoice->date)) . '</td>
                            <td align="center">' . date("d-m-Y", strtotime($invoice->due_date)) . '</td>
                        </tr>
                </table>
                </div>
                </div>
            <div class="invoice-items" style="float: left; width:100%">
                <div class="datagrid">
                    <table>
                        <thead>
                        <tr style="background-color:#5A298C;">
                            <th>Code</th>
                            <th align="left">Description</th>
                            <th>Qté</th>
                            <th>P. unit</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>';
        $footer = '</tbody>
                    </table>
                </div>
            </div>
            <div id="" style="position:absolute; bottom:0;">
            <table  width="100%" >
                       <tr>
                          <td style="background-color: #f5f5f5; width:74%;">
                            <p style="font-size: 10pt;">Les Conditions Générales de Vente sont disponibles à adresse www.uns.be/cgv.pdf. Le paiement de cette facture se fait avant écheance sur le compte<br>IBAN: BE75 3630 6100 2351, 
                        BIC : BBRUBEBB, banque ING, en mentionnant <br>LA COMMUNICATION STRUCTUREE SUIVANTE : <b>' . $invoice->structure . '</b></p>
                          </td>
                          <td style="background-color: #FFFFFF"></td>
                          <td style="background-color: #CCCCCC; width:35%;">
                           <div class="datagrid" style="float: right;">
                    <table>
                            <tbody>
                                <tr>
                                    <th>Total HTVA:</th>
                                    <td>' . invoiceHelper::money_format('%!n',round($invoice->total, 2)) . '</td>
                                </tr>
                                <tr>
                                    <th>TVA(' . $invoice->tva . '%):</th>
                                    <td>' . invoiceHelper::money_format('%!n',round($rate, 2)) . '</td>
                                </tr>
                                <tr>
                                    <th>A PAYER:</th>
                                    <td>' . invoiceHelper::money_format('%!n', round($final_total, 2))  . '</td>
                                </tr>
                            </tbody>
                        </table>
                      </div>
                          </td>
                         </tr>                        
                      </table>
                    <p style="font-size: 7pt; align:justify;"> Le défault de paiement aux conditions spécifiées dans cette facture entraine plein droit, et sans mise en demeure, une majoration pour INTERETS de RETARD calculés par mois entiers prenan cours dés la fin du mois de la date de facture et au taux 12% l\'an calculé a partir de son échéeance. 
                    En plus, en cas de retard prolongé une INDEMNITE de 15% du total; de la FACTURE, avec un MINIMUM de 150 euros sera due 30 jours aprés l\'envoi, au débiteur, d\'une mise en demeure de payer la, ou TOUTES les, somme(s) restant due(s).
                    Tribunal compétent : Bruxelles
                </p>
                </div>
        <div id="header1" style="page-break-before:always;">
                    <img src="C:\wamp\www\access_level\public\images\inv_logo.gif">
                    </div></div></body></html>
        
<style type="text/css">
    .datagrid table { border-collapse: collapse; text-align: center; width: 100%; }
    .datagrid {font: normal 10px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 0px solid #006699; -webkit-border-radius: 7px; -moz-border-radius: 7px; border-radius: 7px; }.datagrid table td,.datagrid table th { padding: 7px 4px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5A298C), color-stop(1, #5A298C) );background:-moz-linear-gradient( center top, #5A298C 5%, #5A298C 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#5A298C", endColorstr="#5A298C");background-color:#325C8E; color:#FFFFFF; font-size: 12px; font-weight: bold; border-left: none; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #000001; border-left: none;font-size: 10px;font-weight: normal; }.datagrid table tbody .alt td { background: #f5f5f5; color: #000001; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEf4;} .datagrid table tfoot td { padding: 0; font-size: 11px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#006699", endColorstr="#00557F");background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #00557F; color: #FFFFFF; background: none; background-color:#006699;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
</style>
<style type="text/css">
        .datagrid1 table {border-collapse: collapse;text-align: left;width: 100%; } 
        .datagrid1 {font: normal 10px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 0px solid #075BB0; -webkit-border-radius: 0px; -moz-border-radius: 0px; border-radius: 0px; }.datagrid1 table td, .datagrid1 table th { padding: 2px 10px; }.datagrid1 table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5A298C), color-stop(1, #5A298C) );background:-moz-linear-gradient( center top, #006091 5%, #008ED4 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#006091", endColorstr="#008ED4");background-color:#006091; color:#FFFFFF; font-size: 12px; font-weight: bold; border-left: 2px solid #f5f5f5; } .datagrid1 table thead th:first-child { border: none; }.datagrid1 table tbody td { color: #00496B; border-left: 0px solid #000000;font-size: 12px;font-weight: normal; }.datagrid1 table tbody .alt td { background: #f5f5f5; color: #00496B; }.datagrid1 table tbody td:first-child { border-left: none; }.datagrid1 table tbody tr:last-child td { border-bottom: none; }
</style>';
        return $header . $items . $footer;
    }
    
/*
 * Function to get the lines of the invoice
 */
    public function getLines($lines) {
        $items = '';
        $cor = false;
        foreach ($lines as $line) {

            if ($cor) {
                $items = $items . '<tr class="alt">
                            <td style="width:5%">' . $line->code . '</td>
                            <td align="left" style="width:70%; padding-left:10px;">' . $line->description . '</td>
                            <td style="width:3%">' . round($line->quantity, 2) . '</td>
                            <td align="right" style="width:7%">' . invoiceHelper::money_format('%!n',$line->price_unit) . '  </td>
                            <td align="right" style="width:15%; padding-right:10px">' . invoiceHelper::money_format('%!n',round(($line->quantity * $line->price_unit), 2)) . '</td>
                        </tr>';
                $cor = false;
            } else {
                $items = $items . '<tr>
                            <td style="width:5%">' . $line->code . '</td>
                            <td align="left" style="width:70%; padding-left:10px;">' . $line->description . '</td>
                            <td style="width:3%">' . round($line->quantity, 2) . '</td>
                            <td align="right" style="width:7%">' . invoiceHelper::money_format('%!n',$line->price_unit) . '  </td>
                            <td align="right" style="width:15%; padding-right:10px">' . invoiceHelper::money_format('%!n',round(($line->quantity * $line->price_unit), 2)) . '</td>
                        </tr>';
                $cor = true;
            }
        }
        return $items;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Responses
     */
    public function edit($id) {
        $invoice = $this->invoice->find($id);

        if (is_null($invoice)) {
            return Redirect::route('invoices.index');
        }
        $contentlines = $invoice->InvoiceLines()->get();
        return View::make('invoices.edit', compact('contentlines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Invoice::$rules);

        if ($validation->passes()) {
            $invoice = $this->invoice->find($id);
            $invoice->update($input);

            return Redirect::route('invoices.show', $id);
        }

        return Redirect::route('invoices.index', $id)
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
        $invoice = Invoice::find($id);
        $invoice->InvoiceLines()->forceDelete();
        $servicereports = Servicereport::withTrashed()->where('company_id', $invoice->company_id)->whereBetween('start', array($invoice['start'] . ' 00:01:00', $invoice['end'] . ' 23:59:00'))->get();

        foreach ($servicereports as $servicereport) {
            $servicereport->restore();
        }
        $invoice->forceDelete();

        return Redirect::route('invoices.index');
    }

}
