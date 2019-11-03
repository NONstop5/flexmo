<?php

namespace App\Configs;

class AppConfig
{
    const PUBLIC_ROOT = 'PUBLIC_ROOT';
    const ROOT = 'ROOT';
    const APP_ROOT = 'APP_ROOT';
    const CONTROLLER_PATH = 'CONTROLLER_PATH';
    const MODEL_PATH = 'MODEL_PATH';
    const DEFAULT_CONTROLLER_NAME = 'DEFAULT_CONTROLLER_NAME';
    const DEFAULT_ACTION_NAME = 'DEFAULT_ACTION_NAME';
    const ACTION_POSTFIX = 'ACTION_POSTFIX';

    /**
     * Возвращает конфигурацию подключения к БД
     *
     * @return array
     */
    public function getDbConfig()
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

    /**
     * Возвращает конфигурацию приложения
     *
     * @return array
     */
    public function getAppConfig()
    {
        $appConfig[self::PUBLIC_ROOT] = $_SERVER['DOCUMENT_ROOT'];
        $appConfig[self::ROOT] = dirname($appConfig[self::PUBLIC_ROOT]);
        $appConfig[self::APP_ROOT] = $appConfig[self::ROOT] . '/src/App/';
        $appConfig[self::CONTROLLER_PATH] = $appConfig[self::APP_ROOT] . 'Controllers/';
        $appConfig[self::MODEL_PATH] = $appConfig[self::APP_ROOT] . 'Models/';
        $appConfig[self::DEFAULT_CONTROLLER_NAME] = 'Main';
        $appConfig[self::DEFAULT_ACTION_NAME] = 'index';
        $appConfig[self::ACTION_POSTFIX] = 'Action';

        return $appConfig;
    }
}
