<?php
  $events = $fpdo->from('events')->where('creator', $_SESSION["user_id"]);
  foreach ($events as $key=>$row) :
    $creator = $fpdo->from('users')->where('id', $row['creator']);
    $namex = $creator->fetch('name');
    $surnamex = $creator->fetch('surname');
    $patrx = $creator->fetch('patr');
    echo '<tr class="rowlink creator-row">';
    echo '<td class="idtable">' . $row['id'] . '</td>';
    echo '<th scope="row">' . $row['date'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $surnamex . " " . $namex . " " . $patrx .'</td>';
    echo '</tr>';
  endforeach;
