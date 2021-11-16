<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

	public $view_page_url;

	public function __construct()
	{
		$this->view_page_url = 'Backend.';
	}

    public function dashboard()
    {
    	return view($this->view_page_url.'index');
    }

    public function addUser()
    {
    	echo 'string';
    }
}
