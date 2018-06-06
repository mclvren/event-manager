$(document).ready(function() {
  //Кнопки вывода мероприятий
  $(".creator-row").hide();
  $('#creatormod2').hide();
  $('#creatormod').click(function() {
    $(".last-row").hide();
    $(".creator-row").show();
    $('#creatormod2').show();
    $('#creatormod').hide();
  });
  $('#creatormod2').click(function() {
    $(".last-row").show();
    $(".creator-row").hide();
    $('#creatormod2').hide();
    $('#creatormod').show();
  });
  //
  //Скрытие блоков
  $('#editprofile').hide();
  $('#add').hide();
  $('#info').hide();
  $('#beMember').hide();
  $('#notMember').hide();
  //Показать форму добавления мероприятий
  $('#addbtn').click(function() {
    $('#add').show('medium');
    $('#editprofile').hide('medium');
    var scroll_el = $('#add'); // Объект, который будет в центре экрана.
    if ($(scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
      $('html, body').animate({
        scrollTop: $(scroll_el).offset().top
      }, 500); // анимируем скроолинг к элементу scroll_el
    }
  });
  //Показать форму найтроки профиля
  $('#editprofilebtn').click(function() {
    $('#add').hide('medium');
    $('#editprofile').show('medium');
    var scroll_el = $('#editprofile'); // Объект, который будет в центре экрана.
    if ($(scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
      $('html, body').animate({
        scrollTop: $(scroll_el).offset().top
      }, 500); // анимируем скроолинг к элементу scroll_el
    }
  });
  $('#picture').click(function() {
    $('#add').hide('medium');
    $('#editprofile').show('medium');
    var scroll_el = $('#editprofile'); // Объект, который будет в центре экрана.
    if ($(scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
      $('html, body').animate({
        scrollTop: $(scroll_el).offset().top
      }, 500); // анимируем скроолинг к элементу scroll_el
    }
  });
  //Датапикер
  $('[data-toggle="popover"]').popover();
  $('[data-toggle="tooltip"]').tooltip();
  $('#datepicker-example').datepicker({
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true
  });
  //<!-- Вывод информации о мероприятии -->
  $(function() {
    $('#events').on('click', '.rowlink', function() {
      var evid = $(this).find('.idtable').html();
      var eid = $(this).find('.idtable').html();
      eid = "id=" + eid;
      $.ajax({
        type: 'POST',
        url: 'classes/einfo.php',
        data: eid,
        success: function(data) {
          var obj = jQuery.parseJSON(data);
          $('#editprofile').hide('medium');
          $('#add').hide('medium');
          $('#info').show('medium');
          var scroll_el = $('#info'); // Объект, который будет в центре экрана.
          if ($(scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
            $('html, body').animate({
              scrollTop: $(scroll_el).offset().top
            }, 500); // анимируем скроолинг к элементу scroll_el
          }
            $('input[id^="evid"]').val(evid);
    //      $("#evid)").val(evid);
          $("#mevid").val(evid);
          $('#evname').html(obj[1]);
          $('#evdate').html(obj[2]);
          $('#evdesc').html(obj[3]);
          if (obj[13]!=null) {$('#members-table').html(obj[12]);}
          else {$('#members-table').html('<p>Участников нет!</p>');}

          //Вывод файлов
          if (obj[8] == 1) {
            var url = "uploads/events/" + evid + "/archive." + obj[9];
            $('#evfiles').html("<p>Информационные файлы мероприятия упакованы в архив.</p><a class='btn btn-primary' href='" + url + "'>Скачать</a>");
          } else {
            $('#evfiles').html("<p>Для данного мероприятия файлы пока недоступны.</p>");
          }
          //
          if (obj[7] != obj[6]) {
            $('#cr_edit').hide();
            $('#eveditform').hide();
            $('#members-table').unbind();
          } else {
            $('#eveditform').show();
            $('#cr_edit').show();
            //<!-- Устаноновка места участнику -->
            $('#members-table').unbind();
              $('#members-table').on('click', '.rowlink', function() {
                var memid = $(this).find('.idtable').html();
                var point = prompt("Укажите место", '');
                if (point!=null) {
                $.ajax({
                  type: 'POST',
                  url: 'classes/setpoint.php',
                  data: {id: memid, p: point, eventid: evid},
                  success: function(data) {
                    var obj = jQuery.parseJSON(data);
                      $('#members-table').append(obj);
                    //  window.setTimeout('location.reload()', 3000);
                  }
                }); }

              });
            //<!-- Устаноновка места участнику -->
          }
          if (obj[4]==0) {
            $('#finish-check').prop('checked', false);
          if (obj[10] == 1) {
            $('#beMember').hide();
            $('#notMember').show();
          } else {
            $('#notMember').hide();
            $('#beMember').show();
          }
        } else {$('#finish-check').prop('checked', true);$('#notMember').hide();$('#beMember').hide();}
          var address = obj[5];
          //alert(obj[1]);
          if (address != "") {
            $('#map_canvas').show();
            $("#map_canvas").css({
              "width": "400px",
              "height": "400px"
            });
            //Карта
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var myOptions = {
              zoom: 16,
              center: latlng,
              mapTypeControl: true,
              mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
              },
              navigationControl: true,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            if (geocoder) {
              geocoder.geocode({
                'address': address
              }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                  if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                    map.setCenter(results[0].geometry.location);

                    var infowindow = new google.maps.InfoWindow({
                      content: '<b>' + address + '</b>',
                      size: new google.maps.Size(150, 50)
                    });

                    var marker = new google.maps.Marker({
                      position: results[0].geometry.location,
                      map: map,
                      title: address
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                      infowindow.open(map, marker);
                    });

                  } else {
                    alert("No results found");
                  }
                } else {
                  alert("Geocode was not successful for the following reason: " + status);
                }
              });
            }
          } else {
            $('#map_canvas').hide();
            $("#map_canvas").css({
              "width": "0px",
              "height": "0px"
            });
          }
          //Карта
        }
      });

    });
  });
  //<!-- Вывод информации о мероприятии -->
  //<!-- Редактор профиля -->
  $(function() {
    $('#editform').on('submit', function(e) {
      e.preventDefault();
      var $that = $(this),
        formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
      $.ajax({
        url: $that.attr('action'),
        type: $that.attr('method'),
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false, // важно - убираем преобразование строк по умолчанию
        data: formData,
        dataType: 'json',
        success: function(json) {
          if (json) {
            $that.replaceWith("<h5 class='text-primary my-3 text-center'>" + json + "</h5>");
            window.setTimeout('location.reload()', 3000);
          }
        }
      });
    });
  });
  //<!-- Редактор профиля -->
  //<!-- Добавить мероприятие -->
  $(function() {
    $('#addform').on('submit', function(e) {
      e.preventDefault();
      var $that = $(this),
        formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
      $.ajax({
        url: $that.attr('action'),
        type: $that.attr('method'),
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false, // важно - убираем преобразование строк по умолчанию
        data: formData,
        dataType: 'json',
        success: function(json) {
          if (json) {
            $that.replaceWith("<h5 class='text-primary my-3 text-center'>" + json + "</h5>");
            window.setTimeout('location.reload()', 3000);
          }
        }
      });
    });
  });
  //<!-- Добавить мероприятие -->
  //<!-- Редактировать мероприятие -->
  $(function() {
    $('#eveditform').on('submit', function(e) {
      e.preventDefault();
      var $that = $(this),
        formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
      $.ajax({
        url: $that.attr('action'),
        type: $that.attr('method'),
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false, // важно - убираем преобразование строк по умолчанию
        data: formData,
        dataType: 'json',
        success: function(json) {
          if (json) {
            $that.replaceWith("<h5 class='text-primary my-3 text-center'>" + json + "</h5>");
            window.setTimeout('location.reload()', 3000);
          }
        }
      });
    });
  });
  //<!-- Редактировать мероприятие -->
  //<!-- Связь с организатором -->
  $("#sendform").submit(function() { // пeрeхвaтывaeм всe при сoбытии oтпрaвки
    var form = $(this); // зaпишeм фoрму, чтoбы пoтoм нe былo прoблeм с this
    var error = false; // прeдвaритeльнo oшибoк нeт
    form.find('textarea').each(function() { // прoбeжим пo кaждoму пoлю в фoрмe
      if ($(this).val() == '') { // eсли нaхoдим пустoe
        form.append('Зaпoлнитe пoлe "' + $(this).attr('placeholder') + '"!'); // гoвoрим зaпoлняй!
        error = true; // oшибкa
      }
    });
    if (!error) { // eсли oшибки нeт
      var data = form.serialize(); // пoдгoтaвливaeм дaнныe
      $.ajax({ // инициaлизируeм ajax зaпрoс
        type: 'POST', // oтпрaвляeм в POST фoрмaтe, мoжнo GET
        url: '../classes/send.php', // путь дo oбрaбoтчикa, у нaс oн лeжит в тoй жe пaпкe
        dataType: 'json', // oтвeт ждeм в json фoрмaтe
        data: data, // дaнныe для oтпрaвки
        beforeSend: function(data) { // сoбытиe дo oтпрaвки
          form.find('input[type="submit"]').attr('disabled', 'disabled'); // нaпримeр, oтключим кнoпку, чтoбы нe жaли пo 100 рaз
        },
        success: function(data) { // сoбытиe пoслe удaчнoгo oбрaщeния к сeрвeру и пoлучeния oтвeтa
          if (data['error']) { // eсли oбрaбoтчик вeрнул oшибку
            alert(data['error']); // пoкaжeм eё тeкст
          } else { // eсли всe прoшлo oк
            form.html('Сообщение oтпрaвлeнo! <br> Ответ придет на указанную в вашем профиле почту.'); // пишeм чтo всe oк
          }
        },
        error: function(xhr, ajaxOptions, thrownError) { // в случae нeудaчнoгo зaвeршeния зaпрoсa к сeрвeру
          form.append(xhr.status); // пoкaжeм oтвeт сeрвeрa
          form.append(thrownError); // и тeкст oшибки
        },
        complete: function(data) { // сoбытиe пoслe любoгo исхoдa
          form.find('input[type="submit"]').prop('disabled', false); // в любoм случae включим кнoпку oбрaтнo
        }

      });
    }
    return false; // вырубaeм стaндaртную oтпрaвку фoрмы
  });
});
//Датапикер
$('.date-picker').each(function() {
  $(this).datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d',
    templates: {
      leftArrow: '<i class="now-ui-icons arrows-1_minimal-left"></i>',
      rightArrow: '<i class="now-ui-icons arrows-1_minimal-right"></i>'
    }
  }).on('show', function() {
    $('.datepicker').addClass('open');
    datepicker_color = $(this).data('datepicker-color');
    if (datepicker_color.length != 0) {
      $('.datepicker').addClass('datepicker-' + datepicker_color + '');
    }
  }).on('hide', function() {
    $('.datepicker').removeClass('open');
  });
});
//Стать организатором
function beCreator() {
  $.post('./classes/becreator.php', {
    action: 'beCreator'
  }, function(data) {
    alert(data);
    location.reload();
  });
}
//<!-- Участвовать -->
$(function() {
  $('#beMember').on('submit', function(e) {
    e.preventDefault();
    var $that = $(this),
      formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    $.ajax({
      url: $that.attr('action'),
      type: $that.attr('method'),
      contentType: false, // важно - убираем форматирование данных по умолчанию
      processData: false, // важно - убираем преобразование строк по умолчанию
      data: formData,
      dataType: 'json',
      success: function(json) {
        if (json) {
          $that.replaceWith("<h5 class='text-primary my-3 text-center'>" + json + "</h5>");
          window.setTimeout('location.reload()', 3000);
        }
      }
    });
  });
});
//<!-- Участвовать -->
//<!-- Отказаться от участия -->
$(function() {
  $('#notMember').on('submit', function(e) {
    e.preventDefault();
    var $that = $(this),
      formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    $.ajax({
      url: $that.attr('action'),
      type: $that.attr('method'),
      contentType: false, // важно - убираем форматирование данных по умолчанию
      processData: false, // важно - убираем преобразование строк по умолчанию
      data: formData,
      dataType: 'json',
      success: function(json) {
        if (json) {
          $that.replaceWith("<h5 class='text-primary my-3 text-center'>" + json + "</h5>");
          window.setTimeout('location.reload()', 3000);
        }
      }
    });
  });
});
//<!-- Отказаться от участия -->
//<!-- Удалить мероприятие -->
$(function() {
  $('#evDelete').on('submit', function(e) {
    e.preventDefault();
    var $that = $(this),
      formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    $.ajax({
      url: $that.attr('action'),
      type: $that.attr('method'),
      contentType: false, // важно - убираем форматирование данных по умолчанию
      processData: false, // важно - убираем преобразование строк по умолчанию
      data: formData,
      dataType: 'json',
      success: function(json) {
        if (json) {
          $that.replaceWith("<h5 class='text-primary my-3 text-center'>" + json + "</h5>");
          window.setTimeout('location.reload()', 3000);
        }
      }
    });
  });
});
//<!-- Удалить мероприятие -->
//<!-- Вывод информации о мероприятии -->
