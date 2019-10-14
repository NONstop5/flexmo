<?php

namespace App\Controllers;


class AboutNew extends AppController
{
    public function editPageAction()
    {
        require_once VIEWS_PATH . $this->route['controller'] . '/' . $this->route['view'] . '.php';
    }
}
