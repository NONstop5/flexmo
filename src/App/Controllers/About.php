<?php

namespace App\Controllers;

use App\AppController;

class About extends AppController
{
    protected $pageTitle = 'О нас';
    protected $layoutName = 'layoutRed';

    public function run()
    {
        $this->render();
    }
}
