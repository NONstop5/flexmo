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
    const DEFAULT_LAYOUT_NAME = 'LAYOUTS_PATH';
    const ACTION_POSTFIX = 'ACTION_POSTFIX';

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
        return [
//            self::PUBLIC_ROOT => $_SERVER['DOCUMENT_ROOT'],
//            self::ROOT => dirname(PUBLIC_ROOT)),
//            self::APP_ROOT => ROOT . '/src/App/',
//            self::CONTROLLER_PATH => ,
//            self::MODEL_PATH => ,
//            self::VIEW_PATH => ,
//            self::LAYOUTS_PATH => ,
//            self::DEFAULT_LAYOUT_NAME => ,
//            self::ACTION_POSTFIX =>
        ];
    }
}
