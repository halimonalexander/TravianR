<div id="side_navi">
    <a id="logo" href="{{ __('messages.HOMEPAGE') }}" name="logo">
        <img src="img/x.gif" @if ($session->plus) "class="logo_plus"@endif alt="Travian">
    </a>

    <p>
        <a href="{{ __('messages.HOMEPAGE') }}">{{ __('messages.HOME') }}</a>
        <a href="spieler.php?uid={{ $session->uid }}">{{ __('messages.PROFILE') }}</a>
        <a href="#" onclick="return Popup(0,0,1);">{{ __('messages.INSTRUCT') }}</a>
        @if(Auth::user()->role == 'MULTIHUNTER')
        <a href="Admin/admin.php"><font color="Blue">Multihunter Panel</font></a>
        @endif
        @if(Auth::user()->role == 'ADMIN')
            <a href="Admin/admin.php"><font color="Red">{{ __('messages.ADMIN_PANEL') }}</font></a>
            <a href="massmessage.php">{{ __('messages. MASS_MESSAGE') }}</a>
            <a href="sysmsg.php">{{ __('messages.SYSTEM_MESSAGE') }}</a>
            <a href="create_account.php">Create Natars</a>
        @endif
        <a href="logout.php">{{ __('messages.LOGOUT') }}</a>
    </p>
    <p>
        <a href="plus.php?id=3">{{ __('messages.SERVER_NAME') }}
            <b><span class="plus_g">P</span><span class="plus_o">l</span><span class="plus_g">u</span><span class="plus_o">s</span></b>
        </a>
    </p>
    <p>
        <a href="../../../src/Templates/rules.php"><b>{{ __('messages.GAME_RULES') }}</b></a>
        <a href="../../../src/Templates/support.php"><b>{{ __('messages.SUPPORT') }}</b></a>
    </p>

    <?php
    $timestamp = $database->isDeleting($session->uid);
    if ($timestamp) {
        echo "<td colspan=\"2\" class=\"count\">";
        if ($timestamp > time() + 48 * 3600) {
            echo "<a href=\"spieler.php?s=3&id=" . $session->uid . "&a=1&e=4\"><img
		class=\"del\" src=\"img/x.gif\" alt=\"Cancel process\"
		title=\"Cancel process\" /> </a>";
        }
        $time = $generator->getTimeFormat(($timestamp - time()));
        echo "<a href=\"spieler.php?s=3\"> The account will be deleted in <span
		id=\"timer1\">" . $time . "</span> .</a></td>";
    }
    ?>
    </div>
    <?php
    if ($_SESSION['ok'] == '1') {
    ?>

        <div id="content" class="village1">
            <h1>{{ __('messages.ANNOUNCEMENT') }}</h1>
            </br>
            <h3>Hi <?php echo $session->username; ?>,</h3>
            <?php include("Templates/text.php"); ?>
            <div class="c1">
                </br>
                <h3><a href="dorf1.php?ok">&raquo; {{ __('messages.GO2MY_VILLAGE') }}</a></h3>
            </div>
        </div>

        <div id="side_info">
            <?php
            include("Templates/quest.php");
            include("Templates/news.php");
            include("Templates/multivillage.php");
            include("Templates/links.php");
            ?>
        </div>

        <div class="clear"></div>

        <div class="footer-stopper"></div>

        <div class="clear"></div><?php
        include("Templates/footer.php");
        include("Templates/res.php");
        ?>

        <div id="stime">
            <div id="ltime">
                <div id="ltimeWrap">
                    Calculated in <b><?php
                        echo round(($generator->pageLoadTimeEnd() - $start) * 1000);
                        ?></b> ms
                    <br>
                    Server time: <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
                </div>
            </div>
        </div>

        <div id="ce"></div><?php
        die();
    }
