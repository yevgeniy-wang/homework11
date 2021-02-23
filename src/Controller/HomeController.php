<?php


namespace Hillel\Homework11\Controller;

use Illuminate\Http\RedirectResponse;

class HomeController
{
    public function index()
    {
        return view('pages/index');
    }
}
