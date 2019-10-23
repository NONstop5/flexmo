<?php


namespace Flexmo;


class Utils
{
    /**
     * Преобразует строку запроса c дифисами в имя класса в CamelCase
     *
     * @param $className
     * @return mixed
     */
    public static function convertToCamelCase($className)
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
