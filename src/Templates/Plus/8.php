<?php
//////////////     made by alq0rsan   /////////////////////////
if ($session->access != BANNED && $session->gold >= 10) {
    $MyGold = mysql_query("SELECT * FROM users WHERE `id`='" . $session->uid . "'");
    $golds = mysql_fetch_array($MyGold);

    $MyId = mysql_query("SELECT * FROM users WHERE `id`='" . $session->uid . "'");
    $uuid = mysql_fetch_array($MyId);


    $MyVilId = mysql_query("SELECT * FROM bdata WHERE `wid`='" . $village->wid . "'");
    $uuVilid = mysql_fetch_array($MyVilId);


    $goldlog = mysql_query("SELECT * FROM gold_fin_log");

    $today = date("mdHi");
    if ($session->sit == 0) {
        if (mysql_num_rows($MyGold)) {
            if ($golds['6'] > 2) {

                if (mysql_num_rows($MyGold)) {


                    if ($golds['12'] == 0) {
                        mysql_query("UPDATE users set plus = ('" . mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")) . "')+" . PLUS_TIME . " where `id`='" . $session->uid . "'");
                    } else {
                        mysql_query("UPDATE users set plus = '" . ($golds['12'] + PLUS_TIME) . "' where `id`='" . $session->uid . "'");
                    }


                    $done1 = "&nbsp;&nbsp;Plus Account";
                    mysql_query("UPDATE users set gold = " . ($session->gold - 10) . " where `id`='" . $session->uid . "'");
                    mysql_query("INSERT INTO gold_fin_log VALUES ('" . (mysql_num_rows($goldlog) + 1) . "', '" . $village->wid . "', 'Plus Account')");

                } else {
                    $done1 = "nothing has been done";
                    mysql_query("INSERT INTO gold_fin_log VALUES ('" . (mysql_num_rows($goldlog) + 1) . "', '" . $village->wid . "', 'Failed Plus Account')");

                }
            } else {
                $done1 = "&nbsp;&nbsp;You need more gold";
            }
        }
    }


    header("Location: plus.php?id=3");
} else {
    header("Location: banned.php");
}
?>
