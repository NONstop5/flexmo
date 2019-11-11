// TODO Тут специально использован синтаксис ES5
(function () {
  var $butonDbSave = $('.button-db-save');
  var $butonDbSaveJson = $('.button-db-save_json');

  /**
   * Показывает прелоадер в кнопке
   */
  var showPreloader = function ($buttonElem) {
    $buttonElem.prop('disabled', true);
    $buttonElem.html(
      `<span class="spinner-border spinner-border-sm"></span>
        Загрузка...`
    );
  };

  /**
   * Устанавливает стиль кнопки загрузки
   * @param status
   * @param $buttonElem
   */
  var setButtonStyle = function (status, $buttonElem) {
    if (status === 'success') {
      $buttonElem.html('Сохранено в БД!');
      $buttonElem.removeClass('btn-danger').addClass('btn-success');
    } else {
      $buttonElem.removeClass('btn-success').addClass('btn-danger');
      $buttonElem.html('Ошибка!');
    }
  };

  /**
   * Отправляет Ajax
   * @param saveType
   * @param $buttonElem
   */
  var sendAjaxData = function (saveType, $buttonElem) {

    $.ajax({
      method: 'post',
      url: '/tree-data/save',
      dataType: 'json',
      data: {
        saveType: saveType
      },
      success: function (response) {
        setButtonStyle(response.result, $buttonElem);
      },
      error: function () {
        setButtonStyle('error', $buttonElem);
      }
    });
  };

  // При нажатии накнопку сохранения в БД
  $butonDbSave.on('click', function () {
    showPreloader($(this));
    sendAjaxData('original', $(this));
  });

  // При нажатии накнопку сохранения в БД как JSON
  $butonDbSaveJson.on('click', function () {
    showPreloader($(this));
    sendAjaxData('json', $(this));
  });
})();
