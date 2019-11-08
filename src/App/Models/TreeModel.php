<?php

namespace App\Models;

use Exception;
use Flexmo\Database;

class TreeModel
{
    protected $treeDataModel;
    protected $database;

    public function __construct(
        TreeDataModel $treeDataModel,
        Database $database
    ) {
        $this->treeDataModel = $treeDataModel;
        $this->database = $database;
        $this->database->makePdo();
    }

    /**
     * Сортирует многомерный массив
     *
     * @param $data
     * @return array
     */
    private function sortData($data)
    {
        array_multisort($data);

        return $data;
    }

    /**
     * Очищаем таблицу от данных
     */
    private function clearTable()
    {
        $this->database->pdo->query('DELETE FROM tree');
    }

    /**
     * Сохраняет начальный массив с данными в БД
     * TODO Транзакцию добавил для скорости, поле "level" - чтобы потом при выводе не вычислять его, т.к. выводов может быть много
     *
     * @return string
     */
    public function saveData()
    {
        $this->clearTable();

        $sortedData = $this->sortData($this->treeDataModel->getStartData());
        $result = true;

        try {
            $this->database->pdo->beginTransaction();

            foreach ($sortedData as $item) {
                $sql = "INSERT INTO `tree` (
                  `position`, `title`, `value`, `level`
                ) VALUES (
                  :position, :title, :value, :level
                )";

                $params = [
                    'position' => $item['position'],
                    'title' => $item['title'],
                    'value' => $item['value'],
                    'level' => count(explode('.', $item['position'])) - 1
                ];

                $stmt = $this->database->pdo->prepare($sql);
                $result = $result && $stmt->execute($params);
            }

            $this->database->pdo->commit();
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
            $this->database->pdo->rollBack();
            $result = false;
        }

        return $result ? 'success' : 'error';
    }

    /**
     * Сохраняет начальный массив с данными в БД как JSON
     *
     * @return string
     */
    public function saveDataAsJson()
    {
        $sql = "UPDATE `tree_json`
                SET `tree_data` = :jsonData
                WHERE `id` = 1";
        $params = [
            'jsonData' => json_encode($this->sortData($this->treeDataModel->getStartData()))
        ];
        $stmt = $this->database->pdo->prepare($sql);

        return $stmt->execute($params) ? 'success' : 'error';
    }

    /**
     * Получает данные из БД из полей
     *
     * @return array
     */
    public function getData()
    {
        $sql = "SELECT `position`, `title`, `value`, `level`
                FROM `tree`";

        return $this->database->pdo->query($sql)->fetchAll();
    }

    /**
     * Возвращает тэги открытия списка для уровня дерева
     *
     * @param $value
     * @return string
     */
    private function getListOpenHtml($value)
    {
        return '<ul><li>' . $value;
    }

    /**
     * Возвращает тэги закрытия списка для одного или нескольких уровней дерева
     *
     * @param $count
     * @return string
     */
    private function getListCloseHtml($count)
    {
        $result = '';

        for ($i = 1; $i <= $count; $i++) {
            $result .= '</li></ul>';
        }

        return $result;
    }

    /**
     * Создает и возвращает html - дерево
     * TODO Можно было сделать по другому, с рекурсией, но для этого надо было бы создавать в БД поле parent_id, заполнять его и т.д.
     *
     * @param array $data
     * @return string
     */
    public function generateTree($data)
    {
        $resultHtml = '';
        $prevLevel = -1;

        foreach ($data as $item) {
            $currentLevel = $item['level'];
            $diffLevels = $currentLevel - $prevLevel;
            $itemValue = "<b>{$item['position']}</b> - <i>{$item['title']}</i> - <u>{$item['value']}</u>";

            if ($diffLevels > 0) {
                $resultHtml .= $this->getListOpenHtml($itemValue);
            } else {
                $resultHtml .= $this->getListCloseHtml(abs($diffLevels) + 1);
                $resultHtml .= $this->getListOpenHtml($itemValue);
            }

            $prevLevel = $currentLevel;
        }

        return $resultHtml;
    }

    /**
     * Получает данные из БД как JSON
     *
     * @return array
     */
    public function getDataJson()
    {
        $sql = "SELECT `tree_data`
                FROM `tree_json`";

        return json_decode($this->database->pdo->query($sql)->fetch()['tree_data']);
    }
}
