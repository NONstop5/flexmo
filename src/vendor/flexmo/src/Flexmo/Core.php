<?php


namespace Flexmo;


use Tracy\Debugger;

class Core
{
    protected $appConfig;

    public function __construct($appConfig = [])
    {
        $this->appConfig = $appConfig;

        $this->initDebugger();
        $this->initRouter();
    }

    private function initDebugger()
    {
        Debugger::enable();
    }

    private function initRouter()
    {
        $router = new Router();
        $router->dispatch();
    }
}
