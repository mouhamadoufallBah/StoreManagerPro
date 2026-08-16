<?php

namespace StoreManagerPro\Src\controller;

use StoreManagerPro\Src\Core\View;

class DashboardController
{

    public function index()
    {

        View::render('dashboard/index', []);
    }
}
