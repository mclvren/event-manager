<?php
//Выборка за последние 30 дней
$events = $fpdo->from('events');
foreach ($events as $key=>$row) :
  $creator = $fpdo->from('users')->where('id', $row['creator']);
  $namexx = $creator->fetch('name');
  $surnamexx = $creator->fetch('surname');
  $patrxx = $creator->fetch('patr');
  echo '<tr class="rowlink last-row">';
  echo '<td class="idtable">' . $row['id'] . '</td>';
  echo '<th scope="row">' . $row['date'] . '</td>';
  echo '<td>' . $row['name'] . '</td>';
  echo '<td>' . $surnamexx . " " . $namexx . " " . $patrxx .'</td>';
  echo '</tr>';
endforeach;
