<?php

$getheroinfo = mysql_query("SELECT * FROM hero  WHERE `uid`='" . $session->uid . "'"));
$heroinfo = mysql_fetch_array($getheroinfo);
echo $heroinfo['attackpower'];
$hero = array('atk' => 40 * $heroinfo['attackpower'], 'di' => 35, 'dc' => 50, 'wood' => 120, 'clay' => 100, 'iron' => 150, 'crop' => 30, 'pop' => 6, 'speed' => 6, 'time' => 1600, 'cap' => 0);
