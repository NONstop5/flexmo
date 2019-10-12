<?php

namespace app\Controllers;

class About
{
    public function __construct()
    {
        echo __CLASS__ . '<br>';
    }

    public function indexAction()
    {
        echo __FUNCTION__ . '<br>';
    }
}
