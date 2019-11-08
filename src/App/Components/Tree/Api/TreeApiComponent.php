<?php

namespace App\Components\Tree\Api;

use App\AppComponent;
use App\Models\TreeModel;

class TreeApiComponent extends AppComponent
{
    protected $treeModel;

    public function __construct(
        TreeModel $treeModel
    ) {
        $this->treeModel = $treeModel;
    }

    public function run()
    {
        return json_encode(['data' => $this->treeModel->getDataJson()]);
    }
}
