<?php


namespace Flexmo;


class Utils
{
    /**
     * Преобразует строку из kebab-case в CamelCase
     *
     * @param $className
     * @return mixed
     */
    public static function convertKebabCaseToCamelCase($className)
    {
        return str_replace('-', '', ucwords($className, '-'));
    }

    /**
     * Преобразует строку из camelCase в kebab-case
     *
     * @param $camelCaseString
     * @return mixed
     */
    public static function convertCamelCaseToKebabCase($camelCaseString)
    {
        $parts = preg_split('/(?=[A-Z])/', $camelCaseString);
        $partsLowerCase = array_map(function ($part) {
            return lcfirst($part);
        }, $parts);

        return implode('-', $partsLowerCase);
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
