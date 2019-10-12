<?php

namespace vendor\flexmo\src\core;

class Router
{
    const ACTION_ADDON_STRING = 'Action';

    /** @var array Таблица маршрутов */
    protected static $routes = [];

    /** @var array Текущий маршрут */
    protected static $currentRoute = [];

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * Возвращает таблицу маршрутов
     *
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Возвращает текуцщий маршрут
     *
     * @return array
     */
    public static function getCurrentRoute()
    {
        return self::$currentRoute;
    }

    /**
     * Перенаправляет URL по маршруту
     *
     * @param string $url
     */
    public static function dispatch($url)
    {
        if (self::matchRoute($url)) {
            $controllerClassName = 'app\Controllers\\' . self::convertToCamelCase(self::$currentRoute['controller']);

            if (class_exists($controllerClassName)) {
                $controllerObject = new $controllerClassName();
                $controllerAction = lcfirst(self::convertToCamelCase(self::$currentRoute['action']));
                $controllerAction .= self::ACTION_ADDON_STRING;

                if (method_exists($controllerObject, $controllerAction)) {
                    $controllerObject->$controllerAction();
                } else {
                    echo 'No Method!';
                }
            } else {
                echo 'NO Class!';
            }
        } else {
            echo 'NOT MATCH!';
            //self::errorPage();
        }
    }

    /**
     * Сравнивает строку URL с таблицей маршрутов
     *
     * @param string $url
     * @return bool
     */
    private static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                self::$currentRoute = $route;
                return true;
            }
        }

        return false;
    }

    /**
     * Преобразует строку запроса c дифисами в имя класса в CamelCase
     *
     * @param $className
     * @return mixed
     */
    private static function convertToCamelCase($className)
    {
        return str_replace('-', '', ucwords($className, '-'));
    }

    /**
     * Выводит страницу 404
     */
    public static function errorPage()
    {
        header('Location: ' . $_SERVER['REQUEST_URI'], true, 404);
        print('Страница не обнаружена!');
    }
}
