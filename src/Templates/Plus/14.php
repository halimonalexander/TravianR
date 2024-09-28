<?php
//////////////     made by alq0rsan   /////////////////////////
if ($session->access != BANNED) {
    $MyGold = mysql_query("SELECT * FROM users WHERE `id`='" . $session->uid . "'");
    $golds = mysql_fetch_array($MyGold);

    $MyVilId = mysql_query("SELECT * FROM vdata WHERE `wref`='" . $village->wid . "'");
    $uuVilid = mysql_fetch_array($MyVilId);

    $totalT = ($T1 + $T2 + $T3 + $T4);
    $totalR = ($uuVilid['6'] + $uuVilid['7'] + $uuVilid['8'] + $uuVilid['10']);

    $goldlog = mysql_query("SELECT * FROM gold_fin_log");

    if ($totalT <= $totalR) {
        mysql_query("UPDATE vdata set wood = '" . $T1 . "' where `wref`='" . $village->wid . "'");
        mysql_query("UPDATE vdata set clay = '" . $T2 . "' where `wref`='" . $village->wid . "'");
        mysql_query("UPDATE vdata set iron = '" . $T3 . "' where `wref`='" . $village->wid . "'");
        mysql_query("UPDATE vdata set crop = '" . $T4 . "' where `wref`='" . $village->wid . "'");
        mysql_query("UPDATE users set gold = " . ($session->gold - 3) . " where `id`='" . $session->uid . "'");
        mysql_query("INSERT INTO gold_fin_log VALUES ('" . (mysql_num_rows($goldlog) + 1) . "', '" . $village->wid . "', 'trade 1:1')");
        echo "done";
    } else {
        echo "failed";
        mysql_query("INSERT INTO gold_fin_log VALUES ('" . (mysql_num_rows($goldlog) + 1) . "', '" . $village->wid . "', 'Failed trade 1:1')");

    }

    header("Location: plus.php?id=3");
} else {
    header("Location: banned.php");
}
?>
