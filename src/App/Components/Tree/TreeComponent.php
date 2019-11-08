<?php

namespace App\Components\Tree;

use App\AppComponent;
use App\Models\TreeModel;

class TreeComponent extends AppComponent
{
    protected $treeModel;

    public function __construct(TreeModel $treeModel)
    {
        $this->treeModel = $treeModel;
    }

    public function getTemplate()
    {
        $data = $this->treeModel->getData();

        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php', [
            'treePhp' => $this->treeModel->generateTree($data),
            'treeCss' => $data
        ]);
    }
}
