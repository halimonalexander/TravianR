<?php

include_once("GameEngine/Data/hero_full.php");

if (isset($_POST['name'])) {
    $_POST['name'] = stripslashes($_POST['name']);
    mysql_query("UPDATE hero SET `name`='" . ($_POST['name']) . "' where `uid`='" . $session->uid . "'") or die("ERROR:" . mysql_error());
    $hero = mysql_query("SELECT * FROM hero WHERE `uid` = " . $session->uid . "");
    $hero_info = mysql_fetch_array($hero);
    echo "" . NAME_CHANGED . "";
}

$hero = $units->Hero($session->uid);
?>

<table id="distribution" cellpadding="1" cellspacing="1">
    <thead>
    <tr>
        <th colspan="5">
            <?php
            if (isset($_GET['rename'])) {
                echo "<form action=\"\" method=\"POST\"><input type=\"hidden\" name=\"userid\" value=\"" . $session->uid . "\"><input type=\"hidden\" name=\"hero\" value=\"1\"><input type=\"text\" class=\"text\" name=\"name\" maxlength=\"20\" value=\"" . $hero_info['name'] . "\">";
            } else {
                echo "<a href=\"build.php?id=" . $id . "&rename\">" . $hero_info['name'] . "</a></form>";
            }
            ?>
            <?php echo LEVEL; ?> <?php echo $hero_info['level']; ?> <span
                    class="info">( <?php echo "<img class=\"unit u" . $hero_info['unit'] . "\" src=\"img/x.gif\" alt=\"" . $technology->getUnitName($hero_info['unit']) . "\" title=\"" . $technology->getUnitName($hero_info['unit']) . "\" /> " . $technology->getUnitName($hero_info['unit']); ?> )</span>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th><?php echo OFFENCE; ?></th>
        <td class="val"><?php echo $hero['atk']; ?></td>
        <td class="xp"><img class="bar" src="img/x.gif" style="width:<?php echo (2 * $hero_info['attack']) + 1; ?>px;"
                            alt="<?php echo $hero['atk']; ?>" title="<?php echo $hero['atk']; ?>"/></td>
        <td class="up"><span class="none">
        <?php
        if ($hero_info['points'] > 0 && $hero_info['attack'] < 100) {
            if ($session->access != BANNED) {
                echo "<a href=\"build.php?id=" . $id . "&add=off\">(<b>+</b>)</a>";
            } else {
                header("Location: banned.php");
            }
        } else {
            echo "<span class=\"none\">(+)</span>";
        }
        ?>
        </td>
        <td class="po"><?php echo $hero_info['attack']; ?></td>
    </tr>
    <tr>
        <th><?php echo DEFENCE; ?></th>
        <td class="val"><?php echo $hero['di'] . "/" . $hero['dc']; ?></td>
        <td class="xp"><img class="bar" src="img/x.gif" style="width:<?php echo (2 * $hero_info['defence']) + 1; ?>px;"
                            alt="<?php echo ($hero['di']) . "/" . ($hero['dc']); ?>"
                            title="<?php echo ($hero['di']) . "/" . ($hero['dc']); ?>"/></td>
        <td class="up"><span class="none">
        <?php
        if ($hero_info['points'] > 0 && $hero_info['defence'] < 100) {
            if ($session->access != BANNED) {
                echo "<a href=\"build.php?id=" . $id . "&add=deff\">(<b>+</b>)</a>";
            } else {
                header("Location: banned.php");
            }
        } else {
            echo "<span class=\"none\">(+)</span>";
        }
        ?>
        </td>
        <td class="po"><?php echo $hero_info['defence']; ?></td>
    </tr>
    <tr>
        <th><?php echo OFF_BONUS; ?></th>
        <td class="val"><?php echo ($hero['ob'] - 1) * 100; ?>%</td>
        <td class="xp"><img class="bar" src="img/x.gif" style="width:<?php echo ($hero['ob'] - 1) * 1000 + 1; ?>px;"
                            alt="<?php echo ($hero['ob'] - 1) * 100; ?>%"
                            title="<?php echo ($hero['ob'] - 1) * 100; ?>%"/></td>
        <td class="up"><span class="none">
        <?php
        if ($hero_info['points'] > 0 && $hero_info['attackbonus'] < 100) {
            if ($session->access != BANNED) {
                echo "<a href=\"build.php?id=" . $id . "&add=obonus\">(<b>+</b>)</a>";
            } else {
                header("Location: banned.php");
            }

        } else {
            echo "<span class=\"none\">(+)</span>";
        }
        ?>
        </td>
        <td class="po"><?php echo $hero_info['attackbonus']; ?></td>
    </tr>
    <tr>
        <th><?php echo DEF_BONUS; ?></th>
        <td class="val"><?php echo ($hero['db'] - 1) * 100; ?>%</td>
        <td class="xp"><img class="bar" src="img/x.gif" style="width:<?php echo ($hero['db'] - 1) * 1000 + 1; ?>px;"
                            alt="<?php echo ($hero['db'] - 1) * 100; ?>%"
                            title="<?php echo ($hero['db'] - 1) * 100; ?>%"/></td>
        <td class="up"><span class="none">
        <?php
        if ($hero_info['points'] > 0 && $hero_info['defencebonus'] < 100) {
            if ($session->access != BANNED) {
                echo "<a href=\"build.php?id=" . $id . "&add=dbonus\">(<b>+</b>)</a>";
            } else {
                header("Location: banned.php");
            }

        } else {
            echo "<span class=\"none\">(+)</span>";
        }
        ?>
        </td>
        <td class="po"><?php echo $hero_info['defencebonus']; ?></td>
    </tr>
    <tr>
        <th><?php echo REGENERATION; ?></th>
        <td class="val"><?php echo($hero_info['regeneration'] * 5 * SPEED); ?>/<?php echo DAY; ?></td>
        <td class="xp"><img class="bar" src="img/x.gif"
                            style="width:<?php echo ($hero_info['regeneration'] * 2) + 1; ?>px;"
                            alt="<?php echo($hero_info['regeneration'] * 5 * SPEED); ?>%/Day"
                            title="<?php echo($hero_info['regeneration'] * 5 * SPEED); ?>%/Day"/></td>
        <td class="up"><span class="none">
        <?php
        if ($hero_info['points'] > 0 && $hero_info['regeneration'] < 100) {
            if ($session->access != BANNED) {
                echo "<a href=\"build.php?id=" . $id . "&add=reg\">(<b>+</b>)</a>";
            } else {
                header("Location: banned.php");
            }

        } else {
            echo "<span class=\"none\">(+)</span>";
        }
        ?>
        </td>
        <td class="po"><?php echo $hero_info['regeneration']; ?></td>
    </tr>
    <tr>
        <td colspan="5" class="empty"></td>
    </tr>
    <tr>
        <?php if ($hero_info['experience'] < 495000) { ?>
            <th title="until the next level"><?php echo EXPERIENCE; ?>:</th>
            <td class="val"><?php echo (int)(($hero_info['experience'] - $hero_levels[$hero_info['level']]) / ($hero_levels[$hero_info['level'] + 1] - $hero_levels[$hero_info['level']]) * 100) ?>
                %
            </td>
            <td class="xp"><img class="bar" src="img/x.gif"
                                style="width:<?php echo ($hero_info['experience'] - $hero_levels[$hero_info['level']]) / ($hero_levels[$hero_info['level'] + 1] - $hero_levels[$hero_info['level']]) * 100 * 2 ?>px;"
                                alt="<?php echo ($hero_info['experience'] - $hero_levels[$hero_info['level']]) / ($hero_levels[$hero_info['level'] + 1] - $hero_levels[$hero_info['level']]) * 100 ?>%"
                                title="<?php echo ($hero_info['experience'] - $hero_levels[$hero_info['level']]) / ($hero_levels[$hero_info['level'] + 1] - $hero_levels[$hero_info['level']]) * 100 ?>%"/>
            </td>
            <td class="up"></td>
            <td class="rem"><?php echo $hero_info['points']; ?></td>
        <?php } else { ?>
            <th title="until the next level"><?php echo EXPERIENCE; ?>:</th>
            <td class="val">100%</td>
            <td class="xp"><img class="bar" src="img/x.gif" style="width:200px;" alt="100%" title="100%"/></td>
            <td class="up"></td>
            <td class="rem"><?php echo $hero_info['points']; ?></td>
        <?php } ?>
    </tr>
    </tbody>
</table>
<?php if (isset($_GET['e'])) {
    echo "<p><font size=\"1\" color=\"red\"><b>" . ERROR_NAME_SHORT . "</b></font></p>";
}
?>
<?php if ($hero_info['level'] <= 3) { ?>
    <p><?php echo YOU_CAN; ?> <a
                href="build.php?id=<?php echo $id; ?>&add=reset"><?php echo RESET; ?></a><?php echo YOUR_POINT_UNTIL; ?>
        <b>3</b><?php echo OR_LOWER; ?> </p>
<?php } ?>

<p><?php echo YOUR_HERO_HAS; ?> <b><?php echo floor($hero_info['health']); ?></b>% <?php echo OF_HIT_POINTS; ?>.<br/>
    <?php echo YOUR_HERO_HAS; ?> <?php echo CONQUERED; ?>
    <b><?php echo $database->VillageOasisCount($village->wid); ?></b> <a
            href="build.php?id=<?php echo $id; ?>&land"><?php echo OASES; ?></a>.</p>

<?php

if (isset($_GET['add'])) {
    if ($_GET['add'] == "reset") {
        if ($hero_info['level'] <= 3) {
            if ($hero_info['attack'] != 0 or $hero_info['defence'] != 0 or $hero_info['attackbonus'] != 0 or $hero_info['defencebonus'] != 0 or $hero_info['regeneration'] != 0) {
                mysql_query("UPDATE hero SET `points` = '" . (($hero_info['level'] * 5) + 5) . "' WHERE `uid` = '" . $session->uid . "'");
                mysql_query("UPDATE hero SET `attack` = '0' WHERE `uid` = '" . $session->uid . "'");
                mysql_query("UPDATE hero SET `defence` = '0' WHERE `uid` = '" . $session->uid . "'");
                mysql_query("UPDATE hero SET `attackbonus` = '0' WHERE `uid` = '" . $session->uid . "'");
                mysql_query("UPDATE hero SET `defencebonus` = '0' WHERE `uid` = '" . $session->uid . "'");
                mysql_query("UPDATE hero SET `regeneration` = '0' WHERE `uid` = '" . $session->uid . "'");
                header("Location: build.php?id=" . $id . "");
            }
        }
    }
    if ($_GET['add'] == "off" && $hero_info['attack'] < 100) {
        if ($hero_info['points'] > 0) {
            mysql_query("UPDATE hero SET `attack` = `attack` + 1 WHERE `uid` = '" . $session->uid . "'");
            mysql_query("UPDATE hero SET `points` = `points` - 1 WHERE `uid` = '" . $session->uid . "'");
            header("Location: build.php?id=" . $id . "");
        }
    }
    if ($_GET['add'] == "deff" && $hero_info['defence'] < 100) {
        if ($hero_info['points'] > 0) {
            mysql_query("UPDATE hero SET `defence` = `defence` + 1 WHERE `uid` = '" . $session->uid . "'");
            mysql_query("UPDATE hero SET `points` = `points` - 1 WHERE `uid` = '" . $session->uid . "'");
            header("Location: build.php?id=" . $id . "");
        }
    }
    if ($_GET['add'] == "obonus" && $hero_info['attackbonus'] < 100) {
        if ($hero_info['points'] > 0) {
            mysql_query("UPDATE hero SET `attackbonus` = `attackbonus` + 1 WHERE `uid` = '" . $session->uid . "'");
            mysql_query("UPDATE hero SET `points` = `points` - 1 WHERE `uid` = '" . $session->uid . "'");
            header("Location: build.php?id=" . $id . "");
        }
    }
    if ($_GET['add'] == "dbonus" && $hero_info['defencebonus'] < 100) {
        if ($hero_info['points'] > 0) {
            mysql_query("UPDATE hero SET `defencebonus` = `defencebonus` + 1 WHERE `uid` = '" . $session->uid . "'");
            mysql_query("UPDATE hero SET `points` = `points` - 1 WHERE `uid` = '" . $session->uid . "'");
            header("Location: build.php?id=" . $id . "");
        }
    }
    if ($_GET['add'] == "reg" && $hero_info['regeneration'] < 100) {
        if ($hero_info['points'] > 0) {
            mysql_query("UPDATE hero SET `regeneration` = `regeneration` + 1 WHERE `uid` = '" . $session->uid . "'");
            mysql_query("UPDATE hero SET `points` = `points` - 1 WHERE `uid` = '" . $session->uid . "'");
            header("Location: build.php?id=" . $id . "");
        }
    }
}
?>
