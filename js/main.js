(function(){
  var $form;

  init();
  attachEvents();

  /**
   * Инициализация
   */
  function init() {
    $form = $('.form');

    initFileUpload();
  }

  /**
   * Обработчики форм
   */
  function attachEvents() {
    $('#link_popup_show').on('click', onPopupShow);
    $('.popup__overlay, #icon_popup_close').on('click', onPopupHide);
    $('.input_text, .textarea_text').on('keypress', onToolTipHide)
    $('#upload_file').on('change', onChangeFile);
    $form.on('submit', onCheckForm);
    $form.on('reset', onClearForm);
  }

  /**
   * Открытие PopUp
   *
   */
  function onPopupShow () {
    var $popup = $('.popup__overlay'),
      $modal = $('.popup');
      $popup.fadeIn(300);
  }

  /**
   * Скрытие PopUp
   */
  function onPopupHide (event){
    var $popup = $('.popup__overlay');
    e = event || window.event
    if (e.target == this) {
        $popup.fadeOut(300);
        controlForm.clearForm($form);
    }
  }

  /**
   * Выбор загружаемого файла
   */
  function onChangeFile (element) {
    var $this = $(this),
        paht_file = $this.val().replace(/.+[\\\/]/, "");

    if (paht_file) {
      $('.upload_paht_file').text(paht_file);
    }else {
      $('.upload_paht_file').text('Загрузите изображение');
    }
  }

  /**
   * Загрузчик файлов
   */
  function initFileUpload () {
    if($('input[type=file]').length>0) {

      $('#upload_file').fileupload({
        url: 'php/myuploadhandler.php',
        dataType: 'json',
        replaceFileInput: false,
        maxNumberOfFiles: 1,

          add: function(e, data) {
            var jsondata,
                $this = $(this);

            if (!~data.files[0].type.indexOf('image')) {
                controlForm.addToolTip($this,'Ваш файл не является изображением');

            } else if (data.files[0].size > 1024*1024) {
                controlForm.addToolTip($this,'Ваш файл слишком большой (более 1Mb)');

            } else {

              data.submit()
              .success(function (result, textStatus, jqXHR) {
                $('#project_img').val(result.new_file_name);
                controlForm.delToolTip($this);
              })
              .error(function (jqXHR, textStatus, errorThrown) {
                controlForm.addToolTip($this,'Ошибка загрузки файла');
              });
            }
          },

          progress: function(e, data){
              controlForm.addToolTip($(this),'Загрузка файла, подождите....');
          }

        })
      }
    }

  /**
   * Удаление ToolTip при наборе текста
   */
  function onToolTipHide (element) {
    var $this = $(this);
    controlForm.delToolTip($this);
  }

  /**
   * Проверка валидации и отправка данных на сервер
   */
  function onCheckForm (form){
    form.preventDefault();

    if(controlForm.validForm($(this))) {
      controlForm.sendAjax($(this));
    }
  }

  /**
   * Очистка формы по кнопке
   */
  function onClearForm (form){
    controlForm.clearForm($(this));
  }
})();

  /**
   *
   * Работа с формой
   *
   */
(function() {
  var my,
      $currentForm;

  publicInterface();

  /**
   * Отображение ToolTip
   */
  function addToolTipError ($element, toltiptext) {
    var $tooltip = $element.closest('.form__item').find('.tooltipstext');
        $tooltip.text(toltiptext);

      $tooltip.fadeIn(100, function(){

      if ($element.attr('type') !== 'file') {
        $element.addClass('error');
      }else {
        $('.label_upload_file').addClass('error');
      }
     });
  }

  /**
   * Скрытие ToolTip
   */
  function delToolTipError ($element) {
    var $tooltip = $element.closest('.form__item').find('.tooltipstext');

    $tooltip.fadeOut(100, function(){
      $element.removeClass('error');
      if ($element.attr('type') !== 'file') {
          $element.removeClass('error');
      }else {
        $('.label_upload_file').removeClass('error');
      }
    });
  }

  /**
   * Вывод сообщения перед отправкой данных на сервер
   */
  function ajaxBeforeSendForm() {
    var jsondata = {'status':'server_before', 'status_text':'Подождите ответ от сервера.'};
    createStatusServer ($currentForm, jsondata);
  }

  /**
   * Вывод сообщения при упешной отправке данных на сервер
   */
  function ajaxSuccessForm(jsondata) {
    var idform = $currentForm.attr('id'),
        status = jsondata['status'];

    createStatusServer ($currentForm, jsondata);

    if (idform === 'login_form' && status === 'server_ok') {
       setTimeout("document.location.href='../loft1php'", 1000);
    }

    if (idform === 'popup_form' && status === 'server_ok') {
      $('.myinfo-container').prepend(jsondata['project_new']);
        setTimeout( function (){
          $(".popup__overlay").trigger( "click" );
        }, 2000);
    }
  }

  /**
   * Вывод сообщения об ошибке на сервере
   */
  function ajaxErrorForm(error) {
    var jsondata = {'status':'server_error', 'status_text':'Ошибка сервера ajax'};
    createStatusServer ($currentForm, jsondata);
  }

  /**
   * Отображение сообщений сервера пользователю
   */
  function createStatusServer ($form, jsondata) {
    var status = jsondata['status'],
      status_text = jsondata['status_text'],
      $sever_mess = $form.find('.sever_mess');

    if (status === 'server_before') {
      $sever_mess.removeClass('server_error server_ok')
                 .addClass('server_before')
                 .find('.server_mess_title')
                 .text('Одну минуточку...');
    }

    if (status === 'server_error' ) {
      $sever_mess.removeClass('server_ok')
                 .addClass('server_error')
                 .find('.server_mess_title')
                 .text('Ошибка!');
    }

    if (status === 'server_ok') {
      $sever_mess.removeClass('server_error')
                 .addClass('server_ok')
                 .find('.server_mess_title')
                 .text('Спасибо!');
    }

    $sever_mess.find('.server_mess_desc').text(status_text);
  }


   /**
   * Открытые методы
   */
  function publicInterface() {
    my = {

      /**
       * Проверка заполнения форм пользователем
       */
      validForm: function($form) {
              var isValidForm = true,
                  toltipText;

              $form.find('input, textarea').each(function(e) {
                var $this = $(this),
                    labeltext='';

                if ($this.val().trim() === '') {

                  labeltext = $this.closest('.form__item').find('.label_text').text();
                  toltipText = 'Заполните поле "' + labeltext + '"';

                  isValidForm = false;
                  addToolTipError($this, toltipText);
                }
              });

              return isValidForm;
            },

      /**
       * Скрытие ToolTip у элемента
       */
      delToolTip: function ($element) {
        delToolTipError($element);
      },

      /**
       * Добавление ToolTip элементу
       */
      addToolTip: function ($element, toltiptext){
        addToolTipError($element, toltiptext);
      },

      /**
       * Очистка полей формы
       */
      clearForm: function ($form) {
        $form.find("input, textarea").each(function(e) {
          var $this = $(this);

            $this.val('');
            $('.upload_paht_file').text('Загрузите изображение');
            delToolTipError($this);
        });

        $form.find('.sever_mess').removeClass('server_error server_ok server_before');
      },

      /**
       * Отправка данных на сервер
       */
      sendAjax: function($form){
          var formdata = $form.serialize(),
            urlHandlerAjax = $form.attr('action');

            ajaxOptions = {
              url: urlHandlerAjax,
              type: 'post',
              data: {formdata : formdata},
              dataType: 'json',
              beforeSend: ajaxBeforeSendForm,
              success: ajaxSuccessForm,
              error: ajaxErrorForm
            };

        $currentForm = $form;
        $.ajax(ajaxOptions);
      }
    };
  }

  window.controlForm = my;
})();


/* Navigation*/
(function () {

  if(document.getElementById('navigation-list')) {
    var navelements = document.getElementById('navigation-list').getElementsByTagName('li'),
        currentpage = location.pathname.match(/[^/]*$/);

    if (navelements.length > 0) {
      for(var i = 0, len = navelements.length;  i < len; i++) {
        if (currentpage[0] === "" ) {
          currentpage = "index.php";
        }

        if (navelements[i].querySelector('a').href.indexOf(currentpage) !=-1) {
            navelements[i].className += " current";
        }
      }
    }
  }
})();
