<div id="build" class="gid20"><a href="#" onClick="return Popup(20,4);" class="build_logo">
        <img class="building g20" src="img/x.gif" alt="Stable" title="<?php echo STABLE; ?>"/> </a>

    <h1><?php echo STABLE; ?> <span
                class="level"><?php echo LEVEL; ?><?php echo $village->resarray['f' . $id]; ?></span></h1>
    <p class="build_desc"><?php echo STABLE_DESC; ?><br/></p>

    <?php if ($building->getTypeLevel(20) > 0) { ?>

        <form method="POST" name="snd" action="build.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="hidden" name="ft" value="t1"/>
            <table cellpadding="1" cellspacing="1" class="build_details">
                <thead>
                <tr>
                    <td><?php echo NAME; ?></td>
                    <td><?php echo QUANTITY; ?></td>
                    <td><?php echo MAX; ?></td>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($session->tribe != 4) {
                    include("20_" . $session->tribe . ".php");
                }
                ?>
                </tbody>
            </table>
            <p>
                <input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif"
                       alt="train"/>
            </p>

        </form>
        <?php
    } else {
        echo "<b>" . TRAINING_COMMENCE_STABLE . "</b><br>\n";
    }
    $trainlist = $technology->getTrainingList(2);
    if (count($trainlist) > 0) {
        //$timer = 2*count($trainlist);
        echo "
    <table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
		<thead><tr>
			<td>" . TRAINING . "</td>
			<td>" . DURATION . "</td>
			<td>" . FINISHED . "</td>
		</tr></thead>
		<tbody>";
        $TrainCount = 0;
        foreach ($trainlist as $train) {
            $TrainCount++;
            echo "<tr><td class=\"desc\">";
            echo "<img class=\"unit u" . $train['unit'] . "\" src=\"img/x.gif\" alt=\"" . $train['name'] . "\" title=\"" . $train['name'] . "\" />";
            echo $train['amt'] . " " . $train['name'] . "</td><td class=\"dur\">";
            if ($TrainCount == 1) {
                $NextFinished = $generator->getTimeFormat($train['timestamp2'] - time());
                echo "<span id=timer1>" . $generator->getTimeFormat($train['timestamp'] - time()) . "</span>";
            } else {
                echo $generator->getTimeFormat($train['eachtime'] * $train['amt']);
            }
            echo "</span></td><td class=\"fin\">";
            $time = $generator->procMTime($train['timestamp']);
            if ($time[0] != "today") {
                echo "on " . $time[0] . " at ";
            }
            echo $time[1];
        } ?>
        </tr>
        <tr class="next">
            <td colspan="3"><?php echo UNIT_FINISHED; ?> <span id="timer2"><?php echo $NextFinished; ?></span></td>
        </tr>
        </tbody></table>
    <?php }
    ?>
    <?php
    include("upgrade.php");
    ?> </p></div>
