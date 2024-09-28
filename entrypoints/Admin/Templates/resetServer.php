<?php

include_once("../../GameEngine/config.php");
include_once("../../GameEngine/Database/GrandRepository.php");
$database = new MYSQLi_DB();

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['access'] != ADMIN) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
set_time_limit(0);
mysql_query("TRUNCATE TABLE a2b");
mysql_query("TRUNCATE TABLE abdata");
mysql_query("TRUNCATE TABLE activate");
mysql_query("TRUNCATE TABLE active");
mysql_query("TRUNCATE TABLE admin_log");
mysql_query("TRUNCATE TABLE alidata");
mysql_query("TRUNCATE TABLE ali_invite");
mysql_query("TRUNCATE TABLE ali_log");
mysql_query("TRUNCATE TABLE ali_permission");
mysql_query("TRUNCATE TABLE allimedal");
mysql_query("TRUNCATE TABLE artefacts");
mysql_query("TRUNCATE TABLE attacks");
mysql_query("TRUNCATE TABLE banlist");
mysql_query("TRUNCATE TABLE bdata");
mysql_query("TRUNCATE TABLE build_log");
mysql_query("TRUNCATE TABLE chat");
mysql_query("TRUNCATE TABLE config");
mysql_query("TRUNCATE TABLE deleting");
mysql_query("TRUNCATE TABLE demolition");
mysql_query("TRUNCATE TABLE diplomacy");
mysql_query("TRUNCATE TABLE enforcement");
mysql_query("TRUNCATE TABLE farmlist");
mysql_query("TRUNCATE TABLE fdata");
mysql_query("TRUNCATE TABLE forum_cat");
mysql_query("TRUNCATE TABLE forum_edit");
mysql_query("TRUNCATE TABLE forum_post");
mysql_query("TRUNCATE TABLE forum_survey");
mysql_query("TRUNCATE TABLE forum_topic");
mysql_query("TRUNCATE TABLE general");
mysql_query("TRUNCATE TABLE gold_fin_log");
mysql_query("TRUNCATE TABLE hero");
mysql_query("TRUNCATE TABLE illegal_log");
mysql_query("TRUNCATE TABLE links");
mysql_query("TRUNCATE TABLE login_log");
mysql_query("TRUNCATE TABLE market");
mysql_query("TRUNCATE TABLE market_log");
mysql_query("TRUNCATE TABLE mdata");
mysql_query("TRUNCATE TABLE medal");
mysql_query("TRUNCATE TABLE movement");
mysql_query("TRUNCATE TABLE ndata");
mysql_query("TRUNCATE TABLE online");
mysql_query("TRUNCATE TABLE password");
mysql_query("TRUNCATE TABLE prisoners");
mysql_query("TRUNCATE TABLE raidlist");
mysql_query("TRUNCATE TABLE research");
mysql_query("TRUNCATE TABLE route");
mysql_query("TRUNCATE TABLE send");
mysql_query("TRUNCATE TABLE tdata");
mysql_query("TRUNCATE TABLE tech_log");
mysql_query("TRUNCATE TABLE training");
mysql_query("TRUNCATE TABLE units");
$time = time();
mysql_query("TRUNCATE TABLE odata");

$database->populateOasisdata();
$database->populateOasis();
$database->populateOasisUnits2();
$uid = $database->getVillageID(5);

$passw = md5('123456');
mysql_query("TRUNCATE TABLE users");
mysql_query("INSERT INTO users (id, username, password, email, tribe, access, gold, gender, birthday, location, desc1, desc2, plus, b1, b2, b3, b4, sit1, sit2, alliance, sessid, act, timestamp, ap, apall, dp, dpall, protect, quest, gpack, cp, lastupdate, RR, Rc, ok) VALUES
(5, 'Multihunter', '" . $passw . "', 'multihunter@travianx.mail', 0, 9, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(1, 'Support', '', 'support@travianx.mail', 0, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(2, 'Nature', '', 'support@travianx.mail', 4, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(4, 'Taskmaster', '', 'support@travianx.mail', 0, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0)");

mysql_query("INSERT INTO units (vref) VALUES ($uid)");
mysql_query("INSERT INTO tdata (vref) VALUES ($uid)");

mysql_query("INSERT INTO fdata (vref, f1t, f2t, f3t, f4t, f5t, f6t, f7t, f8t, f9t, f10t, f11t, f12t, f13t, f14t, f15t, f16t, f17t, f18t, f26, f26t, wwname) VALUES ($uid, '1', '4', '1', '3', '2',  '2', '3', '4', '4', '3', '3', '4', '4', '1', '4', '2', '1', '2', '1', '15', 'World Wonder')");

mysql_query("DELETE FROM vdata WHERE owner<>5");
mysql_query("UPDATE wdata SET occupied=0 WHERE id<>$uid");
mysql_query("TRUNCATE TABLE ww_attacks");

header("Location: ../admin.php?p=resetdone");
?>
