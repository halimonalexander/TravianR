<div id="content" class="map">
    <?php
    $basearray = $database->getMInfo($_GET['d']);
    $uinfo = $database->getVillage($basearray['id']);
    $oasis1 = mysql_query('SELECT * FROM `odata` WHERE `wref` = ' . mysql_real_escape_string($_GET['d']));
    $oasis = mysql_fetch_assoc($oasis1);
    $access = $session->access;
    ?>
    <h1><?php if ($basearray['fieldtype'] != 0) {
            echo !$basearray['occupied'] ? ABANDVALLEY : $basearray['name'];
            echo " (" . $basearray['x'] . "|" . $basearray['y'] . ")";
        } else {
            echo !$oasis['conqured'] ? UNOCCUOASIS : OCCUOASIS;
            echo " (" . $basearray['x'] . "|" . $basearray['y'] . ")";
            $otext = !$oasis['conqured'] ? UNOCCUOASIS : OCCUOASIS;
        } ?></h1>
    <?php if ($basearray['occupied'] && $basearray['capital']) {
        echo "<div id=\"dmain\">(capital)</div>";
    }
    if ($uinfo['owner'] == 3 && $uinfo['name'] == PLANVILLAGE){
        ?>
        <img src="img/x.gif" id="detailed_map" class="f99" alt="<?php echo PLANVILLAGE; ?>"/>
    <?php }else{ ?>
    <img src="img/x.gif" id="detailed_map"
         class="<?php echo ($basearray['fieldtype'] == 0) ? 'w' . $basearray['oasistype'] : 'f' . $basearray['fieldtype'] ?>"
         alt="<?php
         switch ($basearray['fieldtype']) {
             case 1:
                 $tt = "3-3-3-9";
                 break;
             case 2:
                 $tt = "3-4-5-6";
                 break;
             case 3:
                 $tt = "4-4-4-6";
                 break;
             case 4:
                 $tt = "4-5-3-6";
                 break;
             case 5:
                 $tt = "5-3-4-6";
                 break;
             case 6:
                 $tt = "1-1-1-15";
                 break;
             case 7:
                 $tt = "4-4-3-7";
                 break;
             case 8:
                 $tt = "3-4-4-7";
                 break;
             case 9:
                 $tt = "4-3-4-7";
                 break;
             case 10:
                 $tt = "3-5-4-6";
                 break;
             case 11:
                 $tt = "4-3-5-6";
                 break;
             case 12:
                 $tt = "5-4-3-6";
                 break;
             case 0:
                 switch ($basearray['oasistype']) {
                     case 1:
                     case 2:
                         $tt = "+25% " . LUMBER . " " . PERHOUR . "\" title=\"+25% " . LUMBER . " " . PERHOUR;
                         $ttt = "<td class=\"ico\"><img class=\"r1\" src=\"img/x.gif\" title=\"" . LUMBER . "\"> 25% " . LUMBER . "</td>";
                         break;
                     case 3:
                         $tt = "+25% " . LUMBER . " and +25% " . CROP . " " . PERHOUR . "\" title=\"+25% " . LUMBER . " and +25% " . CROP . " " . PERHOUR;
                         $ttt = "<td class=\"ico\"><img class=\"r1\" src=\"img/x.gif\" title=\"" . LUMBER . "\"> 25% " . LUMBER . "</td>
		<tr><td class=\"ico\"><img class=\"r4\" src=\"img/x.gif\" title=\"" . CROP . "\"> 25% " . CROP . "</td></tr>";
                         break;
                     case 4:
                     case 5:
                         $tt = "+25% " . CLAY . " " . PERHOUR . "\" title=\"+25% " . CLAY . " " . PERHOUR;
                         $ttt = "<td class=\"ico\"><img class=\"r2\" src=\"img/x.gif\" title=\"" . CLAY . "\"> 25% " . CLAY . "</td>";
                         break;
                     case 6:
                         $tt = "+25% " . CLAY . " and +25% " . CROP . " " . PERHOUR . "\" title=\"+25% " . CLAY . " and +25% " . CROP . " " . PERHOUR;
                         $ttt = "<td class=\"ico\"><img class=\"r2\" src=\"img/x.gif\" title=\"" . CLAY . "\"> 25% " . CLAY . "</td>
		<tr><td class=\"ico\"><img class=\"r4\" src=\"img/x.gif\" title=\"" . CROP . "\"> 25% " . CROP . "</td></tr>";
                         break;
                     case 7:
                     case 8:
                         $tt = "+25% " . IRON . " " . PERHOUR . "\" title=\"+25% " . IRON . " " . PERHOUR;
                         $ttt = "<td class=\"ico\"><img class=\"r3\" src=\"img/x.gif\" title=\"" . IRON . "\"> 25% " . IRON . "</td>";
                         break;
                     case 9:
                         $tt = "+25% " . IRON . " and +25% " . CROP . " " . PERHOUR . "\" title=\"+25% " . IRON . " and +25% " . CROP . " " . PERHOUR;
                         $ttt = "<td class=\"ico\"><img class=\"r3\" src=\"img/x.gif\" title=\"" . IRON . "\"> 25% " . IRON . "</td>
		<tr><td class=\"ico\"><img class=\"r4\" src=\"img/x.gif\" title=\"" . CROP . "\"> 25% " . CROP . "</td></tr>";
                         break;
                     case 10:
                     case 11:
                         $tt = "+25% " . CROP . " " . PERHOUR . "\" title=\"+25% " . CROP . " " . PERHOUR;
                         $ttt = "<td class=\"ico\"><img class=\"r4\" src=\"img/x.gif\" title=\"" . CROP . "\"> 25% " . CROP . "</td>";
                         break;
                     case 12:
                         $tt = "+50% " . CROP . " " . PERHOUR . "\" title=\"+50% " . CROP . " " . PERHOUR;
                         $ttt = "<td class=\"ico\"><img class=\"r4\" src=\"img/x.gif\" title=\"" . CROP . "\"> 50% " . CROP . "</td>";
                         break;
                 }
                 break;
         }
         echo $tt . "\"";
         $landd = explode("-", $tt); ?> />
<?php } ?>
<div id=" map_details">
    <?php if ($basearray['fieldtype'] == 0) {
        if ($oasis['owner'] == 2) {
            ?>
            <table cellpadding="1" cellspacing="1" id="bonus" class="tableNone bonus">
                <thead>
                <tr>
                    <th>Bonus:</th>
                </tr>
                </thead>
                <tbody>
                <?php
                echo $ttt;
                ?>
                </tbody>
            </table>

            <table cellpadding="1" cellspacing="1" id="troop_info" class="tableNone">
                <thead>
                <tr>
                    <th colspan="3"><?php echo TROOP; ?>:</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $unit = $database->getUnit($_GET['d']);
                $unarray = array(31 => U31, U32, U33, U34, U35, U36, U37, U38, U39, U40);
                $a = 0;
                for ($i = 31; $i <= 40; $i++) {
                    if ($unit['u' . $i]) {
                        echo '<tr>';
                        echo '<td class="ico"><img class="unit u' . $i . '" src="img/x.gif" alt="' . $unarray[$i] . '" title="' . $unarray[$i] . '" /></td>';
                        echo '<td class="val">' . $unit['u' . $i] . '</td>';
                        echo '<td class="desc">' . $unarray[$i] . '</td>';
                        echo '</tr>';
                    } else {
                        $a = $a + 1;
                    }
                }
                if ($a == 10) {
                    echo '<tr><td><?php echo NOTROOP;?></td></tr>';
                }


                ?>
                </tbody>
            </table>

            <table cellpadding="1" cellspacing="1" id="troop_info" class="tableNone rep">
                <thead>
                <tr>
                    <th><?php echo REPORT; ?>:</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($session->uid == $database->getVillage($_GET['d'])) {
                    $limit = "ntype=0 and ntype=4 and ntype=5 and ntype=6 and ntype=7";
                } else {
                    $limit = "ntype!=8 and ntype!=9 and ntype!=10 and ntype!=11 and ntype!=12 and ntype!=13 and ntype!=14 AND ntype!=15 AND ntype!=16 AND ntype!=17";
                }
                $toWref = $_GET['d'];
                if ($session->alliance != 0) {
                    $result = mysql_query("SELECT * FROM ndata WHERE $limit AND ally = " . $session->alliance . " AND toWref = " . $toWref . " ORDER BY time DESC Limit 5");
                    $query = mysql_num_rows($result);
                    if ($query != 0) {
                        while ($row = mysql_fetch_array($result)) {
                            $dataarray = explode(",", $row['data']);
                            $type = $row['ntype'];
                            $topic = $row['topic'];
                            echo "<tr><td>";
                            if ($type == 18 or $type == 19 or $type == 20 or $type == 21) {
                                echo "<img src=\"gpack/travian_default/img/scouts/$type.gif\" alt=\"" . $topic . "\" title=\"" . $topic . "\" />";
                            } else {
                                echo "<img src=\"img/x.gif\" class=\"iReport iReport" . $row['ntype'] . "\" title=\"" . $topic . "\"> ";
                            }
                            $date = $generator->procMtime($row['time']);
                            echo "<a href=\"berichte.php?id=" . $row['id'] . "&vill=" . $row['id'] . "\">" . $date[0] . " " . date('H:i', $row['time']) . "</a> ";
                            echo "</td></tr>";
                        }
                    } else { ?>
                        <tr>
                            <td><?php echo THERENOINFO; ?></td>
                        </tr>

                    <?php }
                } else {
                    $result = mysql_query("SELECT * FROM ndata WHERE uid = " . $session->uid . " AND toWref = " . $toWref . " ORDER BY time DESC Limit 5");
                    $query = mysql_num_rows($result);
                    if ($query != 0) {
                        while ($row = mysql_fetch_array($result)) {
                            $dataarray = explode(",", $row['data']);
                            $type = $row['ntype'];
                            $topic = $row['topic'];
                            echo "<tr><td>";
                            if ($type == 18 or $type == 19 or $type == 20 or $type == 21) {
                                echo "<img src=\"gpack/travian_default/img/scouts/$type.gif\" alt=\"" . $topic . "\" title=\"" . $topic . "\" />";
                            } else {
                                echo "<img src=\"img/x.gif\" class=\"iReport iReport" . $row['ntype'] . "\" title=\"" . $topic . "\"> ";
                            }
                            $date = $generator->procMtime($row['time']);
                            echo "<a href=\"berichte.php?id=" . $row['id'] . "&vill=" . $row['id'] . "\">" . $date[0] . " " . date('H:i', $row['time']) . "</a> ";
                            echo "</td></tr>";
                        }
                    } else { ?>
                        <tr>
                            <td><?php echo THERENOINFO; ?></td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
            <?php
        } else {
            ?>
            <table cellpadding="1" cellspacing="1" id="village_info" class="tableNone">
                <?php
                $uinfo = $database->getUserArray($oasis['owner'], 1); ?>
                <tbody>
                <tr>
                    <th>Tribe</th>
                    <td><?php switch ($uinfo['tribe']) {
                            case 1:
                                echo TRIBE1;
                                break;
                            case 2:
                                echo TRIBE2;
                                break;
                            case 3:
                                echo TRIBE3;
                                break;
                            case 4:
                                echo TRIBE4;
                                break;
                            case 5:
                                echo TRIBE5;
                                break;
                        } ?></td>
                </tr>
                <tr>
                    <th>Alliance</th>
                    <?php if ($uinfo['alliance'] == 0) {
                        echo '<td>-</td>';
                    } else echo '
			<td><a href="allianz.php?aid=' . $uinfo['alliance'] . ' ">' . $database->getUserAlliance($oasis['owner']) . '</a></td>'; ?>
                </tr>
                <tr>
                    <th>Owner</th>
                    <td>
                        <a href="spieler.php?uid=<?php echo $oasis['owner']; ?>"><?php echo $database->getUserField($oasis['owner'], 'username', 0); ?></a>
                    </td>
                </tr>
                <tr>
                    <th>Village</th>
                    <td>
                        <a href="karte.php?d=<?php echo $oasis['conqured']; ?>&c=<?php echo $generator->getMapCheck($oasis['conqured']); ?>"><?php echo $database->getVillageField($oasis['conqured'], "name"); ?> </a>
                    </td>
                </tr>
                </tbody>
            </table>

            <table cellpadding="1" cellspacing="1" id="bonus" class="tableNone bonus">
                <thead>
                <tr>
                    <th>Bonus:</th>
                </tr>
                </thead>
                <tbody>
                <?php
                echo $ttt;
                ?>
                </tbody>
            </table>

            <table cellpadding="1" cellspacing="1" id="troop_info" class="tableNone rep">
                <thead>
                <tr>
                    <th>Reports:</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($session->uid == $database->getVillage($_GET['d'])) {
                    $limit = "ntype=0 and ntype=4 and ntype=5 and ntype=6 and ntype=7 and ntype=20 and ntype=21";
                } else {
                    $limit = "ntype!=8 and ntype!=9 and ntype!=10 and ntype!=11 and ntype!=12 and ntype!=13 and ntype!=14 and ntype!=15 and ntype!=16 and ntype!=17";
                }
                $toWref = $_GET['d'];
                if ($session->alliance != 0) {
                    $result = mysql_query("SELECT * FROM ndata WHERE $limit AND ally = " . $session->alliance . " AND toWref = " . $toWref . " ORDER BY time DESC Limit 5");
                    $query = mysql_num_rows($result);
                    if ($query != 0) {
                        while ($row = mysql_fetch_array($result)) {
                            $dataarray = explode(",", $row['data']);
                            $type = $row['ntype'];
                            $topic = $row['topic'];
                            echo "<tr><td>";
                            if ($type == 18 or $type == 19 or $type == 20 or $type == 21) {
                                echo "<img src=\"gpack/travian_default/img/scouts/$type.gif\" alt=\"" . $topic . "\" title=\"" . $topic . "\" />";
                            } else {
                                echo "<img src=\"img/x.gif\" class=\"iReport iReport" . $row['ntype'] . "\" title=\"" . $topic . "\"> ";
                            }
                            $date = $generator->procMtime($row['time']);
                            echo "<a href=\"berichte.php?id=" . $row['id'] . "&vill=" . $row['id'] . "\">" . $date[0] . " " . date('H:i', $row['time']) . "</a> ";
                            echo "</td></tr>";
                        }
                    } else { ?>
                        <tr>
                            <td><?php echo THERENOINFO; ?></td>
                        </tr>

                    <?php }
                } else {
                    $result = mysql_query("SELECT * FROM ndata WHERE uid = " . $session->uid . " AND toWref = " . $toWref . " ORDER BY time DESC Limit 5");
                    $query = mysql_num_rows($result);
                    if ($query != 0) {
                        while ($row = mysql_fetch_array($result)) {
                            $dataarray = explode(",", $row['data']);
                            $type = $row['ntype'];
                            $topic = $row['topic'];
                            echo "<tr><td>";
                            if ($type == 18 or $type == 19 or $type == 20 or $type == 21) {
                                echo "<img src=\"gpack/travian_default/img/scouts/$type.gif\" alt=\"" . $topic . "\" title=\"" . $topic . "\" />";
                            } else {
                                echo "<img src=\"img/x.gif\" class=\"iReport iReport" . $row['ntype'] . "\" title=\"" . $topic . "\"> ";
                            }
                            $date = $generator->procMtime($row['time']);
                            echo "<a href=\"berichte.php?id=" . $row['id'] . "&vill=" . $row['id'] . "\">" . $date[0] . " " . date('H:i', $row['time']) . "</a> ";
                            echo "</td></tr>";
                        }
                    } else { ?>
                        <tr>
                            <td><?php echo THERENOINFO; ?></td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
            <?php
        }
    } else if (!$basearray['occupied']) {
        ?>
        <table cellpadding="1" cellspacing="1" id="distribution" class="tableNone">

            <thead>
            <tr>
                <th colspan="3"><?php echo LANDDIST; ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="ico"><img class="r1" src="img/x.gif" alt="<?php echo LUMBER; ?>"
                                     title="<?php echo LUMBER; ?>"/></td>
                <td class="val"><?php echo $landd['0']; ?></td>
                <td class="desc"><?php echo WOODCUTTER; ?></td>

            </tr>
            <tr>
                <td class="ico"><img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>"/>
                </td>
                <td class="val"><?php echo $landd['1']; ?></td>
                <td class="desc"><?php echo CLAYPIT; ?></td>
            </tr>
            <tr>
                <td class="ico"><img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>"/>
                </td>

                <td class="val"><?php echo $landd['2']; ?></td>
                <td class="desc"><?php echo IRONMINE; ?></td>
            </tr>
            <tr>
                <td class="ico"><img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>"/>
                </td>
                <td class="val"><?php echo $landd['3']; ?></td>
                <td class="desc"><?php echo CROPLAND; ?></td>

            </tr>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <table cellpadding="1" cellspacing="1" id="village_info" class="tableNone">
            <!--<thead>
			<th colspan="2"><div><?php echo $basearray['name']; ?></div>&nbsp;(<?php echo $basearray['x']; ?>|<?php echo $basearray['y']; ?>)</th>
		</tr></thead>-->
            <?php
            $uinfo = $database->getUserArray($basearray['owner'], 1); ?>
            <tbody>
            <tr>
                <th><?php echo TRIBE; ?></th>
                <td><?php switch ($uinfo['tribe']) {
                        case 1:
                            echo TRIBE1;
                            break;
                        case 2:
                            echo TRIBE2;
                            break;
                        case 3:
                            echo TRIBE3;
                            break;
                        case 4:
                            echo TRIBE4;
                            break;
                        case 5:
                            echo TRIBE5;
                            break;
                    } ?></td>
            </tr>
            <tr>
                <th><?php echo ALLIANCE; ?></th>
                <?php if ($uinfo['alliance'] == 0) {
                    echo '<td>-</td>';
                } else echo '
			<td><a href="allianz.php?aid=' . $uinfo['alliance'] . ' ">' . $database->getUserAlliance($basearray['owner']) . '</a></td>'; ?>
            </tr>
            <tr>
                <th><?php echo OWNER; ?></th>
                <td>
                    <a href="spieler.php?uid=<?php echo $basearray['owner']; ?>"><?php echo $database->getUserField($basearray['owner'], 'username', 0); ?></a>
                </td>
            </tr>
            <tr>
                <th><?php echo POP; ?></th>
                <td><?php echo $basearray['pop']; ?></td>
            </tr>
            </tbody>
        </table>

        <table cellpadding="1" cellspacing="1" id="troop_info" class="tableNone rep">
            <thead>
            <tr>
                <th><?php echo REPORT; ?>:</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($session->uid == $database->getVillage($_GET['d'])) {
                $limit = "ntype=0 and ntype=4 and ntype=5 and ntype=6 and ntype=7";
            } else {
                $limit = "ntype!=8 and ntype!=9 and ntype!=10 and ntype!=11 and ntype!=12 and ntype!=13 and ntype!=14 AND ntype!=15 AND ntype!=16 AND ntype!=17";
            }
            $toWref = $_GET['d'];
            if ($session->alliance != 0) {
                $result = mysql_query("SELECT * FROM ndata WHERE $limit AND ally = " . $session->alliance . " AND toWref = " . $toWref . " ORDER BY time DESC Limit 5");
                $query = mysql_num_rows($result);
                if ($query != 0) {
                    while ($row = mysql_fetch_array($result)) {
                        $dataarray = explode(",", $row['data']);
                        $type = $row['ntype'];
                        $topic = $row['topic'];
                        echo "<tr><td>";
                        if ($type == 18 or $type == 19 or $type == 20 or $type == 21 or $type == 22) {
                            echo "<img src=\"gpack/travian_default/img/scouts/$type.gif\" alt=\"" . $topic . "\" title=\"" . $topic . "\" />";
                        } else {
                            echo "<img src=\"img/x.gif\" class=\"iReport iReport" . $row['ntype'] . "\" title=\"" . $topic . "\"> ";
                        }
                        $date = $generator->procMtime($row['time']);
                        echo "<a href=\"berichte.php?id=" . $row['id'] . "&vill=" . $row['id'] . "\" title=\"" . $topic . "\">" . $date[0] . " " . date('H:i', $row['time']) . "</a> ";
                        echo "</td></tr>";
                    }
                } else { ?>
                    <tr>
                        <td><?php echo THERENOINFO; ?></td>
                    </tr>

                <?php }
            } else {
                $result = mysql_query("SELECT * FROM ndata WHERE $limit AND uid = " . $session->uid . " AND toWref = " . $toWref . " ORDER BY time DESC Limit 5");
                $query = mysql_num_rows($result);
                if ($query != 0) {
                    while ($row = mysql_fetch_array($result)) {
                        $dataarray = explode(",", $row['data']);
                        $type = $row['ntype'];
                        $topic = $row['topic'];
                        echo "<tr><td>";
                        if ($type == 18 or $type == 19 or $type == 20 or $type == 21) {
                            echo "<img src=\"gpack/travian_default/img/scouts/$type.gif\" alt=\"" . $topic . "\" title=\"" . $topic . "\" />";
                        } else {
                            echo "<img src=\"img/x.gif\" class=\"iReport iReport" . $row['ntype'] . "\" title=\"" . $topic . "\"> ";
                        }
                        $date = $generator->procMtime($row['time']);
                        echo "<a href=\"berichte.php?id=" . $row['id'] . "&vill=" . $row['id'] . "\">" . $date[0] . " " . date('H:i', $row['time']) . "</a> ";
                        echo "</td></tr>";
                    }
                } else { ?>
                    <tr>
                        <td><?php echo THERENOINFO; ?></td>
                    </tr>

                <?php }
            } ?>
            </tbody>
        </table>
    <?php } ?>
</div>
<table cellpadding="1" cellspacing="1" id="options" class="tableNone">
    <thead>
    <tr>
        <th><?php echo OPTION; ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>

        <td><a href="karte.php?z=<?php echo $_GET['d']; ?>">&raquo; <?php echo CENTREMAP; ?>.</a></td>
    </tr>
    <?php if (!$basearray['occupied']) { ?>

        <tr>
            <td class="none"><?php
                $mode = CP;
                $total = count($database->getProfileVillages($session->uid));
                $need_cps = ${'cp' . $mode}[$total + 1];
                $cps = floor($database->getUserField($session->uid, 'cp', 0));

                if ($cps >= $need_cps) {
                    $enough_cp = true;
                } else {
                    $enough_cp = false;
                }


                if ($village->unitarray['u' . $session->tribe . '0'] >= 3 and $enough_cp and $village->resarray['f39']) {
                    $test = "<a href=\"a2b.php?id=" . $_GET['d'] . "&amp;s=1\">&raquo;  " . FNEWVILLAGE . "</a>";
                } elseif ($village->unitarray['u' . $session->tribe . '0'] >= 3 and !$enough_cp) {
                    $test = "&raquo; " . FNEWVILLAGE . " ($cps/$need_cps " . CULTUREPOINT . ")";
                } elseif (!$village->resarray['f39']) {
                    $test = "&raquo; " . FNEWVILLAGE . " (" . BUILDRALLY . ")";
                } else {
                    $test = "&raquo; " . FNEWVILLAGE . " (" . $village->unitarray['u' . $session->tribe . '0'] . "/3 " . SETTLERSAVAIL . ")";
                }

                echo ($basearray['fieldtype'] == 0) ?
                    ($village->resarray['f39'] == 0) ?
                        ($basearray['owner'] == $session->uid) ?

                            "<a href=\"build.php?id=39\">&raquo; " . RAID . " $otext " . OASIS . " (" . BUILDRALLY . ")</a>" :
                            "&raquo; " . RAID . " $otext " . OASIS . " (" . BUILDRALLY . ")" :
                        "<a href=\"a2b.php?z=" . $_GET['d'] . "&o\">&raquo; " . RAID . " $otext</a>" :
                    "$test"
                ?>
        </tr>
    <?php } else if ($basearray['occupied'] && $basearray['wref'] != $_SESSION['wid']) { ?>
        <tr>
            <td class="none">
                <?php
                if ($basearray['fieldtype'] == 0) {
                    $query1 = mysql_query('SELECT * FROM `odata` WHERE `wref` = ' . mysql_escape_string($_GET['d']));
                } else {
                    $query1 = mysql_query('SELECT * FROM `vdata` WHERE `wref` = ' . mysql_real_escape_string($_GET['d']));
                }
                $data1 = mysql_fetch_assoc($query1);
                $query2 = mysql_query('SELECT * FROM `users` WHERE `id` = ' . $data1['owner']);
                $data2 = mysql_fetch_assoc($query2);
                if ($data2['access'] == '0' or $data2['access'] == '8' or $data2['access'] == '9') {
                    echo "&raquo; " . SENDTROOP . " (" . BAN . ")";
                } else if ($data2['vac_mode'] == '1') {
                    echo "&raquo; Send troops. (Vacation mode on)";
                } else if ($data2['protect'] < time()) {
                    echo $village->resarray['f39'] ? "<a href=\"a2b.php?s=2&z=" . $_GET['d'] . "\">&raquo; " . SENDTROOP : "&raquo; " . SENDTROOP . " (" . BUILDRALLY . ")";
                } else {
                    echo "&raquo; " . SENDTROOP . " (" . BEGINPRO . ")";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td class="none">
                <?php
                if ($data2['access'] == '0' or $data2['access'] == '8' or $data2['access'] == '9') {
                    echo "&raquo; " . SENDMERC . " (" . BAN . ")";
                } else if ($data2['vac_mode'] == '1') {
                    echo "&raquo; Send merchant(s). (Vacation mode on)";
                } else {
                    echo $building->getTypeLevel(17) ? "<a href=\"build.php?z=" . $_GET['d'] . "&id=" . $building->getTypeField(17) . "\">&raquo; " . SENDMERC : "&raquo; " . SENDMERC . "(" . BUILDMARKET . ")";
                }

                ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

</div>
