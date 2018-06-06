<?php
if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
session_start();
if ($_POST) { // eсли пeрeдaн мaссив POST
	$uid=$_SESSION["user_id"];
	$id = htmlspecialchars($_POST["id"]); // пишeм дaнныe в пeрeмeнныe и экрaнируeм спeцсимвoлы
  require_once 'pdo.php';
  $query = $fpdo->from('events')->where('id', $id);
  foreach ($query as $key=>$row) :
  $name=$row['name'];
  $date=$row['date'];
	$address=$row['address'];
  $description=$row['description'];
  $finished=$row['finished'];
	$creator=$row['creator'];
  $fl=$row['fl'];
  $fl_type=$row['fl_type'];
  endforeach;
  $query = $fpdo->from('members')->where(array('usrid'=>$uid,'evid'=>$id));
  foreach ($query as $key=>$row) :
  $memid=$row['id'];
  $evid=$row['evid'];
  $point=$row['point'];
  endforeach;
  if ($evid==$id) {$isM=1; $pointM=$point;} else {$isM=0;}
  //Участники
  $table='<table class="table table-bordered table-striped table-hover">';
  $table.='<thead class="thead-inverse">';
  $table.='<tr class="bg-info">';
  $table.='<th scope="col">Никнейм</th>';
  $table.='<th scope="col">ФИО</th>';
  $table.='<th scope="col">Место</th>';
  $table.='</tr>';
  $table.='</thead>';
  $table.='<tbody id="members-table">';
  $members = $fpdo->from('members')->where('evid', $id);
  foreach ($members as $key=>$row) :
    $meid=$row['id'];
    $fio = $fpdo->from('users')->where('id', $row['usrid']);
    $usernamexxx = $fio->fetch('username');
    $namexxx = $fio->fetch('name');
    $surnamexxx = $fio->fetch('surname');
    $patrxxx = $fio->fetch('patr');
    if ($memid==$meid) {
      $table.= '<tr class="last-row table-warning text-dark rowlink">';
      $table.='<td class="idtable d-none">' . $row['id'] . '</td>';
      $table.= '<th scope="row">' . $usernamexxx . '</td>';
      $table.= '<td>' . $surnamexxx . " " . $namexxx . " " . $patrxxx . '</td>';
      $table.= '<td>' . $row['point'] .'</td>';
      $table.= '</tr>';
    }
    else {
    $table.= '<tr class="last-row text-dark rowlink">';
    $table.='<td class="idtable d-none">' . $row['id'] . '</td>';
    $table.= '<th scope="row">' . $usernamexxx . '</td>';
    $table.= '<td>' . $surnamexxx . " " . $namexxx . " " . $patrxxx . '</td>';
    $table.= '<td>' . $row['point'] .'</td>';
    $table.= '</tr>';
  }
  endforeach;
$table.='</tbody>';
$table.='</table>';
//
	$json = array(); // пoдгoтoвим мaссив oтвeтa
    $json['1'] = $name;
    $json['2'] = $date;
		$json['3'] = $description;
    $json['4'] = $finished;
		$json['5'] = $address;
		$json['6'] = $creator;
		$json['7'] = $uid;
    $json['8'] = $fl;
    $json['9'] = $fl_type;
    $json['10'] = $isM;
    $json['11'] = $pointM;
    $json['12'] = $table;
    $json['13'] = $meid;
		echo json_encode($json); // вывoдим мaссив oтвeтa
  }
 ?>
