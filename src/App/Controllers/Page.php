<?php

namespace App\Controllers;

use Flexmo\Abstracts\Controller;

class Page extends Controller
{
    public function viewAction()
    {
        echo __CLASS__ . '<br>';
        echo __FUNCTION__ . '<br>';
    }
}
