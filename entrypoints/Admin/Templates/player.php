<?php
$id = $_GET['uid'];
if (isset($id)) {
    include_once("../GameEngine/Ranking.php");
    $varmedal = $database->getProfileMedal($id);
    $displayarray = $database->getUserArray($id, 1);
    $user = $displayarray;
    $profiel = "" . $user['desc1'] . "" . md5('skJkev3') . "" . $user['desc2'] . "";
    $separator = "../";
    require("../Templates/Profile/medal.php");
    $profiel = explode("" . md5('skJkev3') . "", $profiel);
    $varray = $database->getProfileVillages($id);
    $refreshicon = "<img src=\"data:image/png;base64,
	iVBORw0KGgoAAAANSUhEUgAAAAkAAAAKCAIAAADpZ+PpAAAAAXNSR0IArs4c6QAAAARnQU1BAACx
	jwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAEQSURBVChTY/gPBkevHfRrtjMsU9bJ05+5eylE
	kAGI117fKFsqYzhTNeSQY8xhP8vJJmVrK3eeP8Bw58kt03rTkHnRxdvrnKd4m83SCTtsaLZI1K7H
	mGH2xpnHLh+GGPL7/7/S1dVKU2Usd6roTZBh+Pj3M0QCCL78+Fw6v1ooR1myWU2zzpjBb2Ko8xwf
	91l+gRNDLzw6f+nepcsPrl14cPXW8wcMWqVaEYdtPdZYubUHww0AMs5cusygU68UtVUr87CPWbdd
	9Ly83TcO7Lq2I7ozoXfZTAalCjWZemnlaYo2u0wVFkoJdwoyZDOZNDi//vqRwbkjac+dC827p2h3
	Gyh3S6m0a0Qszrnz6RnQWAAxV5tT/VAiNQAAAABJRU5ErkJggg==\">";
    if ($user) {
        $totalpop = 0;
        foreach ($varray as $vil) {
            $totalpop += $vil['pop'];
        }
        include('search2.php');
        echo "<br />";
        $deletion = false;
        if ($deletion) {
            include("playerdeletion.php");
        }

        include("playerinfo.php");
        include("playerheroinfo.php");
        include("playeradditionalinfo.php");
        echo "<br />";
        include("playermedals.php");
        include("villages.php"); ?>

        <div style="float: left;">
            <?php
            include('punish.php');
            ?>
        </div>
        <div style="float: right;">
            <?php
            include('add_village.php');
            ?>
        </div>

        <?php
        $sql = "SELECT * FROM banlist WHERE uid = " . $id . "";
        $numbans = mysql_num_rows(mysql_query($sql));
        ?>
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Ban History (<?php echo $numbans; ?>)</th>
            </tr>
            <tr>
                <td class="hab"><b>Start</b></td>
                <td class="hab"><b>End</b></td>
                <td class="hab"><b>Duration</b></td>
                <td class="on"><b>Reason</b></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = mysql_query($sql);
            while ($row = mysql_fetch_assoc($result)) {
                echo '
							<tr>
								<td class="hab">' . date('d:m:Y H:i', $row['time']) . '</td>
								<td class="hab">' . date('d:m:Y H:i', $row['end']) . '</td>
								<td class="hab">' . round((($row['end'] - $row['time']) / 3600), 2) . ' minutes</td>
								<td class="on">' . $row['reason'] . '</td>
							</tr>';
            }
            ?>
            </tbody>
        </table>
        <?php
    } else {
        include("404.php");
    }
}
?>
