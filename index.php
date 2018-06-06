<?php

if (!empty($_COOKIE['sid'])) {
// Проверка id сессии в cookies
    session_id($_COOKIE['sid']);
}

session_start();
require_once 'classes/Auth.class.php';
require_once 'classes/pdo.php';
//Всего мероприятий
$query = $fpdo->from('events');
$count=0;
foreach ($query as $key=>$row) :
$count++;
endforeach;
//Информация о пользователе
$query = $fpdo->from('users')->where('id', $_SESSION["user_id"]);
foreach ($query as $key=>$row) :
$username=$row['username'];
$email=$row['email'];
$img=$row['img'];
$img_type=$row['img_type'];
$name=$row['name'];
$crt=$row['iscreator'];
$surname=$row['surname'];
$patr=$row['patr'];
endforeach;
$countM=0;
$countF=0;
$query = $fpdo->from('members')->where(array('usrid'=>$_SESSION["user_id"]));
foreach ($query as $key=>$row) :
$evid=$row['evid'];
$countM++;
$event = $fpdo->from('events')->where('id', $evid);
$finished = $event->fetch('finished');
if ($finished==1) {$countF++;}
endforeach;
?>
<!-- Шапка -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="yandex-verification" content="ce73a1bad9028fd6" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.min.css">
  <link rel="stylesheet" href="assets/css/now-ui-kit.css" type="text/css">
  <link rel="stylesheet" href="assets/css/nucleo-icons.css" type="text/css">
  <script src="assets/js/navbar-ontop.js"></script>
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
  <title>Event Manager</title>
  <meta name="description" content="Информационная поддержка организации мероприятий">
  <meta name="keywords" content="event manager, event manager online, система организации проведения мероприятий, онлайн система организации проведения мероприятий, система организации проведения олимпиад">
  <!-- Yandex.Metrika counter -->
  <script type="text/javascript" >
      (function (d, w, c) {
          (w[c] = w[c] || []).push(function() {
              try {
                  w.yaCounter49088050 = new Ya.Metrika2({
                      id:49088050,
                      clickmap:true,
                      trackLinks:true,
                      accurateTrackBounce:true,
                      webvisor:true
                  });
              } catch(e) { }
          });

          var n = d.getElementsByTagName("script")[0],
              s = d.createElement("script"),
              f = function () { n.parentNode.insertBefore(s, n); };
          s.type = "text/javascript";
          s.async = true;
          s.src = "https://mc.yandex.ru/metrika/tag.js";

          if (w.opera == "[object Opera]") {
              d.addEventListener("DOMContentLoaded", f, false);
          } else { f(); }
      })(document, window, "yandex_metrika_callbacks2");
  </script>
  <noscript><div><img src="https://mc.yandex.ru/watch/49088050" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  <!-- /Yandex.Metrika counter -->
 </head>

<body class="">
<?php require_once 'content/top.php'; ?>
<!-- /Шапка -->
<?php if (Auth\User::isAuthorized()): ?>
  <?php require_once 'profile.php'; ?>
      <?php else: ?>
<!-- Контент для гостей -->
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>Последние мероприятия</h2>
          <hr class="mb-4"> </div>
      </div>
      <div class="row">
        <div class="col-md-12 p-3">
          <table class="table table-hover table-striped table-bordered">
            <thead class="thead-inverse">
              <tr class="bg-info">
                <th scope="col">Дата</th>
                <th scope="col">Название</th>
                <th scope="col">Организатор</th>
              </tr>
            </thead>
            <tbody>
			           <?php require_once 'classes/events/last.php' ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<!-- /Контент для гостей -->
  <?php endif; ?>
  <!-- Подвал -->
<?php require_once 'content/bottom.php'; ?>
</body>

</html>
