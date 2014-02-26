<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiSearchController
 *
 * @author trocha
 */
class ApiSearchController extends BaseController{

public function appendValue($data, $type, $element)
{
    // operate on the item passed by reference, adding the element and type
    foreach ($data as $key => & $item) {
    $item[$element] = $type;
    }
    return $data;
}

public function appendURL($data, $prefix)
{
    // operate on the item passed by reference, adding the url based on slug
    foreach ($data as $key => & $item) {
    $item['url'] = url($prefix.'/'.$item['id']);
    }
    return $data;
}

public function index()
{
$query = e(Input::get('q', ''));

if(!$query && $query == '') return Response::json(array(), 400);

    $clients = Client::withTrashed()->where('name', 'like', '%'.$query.'%')
                ->orderBy('name', 'asc')
                ->take(5)
                ->get(array('id', 'name'))->toArray();

    $companies = Company::where('name', 'like', '%'.$query.'%')
                ->has('clients')
                ->take(5)
                ->get(array('id', 'name'))
                ->toArray();
    
    $techs = Utilizador::where('name', 'like', '%'.$query.'%')
            ->orderBy('name', 'asc')
            ->take(5)
            ->get(array('id', 'name'))
            ->toArray();

    // Data normalization
    $techs = $this->appendValue($techs, url('assets/img/icons/tech.png'), 'icon');
    $clients = $this->appendValue($clients, url('assets/img/icons/admin.png'), 'icon');
    $companies = $this->appendValue($companies, url('assets/img/icons/company.png'), 'icon');

    $techs = $this->appendURL($techs, 'utilizadors');
    $clients = $this->appendURL($clients, 'clients');
    $companies = $this->appendURL($companies, 'companies');

    // Add type of data to each item of each set of results
    $techs = $this->appendValue($techs, 'utilizador', 'class');
    $clients = $this->appendValue($clients, 'client', 'class');
    $companies = $this->appendValue($companies, 'company', 'class');

    // Merge all data into one array
    $data = array_merge($clients,$companies);

    return Response::json(array(
    'data' => $data
));
}
public function getclients()
{
$query = e(Input::get('q', ''));

if(!$query && $query == '') return Response::json(array(), 400);

    $clients = Client::withTrashed()->where('name', 'like', '%'.$query.'%')
                ->orderBy('name', 'asc')
                ->take(5)
                ->get(array('id', 'name'))->toArray();

    $companies = Company::where('name', 'like', '%'.$query.'%')
                ->has('clients')
                ->take(5)
                ->get(array('id', 'name'))
                ->toArray();
    
    $techs = Utilizador::where('name', 'like', '%'.$query.'%')
            ->orderBy('name', 'asc')
            ->take(5)
            ->get(array('id', 'name'))
            ->toArray();

    // Data normalization
    $techs = $this->appendValue($techs, url('assets/img/icons/tech.png'), 'icon');
    $clients = $this->appendValue($clients, url('assets/img/icons/admin.png'), 'icon');
    $companies = $this->appendValue($companies, url('assets/img/icons/company.png'), 'icon');

    $techs = $this->appendURL($techs, 'utilizadors');
    $clients = $this->appendURL($clients, 'clients');
    $companies = $this->appendURL($companies, 'companies');

    // Add type of data to each item of each set of results
    $techs = $this->appendValue($techs, 'utilizador', 'class');
    $clients = $this->appendValue($clients, 'client', 'class');
    $companies = $this->appendValue($companies, 'company', 'class');

    // Merge all data into one array
    $data = array_merge($clients,$companies);

    return Response::json(array(
    'data' => $data
));
}
}

