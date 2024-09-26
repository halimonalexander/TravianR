<?php

// Fetch all links
$query = $database->getLinks($session->uid);
if (mysql_num_rows($query) > 0) {
    $links = array();
    while ($data = mysql_fetch_assoc($query)) {
        $links[] = $data;
    }

    print '<br /><br /><table id="vlist" cellpadding="1" cellspacing="1"><thead><tr><td colspan="3"><a href="spieler.php?s=2">Links:</a></td></tr></thead><tbody>';
    foreach ($links as $link) {
        // Check, if the url is extern
        if (substr($link['url'], -1, 1) == '*') {
            $target = ' target="_blank"';
            $external = '<img src="gpack/travian_default/img/a/external.gif" />';
            $link['url'] = str_replace('*', '', $link['url']);
        } else {
            $target = '';
            $external = '';
        }

        echo '<tr><td class="dot">●</td><td class="link">';
        if ($session->plus == 0) {
            echo "buy Plus";
        } else {
            echo '<a href="' . $link['url'] . '"' . $target . '>' . $link['name'] . $external . '</a></td></tr>';
        }
    }
    print '</tbody></table>';
}
?>
