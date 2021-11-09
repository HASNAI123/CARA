<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class APIController extends Controller
{

public function getusers()
{
$query=User::Select('Name','email','approved','roles');
return datatables($query)->make(true);


}


}