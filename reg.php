<?php

if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
session_start();
require_once './classes/Auth.class.php';
require_once './classes/pdo.php';
$query = $fpdo->from('events');
$count=0;
foreach ($query as $key=>$row) :
$count++;
endforeach;
?>
<?php if (Auth\User::isAuthorized()): ?>

      <h1>Вы уже зарегистрированы!</h1>

      <form class="ajax" method="post" action="./ajax.php">
          <input type="hidden" name="act" value="logout">
          <div class="form-actions">
              <button class="btn btn-large btn-primary" type="submit">Logout</button>
          </div>

      </form>
      <?php else: ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.min.css">
  <link rel="stylesheet" href="assets/css/now-ui-kit.css" type="text/css">
  <link rel="stylesheet" href="assets/css/nucleo-icons.css" type="text/css">
  <script src="assets/js/navbar-ontop.js"></script>
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
  <title>Event Manager</title>
  <meta name="description" content="Информационная поддержка организации мероприятий">
  <meta name="keywords"> </head>

<body class="">
  <div class="py-5 text-center">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="text-capitalize display-4">Event Manager</h1>
          <p class="lead text-muted">Информационная поддержка организации мероприятий</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-md bg-primary sticky-top navbar-dark">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center justify-content-center" id="navbar2SupportedContent">
        <a class="btn btn-primary d-none">
          <i class="fa fa-fw fa-home"></i>&nbsp;Главная</a>
        <a class="btn btn-primary text-orimary" href="login.php" id="logbtn">
          <i class="fa d-inline fa-user-circle-o"></i> Вход</a>
        <a class="btn btn-primary d-none">
          <i class="fa fa-fw fa-calendar-plus-o"></i>&nbsp;Добавить мероприятие</a>
        <a class="btn btn-primary d-none">
          <i class="fa fa-fw fa-address-card-o"></i>&nbsp;Изменить профиль</a>
      </div>
    </div>
  </nav>
  <div class="py-5 bg-dark" style="background-image: url(&quot;assets/img/bg11.jpg&quot;); background-size: cover; background-position: center top;" id="reg">
    <div class="container">
      <div class="row my-4">
        <div class="mx-auto col-md-6 col-10 col-xl-4 px-4">
          <div class="card bg-primary">
            <div class="card-body text-center">
              <div class="row mt-5">
                <div class="col-md-12">
                  <h5 class="mb-4">
                    <b>Регистрация</b>
                  </h5>
                </div>
              </div>
              <div class="row mt-4 pt-2">
                <div class="col">
                  <form class="form-signin ajax" method="post" action="./ajax.php">
                    <div class="form-group mb-2">
                      <div class="input-group border-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">
                            <i class="now-ui-icons users_circle-08 lg"></i>
                          </span>
                        </div>
                        <input name="username" class="form-control" id="inlineFormInputGroup1" type="text" placeholder="Никнейм" autocomplete="on" autofocus>
                    </div>
					</div>
					<div class="form-group mb-2">
                      <div class="input-group border-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">
                            <i class="now-ui-icons text_caps-small lg"></i>
                          </span>
                        </div>
                        <input name="name1" type="text" class="form-control" id="inlineFormInputGroup2" placeholder="Имя" autocomplete="name"> </div>
                    </div>
                    <div class="form-group mb-2">
                      <div class="input-group border-0">
                        <div class="input-group-prepend ">
                          <span class="input-group-text" id="basic-addon1">
                            <i class="now-ui-icons text_caps-small lg"></i>
                          </span>
                        </div>
                        <input name="surname" type="text" class="form-control" id="inlineFormInputGroup3" placeholder="Фамилия" autocomplete="surname"> </div>
                    </div>
                    <div class="form-group mb-2">
                      <div class="input-group border-0">
                        <div class="input-group-prepend ">
                          <span class="input-group-text" id="basic-addon1">
                            <i class="now-ui-icons text_caps-small lg"></i>
                          </span>
                        </div>
                        <input name="patr" type="text" class="form-control" id="inlineFormInputGroup3" placeholder="Отчество" autocomplete="patr"> </div>
                    </div>
                    <div class="form-group mb-2">
                      <div class="input-group border-0">
                        <div class="input-group-prepend ">
                          <span class="input-group-text" id="basic-addon1">
                            <i class="now-ui-icons ui-1_email-85 lg"></i>
                          </span>
                        </div>
                        <input name="email" type="email" class="form-control" id="inlineFormInputGroup4" placeholder="Email" autocomplete="email"> </div>
                    </div>
                    <div class="form-group mb-2">
                      <div class="input-group border-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">
                            <i class="now-ui-icons ui-1_lock-circle-open lg"></i>
                          </span>
                        </div>
                        <input name="password1" type="password" class="form-control" id="inlineFormInputGroup5" placeholder="Пароль" autocomplete="new-password"> </div>
                    </div>
                    <div class="form-group mb-3">
                      <div class="input-group border-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">
                            <i class="now-ui-icons ui-1_lock-circle-open lg"></i>
                          </span>
                        </div>
                        <input name="password2" type="password" class="form-control" id="inlineFormInputGroup6" placeholder="Подтвердите пароль" autocomplete="new-password"> </div>
                    </div>
					<input type="hidden" name="act" value="register">
					<div class="main-error alert alert-error hide"></div>
                    <button type="submit" class="btn mt-4 mb-3 btn-light rounded btn-lg text-primary">Подтвердить</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pt-5 bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="mx-auto text-center">Всего мероприятий в системе: <?php echo $count; ?></h1>
        </div>
      </div>
      <div class="row mt-5">

        <div class="col-12 mx-auto text-center">
          <li class="list-inline-item text-light mb-4">
            <small> © 2018 &nbsp;AIV,&nbsp;
              <a href="https://www.invisionapp.com/" target="_blank" class="text-white">Invision</a>,&nbsp;
              <a href="https://www.creative-tim.com/" target="_blank" class="text-white">Creative Tim</a> and
              <a href="https://www.pingendo.com/" target="_blank" class="text-white">Pingendo</a>. </small>
          </li>
        </div>
        <div> </div>
      </div>
    </div>
  </div>
  <script src="./vendor/jquery-2.0.3.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/ajax-form.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"></script>
  <script src="assets/js/parallax.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
  <script>
    $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
            $('#datepicker-example').datepicker({
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true
            });
          });
  </script>
</body>

</html>
<?php endif; ?>
