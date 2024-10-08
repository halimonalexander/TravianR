<?php

include("GameEngine/Village.php");
$start = $generator->pageLoadTimeStart();

if ($session->access == BANNED) {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html>
    <head>
        <title><?php echo SERVER_NAME ?></title>
        <link REL="shortcut icon" HREF="../favicon.ico"/>
        <meta http-equiv="cache-control" content="max-age=0"/>
        <meta http-equiv="pragma" content="no-cache"/>
        <meta http-equiv="expires" content="0"/>
        <meta http-equiv="imagetoolbar" content="no"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <script src="../public/js/mt-full.js?0faaa" type="text/javascript"></script>
        <script src="../public/js/unx.js?0faaa" type="text/javascript"></script>
        <script src="../public/js/new.js?0faaa" type="text/javascript"></script>
        <link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?e21d2" rel="stylesheet" type="text/css"/>
        <link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?e21d2" rel="stylesheet" type="text/css"/>
        <?php
        if ($session->gpack == null || GP_ENABLE == false) {
            echo "
	<link href='" . GP_LOCATE . "travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='" . GP_LOCATE . "lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
        } else {
            echo "
	<link href='" . $session->gpack . "travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='" . $session->gpack . "lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
        }
        ?>
        <script type="text/javascript">
            window.addEvent('domready', start);
        </script>
    </head>


    <body class="v35 ie ie8">
    <div class="wrapper">
        <img style="filter:chroma();" src="../public/img/x.gif" id="msfilter" alt=""/>
        <div id="dynamic_header">
        </div>
        <?php include("Templates/header.php"); ?>
        <div id="mid">
            <?php include("Templates/menu.php"); ?>
            <div id="content" class="village1">
                <?php
                include("Admin/Templates/ban_msg.php");
                ?>
            </div>
            </br></br></br></br>
            <div id="side_info">
                <?php
                include("Templates/multivillage.php");
                include("Templates/quest.php");
                include("Templates/news.php");
                include("Templates/links.php");
                ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="footer-stopper"></div>
        <div class="clear"></div>

        <?php
        include("Templates/footer.php");
        include("Templates/res.php")
        ?>
        <div id="stime">
            <div id="ltime">
                <div id="ltimeWrap">
                    <?php echo CALCULATED_IN; ?> <b><?php
                        echo round(($generator->pageLoadTimeEnd() - $start) * 1000);
                        ?></b> ms

                    <br/><?php echo SEVER_TIME; ?> <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
                </div>
            </div>
        </div>

        <div id="ce"></div>
    </body>
    </html>
    <?php
} else {
    header("Location: dorf1.php");
} ?>
