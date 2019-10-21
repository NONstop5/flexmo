<?php

namespace Flexmo;

use Exception;

class Renderer
{
    /**
     * Возвращает шаблон со вставленными в него данными
     *
     * @param string $template Имя файла-шаблона страницы
     * @param array $data Данные для вставки в файл шаблона страницы
     * @return string result Возвращает контент страницы с данными
     * @throws Exception
     */
    public static function getTemplate($template, $data)
    {
        if (!file_exists($template)) {
            throw new Exception('Шаблон "' . $template . '" не найден!');
        }

        ob_start();
        extract($data);
        include_once $template;

        return ob_get_clean();
    }
}
