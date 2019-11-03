<?php

namespace Flexmo\Abstracts;

use Exception;
use Flexmo\Renderer;

abstract class Component
{
    /**
     * Возвращает шаблон template со вставленными в него данными
     *
     * @param string $template
     * @param array $data
     * @return string
     * @throws Exception
     */
    protected function render(string $template, array $data = [])
    {
        return Renderer::getTemplate($template, $data);
    }
}
