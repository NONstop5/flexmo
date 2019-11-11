// TODO Тут специально использован синтаксис ES6
(function () {
  const $buttonGetData = $(`.button-get-data`);
  const $tree = $(`#tree`);

  /**
   * Создает и отрисовывает дерево по переданным данным
   * @param data
   */
  const generateTree = (data) => {
    $tree.html(data.reduce((result, dataItem) => {
      return result + `
        <li data-tree-branch="${dataItem.position}">
            <span data-tree-click="${dataItem.position}">${dataItem.position} - ${dataItem.title} - ${dataItem.value}</span>
        </li>
      `;
    }, ''));
  };

  /**
   * Получает данные из БД
   */
  const getAjaxData = () => {
    $.ajax({
      method: `get`,
      url: `/tree/get-json-data`,
      dataType: `json`,
      success(response) {
        generateTree(response.data);
        $buttonGetData.prop('disabled', true);
        $tree.dataTree();
      },
      error() {
        throw new Error(`Ошибка при обращении к серверу!`);
      }
    });
  };

  // При нажатии накнопку получения данных из БД
  $buttonGetData.on(`click`, () => {
    getAjaxData();
  });
})();
