<?php

use Travian\Account;

include("GameEngine/Session.php");
include('GameEngine/Account.php');
$account = new Account();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title><?php echo SERVER_NAME; ?></title>
    <link REL="shortcut icon" HREF="../favicon.ico"/>
    <meta name="content-language" content="en"/>
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <script src="../public/js/mt-core.js?0faaa" type="text/javascript"></script>
    <script src="../public/js/mt-more.js?0faaa" type="text/javascript"></script>
    <script src="../public/js/unx.js?0faaa" type="text/javascript"></script>
    <script src="../public/js/new.js?0faaa" type="text/javascript"></script>
    <link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css"/>
    <link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css"/>
    <link href="<?php echo GP_LOCATE ?>travian.css?f4b7c" rel="stylesheet" type="text/css"/>
    <link href="<?php echo GP_LOCATE ?>lang/en/lang.css" rel="stylesheet" type="text/css"/>
</head>

<body class="v35 ie ie7" onload="initCounter()">

<div class="wrapper">
    <div id="dynamic_header">
    </div>
    <div id="header"></div>
    <div id="mid">
        <?php include("Templates/menu.php"); ?>
        <div id="content" class="activate">
            <?php

            if (isset($_GET['e']) && (START_DATE < date('m/d/Y') or START_DATE == date('m/d/Y') && START_TIME <= date('H:i'))) {
                switch ($_GET['e']) {
                    case 1:
                        include("Templates/activate/delete.php");
                        break;
                    case 2:
                        include("Templates/activate/activated.php");
                        break;
                    case 3:
                        include("Templates/activate/cantfind.php");
                        break;
                }
            } else if (isset($_GET['id']) && isset($_GET['c'])) {
                $c = $database->getActivateField($_GET['id'], "email", 0);
                if ($_GET['c'] == $generator->encodeStr($c, 5)) {
                    include("Templates/activate/delete.php");
                } else {
                    include("Templates/activate/activate.php");
                }
            } else {
                include("Templates/activate/activate.php");
            }

            ?>
        </div>
        <div id="side_info" class="outgame">
        </div>

        <div class="clear"></div>
    </div>

    <div class="footer-stopper outgame"></div>
    <div class="clear"></div>

    <?php include("Templates/footer.php"); ?>
    <div id="ce"></div>
</body>
</html>
