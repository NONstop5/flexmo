(function () {
  const $buttonGetData = $(`.button-get-data`);
  const $treeView = $(`#treeview`);

  /**
   * Создает и отрисовывает дерево по переданным данным
   * @param data
   */
  const generateTree = (data) => {
    let htmlResult = ``;
    data.forEach((dataItem) => {
      let levels = dataItem.position.split(`.`);
      let levelString = levels.reduce((result, item) => {
        return result + `-`;
      }, '');

      htmlResult += `<li>${levelString}<b>${dataItem.position}</b> - <i>${dataItem.title}</i> - <u>${dataItem.value}</u></li>\n`;
    });

    //$treeView.html(htmlResult);
    $treeView.hummingbird('addNode', {
      pos: 'after', anchor_attr: 'text', anchor_name: 'Joe Pesci',
      text: 'Ray Liotta', the_id: 'Ray', data_id: 'Ray', end_node: true
    });
    $treeView.hummingbird();
  };

  /**
   * Получает данные из БД
   */
  const getAjaxData = () => {
    $.ajax({
      method: `post`,
      url: `/tree/get-json-data`,
      dataType: `json`,
      success(response) {
        generateTree(response.data);
      },
      error() {
        throw new Error(`Ошибка при обращении к серверу!`);
      }
    });
  };

  // При нажатии накнопку получения данных из БД
  $buttonGetData.on(`click`, () => {
    //getAjaxData();

    //$treeView.hummingbird();
    console.log($treeView);
  });
})();
