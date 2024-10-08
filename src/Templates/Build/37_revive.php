<?php
$artefact = count($database->getOwnUniqueArtefactInfo2($session->uid, 5, 3, 0));
$artefact1 = count($database->getOwnUniqueArtefactInfo2($village->wid, 5, 1, 1));
$artefact2 = count($database->getOwnUniqueArtefactInfo2($session->uid, 5, 2, 0));
if ($artefact > 0) {
    $artefact_bonus = 2;
    $artefact_bonus2 = 1;
} else if ($artefact1 > 0) {
    $artefact_bonus = 2;
    $artefact_bonus2 = 1;
} else if ($artefact2 > 0) {
    $artefact_bonus = 4;
    $artefact_bonus2 = 3;
} else {
    $artefact_bonus = 1;
    $artefact_bonus2 = 1;
}

if ($hero_info['unit'] == 1) {
    $name = U1;
} else if ($hero_info['unit'] == 2) {
    $name = U2;
} else if ($hero_info['unit'] == 3) {
    $name = U3;
} else if ($hero_info['unit'] == 5) {
    $name = U5;
} else if ($hero_info['unit'] == 6) {
    $name = U6;
} else if ($hero_info['unit'] == 11) {
    $name = U11;
} else if ($hero_info['unit'] == 12) {
    $name = U12;
} else if ($hero_info['unit'] == 13) {
    $name = U13;
} else if ($hero_info['unit'] == 15) {
    $name = U15;
} else if ($hero_info['unit'] == 16) {
    $name = U16;
} else if ($hero_info['unit'] == 21) {
    $name = U21;
} else if ($hero_info['unit'] == 22) {
    $name = U22;
} else if ($hero_info['unit'] == 24) {
    $name = U24;
} else if ($hero_info['unit'] == 25) {
    $name = U25;
} else if ($hero_info['unit'] == 26) {
    $name = U26;
}
if ($hero_info['level'] <= 60) {
    $wood = (${'h' . $hero_info['unit'] . '_full'}[$hero_info['level']]['wood']);
    $clay = (${'h' . $hero_info['unit'] . '_full'}[$hero_info['level']]['clay']);
    $iron = (${'h' . $hero_info['unit'] . '_full'}[$hero_info['level']]['iron']);
    $crop = (${'h' . $hero_info['unit'] . '_full'}[$hero_info['level']]['crop']);
    $training_time = $generator->getTimeFormat(round((${'h' . $hero_info['unit'] . '_full'}[$hero_info['level']]['time']) / SPEED * $artefact_bonus2 / $artefact_bonus));
    $training_time2 = time() + round((${'h' . $hero_info['unit'] . '_full'}[$hero_info['level']]['time']) / SPEED * $artefact_bonus2 / $artefact_bonus);
} else {
    $wood = (${'h' . $hero_info['unit'] . '_full'}[60]['wood']);
    $clay = (${'h' . $hero_info['unit'] . '_full'}[60]['clay']);
    $iron = (${'h' . $hero_info['unit'] . '_full'}[60]['iron']);
    $crop = (${'h' . $hero_info['unit'] . '_full'}[60]['crop']);
    $training_time = $generator->getTimeFormat(round((${'h' . $hero_info['unit'] . '_full'}[60]['time']) / SPEED * $artefact_bonus2 / $artefact_bonus));
    $training_time2 = time() + round((${'h' . $hero_info['unit'] . '_full'}[60]['time']) / SPEED * $artefact_bonus2 / $artefact_bonus);
}
?>

    <table cellpadding="1" cellspacing="1" class="build_details">
        <thead>
        <tr>
            <th colspan="2"><?php echo REVIVE; ?><?php echo U0; ?></th>
        </tr>
        </thead>

        <?php
        if ($hero_info['inrevive'] == 1) {
            $timeleft = $generator->getTimeFormat($hero_info['trainingtime'] - time());

            ?>
            <table id="distribution" cellpadding="1" cellspacing="1">
                <thead>
                <tr>
                    <?php echo "<tr class='next'><th>" . HERO_READY . " <span id=timer1>" . $timeleft . "</span></th></tr>"; ?>
                </tr>
                </thead>

                <tr>
                    <?php
                    echo "<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u" . $hero_info['unit'] . "\" src=\"img/x.gif\" alt=\"" . $name . "\" title=\"" . $name . "\" />
						$name ($name1)
					</div>"
                    ?>

                </tr>
            </table>
        <?php } else {
            if ($hero_info['unit'] == 1 or 11 or 21) { ?>
                <tr>
                    <td class="desc">
                        <div class="tit">
                            <img class="unit u<?php echo $hero_info['unit']; ?>" src="img/x.gif"
                                 alt="<?php echo $name; ?>" title="<?php echo $name; ?>"/>
                            <?php echo $name . " (Level " . $hero_info['level'] . ")"; ?>
                        </div>
                        <div class="details">
                            <img class="r1" src="img/x.gif" alt="Wood"
                                 title="<?php echo LUMBER; ?>"/><?php echo $wood; ?>|
                            <img class="r2" src="img/x.gif" alt="Clay" title="<?php echo CLAY; ?>"/><?php echo $clay; ?>
                            |
                            <img class="r3" src="img/x.gif" alt="Iron" title="<?php echo IRON; ?>"/><?php echo $iron; ?>
                            |
                            <img class="r4" src="img/x.gif" alt="Crop" title="<?php echo CROP; ?>"/><?php echo $crop; ?>
                            |
                            <img class="r5" src="img/x.gif" alt="Crop consumption" title="<?php echo CROP_COM; ?>"/>6|
                            <img class="clock" src="img/x.gif" alt="Duration" title="<?php echo DURATION; ?>"/>
                            <?php echo $training_time; ?>
                        </div>
                    </td>

                    <td class="val" width="20%">
                        <center>
                            <?php
                            if ($village->awood < $wood or $village->aclay < $clay or $village->airon < $iron or $village->acrop < $crop) {
                                echo "<span class=\"none\">" . NOT . "" . ENOUGH_RESOURCES . "</span>";
                            } else {
                                echo "<a href=\"build.php?id=" . $id . "&revive=1\">" . REVIVE . "</a>";
                            }

                            ?></center>
                    </td>
                </tr>
            <?php } else { ?>


                <?php if ($database->checkIfResearched($village->wid, 't' . $hero_info['unit']) != 0) { ?>
                    <tr>
                        <td class="desc">
                            <div class="tit">
                                <img class="unit u<?php echo $hero_info['unit']; ?>" src="img/x.gif"
                                     alt="<?php echo $name; ?>" title="<?php echo $name; ?>"/>
                                <?php echo $name . " (Level " . $hero_info['level'] . ")"; ?>
                            </div>
                            <div class="details">
                                <img class="r1" src="img/x.gif" alt="Wood"
                                     title="<?php echo LUMBER; ?>"/><?php echo $wood; ?>|
                                <img class="r2" src="img/x.gif" alt="Clay"
                                     title="<?php echo CLAY; ?>"/><?php echo $clay; ?>|
                                <img class="r3" src="img/x.gif" alt="Iron"
                                     title="<?php echo IRON; ?>"/><?php echo $iron; ?>|
                                <img class="r4" src="img/x.gif" alt="Crop"
                                     title="<?php echo CROP; ?>"/><?php echo $crop; ?>|
                                <img class="r5" src="img/x.gif" alt="Crop consumption" title="<?php echo CROP_COM; ?>"/>6|
                                <img class="clock" src="img/x.gif" alt="Duration" title="<?php echo DURATION; ?>"/>
                                <?php echo $training_time; ?>
                            </div>
                        </td>

                        <td class="val" width="20%">
                            <center>
                                <?php
                                if ($village->awood < $wood or $village->aclay < $clay or $village->airon < $iron or $village->acrop < $crop) {
                                    echo "<span class=\"none\">" . NOT . "" . ENOUGH_RESOURCES . "</span>";
                                } else {
                                    echo "<a href=\"build.php?id=" . $id . "&revive=1\">" . REVIVE . "</a>";
                                }

                                ?>
                            </center>
                        </td>
                    </tr>
                <?php }
            }
        } ?>

    </table>


<?php

if ($_GET['revive'] == 1 && $hero_info['inrevive'] == 0 && $hero_info['intraining'] == 0 && $hero_info['dead'] == 1) {
    if ($session->access != BANNED) {
        mysql_query("UPDATE hero SET `inrevive` = '1', `trainingtime` = '" . $training_time2 . "', `wref` = '" . $village->wid . "' WHERE `uid` = '" . $session->uid . "'");
        mysql_query("UPDATE vdata SET `wood` = `wood` - " . $wood . " WHERE `wref` = '" . $village->wid . "'");
        mysql_query("UPDATE vdata SET `clay` = `clay` - " . $clay . " WHERE `wref` = '" . $village->wid . "'");
        mysql_query("UPDATE vdata SET `iron` = `iron` - " . $iron . " WHERE `wref` = '" . $village->wid . "'");
        mysql_query("UPDATE vdata SET `crop` = `crop` - " . $crop . " WHERE `wref` = '" . $village->wid . "'");
        header("Location: build.php?id=" . $id . "");
    } else {
        header("Location: banned.php");
    }
}
if ($hero_info['inrevive'] == 0 && $hero_info['intraining'] == 0) {
    include("37_train.php");
}
?>
