<?php
$normalA = $database->getOwnArtefactInfoByType($village->wid, 6);
$largeA = $database->getOwnUniqueArtefactInfo($session->uid, 6, 2);

$mainbuilding = $building->getTypeLevel(15);
$cranny = $building->getTypeLevel(23);
$granary = $building->getTypeLevel(11);
$warehouse = $building->getTypeLevel(10);
$embassy = $building->getTypeLevel(18);
$wall = $village->resarray['f40'];
$rallypoint = $building->getTypeLevel(16);
$hero = $building->getTypeLevel(37);
$market = $building->getTypeLevel(17);
$barrack = $building->getTypeLevel(19);
$cropland = $building->getTypeLevel(4);
$grainmill = $building->getTypeLevel(8);
$residence = $building->getTypeLevel(25);
$academy = $building->getTypeLevel(22);
$armoury = $building->getTypeLevel(13);
$woodcutter = $building->getTypeLevel(1);
$palace = $building->getTypeLevel(26);
$claypit = $building->getTypeLevel(2);
$ironmine = $building->getTypeLevel(3);
$blacksmith = $building->getTypeLevel(12);
$stable = $building->getTypeLevel(20);
$trapper = $building->getTypeLevel(36);
$treasury = $building->getTypeLevel(27);
$sawmill = $building->getTypeLevel(5);
$brickyard = $building->getTypeLevel(6);
$ironfoundry = $building->getTypeLevel(7);
$workshop = $building->getTypeLevel(21);
$stonemasonslodge = $building->getTypeLevel(34);
$townhall = $building->getTypeLevel(24);
$tournamentsquare = $building->getTypeLevel(14);
$bakery = $building->getTypeLevel(9);
$tradeoffice = $building->getTypeLevel(28);
$greatbarracks = $building->getTypeLevel(29);
$greatstable = $building->getTypeLevel(30);
$brewery = $building->getTypeLevel(35);
$horsedrinkingtrough = $building->getTypeLevel(41);
$herosmansion = $building->getTypeLevel(37);
$greatwarehouse = $building->getTypeLevel(38);
$greatgranary = $building->getTypeLevel(39);
$greatworkshop = $building->getTypeLevel(42);

$mainbuilding1 = $database->getBuildingByType2($village->wid, 15);
$cranny1 = $database->getBuildingByType2($village->wid, 23);
$granary1 = $database->getBuildingByType2($village->wid, 11);
$warehouse1 = $database->getBuildingByType2($village->wid, 10);
$embassy1 = $database->getBuildingByType2($village->wid, 18);
$wall1 = $database->getBuildingByField2($village->wid, 40);
$rallypoint1 = $database->getBuildingByType2($village->wid, 16);
$hero1 = $database->getBuildingByType2($village->wid, 37);
$market1 = $database->getBuildingByType2($village->wid, 17);
$barrack1 = $database->getBuildingByType2($village->wid, 19);
$cropland1 = $database->getBuildingByType2($village->wid, 4);
$grainmill1 = $database->getBuildingByType2($village->wid, 8);
$residence1 = $database->getBuildingByType2($village->wid, 25);
$academy1 = $database->getBuildingByType2($village->wid, 22);
$armoury1 = $database->getBuildingByType2($village->wid, 13);
$woodcutter1 = $database->getBuildingByType2($village->wid, 1);
$palace1 = $database->getBuildingByType2($village->wid, 26);
$claypit1 = $database->getBuildingByType2($village->wid, 2);
$ironmine1 = $database->getBuildingByType2($village->wid, 3);
$blacksmith1 = $database->getBuildingByType2($village->wid, 12);
$stable1 = $database->getBuildingByType2($village->wid, 20);
$trapper1 = $database->getBuildingByType2($village->wid, 36);
$treasury1 = $database->getBuildingByType2($village->wid, 27);
$sawmill1 = $database->getBuildingByType2($village->wid, 5);
$brickyard1 = $database->getBuildingByType2($village->wid, 6);
$ironfoundry1 = $database->getBuildingByType2($village->wid, 7);
$workshop1 = $database->getBuildingByType2($village->wid, 21);
$stonemasonslodge1 = $database->getBuildingByType2($village->wid, 34);
$townhall1 = $database->getBuildingByType2($village->wid, 24);
$tournamentsquare1 = $database->getBuildingByType2($village->wid, 14);
$bakery1 = $database->getBuildingByType2($village->wid, 9);
$tradeoffice1 = $database->getBuildingByType2($village->wid, 28);
$greatbarracks1 = $database->getBuildingByType2($village->wid, 29);
$greatstable1 = $database->getBuildingByType2($village->wid, 30);
$brewery1 = $database->getBuildingByType2($village->wid, 35);
$horsedrinkingtrough1 = $database->getBuildingByType2($village->wid, 41);
$herosmansion1 = $database->getBuildingByType2($village->wid, 37);
$greatwarehouse1 = $database->getBuildingByType2($village->wid, 38);
$greatgranary1 = $database->getBuildingByType2($village->wid, 39);
$greatworkshop1 = $database->getBuildingByType2($village->wid, 42);

?>
<div id="build" class="gid0"><h1<?php echo CONSTRUCT_NEW_BUILDING; ?></h1>
    <?php
    if ($mainbuilding == 0 && $mainbuilding1 == 0 && $id != 39 && $id != 40) {
        include("avaliable/mainbuilding.php");
    }
    if ((($cranny == 0 && $cranny1 == 0) || $cranny == 10) && $mainbuilding >= 1 && $id != 39 && $id != 40) {
        include("avaliable/cranny.php");
    }
    if ((($granary == 0 && $granary1 == 0) || $granary == 20) && $mainbuilding >= 1 && $id != 39 && $id != 40) {
        include("avaliable/granary.php");
    }
    if ($wall == 0 && $wall1 == 0) {
        if ($session->tribe == 1 && $id != 39) {
            include("avaliable/citywall.php");
        }
        if ($session->tribe == 2 && $id != 39) {
            include("avaliable/earthwall.php");
        }
        if ($session->tribe == 3 && $id != 39) {
            include("avaliable/palisade.php");
        }
        if ($session->tribe == 4 && $id != 39) {
            include("avaliable/earthwall.php");
        }
        if ($session->tribe == 5 && $id != 39) {
            include("avaliable/citywall.php");
        }
    }
    if ((($warehouse == 0 && $warehouse1 == 0) || $warehouse == 20) && $mainbuilding >= 1 && $id != 39 && $id != 40) {
        include("avaliable/warehouse.php");
    }
    if ((($greatwarehouse == 0 && $greatwarehouse1 == 0) || $greatwarehouse == 20) && $mainbuilding >= 10 && ($largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid || $village->natar == 1) && ($id != 39 && $id != 40)) {
        include("avaliable/greatwarehouse.php");
    }
    if ((($greatgranary == 0 && $greatgranary1 == 0) || $greatgranary == 20) && $mainbuilding >= 10 && ($largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid || $village->natar == 1) && ($id != 39 && $id != 40)) {
        include("avaliable/greatgranary.php");
    }
    if ((($trapper == 0 && $trapper1 == 0) || $trapper == 20) && $rallypoint >= 1 && $session->tribe == 3 && $id != 39 && $id != 40) {
        include("avaliable/trapper.php");
    }
    if ($rallypoint == 0 && $rallypoint1 == 0 && $id != 40) {
        include("avaliable/rallypoint.php");
    }
    if ($embassy == 0 && $embassy1 == 0 && $id != 39 && $id != 40) {
        include("avaliable/embassy.php");
    }
    //fix hero
    if ($hero == 0 && $hero1 == 0 && $mainbuilding >= 3 && $rallypoint >= 1 && $id != 39 && $id != 40) {
        include("avaliable/hero.php");
    }
    //fix barracks
    if ($rallypoint >= 1 && $mainbuilding >= 3 && $barrack == 0 && $barrack1 == 0 && $id != 39 && $id != 40) {
        include("avaliable/barracks.php");
    }
    if ($mainbuilding >= 3 && $academy >= 1 && $armoury == 0 && $armoury1 == 0 && $id != 39 && $id != 40) {
        include("avaliable/armoury.php");
    }
    if ($cropland >= 5 && $grainmill == 0 && $grainmill1 == 0 && $id != 39 && $id != 40) {
        include("avaliable/grainmill.php");
    }
    //fix marketplace
    if ($granary >= 1 && $warehouse >= 1 && $mainbuilding >= 3 && $market == 0 && $market1 == 0 && $id != 39 && $id != 40) {
        include("avaliable/marketplace.php");
    }
    if ($mainbuilding >= 5 && $residence == 0 && $residence1 == 0 && $id != 39 && $id != 40 && $palace == 0) {
        include("avaliable/residence.php");
    }
    if ($academy == 0 && $academy1 == 0 && $mainbuilding >= 3 && $barrack >= 3 && $id != 39 && $id != 40) {
        include("avaliable/academy.php");
    }

    if ($palace == 0 && $palace1 == 0 && $village->natar == 0 && $embassy >= 1 && $mainbuilding >= 5 && $id != 39 && $id != 40 && $residence == 0 && $residence1 == 0) {

//Fix Castle
//id user
        $user = $session->uid;

//connect to DB
        mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
        mysql_select_db(SQL_DB);

//loop search village user
        $query = mysql_query("SELECT * FROM vdata WHERE owner = " . $user . "");
        while ($villaggi_array = mysql_fetch_array($query)) {

            //loop structure village
            $query1 = mysql_query("SELECT * FROM fdata WHERE vref = " . $villaggi_array['wref'] . "");
            $strutture = mysql_fetch_array($query1);

//search Castle in array structure village
            $test = in_array(26, $strutture);
            if ($test) {
                break;
            }

        }


//if Castle no ready include palace.php
        if (!$test) {
            include("avaliable/palace.php");
        }

//end Fix
    }


    if ($blacksmith == 0 && $blacksmith1 == 0 && $academy >= 3 && $mainbuilding >= 3 && $id != 39 && $id != 40) {
        include("avaliable/blacksmith.php");
    }
    if ($stonemasonslodge == 0 && $stonemasonslodge1 == 0 && $palace >= 3 && $mainbuilding >= 5 && $id != 39 && $id != 40) {
        include("avaliable/stonemason.php");
    }
    if ($stable == 0 && $stable1 == 0 && $blacksmith >= 3 && $academy >= 5 && $id != 39 && $id != 40) {
        include("avaliable/stable.php");
    }
    if ($treasury == 0 && $treasury1 == 0 && $village->natar == 0 && $mainbuilding >= 10 && $id != 39 && $id != 40) {
        include("avaliable/treasury.php");
    }
    if ($brickyard == 0 && $brickyard1 == 0 && $claypit >= 10 && $mainbuilding >= 5 && $id != 39 && $id != 40) {
        include("avaliable/brickyard.php");
    }
    if ($sawmill == 0 && $sawmill1 == 0 && $woodcutter >= 10 && $mainbuilding >= 5 && $id != 39 && $id != 40) {
        include("avaliable/sawmill.php");
    }
    if ($ironfoundry == 0 && $ironfoundry1 == 0 && $ironmine >= 10 && $mainbuilding >= 5 && $id != 39 && $id != 40) {
        include("avaliable/ironfoundry.php");
    }
    if ($workshop == 0 && $workshop1 == 0 && $academy >= 10 && $mainbuilding >= 5 && $id != 39 && $id != 40) {
        include("avaliable/workshop.php");
    }
    if ($tournamentsquare == 0 && $tournamentsquare1 == 0 && $rallypoint >= 15 && $id != 39 && $id != 40) {
        include("avaliable/tsquare.php");
    }
    if ($bakery == 0 && $bakery1 == 0 && $grainmill >= 5 && $cropland >= 10 && $mainbuilding >= 5 && $id != 39 && $id != 40) {
        include("avaliable/bakery.php");
    }
    if ($townhall == 0 && $townhall1 == 0 && $mainbuilding >= 10 && $academy >= 10 && $id != 39 && $id != 40) {
        include("avaliable/townhall.php");
    }
    if ($tradeoffice == 0 && $tradeoffice1 == 0 && $market == 20 && $stable >= 10 && $id != 39 && $id != 40) {
        include("avaliable/tradeoffice.php");
    }
    if ($session->tribe == 1 && $horsedrinkingtrough == 0 && $horsedrinkingtrough1 == 0 && $rallypoint >= 10 && $stable == 20 && $id != 39 && $id != 40) {
        include("avaliable/horsedrinking.php");
    }
    if ($session->tribe == 2 && $village->capital == 1 && $brewery == 0 && $brewery1 == 0 && $rallypoint >= 10 && $granary == 20 && $id != 39 && $id != 40) {
        include("avaliable/brewery.php");
    }
    if ($greatbarracks == 0 && $greatbarracks1 == 0 && $barrack == 20 && $village->capital == 0 && $id != 39 && $id != 40) {
        include("avaliable/greatbarracks.php");
    }
    if ($greatstable == 0 && $greatstable1 == 0 && $stable == 20 && $village->capital == 0 && $id != 39 && $id != 40) {
        include("avaliable/greatstable.php");
    }
    if ($greatworkshop == 0 && $greatworkshop1 == 0 && $workshop == 20 && $village->capital == 0 && $id != 39 && $id != 40 && GREAT_WKS) {
        include("avaliable/greatworkshop.php");
    }
    if ($id != 39 && $id != 40) {
        ?>
        <p class="switch"><a id="soon_link"
                             href="javascript:show_build_list('soon');"><?php echo SHOWSOON_AVAILABLE_BUILDINGS; ?></a>
        </p>

        <div id="build_list_soon" class="hide">
            <?php
            if ($rallypoint == 0 && $session->tribe == 3 && $trapper == 0) {
                include("soon/trapper.php");
            }
            if ($mainbuilding < 10 && $warehouse < 10 && $village->capital == 0 && $largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid) {
                include("soon/greatwarehouse.php");
            }
            if ($mainbuilding < 10 && $granary < 10 && $village->capital == 0 && $largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid) {
                include("soon/greatgranary.php");
            }
            if ($hero == 0 && ($mainbuilding <= 2 || $rallypoint == 0)) {
                include("soon/hero.php");
            }
            if ($barrack == 0 && ($rallypoint == 0 || $mainbuilding <= 2)) {
                include("soon/barracks.php");
            }
            if ($armoury == 0 && ($mainbuilding <= 2 || $academy == 0)) {
                include("soon/armoury.php");
            }
            if ($cropland <= 4) {
                include("soon/grainmill.php");
            }
            if ($marketplace == 0 && ($mainbuilding <= 2 || $granary <= 0 || $warehouse <= 0)) {
                include("soon/marketplace.php");
            }
            if ($residence == 0 && $mainbuilding <= 4) {
                include("soon/residence.php");
            }
            if ($academy == 0 && ($mainbuilding <= 2 || $barrack <= 2)) {
                include("soon/academy.php");
            }
            if ($embassy == 0 || $mainbuilding >= 2 && $mainbuilding <= 4 && $village->natar == 0) {
//Fix Castle
//id user
                $user = $session->uid;

//connect to DB
                mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
                mysql_select_db(SQL_DB);

//loop search village user
                $query = mysql_query("SELECT * FROM vdata WHERE owner = " . $user . "");
                while ($villaggi_array = mysql_fetch_array($query)) {

                    //loop structure village
                    $query1 = mysql_query("SELECT * FROM fdata WHERE vref = " . $villaggi_array['wref'] . "");
                    $strutture = mysql_fetch_array($query1);

//search Castle in array structure village
                    $test = in_array(26, $strutture);
                    if ($test) {
                        break;
                    }

                }


//if Castle no ready include palace.php
                if (!$test) {
                    include("soon/palace.php");
                }

//end Fix
            }
            if ($blacksmith == 0 && ($academy <= 2 || $mainbuilding <= 2)) {
                include("soon/blacksmith.php");
            }
            if ($stonemasonslodge == 0 && $palace <= 2 && $palace != 0 && $mainbuilding >= 2 && $mainbuilding <= 4 && $residence == 0 && $village->capital == 1) {
                include("soon/stonemason.php");
            }
            if ($stable == 0 && (($blacksmith <= 2 && $blacksmith != 0) || ($academy >= 2 && $academy <= 4))) {
                include("soon/stable.php");
            }
            if ($treasury == 0 && $mainbuilding <= 9 && $mainbuilding >= 5 && $village->natar == 0) {
                include("soon/treasury.php");
            }
            if ($brickyard == 0 && $claypit <= 9 && $claypit >= 5 && $mainbuilding >= 2 && $mainbuilding <= 4) {
                include("soon/brickyard.php");
            }
            if ($sawmill == 0 && $woodcutter <= 9 && $woodcutter >= 5 && $mainbuilding >= 2 && $mainbuilding <= 4) {
                include("soon/sawmill.php");
            }
            if ($ironfoundry == 0 && $ironmine <= 9 && $ironmine >= 5 && $mainbuilding >= 2 && $mainbuilding <= 4) {
                include("soon/ironfoundry.php");
            }
            if ($workshop == 0 && $academy <= 9 && $academy >= 5 && $mainbuilding >= 2 && $mainbuilding <= 4) {
                include("soon/workshop.php");
            }
            if ($tournamentsquare == 0 && $rallypoint <= 14 && $rallypoint >= 7) {
                include("soon/tsquare.php");
            }
            if ($bakery == 0 && $grainmill <= 4 && $grainmill != 0 && $cropland >= 5 && $cropland <= 9 && $mainbuilding >= 2 && $mainbuilding <= 4) {
                include("soon/bakery.php");
            }
            if ($townhall == 0 && ($mainbuilding <= 9 && $mainbuilding >= 5) || ($academy >= 5 && $academy <= 9)) {
                include("soon/townhall.php");
            }
            if ($tradeoffice == 0 && $market <= 19 && $market >= 10 || $stable >= 5 && $stable <= 9) {
                include("soon/tradeoffice.php");
            }
            if ($session->tribe == 1 && $horsedrinkingtrough == 0 && $rallypoint <= 9 && $rallypoint >= 5 || $stable <= 19 && $stable >= 10 && $session->tribe == 1) {
                include("soon/horsedrinking.php");
            }
            if ($brewery == 0 && $village->capital == 1 && $rallypoint <= 9 && $rallypoint >= 5 || $granary <= 19 && $granary >= 10 && $session->tribe == 2) {
                include("soon/brewery.php");
            }
            if ($greatbarracks == 0 && $barrack >= 18 && $village->capital == 0) {
                include("soon/greatbarracks.php");
            }
            if ($greatstable == 0 && $stable >= 18 && $village->capital == 0) {
                include("soon/greatstable.php");
            }
            if ($greatworkshop == 0 && $workshop >= 18 && $village->capital == 0 && GREAT_WKS) {
                include("soon/greatworkshop.php");
            }
            ?>
        </div><p class="switch"><a id="all_link" class="hide"
                                   href="javascript:show_build_list('all');"><?php echo SHOW_MORE; ?></a></p>
        <div id="build_list_all" class="hide">
            <?php
            if ($academy == 0 && ($mainbuilding == 1 || $barrack == 0)) {
                include("soon/academy.php");
            }
            if ($palace == 0 && ($embassy == 0 || $mainbuilding <= 2) && $village->natar == 0) {
                include("soon/palace.php");
            }
            if ($blacksmith == 0 && ($academy == 0 || $mainbuilding == 1)) {
                include("soon/blacksmith.php");
            }
            if ($stonemason == 0 && ($palace == 0 || $mainbuilding <= 2) && $residence == 0) {
                include("soon/stonemason.php");
            }
            if ($stable == 0 && ($blacksmith == 0 || $academy <= 2)) {
                include("soon/stable.php");
            }
            if ($treasury == 0 && $mainbuilding <= 5) {
                include("soon/treasury.php");
            }
            if ($brickyard == 0 && ($claypit <= 5 || $mainbuilding <= 2)) {
                include("soon/brickyard.php");
            }
            if ($sawmill == 0 && ($woodcutter <= 5 || $mainbuilding <= 2)) {
                include("soon/sawmill.php");
            }
            if ($ironfoundry == 0 && ($ironmine <= 5 || $mainbuilding <= 2)) {
                include("soon/ironfoundry.php");
            }
            if ($workshop == 0 && ($academy <= 5 || $mainbuilding <= 2)) {
                include("soon/workshop.php");
            }
            if ($tournamentsquare == 0 && $rallypoint <= 7) {
                include("soon/tsquare.php");
            }
            if ($bakery == 0 && ($grainmill == 0 || $cropland <= 5 || $mainbuilding <= 2)) {
                include("soon/bakery.php");
            }
            if ($townhall == 0 && ($mainbuilding <= 5 || $academy <= 5)) {
                include("soon/townhall.php");
            }
            if ($tradeoffice == 0 && ($market <= 10 || $stable <= 5)) {
                include("soon/tradeoffice.php");
            }
            if ($session->tribe == 1 && $horsedrinkingtrough == 0 && ($rallypoint <= 5 || $stable <= 10)) {
                include("soon/horsedrinking.php");
            }
            if ($brewery == 0 && ($rallypoint <= 5 || $granary <= 10) && $session->tribe == 2 && $village->capital == 1) {
                include("soon/brewery.php");
            }
            if ($greatbarracks == 0 && $barrack >= 15 && $village->capital == 0) {
                include("soon/greatbarracks.php");
            }
            if ($greatstable == 0 && $stable >= 15 && $village->capital == 0) {
                include("soon/greatstable.php");
            }
            if ($greatworkshop == 0 && $workshop >= 15 && $village->capital == 0 && GREAT_WKS) {
                include("soon/greatworkshop.php");
            }
            ?>
        </div>
        <script language="JavaScript" type="text/javascript">
            function show_build_list(list) {
                // aktuelle liste, aktueller link
                var build_list = document.getElementById('build_list_' + list);
                var link = document.getElementById(list + '_link');

                var all_link = document.getElementById('all_link');
                var soon_link = document.getElementById('soon_link');

                var build_list_all = document.getElementById('build_list_all');
                var build_list_soon = document.getElementById('build_list_soon');

                if (build_list.className == 'hide') {
                    build_list.className = '';
                    if (link == soon_link) {
                        link.innerHTML = '<?php echo HIDESOON_AVAILABLE_BUILDINGS;?>';
                        if (all_link !== null) {
                            all_link.className = '';
                        }
                    } else {
                        link.innerHTML = '<?php echo HIDE_MORE;?>';
                    }
                } else {
                    build_list.className = 'hide';
                    if (link == soon_link) {
                        link.innerHTML = '<?php echo SHOWSOON_AVAILABLE_BUILDINGS;?>';
                        if (all_link !== null) {
                            all_link.innerHTML = 'show more';
                            all_link.className = 'hide';
                            build_list_all.className = 'hide';
                        }
                    } else {
                        link.innerHTML = '<?php echo SHOW_MORE;?>';
                    }
                }
            }
        </script>
        <?php
    }
    ?>
</div>
