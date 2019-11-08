<?php

namespace App\Components\TreeData\Api;

use App\AppComponent;
use App\Models\TreeModel;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class TreeDataApiComponent extends AppComponent
{
    protected $treeModel;
    protected $request;

    public function __construct(
        TreeModel $treeModel,
        Request $request
    ) {
        $this->treeModel = $treeModel;
        $this->request = $request;
    }

    public function run()
    {
        $response = [];
        $saveType = $this->request->request->get('saveType');

        if (!$saveType) {
            throw new Exception('Параметр не передан!');
        }

        if ($saveType === 'original') {
            $result = $this->treeModel->saveData();
        } else {
            $result = $this->treeModel->saveDataAsJson();
        }

        $response['result'] = $result;

        return json_encode($response);
    }
}
