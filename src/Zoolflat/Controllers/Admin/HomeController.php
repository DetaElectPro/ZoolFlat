<?php

namespace Zoolflat\Zoolflat\Zoolflat\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
       return view('Zoolflat::admin.home.index');
    }
}
