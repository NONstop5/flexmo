<?php


namespace App\Configs;


class AppConfig
{
    const PUBLIC_ROOT = 'PUBLIC_ROOT';
    const ROOT = 'ROOT';
    const APP_ROOT = 'APP_ROOT';
    const CONTROLLER_PATH = 'CONTROLLER_PATH';
    const MODEL_PATH = 'MODEL_PATH';
    const VIEW_PATH = 'VIEW_PATH';
    const LAYOUTS_PATH = 'LAYOUTS_PATH';
    const DEFAULT_LAYOUT_NAME = 'DEFAULT_LAYOUT_NAME';
    const DEFAULT_CONTROLLER_NAME = 'DEFAULT_CONTROLLER_NAME';
    const DEFAULT_ACTION_NAME = 'DEFAULT_ACTION_NAME';
    const DEFAULT_VIEW_NAME = 'DEFAULT_VIEW_NAME';

    const ACTION_POSTFIX = 'ACTION_POSTFIX';
    const VIEW_EXTENSION = 'VIEW_EXTENSION';

    public static function getDbConfig()
    {
        return [
            'dbDriver' => 'mysql',
            'dbHost' => 'localhost',
            'dbPort' => '3306',
            'dbName' => 'marlin-test-project-1',
            'dbUser' => 'root',
            'dbPassword' => '',
            'dbCharset' => 'utf8'
        ];
    }

    public static function getAppConfig()
    {
        $appConfig[self::PUBLIC_ROOT] = $_SERVER['DOCUMENT_ROOT'];
        $appConfig[self::ROOT] = dirname($appConfig[self::PUBLIC_ROOT]);
        $appConfig[self::APP_ROOT] = $appConfig[self::ROOT] . '/src/App/';
        $appConfig[self::CONTROLLER_PATH] = $appConfig[self::APP_ROOT] . 'Controllers/';
        $appConfig[self::MODEL_PATH] = $appConfig[self::APP_ROOT] . 'Models/';
        $appConfig[self::VIEW_PATH] = $appConfig[self::APP_ROOT] . 'Views/';
        $appConfig[self::LAYOUTS_PATH] = $appConfig[self::VIEW_PATH] . 'Layouts/';
        $appConfig[self::DEFAULT_LAYOUT_NAME] = 'defaultLayout';
        $appConfig[self::DEFAULT_CONTROLLER_NAME] = 'Main';
        $appConfig[self::DEFAULT_ACTION_NAME] = 'index';
        $appConfig[self::DEFAULT_VIEW_NAME] = 'index';
        $appConfig[self::ACTION_POSTFIX] = 'Action';

        return $appConfig;
    }
}
