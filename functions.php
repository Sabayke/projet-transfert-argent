<?php
function userList($array) {
  $i=0;
  foreach($array as $user) {
    echo '<option value='.$i.'>';
    $array[$i]->get('name');
    echo '</option>';
    $i++;
  }
}
