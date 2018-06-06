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
      <a class="navbar-brand" href="#">
  <?php if (Auth\User::isAuthorized()): ?>
    <i class="fa fa-user fa-fw"></i><?php echo $username; ?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center justify-content-center" id="navbar2SupportedContent">
    <a class="btn btn-primary" href="/">
      <i class="fa fa-fw fa-home"></i>&nbsp;Главная</a>
      <?php
      if ($crt==1) {
        echo '<a class="btn btn-primary" id="addbtn" href="#add">';
        echo '<i class="fa fa-fw fa-calendar-plus-o"></i>&nbsp;Добавить мероприятие</a>';
      } ?>
    <a class="btn btn-primary" id="editprofilebtn" href="#editprofile">
      <i class="fa fa-fw fa-address-card-o"></i>&nbsp;Изменить профиль</a>
      <form class="ajax" method="post" action="./ajax.php">
                <input type="hidden" name="act" value="logout">
                <div class="form-actions">
                    <button class="btn btn-large btn-primary" type="submit"><i class="fa d-inline fa-user-circle-o"></i> Выйти</button>
                </div>
            </form>
    <?php else: ?>
        <i class="fa fa-user fa-fw"></i>Гость</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center justify-content-center" id="navbar2SupportedContent">
        <a class="btn btn-primary text-orimary" href="login.php" id="logbtn">
          <i class="fa d-inline fa-user-circle-o"></i> Вход</a>
        <a class="btn btn-primary" href="reg.php" id="regbtn">
          <i class="fa fa-fw fa-user-plus"></i>&nbsp;Регистрация</a>
<?php endif; ?>
</div>
</div>
</nav>
