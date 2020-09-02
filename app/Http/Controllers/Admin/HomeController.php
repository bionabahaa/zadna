<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Configs;


class HomeController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        return $this->_view('home','index');
    }
    public function sign_in(){

    }
    public function sign_out(){
        return $this->_view('home','signin');
    }

}
