<?php
//////////////     made by alq0rsan   /////////////////////////
if ($session->access != BANNED) {
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

                    if ($golds['b3'] < time()) {
                        mysql_query("UPDATE users set b3 = '" . (time() + PLUS_PRODUCTION) . "' where `id`='" . $session->uid . "'");
                    } else {
                        mysql_query("UPDATE users set b3 = '" . ($golds['b3'] + PLUS_PRODUCTION) . "' where `id`='" . $session->uid . "'");
                    }


                    $done1 = "+25% Production: Iron";
                    mysql_query("UPDATE users set gold = " . ($session->gold - 5) . " where `id`='" . $session->uid . "'");
                    mysql_query("INSERT INTO gold_fin_log VALUES ('" . (mysql_num_rows($goldlog) + 1) . "', '" . $village->wid . "', '+25%  Production: Iron')");

                } else {
                    $done1 = "nothing has been done";
                    mysql_query("INSERT INTO gold_fin_log VALUES ('" . (mysql_num_rows($goldlog) + 1) . "', '" . $village->wid . "', 'Failed +25%  Production: Iron')");

                }
            } else {
                $done1 = "You need more gold";
            }
        }
    }


    header("Location: plus.php?id=3");
} else {
    header("Location: banned.php");
}
?>
