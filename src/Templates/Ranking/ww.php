<?php
if (WW == True) {
    $result = mysql_query("select users.id, users.username,users.alliance, fdata.wwname, fdata.f99, vdata.name, fdata.vref
                        FROM users
                        INNER JOIN vdata ON users.id = vdata.owner
                        INNER JOIN fdata ON fdata.vref = vdata.wref
                        WHERE fdata.f99t = 40 ORDER BY fdata.f99 Desc, id Desc LIMIT 20");
    ?>
    <table cellpadding="1" cellspacing="1" id="villages" class="row_table_data">
    <thead>
    <tr>
        <th colspan="7">Wonder of the world</th>
    </tr>
    <tr>
        <td></td>
        <td>Player</td>
        <td>Name</td>
        <td>Alliance</td>
        <td>Level</td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?php
    $cont = 1;
    while ($row = mysql_fetch_array($result)) {
        $ally = $database->getAlliance($row[alliance]);
        $query = @mysql_query('SELECT * FROM `ww_attacks` WHERE `vid` = ' . $row['vref'] . ' ORDER BY `attack_time` ASC LIMIT 1');
        $row2 = @mysql_fetch_assoc($query);
        ?>
        <tr>
            <td><?php echo $cont;
                $cont++; ?>.
            </td>
            <td><?php echo "<a href=\"karte.php?d=" . $row['vref'] . "&amp;c=" . $generator->getMapCheck($row['vref']) . "\">"; ?><?php echo $row['username']; ?></a></td>
            <td><?php echo $row['wwname']; ?></td>
            <td><a href="allianz.php?aid=<?php echo $ally['id']; ?>"><?php echo $ally['tag']; ?></a></td>
            <td><?php echo $row['f99']; ?></td>
            <?php if ($row2['attack_time'] != 0): ?>
                <td><img src="gpack/travian_default/img/a/att1.gif"
                         title="<?php print date('d.m.Y, H:i:s', $row2['attack_time']); ?>"/></td>
            <?php else: ?>
                <td>&nbsp;</td>
            <?php endif; ?>
        </tr>
        <?php
    }
} else {
    header("Location: statistiken.php");
}
?>
