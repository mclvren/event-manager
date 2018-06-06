  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <a id="picture" href="#editprofile">
          <?php
          if ($img==1) {
          echo "<img class='d-block rounded-circle mx-auto shadow' src='uploads/users/".$_SESSION["user_id"]."/".profile.".".$img_type."' width='300' height='300'> </a>";
          }
          else {echo "<img class='d-block rounded-circle mx-auto shadow' src='https://pingendo.com/assets/photos/wireframe/photo-1.jpg' width='300' height='300'> </a>";}
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 bg-secondary">
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <h1 class="display-1 text-center"><?php echo $countM; ?></h1>
          <p class="text-center">Всего</p>
        </div>
        <div class="col-md-8">
          <br>
          <h1 class="display-1 text-center"><?php echo $surname . " " . $name . " " . $patr; ?></h1>
        </div>
        <div class="col-md-2">
          <h1 class="display-1 text-center"><?php echo $countF; ?></h1>
          <p class="text-center">Закончено</p>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>Список мероприятий</h2>
          <hr class="mb-4"> </div>
      </div>
      <div class="row">
        <div class="col-md-12 p-3">
          <table class="table table-bordered table-striped table-hover">
            <thead class="thead-inverse">
              <tr class="bg-info">
                <th scope="col" width="10.5%">Дата</th>
                <th scope="col">Название</th>
                <th scope="col">Организатор</th>
              </tr>
            </thead>
            <tbody id="events">
              <!-- Вывод мероприятий -->
                <?php
                if ($crt==1) {
                  require_once 'classes/events/creator.php';
                }
                ?>
                <?php require_once 'classes/events/user.php' ?>
              <!-- Вывод мероприятий -->
            </tbody>
          </table>
          <?php
          if ($crt==1) {
            echo '<button class="btn btn-large btn-primary" id="creatormod" type="submit">Показать только созданные мероприятия</button>';
            echo '<button class="btn btn-large btn-primary" id="creatormod2" type="submit">Показать все мероприятия</button>';
          }
          else {
            echo '<button class="btn btn-large btn-primary" id="becreator" onclick="beCreator()" type="submit">Cтать организатором</button>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 bg-gray" id="info">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mb-4 card border-0">
            <b>
              <div class="card-header text-primary"><span id="evname"></span>
                <span class="text-secondary float-right" id="evdate"></span>
              </div>
            </b>
            <ul class="nav nav-tabs flex-column flex-lg-row p-3 bg-primary justify-content-md-center">
              <li class="nav-item mr-1 text-center">
                <a href="" class="active nav-link rounded" data-toggle="pill" data-target="#tabBackgroundOne">Описание</a>
              </li>
              <li class="nav-item mr-1 text-center">
                <a class="nav-link rounded" href="" data-toggle="pill" data-target="#tabBackgroundTwo">Файлы</a>
              </li>
              <li class="nav-item mr-1 text-center">
                <a href="" class="nav-link rounded" data-toggle="pill" data-target="#tabBackgroundThree">Участники</a>
              </li>
              <li class="nav-item text-center">
                <a href="" class="nav-link rounded" data-toggle="pill" data-target="#tabBackgroundFour">Связаться с организатором</a>
              </li>
              <li class="nav-item text-center" id="cr_edit">
                <a href="" class="nav-link rounded" data-toggle="pill" data-target="#tabBackgroundFive">Редактировать</a>
              </li>
            </ul>
            <div class="card-body">
              <div class="tab-content mt-2">
                <div class="tab-pane fade show active text-center" id="tabBackgroundOne" role="tabpanel">
                  <div class="d-block px-3 float-left rounded" style="margin-right: 5px;" id="map_canvas"></div>
                  <p class="text-left"><span id="evdesc" style="padding: 20px;"></span></p>
                </div>
                <div class="tab-pane fade text-center" id="tabBackgroundTwo" role="tabpanel">
                  <p class=""><span id="evfiles"></span></p>
                </div>
                <div class="tab-pane fade text-center" id="tabBackgroundThree" role="tabpanel">
                    <div id="members-table"></div>
                  <p>
                    <form method="post" action="classes/beMember.php" id="beMember">
                      <input id="evid1" name="evid" type="hidden" value="">
                      <input class="btn btn-primary my-2 rounded" type="submit" value="Участвовать"/>
                    </form>
                    <form method="post" action="classes/notMember.php" id="notMember">
                      <input id="mevid" name="mevid" type="hidden" value="">
                      <input class="btn btn-primary my-2 rounded" type="submit" value="Отказаться от участия"/>
                    </form>
                  </p>
                </div>
                <div class="tab-pane fade text-center" id="tabBackgroundFour" role="tabpanel">
                  <form method="post" action="" id="sendform"> <br />
                    <input id="evid2" name="evid" type="hidden" value="">
                    <textarea class="form-control" cols="25" rows="10" name="message" placeholder="Сooбщeниe.." val=""></textarea> <br />
                    <input class="btn btn-primary my-2 rounded" type="submit" value="Отправить"/>
                  </form>
                </div>
                <div class="tab-pane fade text-center" id="tabBackgroundFive" role="tabpanel">
                  <form id="eveditform" class="" action="classes/evedit.php" enctype="multipart/form-data" method="post">
                    <h5 class="text-primary my-3 text-left">Редактирование мероприятия</h5>
                    <hr>
                    <div class="form-group">
                      <input id="evid3" name="evid" type="hidden" value="">
                      <p class="text-left">Название</p>
                      <input name="name" type="text" class="form-control text-secondary" placeholder="Введите название">
                      <small class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <p class="text-left">Дата</p>
                      <input name="date" type="text" class="form-control date-picker" data-datepicker-color="default" placeholder="Выберите дату"> </div>
                    <div class="form-group">
                      <p class="text-left">Описание</p>
                      <textarea name="description" class="form-control text-secondary rounded" rows="3" placeholder="Опишите ваше мероприятие"></textarea>
                    </div>
                    <div class="form-group">
                      <p class="text-left">Адрес</p>
                      <input name="address" type="text" class="form-control" id="inlineFormInput4" placeholder="Укажите адрес"> </div>
                    <div class="form-group">
                      <p class="text-left">Файлы (перед загрузкой упакуйте ваши файлы в архив zip, rar, 7z, tar или gz)</p>
                      <input name="evfile1" id="evfile" type="file" class="form-control-file" id="inlineFormInput5" accept=".zip,.rar,.7z,.tar,.gz"> </div>
                      <p class="text-left"><label class="checkbox">
            						<input id="finish-check" name="finished" type="checkbox" value="finished"> Закончено
            					</label></p>
                      <label>Поля, которые не нужно редактировать оставьте пустыми!</label><br>
                    <button type="submit" class="btn btn-primary my-2 rounded">Подтвердить</button>
                  </form>
                  <form method="post" action="classes/evDelete.php" id="evDelete">
                    <hr>
                    <input id="evid4" name="evid" type="hidden" value="">
                    <input class="btn btn-primary my-2 rounded" type="submit" value="Удалить мероприятие"/>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 bg-gray" id="add">
    <div class="container">
      <div class="row">
        <div class="col-md-12  bg-light card">
          <form id="addform" class="" action="classes/add.php" enctype="multipart/form-data" method="post">
            <h5 class="text-primary my-3 text-left">Добавление мероприятия</h5>
            <hr>
            <div class="form-group">
              <label>Название</label>
              <input name="name" type="text" class="form-control text-secondary" placeholder="Введите название">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Дата</label>
              <input name="date" type="text" class="form-control date-picker" data-datepicker-color="default" value="2018-05-28"> </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Описание</label>
              <textarea name="description" class="form-control text-secondary rounded" rows="3" placeholder="Опишите ваше мероприятие"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Адрес</label>
              <input name="address" type="text" class="form-control" id="inlineFormInput4" placeholder="Укажите адрес"> </div>
          <!--  <div class="form-group">
              <label for="exampleInputEmail1">Файлы</label>
              <input name="evfile" id="evfile" type="file" class="form-control-file" id="inlineFormInput5"> </div> -->
            <button type="submit" class="btn btn-primary my-2 rounded">Подтвердить</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 bg-gray" id="editprofile">
    <div class="container">
      <div class="row">
        <div class="col-md-12  bg-light card">
          <form id="editform" class="" action="classes/edit.php" enctype="multipart/form-data" method="post">
            <h5 class="text-primary my-3 text-left">Изменение профиля</h5>
            <hr>
            <div class="form-group">
              <label class="text-dark">Никнейм</label>
              <input name="username" type="text" class="form-control" placeholder="<?php echo $username; ?>">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1" class="text-dark">Email</label>
              <input name="email" type="email" class="form-control" id="inlineFormInput1" placeholder="<?php echo $email; ?>" autocomplete="email"> </div>
            <div class="form-group">
              <label for="exampleInputEmail1" class="text-dark">Старый пароль</label>
              <input name="password1" type="password" class="form-control" id="inlineFormInput2" placeholder="Для изменения пароля необходимо указать старый" autocomplete="password"> </div>
            <div class="form-group">
              <label for="exampleInputEmail1" class="text-dark">Новый пароль</label>
              <input name="password2" type="password" class="form-control" id="inlineFormInput3" placeholder="Придумайте новый пароль" autocomplete="new-password"> </div>
            <div class="form-group">
              <label for="exampleInputEmail1" class="text-dark">Изображение профиля</label>
              <input name="img" type="file" class="form-control-file" id="img" accept="image/*"> </div>
            <button id="editbtn" type="submit" class="btn btn-primary my-2 rounded">Подтвердить</button>
          </form>
        </div>
      </div>
    </div>
  </div>
