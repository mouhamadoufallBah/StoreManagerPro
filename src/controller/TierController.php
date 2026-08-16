<?php

namespace StoreManagerPro\Src\controller;

use StoreManagerPro\Src\Core\View;

class TierController
{

    public function index()
    {

        View::render('tiers/index', []);
    }
}
