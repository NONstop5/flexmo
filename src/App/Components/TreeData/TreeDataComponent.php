<?php

namespace App\Components\TreeData;

use App\AppComponent;
use App\Models\TreeDataModel;

class TreeDataComponent extends AppComponent
{
    protected $treeDataModel;

    public function __construct(TreeDataModel $treeDataModel)
    {
        $this->treeDataModel = $treeDataModel;
    }

    public function getTemplate()
    {
        return $this->render(__DIR__ . DIRECTORY_SEPARATOR . 'template.php', [
            'treeData' => $this->treeDataModel->getStartData()
        ]);
    }
}
