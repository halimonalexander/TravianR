<?php

class MYSQL_DB
{

    var $connection;

    function MYSQL_DB()
    {
        $this->connection = mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
        mysql_select_db(SQL_DB, $this->connection);
        mysql_query("SET NAMES 'UTF8'");  //Fix utf8 phpmyadmin by gm4st3r
    }

    function register($username, $password, $email, $tribe, $act)
    {
        $time = time();
        $stime = strtotime(START_DATE) - strtotime(date('m/d/Y')) + strtotime(START_TIME);
        if ($stime > time()) {
            $time = $stime;
        }
        $timep = $time + PROTECTION;
        $time = time();
        $q = "INSERT INTO users (username,password,access,email,timestamp,tribe,act,protect,lastupdate,regtime) VALUES ('$username', '$password', " . USER . ", '$email', $time, $tribe, '$act', $timep, $time, $time)";
        if (mysql_query($q, $this->connection)) {
            return mysql_insert_id($this->connection);
        } else {
            return false;
        }
    }

    function activate($username, $password, $email, $tribe, $locate, $act, $act2)
    {
        $time = time();
        $q = "INSERT INTO activate (username,password,access,email,tribe,timestamp,location,act,act2) VALUES ('$username', '$password', " . USER . ", '$email', $tribe, $time, $locate, '$act', '$act2')";
        if (mysql_query($q, $this->connection)) {
            return mysql_insert_id($this->connection);
        } else {
            return false;
        }
    }

    function unreg($username)
    {
        $q = "DELETE from activate where username = '$username'";
        return mysql_query($q, $this->connection);
    }

    function deleteReinf($id)
    {
        $q = "DELETE from enforcement where id = '$id'";
        mysql_query($q, $this->connection);
    }

    function updateResource($vid, $what, $number)
    {

        $q = "UPDATE vdata set " . $what . "=" . $number . " where wref = $vid";
        $result = mysql_query($q, $this->connection);
        return mysql_query($q, $this->connection);
    }

    function checkExist($ref, $mode)
    {

        if (!$mode) {
            $q = "SELECT username FROM users where username = '$ref' LIMIT 1";
        } else {
            $q = "SELECT email FROM users where email = '$ref' LIMIT 1";
        }
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    function checkExist_activate($ref, $mode)
    {

        if (!$mode) {
            $q = "SELECT username FROM activate where username = '$ref' LIMIT 1";
        } else {
            $q = "SELECT email FROM activate where email = '$ref' LIMIT 1";
        }
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function hasBeginnerProtection($vid)
    {
        $q = "SELECT u.protect FROM users u,vdata v WHERE u.id=v.owner AND v.wref=" . $vid;
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        if (!empty($dbarray)) {
            if (time() < $dbarray[0]) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function updateUserField($ref, $field, $value, $switch)
    {
        if (!$switch) {
            $q = "UPDATE users set $field = '$value' where username = '$ref'";
        } else {
            $q = "UPDATE users set $field = '$value' where id = '$ref'";
        }
        return mysql_query($q, $this->connection);
    }

    function getSitee($uid)
    {
        $q = "SELECT id from users where sit1 = $uid or sit2 = $uid";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getVilWref($x, $y)
    {
        $q = "SELECT * FROM wdata where x = $x AND y = $y";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['id'];
    }

    function caststruc($user)
    {
        //loop search village user
        $query = mysql_query("SELECT * FROM vdata WHERE owner = " . $user . "");
        while ($villaggi_array = mysql_fetch_array($query))

            //loop structure village
            $query1 = mysql_query("SELECT * FROM fdata WHERE vref = " . $villaggi_array['wref'] . "");
        $strutture = mysql_fetch_array($query1);
        return $strutture;
    }

    function removeMeSit($uid, $uid2)
    {
        $q = "UPDATE users set sit1 = 0 where id = $uid and sit1 = $uid2";
        mysql_query($q, $this->connection);
        $q2 = "UPDATE users set sit2 = 0 where id = $uid and sit2 = $uid2";
        mysql_query($q2, $this->connection);
    }

    function getUserField($ref, $field, $mode)
    {
        if (!$mode) {
            $q = "SELECT $field FROM users where id = '$ref'";
        } else {
            $q = "SELECT $field FROM users where username = '$ref'";
        }
        $result = mysql_query($q, $this->connection));
        if ($result) {
            $dbarray = mysql_fetch_array($result);
            return $dbarray[$field];
        } elseif ($field == "username") {
            return "??";
        } else return 0;
    }

    function getInvitedUser($uid)
    {
        $q = "SELECT * FROM users where invited = $uid order by regtime desc";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getVrefField($ref, $field)
    {
        $q = "SELECT $field FROM vdata where wref = '$ref'";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray[$field];
    }

    function getVrefCapital($ref)
    {
        $q = "SELECT * FROM vdata where owner = '$ref' and capital = 1";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray;
    }

    function getStarvation()
    {
        $q = "SELECT * FROM vdata where starv != 0 and owner != 3";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getUnstarvation()
    {
        $q = "SELECT * FROM vdata where starv = 0 and starvupdate = 0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getActivateField($ref, $field, $mode)
    {
        if (!$mode) {
            $q = "SELECT $field FROM activate where id = '$ref'";
        } else {
            $q = "SELECT $field FROM activate where username = '$ref'";
        }
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray[$field];
    }

    function login($username, $password)
    {
        $q = "SELECT password,sessid FROM users where username = '$username'";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        if ($dbarray['password'] == md5($password)) {
            return true;
        } else {
            return false;
        }
    }

    function checkActivate($act)
    {
        $q = "SELECT * FROM activate where act = '$act'";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);

        return $dbarray;
    }

    function sitterLogin($username, $password)
    {
        $q = "SELECT sit1,sit2 FROM users where username = '$username' and access != " . BANNED;
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        if ($dbarray['sit1'] != 0) {
            $q2 = "SELECT password FROM users where id = " . $dbarray['sit1'] . " and access != " . BANNED;
            $result2 = mysql_query($q2, $this->connection);
            $dbarray2 = mysql_fetch_array($result2);
        }
        if ($dbarray['sit2'] != 0) {
            $q3 = "SELECT password FROM users where id = " . $dbarray['sit2'] . " and access != " . BANNED;
            $result3 = mysql_query($q3, $this->connection);
            $dbarray3 = mysql_fetch_array($result3);
        }
        if ($dbarray['sit1'] != 0 || $dbarray['sit2'] != 0) {
            if ($dbarray2['password'] == md5($password) || $dbarray3['password'] == md5($password)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function setDeleting($uid, $mode)
    {
        $time = time() + 72 * 3600;
        if (!$mode) {
            $q = "INSERT into deleting values ($uid,$time)";
        } else {
            $q = "DELETE FROM deleting where uid = $uid";
        }
        mysql_query($q, $this->connection);
    }

    function isDeleting($uid)
    {
        $q = "SELECT timestamp from deleting where uid = $uid";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['timestamp'];
    }

    function modifyGold($userid, $amt, $mode)
    {
        if (!$mode) {
            $q = "UPDATE users set gold = gold - $amt where id = $userid";
        } else {
            $q = "UPDATE users set gold = gold + $amt where id = $userid";
        }
        return mysql_query($q, $this->connection);
    }

    /*****************************************
     * Function to retrieve user array via Username or ID
     * Mode 0: Search by Username
     * Mode 1: Search by ID
     * References: Alliance ID
     *****************************************/

    function getUserArray($ref, $mode)
    {
        if (!$mode) {
            $q = "SELECT * FROM users where username = '$ref'";
        } else {
            $q = "SELECT * FROM users where id = $ref";
        }
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function activeModify($username, $mode)
    {
        $time = time();
        if (!$mode) {
            $q = "INSERT into active VALUES ('$username',$time)";
        } else {
            $q = "DELETE FROM active where username = '$username'";
        }
        return mysql_query($q, $this->connection);
    }

    function addActiveUser($username, $time)
    {
        $q = "REPLACE into active values ('$username',$time)";
        if (mysql_query($q, $this->connection)) {
            return true;
        } else {
            return false;
        }
    }

    function updateActiveUser($username, $time)
    {
        $q = "REPLACE into active values ('$username',$time)";
        $q2 = "UPDATE users set timestamp = $time where username = '$username'";
        $exec1 = mysql_query($q, $this->connection);
        $exec2 = mysql_query($q2, $this->connection);
        if ($exec1 && $exec2) {
            return true;
        } else {
            return false;
        }
    }

    function checkactiveSession($username, $sessid)
    {
        $q = "SELECT username FROM users where username = '$username' and sessid = '$sessid' LIMIT 1";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result) != 0) {
            return true;
        } else {
            return false;
        }
    }

    function submitProfile($uid, $gender, $location, $birthday, $des1, $des2)
    {
        $q = "UPDATE users set gender = $gender, location = '$location', birthday = '$birthday', desc1 = '$des1', desc2 = '$des2' where id = $uid";
        return mysql_query($q, $this->connection);
    }

    function gpack($uid, $gpack)
    {
        $q = "UPDATE users set gpack = '$gpack' where id = $uid";
        return mysql_query($q, $this->connection);
    }

    function GetOnline($uid)
    {
        $q = "SELECT sit FROM online where uid = $uid";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['sit'];
    }

    function UpdateOnline($mode, $name = "", $time = "", $uid = 0)
    {
        global $session;
        if ($mode == "login") {
            $q = "INSERT IGNORE INTO online (name, uid, time, sit) VALUES ('$name', '$uid', " . time() . ", 0)";
            return mysql_query($q, $this->connection);
        } else if ($mode == "sitter") {
            $q = "INSERT IGNORE INTO online (name, uid, time, sit) VALUES ('$name', '$uid', " . time() . ", 1)";
            return mysql_query($q, $this->connection);
        } else {
            $q = "DELETE FROM online WHERE name ='" . addslashes($session->username) . "'";
            return mysql_query($q, $this->connection);
        }
    }

    function generateBase($sector, $mode = 1)
    {
        $num_rows = 0;
        $count_while = 0;
        while (!$num_rows) {
            if (!$mode) {
                $gamesday = time() - COMMENCE;
                if ($gamesday < 3600 * 24 * 10 && $count_while == 0) { //10 day
                    $wide1 = 1;
                    $wide2 = 20;
                } elseif ($gamesday < 3600 * 24 * 20 && $count_while == 1) { //20 day
                    $wide1 = 20;
                    $wide2 = 40;
                } elseif ($gamesday < 3600 * 24 * 30 && $count_while == 2) { //30 day
                    $wide1 = 40;
                    $wide2 = 80;
                } else {        // over 30 day
                    $wide1 = 80;
                    $wide2 = WORLD_MAX;
                }
            } else {
                $wide1 = 1;
                $wide2 = WORLD_MAX;
            }
            switch ($sector) {
                case 1:
                    $q = "Select * from wdata where fieldtype = 3 and (x < -$wide1 and x > -$wide2) and (y > $wide1 and y < $wide2) and occupied = 0"; //x- y+
                    break;
                case 2:
                    $q = "Select * from wdata where fieldtype = 3 and (x > $wide1 and x < $wide2) and (y > $wide1 and y < $wide2) and occupied = 0"; //x+ y+
                    break;
                case 3:
                    $q = "Select * from wdata where fieldtype = 3 and (x < -$wide1 and x > -$wide2) and (y < -$wide1 and y > -$wide2) and occupied = 0"; //x- y-
                    break;
                case 4:
                    $q = "Select * from wdata where fieldtype = 3 and (x > $wide1 and x < $wide2) and (y < -$wide1 and y > -$wide2) and occupied = 0"; //x+ y-
                    break;
            }
            $result = mysql_query($q, $this->connection);
            $num_rows = mysql_num_rows($result);
            $count_while++;
        }
        $result = $this->mysql_fetch_all($result);
        $base = rand(0, ($num_rows - 1));
        return $result[$base]['id'];
    }

    function setFieldTaken($id)
    {
        $q = "UPDATE wdata set occupied = 1 where id = $id";
        return mysql_query($q, $this->connection);
    }

    function addVillage($wid, $uid, $username, $capital)
    {
        $total = count($this->getVillagesID($uid));
        if ($total >= 1) {
            $vname = $username . "\'s village " . ($total + 1);
        } else {
            $vname = $username . "\'s village";
        }
        $time = time();
        $q = "INSERT into vdata (wref, owner, name, capital, pop, cp, celebration, wood, clay, iron, maxstore, crop, maxcrop, lastupdate, created) values ('$wid', '$uid', '$vname', '$capital', 2, 1, 0, 750, 750, 750, " . STORAGE_BASE . ", 750, " . STORAGE_BASE . ", '$time', '$time')";
        return mysql_query($q, $this->connection));
    }

    function addResourceFields($vid, $type)
    {
        switch ($type) {
            case 1:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,4,4,1,4,4,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
                break;
            case 2:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,3,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
                break;
            case 3:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,1,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
                break;
            case 4:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,1,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
                break;
            case 5:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,1,4,1,3,1,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
                break;
            case 6:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,4,4,1,3,4,4,4,4,4,4,4,4,4,4,4,2,4,4,1,15)";
                break;
            case 7:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,1,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
                break;
            case 8:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,3,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
                break;
            case 9:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,3,4,4,1,1,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
                break;
            case 10:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,3,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
                break;
            case 11:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,3,1,1,3,1,4,4,3,3,2,2,3,1,4,4,2,4,4,1,15)";
                break;
            case 12:
                $q = "INSERT into fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,1,4,1,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
                break;
        }
        return mysql_query($q, $this->connection);
    }

    function isVillageOases($wref)
    {
        $q = "SELECT id, oasistype FROM wdata where id = $wref";
        $result = mysql_query($q, $this->connection);
        if ($result) {
            $dbarray = mysql_fetch_array($result);
            return $dbarray['oasistype'];
        } else return 0;
    }

    public function VillageOasisCount($vref)
    {
        $q = "SELECT count(*) FROM `odata` WHERE conqured=$vref";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        return $row[0];
    }

    public function countOasisTroops($vref)
    {
        //count oasis troops: $troops_o
        $troops_o = 0;
        $o_unit2 = mysql_query("select * from units where `vref`='" . $vref . "'");
        $o_unit = mysql_fetch_array($o_unit2);

        for ($i = 1; $i < 51; $i++) {
            $troops_o += $o_unit[$i];
        }
        $troops_o += $o_unit['hero'];

        $o_unit2 = mysql_query("select * from enforcement where `vref`='" . $vref . "'");
        while ($o_unit = @mysql_fetch_array($o_unit2)) {
            for ($i = 1; $i < 51; $i++) {
                $troops_o += $o_unit[$i];
            }
            $troops_o += $o_unit['hero'];
        }
        return $troops_o;
    }

    public function canConquerOasis($vref, $wref)
    {
        $AttackerFields = $this->getResourceLevel($vref);
        for ($i = 19; $i <= 38; $i++) {
            if ($AttackerFields['f' . $i . 't'] == 37) {
                $HeroMansionLevel = $AttackerFields['f' . $i];
            }
        }
        if ($this->VillageOasisCount($vref) < floor(($HeroMansionLevel - 5) / 5)) {
            $OasisInfo = $this->getOasisInfo($wref);
            //fix by ronix
            if ($OasisInfo['conqured'] == 0 || $OasisInfo['conqured'] != 0 && intval($OasisInfo['loyalty']) < 99 / min(3, (4 - $this->VillageOasisCount($OasisInfo['conqured'])))) {
                $CoordsVillage = $this->getCoor($vref);
                $CoordsOasis = $this->getCoor($wref);
                $max = 2 * WORLD_MAX + 1;
                $x1 = intval($CoordsOasis['x']);
                $y1 = intval($CoordsOasis['y']);
                $x2 = intval($CoordsVillage['x']);
                $y2 = intval($CoordsVillage['y']);
                $distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));
                $distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));
                if ($distanceX <= 3 && $distanceY <= 3) {
                    return 1; //can
                } else {
                    return 2; //can but not in 7x7 field
                }
            } else {
                return 3; //loyalty >0
            }
        } else {
            return 0; //req level hero mansion
        }
    }

    public function conquerOasis($vref, $wref)
    {
        $vinfo = $this->getVillage($vref);
        $uid = $vinfo['owner'];
        $q = "UPDATE `odata` SET conqured=$vref,loyalty=100,lastupdated=" . time() . ",owner=$uid,name='Occupied Oasis' WHERE wref=$wref";
        return mysql_query($q, $this->connection);
    }

    public function modifyOasisLoyalty($wref)
    {
        if ($this->isVillageOases($wref) != 0) {
            $OasisInfo = $this->getOasisInfo($wref);
            if ($OasisInfo['conqured'] != 0) {
                $LoyaltyAmendment = floor(100 / min(3, (4 - $this->VillageOasisCount($OasisInfo['conqured']))));
                $q = "UPDATE `odata` SET loyalty=loyalty-$LoyaltyAmendment, lastupdated=" . time() . " WHERE wref=$wref";
                $result = mysql_query($q, $this->connection);
                return $OasisInfo['loyalty'] - $LoyaltyAmendment;
            }
        }
    }

    function populateOasis()
    {
        $q = "SELECT * FROM wdata where oasistype != 0";
        $result = mysql_query($q, $this->connection);
        while ($row = mysql_fetch_array($result)) {
            $wid = $row['id'];

            $this->addUnits($wid);

        }
    }

    function populateOasisUnits($wid, $high)
    {
        $basearray = $this->getOasisInfo($wid);
        if ($high == 0) {
            $max = rand(15, 30);
        } elseif ($high == 1) {
            $max = rand(50, 70);
        } elseif ($high == 2) {
            $max = rand(90, 120);
        }
        $max2 = 0;
        $rand = rand(0, 3);
        if ($rand == 1) {
            $max2 = 3;
        }
        //each Troop is a Set for oasis type like mountains have rats spiders and snakes fields tigers elphants clay wolves so on stonger one more not so less
        switch ($basearray['type']) {
            case 1:
            case 2:
                //+25% lumber per hour
                $q = "UPDATE units SET  u35 = u35 + '" . rand(0, 5) . "', u36 = u36 + '" . rand(0, 5) . "', u37 = u37 + '" . rand(0, 5) . "' WHERE vref = '" . $wid . "' AND (u35 <= " . $max . " OR u36 <= " . $max . " OR u37 <= " . $max . ")";
                $result = mysql_query($q, $this->connection);
                break;
            case 3:
                //+25% lumber and +25% crop per hour
                $q = "UPDATE units SET  u35 = u35 + '" . rand(0, 5) . "', u36 = u36 + '" . rand(0, 5) . "', u37 = u37 + '" . rand(0, 5) . "', u38 = u38 + '" . rand(0, 5) . "', u40 = u40 + '" . rand(0, $max2) . "' WHERE vref = '" . $wid . "' AND (u36 <= " . $max . " OR u37 <= " . $max . " OR u38 <= " . $max . ")";
                $result = mysql_query($q, $this->connection);
                break;
            case 4:
            case 5:
                //+25% clay per hour
                $q = "UPDATE units SET u31 = u31 + '" . rand(0, 5) . "', u32 = u32 + '" . rand(0, 5) . "', u35 = u35 + '" . rand(0, 5) . "' WHERE vref = '" . $wid . "' AND (u31 <= " . $max . " OR u32 <= " . $max . " OR u35 <= " . $max . ")";
                $result = mysql_query($q, $this->connection);
                break;
            case 6:
                //+25% clay and +25% crop per hour
                $q = "UPDATE units SET u31 = u31 + '" . rand(0, 5) . "', u32 = u32 + '" . rand(0, 5) . "', u35 = u35 + '" . rand(0, 5) . "', u40 = u40 + '" . rand(0, $max2) . "' WHERE vref = '" . $wid . "' AND (u31 <= " . $max . " OR u32 <= " . $max . " OR u35 <= " . $max . ")";
                $result = mysql_query($q, $this->connection);
                break;
            case 7:
            case 8:
                //+25% iron per hour
                $q = "UPDATE units SET u31 = u31 + '" . rand(0, 5) . "', u32 = u32 + '" . rand(0, 5) . "', u34 = u34 + '" . rand(0, 5) . "' WHERE vref = '" . $wid . "' AND (u31 <= " . $max . " OR u32 <= " . $max . " OR u34 <= " . $max . ")";
                $result = mysql_query($q, $this->connection);
                break;
            case 9:
                //+25% iron and +25% crop
                $q = "UPDATE units SET u31 = u31 + '" . rand(0, 5) . "', u32 = u32 + '" . rand(0, 5) . "', u34 = u34 + '" . rand(0, 5) . "', u39 = u39 + '" . rand(0, $max2) . "' WHERE vref = '" . $wid . "' AND (u31 <= " . $max . " OR u32 <= " . $max . " OR u34 <= " . $max . ")";
                $result = mysql_query($q, $this->connection);
                break;
            case 10:
            case 11:
                //+25% crop per hour
                $q = "UPDATE units SET u33 = u33 + '" . rand(0, 5) . "', u37 = u37 + '" . rand(0, 5) . "', u38 = u38 + '" . rand(0, 5) . "', u39 = u39 + '" . rand(0, $max2) . "' WHERE vref = '" . $wid . "' AND (u33 <= " . $max . " OR u37 <= " . $max . " OR u38 <= " . $max . ")";
                $result = mysql_query($q, $this->connection);
                break;
            case 12:
                //+50% crop per hour
                $q = "UPDATE units SET u33 = u33 + '" . rand(0, 5) . "', u37 = u37 + '" . rand(0, 5) . "', u38 = u38 + '" . rand(0, 5) . "', u39 = u39 + '" . rand(0, 5) . "', u40 = u40 + '" . rand(0, $max2) . "' WHERE vref = '" . $wid . "' AND (u33 <= " . $max . " OR u37 <= " . $max . " OR u38 <= " . $max . " OR u39 <= " . $max . ")";
                $result = mysql_query($q, $this->connection);
                break;
        }
    }

    function populateOasisUnits2()
    {
        $q2 = "SELECT * FROM wdata where oasistype != 0";
        $result2 = mysql_query($q2, $this->connection);
        while ($row = mysql_fetch_array($result2)) {
            $wid = $row['id'];
            switch ($row['oasistype']) {
                case 1:
                case 2:
                    //+25% lumber oasis
                    $q = "UPDATE units SET  u35 = u35 + '" . rand(5, 10) . "', u36 = u36 + '" . rand(0, 5) . "', u37 = u37 + '" . rand(0, 5) . "' WHERE vref = '" . $wid . "' AND u35 <= '10' AND u36 <= '10' AND u37 <= '10'";
                    $result = mysql_query($q, $this->connection);
                    break;
                case 3:
                    //+25% lumber and +25% crop oasis
                    $q = "UPDATE units SET u35 = u35 + '" . rand(5, 15) . "', u36 = u36 + '" . rand(0, 5) . "', u37 = u37 + '" . rand(0, 5) . "' WHERE vref = '" . $wid . "' AND u35 <= '10' AND u36 <= '10' AND u37 <='10'";
                    $result = mysql_query($q, $this->connection);
                    break;
                case 4:
                case 5:
                    //+25% clay oasis
                    $q = "UPDATE units SET u31 = u31 + '" . rand(10, 15) . "', u32 = u32 + '" . rand(5, 15) . "', u35 = u35 + '" . rand(0, 10) . "' WHERE vref = '" . $wid . "' AND u31 <= '10' AND u32 <= '10' AND u35 <= '10'";
                    $result = mysql_query($q, $this->connection);
                    break;
                case 6:
                    //+25% clay and +25% crop oasis
                    $q = "UPDATE units SET u31 = u31 + '" . rand(15, 20) . "', u32 = u32 + '" . rand(10, 15) . "', u35 = u35 + '" . rand(0, 10) . "' WHERE vref = '" . $wid . "' AND u31 <= '10' AND u32 <= '10' AND u35 <='10'";
                    $result = mysql_query($q, $this->connection);
                    break;
                case 7:
                case 8:
                    //+25% iron oasis
                    $q = "UPDATE units SET u31 = u31 + '" . rand(10, 15) . "', u32 = u32 + '" . rand(5, 15) . "', u34 = u34 + '" . rand(0, 10) . "' WHERE vref = '" . $wid . "' AND u31 <= '10' AND u32 <= '10' AND u34 <= '10'";
                    $result = mysql_query($q, $this->connection);
                    break;
                case 9:
                    //+25% iron and +25% crop oasis
                    $q = "UPDATE units SET u31 = u31 + '" . rand(15, 20) . "', u32 = u32 + '" . rand(10, 15) . "', u34 = u34 + '" . rand(0, 10) . "' WHERE vref = '" . $wid . "' AND u31 <= '10' AND u32 <= '10' AND u34 <='10'";
                    $result = mysql_query($q, $this->connection);
                    break;
                case 10:
                case 11:
                    //+25% crop oasis
                    $q = "UPDATE units SET u31 = u31 + '" . rand(5, 15) . "', u33 = u33 + '" . rand(5, 10) . "', u37 = u37 + '" . rand(0, 10) . "', u39 = u39 + '" . rand(0, 5) . "' WHERE vref = '" . $wid . "' AND u31 <= '10' AND u33 <= '10' AND u37 <='10' AND u39 <='10'";
                    $result = mysql_query($q, $this->connection);
                    break;
                case 12:
                    //+50% crop oasis
                    $q = "UPDATE units SET u31 = u31 + '" . rand(10, 15) . "', u33 = u33 + '" . rand(5, 10) . "', u38 = u38 + '" . rand(0, 5) . "', u39 = u39 + '" . rand(0, 5) . "' WHERE vref = '" . $wid . "' AND u31 <= '10' AND u33 <= '10' AND u38 <='10'AND u39 <='10'";
                    $result = mysql_query($q, $this->connection);
                    break;
            }
        }
    }

    function removeOases($wref)
    {
        $q = "UPDATE odata SET conqured = 0, owner = 2, name = 'Unoccupied Oasis' WHERE wref = $wref";
        return mysql_query($q, $this->connection);
    }


    /***************************
     * Function to retrieve type of village via ID
     * References: Village ID
     ***************************/
    function getVillageType($wref)
    {
        $q = "SELECT id, fieldtype FROM wdata where id = $wref";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['fieldtype'];
    }


    /*****************************************
     * Function to retrieve if is ocuped via ID
     * References: Village ID
     *****************************************/
    function getVillageState($wref)
    {
        $q = "SELECT oasistype,occupied FROM wdata where id = $wref";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        if ($dbarray['occupied'] != 0 || $dbarray['oasistype'] != 0) {
            return true;
        } else {
            return false;
        }
    }

    function getProfileVillages($uid)
    {
        $q = "SELECT capital,wref,name,pop,created from vdata where owner = $uid order by pop desc";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getProfileMedal($uid)
    {
        $q = "SELECT id,categorie,plaats,week,img,points from medal where userid = $uid and del = 0 order by id desc";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);

    }

    function getProfileMedalAlly($uid)
    {
        $q = "SELECT id,categorie,plaats,week,img,points from allimedal where allyid = $uid and del = 0 order by id desc";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);

    }

    function getVillageID($uid)
    {
        $q = "SELECT wref FROM vdata WHERE owner = $uid";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['wref'];
    }


    function getVillagesID($uid)
    {
        $q = "SELECT wref from vdata where owner = $uid order by capital DESC,pop DESC";
        $result = mysql_query($q, $this->connection);
        $array = $this->mysql_fetch_all($result);
        $newarray = array();
        for ($i = 0; $i < count($array); $i++) {
            array_push($newarray, $array[$i]['wref']);
        }
        return $newarray;
    }

    function getVillagesID2($uid)
    {
        $q = "SELECT wref from vdata where owner = $uid order by capital DESC,pop DESC";
        $result = mysql_query($q, $this->connection);
        $array = $this->mysql_fetch_all($result);
        return $array;
    }

    function getVillage($vid)
    {
        $q = "SELECT * FROM vdata where wref = $vid";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    public function getVillageBattleData($vid)
    {
        $q = "SELECT u.id,u.tribe,v.capital,f.f40 AS wall FROM users u,fdata f,vdata v WHERE u.id=v.owner AND f.vref=v.wref AND v.wref=" . $vid;
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    public function getPopulation($uid)
    {
        $q = "SELECT sum(pop) AS pop FROM vdata WHERE owner=" . $uid;
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['pop'];
    }

    function getOasisV($vid)
    {
        $q = "SELECT * FROM odata where wref = $vid";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function getMInfo($id)
    {
        $q = "SELECT * FROM wdata left JOIN vdata ON vdata.wref = wdata.id where wdata.id = $id";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function getOMInfo($id)
    {
        $q = "SELECT * FROM wdata left JOIN odata ON odata.wref = wdata.id where wdata.id = $id";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function getOasis($vid)
    {
        $q = "SELECT * FROM odata where conqured = $vid";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getOasisInfo($wid)
    {
        $q = "SELECT * FROM odata where wref = $wid";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    function getVillageField($ref, $field)
    {
        $q = "SELECT $field FROM vdata where wref = $ref";
        $result = mysql_query($q, $this->connection);
        if ($result) {
            $dbarray = mysql_fetch_array($result);
            return $dbarray[$field];
        } elseif ($field == "name") {
            return "??";
        } else return 0;
    }

    function getOasisField($ref, $field)
    {
        $q = "SELECT $field FROM odata where wref = $ref";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray[$field];
    }

    function setVillageField($ref, $field, $value)
    {
        $q = "UPDATE vdata set $field = '$value' where wref = $ref";
        return mysql_query($q, $this->connection);
    }

    function setVillageLevel($ref, $field, $value)
    {
        $q = "UPDATE fdata set " . $field . " = '" . $value . "' where vref = " . $ref . "";
        return mysql_query($q, $this->connection);
    }

    function getResourceLevel($vid)
    {
        $q = "SELECT * from fdata where vref = $vid";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    function getAdminLog()
    {
        $q = "SELECT id,user,log,time from admin_log where id != 0 ORDER BY id ASC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    //fix market log
    function getMarketLog()
    {
        $q = "SELECT id,wid,log from market_log where id != 0 ORDER BY id ASC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getMarketLogVillage($village)
    {
        $q = "SELECT wref,owner,name from vdata where wref =$village ";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getMarketLogUsers($id_user)
    {
        $q = "SELECT id,username from users where id =$id_user ";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    //end fix

    function getCoor($wref)
    {
        if ($wref != "") {
            $q = "SELECT x,y FROM wdata where id = $wref";
            $result = mysql_query($q, $this->connection);
            return mysql_fetch_array($result);
        }
    }

    function CheckForum($id)
    {
        $q = "SELECT * from forum_cat where alliance = '$id'";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    function CountCat($id)
    {
        $q = "SELECT count(id) FROM forum_topic where cat = '$id'";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        return $row[0];
    }

    function LastTopic($id)
    {
        $q = "SELECT * from forum_topic where cat = '$id' order by post_date";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function CheckLastTopic($id)
    {
        $q = "SELECT * from forum_topic where cat = '$id'";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    function CheckLastPost($id)
    {
        $q = "SELECT * from forum_post where topic = '$id'";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    function LastPost($id)
    {
        $q = "SELECT * from forum_post where topic = '$id'";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function CountTopic($id)
    {
        $q = "SELECT count(id) FROM forum_post where owner = '$id'";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);

        $qs = "SELECT count(id) FROM forum_topic where owner = '$id'";
        $results = mysql_query($qs, $this->connection);
        $rows = mysql_fetch_row($results);
        return $row[0] + $rows[0];
    }

    function CountPost($id)
    {
        $q = "SELECT count(id) FROM forum_post where topic = '$id'";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        return $row[0];
    }

    function ForumCat($id)
    {
        $q = "SELECT * from forum_cat where alliance = '$id' ORDER BY id";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function ForumCatEdit($id)
    {
        $q = "SELECT * from forum_cat where id = '$id'";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function ForumCatAlliance($id)
    {
        $q = "SELECT alliance from forum_cat where id = $id";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['alliance'];
    }

    function ForumCatName($id)
    {
        $q = "SELECT forum_name from forum_cat where id = $id";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['forum_name'];
    }

    function CheckCatTopic($id)
    {
        $q = "SELECT * from forum_topic where cat = '$id'";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    function CheckResultEdit($alli)
    {
        $q = "SELECT * from forum_edit where alliance = '$alli'";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    function CheckCloseTopic($id)
    {
        $q = "SELECT close from forum_topic where id = '$id'";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['close'];
    }

    function CheckEditRes($alli)
    {
        $q = "SELECT result from forum_edit where alliance = '$alli'";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['result'];
    }

    function CreatResultEdit($alli, $result)
    {
        $q = "INSERT into forum_edit values (0,'$alli','$result')";
        mysql_query($q, $this->connection);
        return mysql_insert_id($this->connection);
    }

    function UpdateResultEdit($alli, $result)
    {
        $date = time();
        $q = "UPDATE forum_edit set result = '$result' where alliance = '$alli'";
        return mysql_query($q, $this->connection);
    }

    function getVillageType2($wref)
    {
        $q = "SELECT * FROM wdata where id = $wref";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['oasistype'];
    }

    function getVillageType3($wref)
    {
        $q = "SELECT * FROM wdata where id = $wref";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray;
    }

    function getFLData($id)
    {
        $q = "SELECT * FROM farmlist where id = $id";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function checkVilExist($wref)
    {
        $q = "SELECT * FROM vdata where wref = '$wref'";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    function checkOasisExist($wref)
    {
        $q = "SELECT * FROM odata where wref = '$wref'";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    function UpdateEditTopic($id, $title, $cat)
    {
        $q = "UPDATE forum_topic set title = '$title', cat = '$cat' where id = $id";
        return mysql_query($q, $this->connection);
    }

    function UpdateEditForum($id, $name, $des)
    {
        $q = "UPDATE forum_cat set forum_name = '$name', forum_des = '$des' where id = $id";
        return mysql_query($q, $this->connection);
    }

    function StickTopic($id, $mode)
    {
        $q = "UPDATE forum_topic set stick = '$mode' where id = '$id'";
        return mysql_query($q, $this->connection);
    }

    function ForumCatTopic($id)
    {
        $q = "SELECT * from forum_topic where cat = '$id' AND stick = '' ORDER BY post_date desc";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function ForumCatTopicStick($id)
    {
        $q = "SELECT * from forum_topic where cat = '$id' AND stick = '1' ORDER BY post_date desc";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function ShowTopic($id)
    {
        $q = "SELECT * from forum_topic where id = '$id'";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function ShowPost($id)
    {
        $q = "SELECT * from forum_post where topic = '$id'";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function ShowPostEdit($id)
    {
        $q = "SELECT * from forum_post where id = '$id'";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function CreatForum($owner, $alli, $name, $des, $area)
    {
        $q = "INSERT into forum_cat values (0,'$owner','$alli','$name','$des','$area')";
        mysql_query($q, $this->connection);
        return mysql_insert_id($this->connection);
    }

    function CreatTopic($title, $post, $cat, $owner, $alli, $ends, $alliance, $player, $coor, $report)
    {
        $date = time();
        $q = "INSERT into forum_topic values (0,'$title','$post','$date','$date','$cat','$owner','$alli','$ends','','','$alliance','$player','$coor','$report')";
        mysql_query($q, $this->connection);
        return mysql_insert_id($this->connection);
    }

    /*************************
     * FORUM SUREY
     *************************/

    function createSurvey($topic, $title, $option1, $option2, $option3, $option4, $option5, $option6, $option7, $option8, $ends)
    {
        $q = "INSERT into forum_survey (topic,title,option1,option2,option3,option4,option5,option6,option7,option8,ends) values ('$topic','$title','$option1','$option2','$option3','$option4','$option5','$option6','$option7','$option8','$ends')";
        return mysql_query($q, $this->connection);
    }

    function getSurvey($topic)
    {
        $q = "SELECT * FROM forum_survey where topic = $topic";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function checkSurvey($topic)
    {
        $q = "SELECT * FROM forum_survey where topic = $topic";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    function Vote($topic, $num, $text)
    {
        $q = "UPDATE forum_survey set vote" . $num . " = vote" . $num . " + 1, voted = '$text' where topic = " . $topic . "";
        return mysql_query($q, $this->connection);
    }

    function checkVote($topic, $uid)
    {
        $q = "SELECT * FROM forum_survey where topic = $topic";
        $result = mysql_query($q, $this->connection);
        $array = mysql_fetch_array($result);
        $text = $array['voted'];
        if (preg_match('/,' . $uid . ',/', $text)) {
            return true;
        } else {
            return false;
        }
    }

    function getVoteSum($topic)
    {
        $q = "SELECT * FROM forum_survey where topic = $topic";
        $result = mysql_query($q, $this->connection);
        $array = mysql_fetch_array($result);
        $sum = 0;
        for ($i = 1; $i <= 8; $i++) {
            $sum += $array['vote' . $i];
        }
        return $sum;
    }


    /*************************
     * FORUM SUREY
     *************************/

    function CreatPost($post, $tids, $owner, $alliance, $player, $coor, $report)
    {
        $date = time();
        $q = "INSERT into forum_post values (0,'$post','$tids','$owner','$date','$alliance','$player','$coor','$report')";
        mysql_query($q, $this->connection);
        return mysql_insert_id($this->connection);
    }

    function UpdatePostDate($id)
    {
        $date = time();
        $q = "UPDATE forum_topic set post_date = '$date' where id = $id";
        return mysql_query($q, $this->connection);
    }

    function EditUpdateTopic($id, $post, $alliance, $player, $coor, $report)
    {
        $q = "UPDATE forum_topic set post = '$post', alliance0 = '$alliance', player0 = '$player', coor0 = '$coor', report0 = '$report' where id = $id";
        return mysql_query($q, $this->connection);
    }

    function EditUpdatePost($id, $post, $alliance, $player, $coor, $report)
    {
        $q = "UPDATE forum_post set post = '$post', alliance0 = '$alliance', player0 = '$player', coor0 = '$coor', report0 = '$report' where id = $id";
        return mysql_query($q, $this->connection);
    }

    function LockTopic($id, $mode)
    {
        $q = "UPDATE forum_topic set close = '$mode' where id = '$id'";
        return mysql_query($q, $this->connection);
    }

    function DeleteCat($id)
    {
        $qs = "DELETE from forum_cat where id = '$id'";
        $q = "DELETE from forum_topic where cat = '$id'";
        $q2 = "SELECT id from forum_topic where cat ='$id'";
        $result = mysql_query($q2, $this->connection);
        if (!empty($result)) {
            $array = $this->mysql_fetch_all($result);
            foreach ($array as $ss) {
                $this->DeleteSurvey($ss['id']);
            }
        }
        mysql_query($qs, $this->connection);
        return mysql_query($q, $this->connection);
    }

    function DeleteSurvey($id)
    {
        $qs = "DELETE from forum_survey where topic = '$id'";
        return mysql_query($qs, $this->connection);
    }

    function DeleteTopic($id)
    {
        $qs = "DELETE from forum_topic where id = '$id'";
        //  $q = "DELETE from forum_post where topic = '$id'";//
        return mysql_query($qs, $this->connection); //
        // mysql_query($q,$this->connection);
    }

    function DeletePost($id)
    {
        $q = "DELETE from forum_post where id = '$id'";
        return mysql_query($q, $this->connection);
    }

    function getAllianceName($id)
    {
        $q = "SELECT tag from alidata where id = $id";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['tag'];
    }

    function getAlliancePermission($ref, $field, $mode)
    {
        if (!$mode) {
            $q = "SELECT $field FROM ali_permission where uid = '$ref'";
        } else {
            $q = "SELECT $field FROM ali_permission where username = '$ref'";
        }
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray[$field];
    }

    function getAlliance($id)
    {
        $q = "SELECT * from alidata where id = $id";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    function setAlliName($aid, $name, $tag)
    {
        $q = "UPDATE alidata set name = '$name', tag = '$tag' where id = $aid";
        return mysql_query($q, $this->connection);
    }

    function isAllianceOwner($id)
    {
        $q = "SELECT * from alidata where leader = '$id'";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    function aExist($ref, $type)
    {
        $q = "SELECT $type FROM alidata where $type = '$ref'";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    function modifyPoints($aid, $points, $amt)
    {
        $q = "UPDATE users set $points = $points + $amt where id = $aid";
        return mysql_query($q, $this->connection);
    }

    function modifyPointsAlly($aid, $points, $amt)
    {
        $q = "UPDATE alidata set $points = $points + $amt where id = $aid";
        return mysql_query($q, $this->connection);
    }

    /*****************************************
     * Function to create an alliance
     * References:
     *****************************************/
    function createAlliance($tag, $name, $uid, $max)
    {
        $q = "INSERT into alidata values (0,'$name','$tag',$uid,0,0,0,'','',$max,'','','','','','','','','')";
        mysql_query($q, $this->connection);
        return mysql_insert_id($this->connection);
    }

    function procAllyPop($aid)
    {
        $ally = $this->getAlliance($aid);
        $memberlist = $this->getAllMember($ally['id']);
        $oldrank = 0;
        foreach ($memberlist as $member) {
            $oldrank += $this->getVSumField($member['id'], "pop");
        }
        if ($ally['oldrank'] != $oldrank) {
            if ($ally['oldrank'] < $oldrank) {
                $totalpoints = $oldrank - $ally['oldrank'];
                $this->addclimberrankpopAlly($ally['id'], $totalpoints);
                $this->updateoldrankAlly($ally['id'], $oldrank);
            } else
                if ($ally['oldrank'] > $oldrank) {
                    $totalpoints = $ally['oldrank'] - $oldrank;
                    $this->removeclimberrankpopAlly($ally['id'], $totalpoints);
                    $this->updateoldrankAlly($ally['id'], $oldrank);
                }
        }
    }

    /*****************************************
     * Function to insert an alliance new
     * References:
     *****************************************/
    function insertAlliNotice($aid, $notice)
    {
        $time = time();
        $q = "INSERT into ali_log values (0,'$aid','$notice',$time)";
        mysql_query($q, $this->connection);
        return mysql_insert_id($this->connection);
    }

    /*****************************************
     * Function to delete alliance if empty
     * References:
     *****************************************/
    function deleteAlliance($aid)
    {
        $result = mysql_query("SELECT * FROM users where alliance = $aid");
        $num_rows = mysql_num_rows($result);
        if ($num_rows == 0) {
            $q = "DELETE FROM alidata WHERE id = $aid";
        }
        mysql_query($q, $this->connection);
        return mysql_insert_id($this->connection);
    }

    /*****************************************
     * Function to read all alliance news
     * References:
     *****************************************/
    function readAlliNotice($aid)
    {
        $q = "SELECT * from ali_log where aid = $aid ORDER BY date DESC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    /*****************************************
     * Function to create alliance permissions
     * References: ID, notice, description
     *****************************************/
    function createAlliPermissions($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7, $opt8)
    {

        $q = "INSERT into ali_permission values(0,'$uid','$aid','$rank','$opt1','$opt2','$opt3','$opt4','$opt5','$opt6','$opt7','$opt8')";
        mysql_query($q, $this->connection);
        return mysql_insert_id($this->connection);
    }

    /*****************************************
     * Function to update alliance permissions
     * References:
     *****************************************/
    function deleteAlliPermissions($uid)
    {
        $q = "DELETE from ali_permission where uid = '$uid'";
        return mysql_query($q, $this->connection);
    }

    /*****************************************
     * Function to update alliance permissions
     * References:
     *****************************************/
    function updateAlliPermissions($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7)
    {

        $q = "UPDATE ali_permission SET rank = '$rank', opt1 = '$opt1', opt2 = '$opt2', opt3 = '$opt3', opt4 = '$opt4', opt5 = '$opt5', opt6 = '$opt6', opt7 = '$opt7' where uid = $uid && alliance =$aid";
        return mysql_query($q, $this->connection);
    }

    /*****************************************
     * Function to read alliance permissions
     * References: ID, notice, description
     *****************************************/
    function getAlliPermissions($uid, $aid)
    {
        $q = "SELECT * FROM ali_permission where uid = $uid && alliance = $aid";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    /*****************************************
     * Function to update an alliance description and notice
     * References: ID, notice, description
     *****************************************/
    function submitAlliProfile($aid, $notice, $desc)
    {

        $q = "UPDATE alidata SET `notice` = '$notice', `desc` = '$desc' where id = $aid";
        return mysql_query($q, $this->connection);
    }

    function diplomacyInviteAdd($alli1, $alli2, $type)
    {
        $q = "INSERT INTO diplomacy (alli1,alli2,type,accepted) VALUES ($alli1,$alli2," . (int)intval($type) . ",0)";
        return mysql_query($q, $this->connection);
    }

    function diplomacyOwnOffers($session_alliance)
    {
        $q = "SELECT * FROM diplomacy WHERE alli1 = $session_alliance AND accepted = 0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getAllianceID($name)
    {
        $q = "SELECT id FROM alidata WHERE tag ='" . $this->RemoveXSS($name) . "'";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['id'];
    }

    function getDiplomacy($aid)
    {
        $q = "SELECT * FROM diplomacy WHERE id = $aid";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function diplomacyCancelOffer($id)
    {
        $q = "DELETE FROM diplomacy WHERE id = $id";
        return mysql_query($q, $this->connection);
    }

    function diplomacyInviteAccept($id, $session_alliance)
    {
        $q = "UPDATE diplomacy SET accepted = 1 WHERE id = $id AND alli2 = $session_alliance";
        return mysql_query($q, $this->connection);
    }

    function diplomacyInviteDenied($id, $session_alliance)
    {
        $q = "DELETE FROM diplomacy WHERE id = $id AND alli2 = $session_alliance";
        return mysql_query($q, $this->connection);
    }

    function diplomacyInviteCheck($session_alliance)
    {
        $q = "SELECT * FROM diplomacy WHERE alli2 = $session_alliance AND accepted = 0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function diplomacyInviteCheck2($ally1, $ally2)
    {
        $q = "SELECT * FROM diplomacy WHERE alli1 = $ally1 AND alli2 = $ally2 accepted = 0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getAllianceDipProfile($aid, $type)
    {
        $q = "SELECT * FROM diplomacy WHERE alli1 = '$aid' AND type = '$type' AND accepted = '1' OR alli2 = '$aid' AND type = '$type' AND accepted = '1'";
        $array = $this->query_return($q);
        foreach ($array as $row) {
            if ($row['alli1'] == $aid) {
                $alliance = $this->getAlliance($row['alli2']);
            } elseif ($row['alli2'] == $aid) {
                $alliance = $this->getAlliance($row['alli1']);
            }
            $text .= "";
            $text .= "<a href=allianz.php?aid=" . $alliance['id'] . ">" . $alliance['tag'] . "</a><br> ";
        }
        if (strlen($text) == 0) {
            $text = "-<br>";
        }
        return $text;
    }

    function getAllianceWar($aid)
    {
        $q = "SELECT * FROM diplomacy WHERE alli1 = '$aid' AND type = '3' OR alli2 = '$aid' AND type = '3' AND accepted = '1'";
        $array = $this->query_return($q);
        foreach ($array as $row) {
            if ($row['alli1'] == $aid) {
                $alliance = $this->getAlliance($row['alli2']);
            } elseif ($row['alli2'] == $aid) {
                $alliance = $this->getAlliance($row['alli1']);
            }
            $text .= "";
            $text .= "<a href=allianz.php?aid=" . $alliance['id'] . ">" . $alliance['tag'] . "</a><br> ";
        }
        if (strlen($text) == 0) {
            $text = "-<br>";
        }
        return $text;
    }

    function getAllianceAlly($aid, $type)
    {
        $q = "SELECT * FROM diplomacy WHERE (alli1 = '$aid' or alli2 = '$aid') AND (type = '$type' AND accepted = '1')";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getAllianceWar2($aid)
    {
        $q = "SELECT * FROM diplomacy WHERE alli1 = '$aid' AND type = '3' OR alli2 = '$aid' AND type = '3' AND accepted = '1'";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function diplomacyExistingRelationships($session_alliance)
    {
        $q = "SELECT * FROM diplomacy WHERE alli2 = $session_alliance AND accepted = 1";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function diplomacyExistingRelationships2($session_alliance)
    {
        $q = "SELECT * FROM diplomacy WHERE alli1 = $session_alliance AND accepted = 1";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function diplomacyCancelExistingRelationship($id, $session_alliance)
    {
        $q = "DELETE FROM diplomacy WHERE id = $id AND alli2 = $session_alliance OR id = $id AND alli1 = $session_alliance";
        return mysql_query($q, $this->connection);
    }

    function checkDiplomacyInviteAccept($aid, $type)
    {
        $q = "SELECT * FROM diplomacy WHERE alli1 = $aid AND type = $type AND accepted = 1 OR alli2 = $aid AND type = $type AND accepted = 1";
        $result = mysql_query($q, $this->connection);
        if ($type == 3) {
            return true;
        } else {
            if (mysql_num_rows($result) < 4) {
                return true;
            } else {
                return false;
            }
        }
    }

    function setAlliForumLink($aid, $link)
    {
        $q = "UPDATE alidata SET `forumlink` = '$link' WHERE id = $aid";
        return mysql_query($q, $this->connection);
    }

    function getUserAlliance($id)
    {
        $q = "SELECT alidata.tag from users join alidata where users.alliance = alidata.id and users.id = $id";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        if ($dbarray['tag'] == "") {
            return "-";
        } else {
            return $dbarray['tag'];
        }
    }

    /////////////ADDED BY BRAINIAC - THANK YOU

    function modifyResource($vid, $wood, $clay, $iron, $crop, $mode)
    {
        $q = "SELECT wood,clay,iron,crop,maxstore,maxcrop from vdata where wref = " . $vid . "";
        $result = mysql_query($q, $this->connection);
        $checkres = $this->mysql_fetch_all($result);
        if (!$mode) {
            $nwood = $checkres[0]['wood'] - $wood;
            $nclay = $checkres[0]['clay'] - $clay;
            $niron = $checkres[0]['iron'] - $iron;
            $ncrop = $checkres[0]['crop'] - $crop;
            if ($nwood < 0 or $nclay < 0 or $niron < 0 or $ncrop < 0) {
                $shit = true;
            }
            $dwood = ($nwood < 0) ? 0 : $nwood;
            $dclay = ($nclay < 0) ? 0 : $nclay;
            $diron = ($niron < 0) ? 0 : $niron;
            $dcrop = ($ncrop < 0) ? 0 : $ncrop;
        } else {
            $nwood = $checkres[0]['wood'] + $wood;
            $nclay = $checkres[0]['clay'] + $clay;
            $niron = $checkres[0]['iron'] + $iron;
            $ncrop = $checkres[0]['crop'] + $crop;
            $dwood = ($nwood > $checkres[0]['maxstore']) ? $checkres[0]['maxstore'] : $nwood;
            $dclay = ($nclay > $checkres[0]['maxstore']) ? $checkres[0]['maxstore'] : $nclay;
            $diron = ($niron > $checkres[0]['maxstore']) ? $checkres[0]['maxstore'] : $niron;
            $dcrop = ($ncrop > $checkres[0]['maxcrop']) ? $checkres[0]['maxcrop'] : $ncrop;
        }
        if (!$shit) {
            $q = "UPDATE vdata set wood = $dwood, clay = $dclay, iron = $diron, crop = $dcrop where wref = " . $vid;
            return mysql_query($q, $this->connection);
        } else {
            return false;
        }
    }

    function modifyOasisResource($vid, $wood, $clay, $iron, $crop, $mode)
    {
        $q = "SELECT wood,clay,iron,crop,maxstore,maxcrop from odata where wref = " . $vid . "";
        $result = mysql_query($q, $this->connection);
        $checkres = $this->mysql_fetch_all($result);
        if (!$mode) {
            $nwood = $checkres[0]['wood'] - $wood;
            $nclay = $checkres[0]['clay'] - $clay;
            $niron = $checkres[0]['iron'] - $iron;
            $ncrop = $checkres[0]['crop'] - $crop;
            if ($nwood < 0 or $nclay < 0 or $niron < 0 or $ncrop < 0) {
                $shit = true;
            }
            $dwood = ($nwood < 0) ? 0 : $nwood;
            $dclay = ($nclay < 0) ? 0 : $nclay;
            $diron = ($niron < 0) ? 0 : $niron;
            $dcrop = ($ncrop < 0) ? 0 : $ncrop;
        } else {
            $nwood = $checkres[0]['wood'] + $wood;
            $nclay = $checkres[0]['clay'] + $clay;
            $niron = $checkres[0]['iron'] + $iron;
            $ncrop = $checkres[0]['crop'] + $crop;
            $dwood = ($nwood > $checkres[0]['maxstore']) ? $checkres[0]['maxstore'] : $nwood;
            $dclay = ($nclay > $checkres[0]['maxstore']) ? $checkres[0]['maxstore'] : $nclay;
            $diron = ($niron > $checkres[0]['maxstore']) ? $checkres[0]['maxstore'] : $niron;
            $dcrop = ($ncrop > $checkres[0]['maxcrop']) ? $checkres[0]['maxcrop'] : $ncrop;
        }
        if (!$shit) {
            $q = "UPDATE odata set wood = $dwood, clay = $dclay, iron = $diron, crop = $dcrop where wref = " . $vid;
            return mysql_query($q, $this->connection);
        } else {
            return false;
        }
    }

    function getFieldLevel($vid, $field)
    {
        $q = "SELECT f" . $field . " from fdata where vref = $vid";
        $result = mysql_query($q, $this->connection);
        return mysql_result($result, 0);
    }

    function getFieldType($vid, $field)
    {
        $q = "SELECT f" . $field . "t from fdata where vref = $vid";
        $result = mysql_query($q, $this->connection);
        return mysql_result($result, 0);
    }

    function getFieldDistance($wid)
    {
        $q = "SELECT * FROM vdata where owner > 4 and wref != $wid";
        $array = $this->query_return($q);
        $coor = $this->getCoor($wid);
        $x1 = intval($coor['x']);
        $y1 = intval($coor['y']);
        $prevdist = 0;
        $q2 = "SELECT * FROM vdata where owner = 4";
        $array2 = mysql_fetch_array(mysql_query($q2));
        $vill = $array2['wref'];
        if (mysql_num_rows(mysql_query($q)) > 0) {
            foreach ($array as $village) {
                $coor2 = $this->getCoor($village['wref']);
                $max = 2 * WORLD_MAX + 1;
                $x2 = intval($coor2['x']);
                $y2 = intval($coor2['y']);
                $distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));
                $distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));
                $dist = sqrt(pow($distanceX, 2) + pow($distanceY, 2));
                if ($dist < $prevdist or $prevdist == 0) {
                    $prevdist = $dist;
                    $vill = $village['wref'];
                }
            }
        }
        return $vill;
    }

    function getVSumField($uid, $field)
    {
        if ($field != "cp") {
            $q = "SELECT sum(" . $field . ") FROM vdata where owner = $uid";
        } else {
            $q = "SELECT sum(" . $field . ") FROM vdata where owner = $uid and natar = 0";
        }
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        return $row[0];
    }

    function updateVillage($vid)
    {
        $time = time();
        $q = "UPDATE vdata set lastupdate = $time where wref = $vid";
        return mysql_query($q, $this->connection);
    }


    function updateOasis($vid)
    {
        $time = time();
        $q = "UPDATE odata set lastupdated = $time where wref = $vid";
        return mysql_query($q, $this->connection);
    }

    function updateOasis2($vid, $time)
    {
        $time = time();
        $time2 = NATURE_REGTIME;
        $q = "UPDATE odata set lastupdated2 = $time + $time2 where wref = $vid";
        return mysql_query($q, $this->connection);
    }

    function setVillageName($vid, $name)
    {
        if (!empty($name)) {
            $q = "UPDATE vdata set name = '$name' where wref = $vid";
            return mysql_query($q, $this->connection);
        }
    }

    function modifyPop($vid, $pop, $mode)
    {
        if (!$mode) {
            $q = "UPDATE vdata set pop = pop + $pop where wref = $vid";
        } else {
            $q = "UPDATE vdata set pop = pop - $pop where wref = $vid";
        }
        return mysql_query($q, $this->connection);
    }

    function addCP($ref, $cp)
    {
        $q = "UPDATE vdata set cp = cp + $cp where wref = $ref";
        return mysql_query($q, $this->connection);
    }

    function addCel($ref, $cel, $type)
    {
        $q = "UPDATE vdata set celebration = $cel, type= $type where wref = $ref";
        return mysql_query($q, $this->connection);
    }

    function getCel()
    {
        $time = time();
        $q = "SELECT * FROM vdata where celebration < $time AND celebration != 0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function clearCel($ref)
    {
        $q = "UPDATE vdata set celebration = 0, type = 0 where wref = $ref";
        return mysql_query($q, $this->connection);
    }

    function setCelCp($user, $cp)
    {
        $q = "UPDATE users set cp = cp + $cp where id = $user";
        return mysql_query($q, $this->connection);
    }

    function clearExpansionSlot($id)
    {
        for ($i = 1; $i <= 3; $i++) {
            $q = "UPDATE vdata SET exp" . $i . "=0 WHERE exp" . $i . "=" . $id;
            mysql_query($q, $this->connection);
        }
    }

    function getInvitation($uid)
    {
        $q = "SELECT * FROM ali_invite where uid = $uid";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getInvitation2($uid, $aid)
    {
        $q = "SELECT * FROM ali_invite where uid = $uid and alliance = $aid";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getAliInvitations($aid)
    {
        $q = "SELECT * FROM ali_invite where alliance = $aid && accept = 0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function sendInvitation($uid, $alli, $sender)
    {
        $time = time();
        $q = "INSERT INTO ali_invite values (0,$uid,$alli,$sender,$time,0)";
        return mysql_query($q, $this->connection));
    }

    function removeInvitation($id)
    {
        $q = "DELETE FROM ali_invite where id = $id";
        return mysql_query($q, $this->connection);
    }

    function sendMessage($client, $owner, $topic, $message, $send, $alliance, $player, $coor, $report)
    {
        $time = time();
        $q = "INSERT INTO mdata values (0,$client,$owner,'$topic',\"$message\",0,0,$send,$time,0,0,$alliance,$player,$coor,$report)";
        return mysql_query($q, $this->connection);
    }

    function setArchived($id)
    {
        $q = "UPDATE mdata set archived = 1 where id = $id";
        return mysql_query($q, $this->connection);
    }

    function setNorm($id)
    {
        $q = "UPDATE mdata set archived = 0 where id = $id";
        return mysql_query($q, $this->connection);
    }

    /***************************
     * Function to get messages
     * Mode 1: Get inbox
     * Mode 2: Get sent
     * Mode 3: Get message
     * Mode 4: Set viewed
     * Mode 5: Remove message
     * Mode 6: Retrieve archive
     * References: User ID/Message ID, Mode
     ***************************/
    function getMessage($id, $mode)
    {
        global $session;
        switch ($mode) {
            case 1:
                $q = "SELECT * FROM mdata WHERE target = $id and send = 0 and archived = 0 ORDER BY time DESC";
                break;
            case 2:
                $q = "SELECT * FROM mdata WHERE owner = $id ORDER BY time DESC";
                break;
            case 3:
                $q = "SELECT * FROM mdata where id = $id";
                break;
            case 4:
                $q = "UPDATE mdata set viewed = 1 where id = $id AND target = $session->uid";
                break;
            case 5:
                $q = "UPDATE mdata set deltarget = 1,viewed = 1 where id = $id";
                break;
            case 6:
                $q = "SELECT * FROM mdata where target = $id and send = 0 and archived = 1";
                break;
            case 7:
                $q = "UPDATE mdata set delowner = 1 where id = $id";
                break;
            case 8:
                $q = "UPDATE mdata set deltarget = 1,delowner = 1,viewed = 1 where id = $id";
                break;
            case 9:
                $q = "SELECT * FROM mdata WHERE target = $id and send = 0 and archived = 0 and deltarget = 0 ORDER BY time DESC";
                break;
            case 10:
                $q = "SELECT * FROM mdata WHERE owner = $id and delowner = 0 ORDER BY time DESC";
                break;
            case 11:
                $q = "SELECT * FROM mdata where target = $id and send = 0 and archived = 1 and deltarget = 0";
                break;
        }
        if ($mode <= 3 || $mode == 6 || $mode > 8) {
            $result = mysql_query($q, $this->connection);
            return $this->mysql_fetch_all($result);
        } else {
            return mysql_query($q, $this->connection);
        }
    }

    function getDelSent($uid)
    {
        $q = "SELECT * FROM mdata WHERE owner = $uid and delowner = 1 ORDER BY time DESC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getDelInbox($uid)
    {
        $q = "SELECT * FROM mdata WHERE target = $uid and deltarget = 1 ORDER BY time DESC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getDelArchive($uid)
    {
        $q = "SELECT * FROM mdata WHERE target = $uid and archived = 1 and deltarget = 1 OR owner = $uid and archived = 1 and delowner = 1 ORDER BY time DESC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function unarchiveNotice($id)
    {
        $q = "UPDATE ndata set ntype = archive, archive = 0 where id = $id";
        return mysql_query($q, $this->connection);
    }

    function archiveNotice($id)
    {
        $q = "update ndata set archive = ntype, ntype = 9 where id = $id";
        return mysql_query($q, $this->connection);
    }

    function removeNotice($id)
    {
        $q = "UPDATE ndata set del = 1,viewed = 1 where id = $id";
        return mysql_query($q, $this->connection);
    }

    function noticeViewed($id)
    {
        $q = "UPDATE ndata set viewed = 1 where id = $id";
        return mysql_query($q, $this->connection);
    }

    function addNotice($uid, $toWref, $ally, $type, $topic, $data, $time = 0)
    {
        if ($time == 0) {
            $time = time();
        }
        $q = "INSERT INTO ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'$uid','$toWref','$ally','$topic',$type,'$data',$time,0)";
        return mysql_query($q, $this->connection));
    }

    function getNotice($uid)
    {
        $q = "SELECT * FROM ndata where uid = $uid and del = 0 ORDER BY time DESC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getNotice2($id, $field)
    {
        $q = "SELECT " . $field . " FROM ndata where `id` = '$id'";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray[$field];
    }

    function getNotice3($uid)
    {
        $q = "SELECT * FROM ndata where uid = $uid ORDER BY time DESC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getNotice4($id)
    {
        $q = "SELECT * FROM ndata where id = $id ORDER BY time DESC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getUnViewNotice($uid)
    {
        $q = "SELECT * FROM ndata where uid = $uid AND viewed=0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function createTradeRoute($uid, $wid, $from, $r1, $r2, $r3, $r4, $start, $deliveries, $merchant, $time)
    {
        $x = "UPDATE users SET gold = gold - 2 WHERE id = " . $uid . "";
        mysql_query($x, $this->connection);
        $timeleft = time() + 604800;
        $q = "INSERT into route values (0,$uid,$wid,$from,$r1,$r2,$r3,$r4,$start,$deliveries,$merchant,$time,$timeleft)";
        return mysql_query($q, $this->connection);
    }

    function getTradeRoute($uid)
    {
        $q = "SELECT * FROM route where uid = $uid ORDER BY timestamp ASC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getTradeRoute2($id)
    {
        $q = "SELECT * FROM route where id = $id";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray;
    }

    function getTradeRouteUid($id)
    {
        $q = "SELECT * FROM route where id = $id";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray['uid'];
    }

    function editTradeRoute($id, $column, $value, $mode)
    {
        if (!$mode) {
            $q = "UPDATE route set $column = $value where id = $id";
        } else {
            $q = "UPDATE route set $column = $column + $value where id = $id";
        }
        return mysql_query($q, $this->connection);
    }

    function deleteTradeRoute($id)
    {
        $q = "DELETE FROM route where id = $id";
        return mysql_query($q, $this->connection);
    }

    function addBuilding($wid, $field, $type, $loop, $time, $master, $level)
    {
        $x = "UPDATE fdata SET f" . $field . "t=" . $type . " WHERE vref=" . $wid;
        mysql_query($x, $this->connection));
        $q = "INSERT into bdata values (0,$wid,$field,$type,$loop,$time,$master,$level)";
        return mysql_query($q, $this->connection);
    }

    function removeBuilding($d)
    {
        global $building, $village;
        $jobLoopconID = -1;
        $SameBuildCount = 0;
        $jobs = $building->buildArray;
        for ($i = 0; $i < sizeof($jobs); $i++) {
            if ($jobs[$i]['id'] == $d) {
                $jobDeleted = $i;
            }
            if ($jobs[$i]['loopcon'] == 1) {
                $jobLoopconID = $i;
            }
            if ($jobs[$i]['master'] == 1) {
                $jobMaster = $i;
            }
        }
        if (count($jobs) > 1 && ($jobs[0]['field'] == $jobs[1]['field'])) {
            $SameBuildCount = 1;
        }
        if (count($jobs) > 2 && ($jobs[0]['field'] == $jobs[2]['field'])) {
            $SameBuildCount = 2;
        }
        if (count($jobs) > 2 && ($jobs[1]['field'] == $jobs[2]['field'])) {
            $SameBuildCount = 3;
        }
        if (count($jobs) > 3 && ($jobs[0]['field'] == $jobs[3]['field'])) {
            $SameBuildCount = 8;
        }
        if (count($jobs) > 3 && ($jobs[1]['field'] == $jobs[3]['field'])) {
            $SameBuildCount = 9;
        }
        if (count($jobs) > 3 && ($jobs[2]['field'] == $jobs[3]['field'])) {
            $SameBuildCount = 10;
        }
        if (count($jobs) > 2 && ($jobs[0]['field'] == $jobs[1]['field'] && $jobs[1]['field'] == $jobs[2]['field'])) {
            $SameBuildCount = 4;
        }
        if (count($jobs) > 3 && ($jobs[0]['field'] == $jobs[1]['field'] && $jobs[1]['field'] == $jobs[3]['field'])) {
            $SameBuildCount = 5;
        }
        if (count($jobs) > 3 && ($jobs[0]['field'] == $jobs[2]['field'] && $jobs[2]['field'] == $jobs[3]['field'])) {
            $SameBuildCount = 6;
        }
        if (count($jobs) > 3 && ($jobs[1]['field'] == $jobs[2]['field'] && $jobs[2]['field'] == $jobs[3]['field'])) {
            $SameBuildCount = 7;
        }
        if ($SameBuildCount > 0) {
            if ($SameBuildCount > 3) {
                if ($SameBuildCount == 4 or $SameBuildCount == 5) {
                    if ($jobDeleted == 0) {
                        $uprequire = $building->resourceRequired($jobs[1]['field'], $jobs[1]['type'], 1);
                        $time = $uprequire['time'];
                        $timestamp = $time + time();
                        $q = "UPDATE bdata SET loopcon=0,level=level-1,timestamp=" . $timestamp . " WHERE id=" . $jobs[1]['id'] . "";
                        mysql_query($q, $this->connection);
                    }
                } else if ($SameBuildCount == 6) {
                    if ($jobDeleted == 0) {
                        $uprequire = $building->resourceRequired($jobs[2]['field'], $jobs[2]['type'], 1);
                        $time = $uprequire['time'];
                        $timestamp = $time + time();
                        $q = "UPDATE bdata SET loopcon=0,level=level-1,timestamp=" . $timestamp . " WHERE id=" . $jobs[2]['id'] . "";
                        mysql_query($q, $this->connection);
                    }
                } else if ($SameBuildCount == 7) {
                    if ($jobDeleted == 1) {
                        $uprequire = $building->resourceRequired($jobs[2]['field'], $jobs[2]['type'], 1);
                        $time = $uprequire['time'];
                        $timestamp = $time + time();
                        $q = "UPDATE bdata SET loopcon=0,level=level-1,timestamp=" . $timestamp . " WHERE id=" . $jobs[2]['id'] . "";
                        mysql_query($q, $this->connection);
                    }
                }
                if ($SameBuildCount < 8) {
                    $uprequire1 = $building->resourceRequired($jobs[$jobMaster]['field'], $jobs[$jobMaster]['type'], 2);
                    $time1 = $uprequire1['time'];
                    $timestamp1 = $time1;
                    $q1 = "UPDATE bdata SET level=level-1,timestamp=" . $timestamp1 . " WHERE id=" . $jobs[$jobMaster]['id'] . "";
                    mysql_query($q1, $this->connection);
                } else {
                    $uprequire1 = $building->resourceRequired($jobs[$jobMaster]['field'], $jobs[$jobMaster]['type'], 1);
                    $time1 = $uprequire1['time'];
                    $timestamp1 = $time1;
                    $q1 = "UPDATE bdata SET level=level-1,timestamp=" . $timestamp1 . " WHERE id=" . $jobs[$jobMaster]['id'] . "";
                    mysql_query($q1, $this->connection);
                }
            } else if ($d == $jobs[floor($SameBuildCount / 3)]['id'] || $d == $jobs[floor($SameBuildCount / 2) + 1]['id']) {
                $q = "UPDATE bdata SET loopcon=0,level=level-1,timestamp=" . $jobs[floor($SameBuildCount / 3)]['timestamp'] . " WHERE master = 0 AND id > " . $d . " and (ID=" . $jobs[floor($SameBuildCount / 3)]['id'] . " OR ID=" . $jobs[floor($SameBuildCount / 2) + 1]['id'] . ")";
                mysql_query($q, $this->connection);
            }
        } else {
            if ($jobs[$jobDeleted]['field'] >= 19) {
                $x = "SELECT f" . $jobs[$jobDeleted]['field'] . " FROM fdata WHERE vref=" . $jobs[$jobDeleted]['wid'];
                $result = mysql_query($x, $this->connection));
                $fieldlevel = mysql_fetch_row($result);
                if ($fieldlevel[0] == 0) {
                    if ($village->natar == 1 && $jobs[$jobDeleted]['field'] == 99) { //fix by ronix
                    } else {
                        $x = "UPDATE fdata SET f" . $jobs[$jobDeleted]['field'] . "t=0 WHERE vref=" . $jobs[$jobDeleted]['wid'];
                        mysql_query($x, $this->connection));
                    }
                }
            }
            if (($jobLoopconID >= 0) && ($jobs[$jobDeleted]['loopcon'] != 1)) {
                if (($jobs[$jobLoopconID]['field'] <= 18 && $jobs[$jobDeleted]['field'] <= 18) || ($jobs[$jobLoopconID]['field'] >= 19 && $jobs[$jobDeleted]['field'] >= 19) || sizeof($jobs) < 3) {
                    $uprequire = $building->resourceRequired($jobs[$jobLoopconID]['field'], $jobs[$jobLoopconID]['type']);
                    $x = "UPDATE bdata SET loopcon=0,timestamp=" . (time() + $uprequire['time']) . " WHERE wid=" . $jobs[$jobDeleted]['wid'] . " AND loopcon=1 AND master=0";
                    mysql_query($x, $this->connection));
                }
            }
        }
        $q = "DELETE FROM bdata where id = $d";
        return mysql_query($q, $this->connection);
    }

    function addDemolition($wid, $field)
    {
        global $building, $village;
        $q = "DELETE FROM bdata WHERE field=$field AND wid=$wid";
        mysql_query($q, $this->connection);
        $uprequire = $building->resourceRequired($field, $village->resarray['f' . $field . 't'], 0);
        $q = "INSERT INTO demolition VALUES (" . $wid . "," . $field . "," . ($this->getFieldLevel($wid, $field) - 1) . "," . (time() + floor($uprequire['time'] / 2)) . ")";
        return mysql_query($q, $this->connection);
    }


    function getDemolition($wid = 0)
    {
        if ($wid) {
            $q = "SELECT * FROM demolition WHERE vref=" . $wid;
        } else {
            $q = "SELECT * FROM demolition WHERE timetofinish<=" . time();
        }
        $result = mysql_query($q, $this->connection);
        if (!empty($result)) {
            return $this->mysql_fetch_all($result);
        } else {
            return NULL;
        }
    }

    function finishDemolition($wid)
    {
        $q = "UPDATE demolition SET timetofinish=" . time() . " WHERE vref=" . $wid;
        $result = mysql_query($q, $this->connection);
        return mysql_affected_rows();
    }

    function delDemolition($wid)
    {
        $q = "DELETE FROM demolition WHERE vref=" . $wid;
        return mysql_query($q, $this->connection);
    }

    function getJobs($wid)
    {
        $q = "SELECT * FROM bdata where wid = $wid order by master,timestamp ASC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function FinishWoodcutter($wid)
    {
        $time = time() - 1;
        $q = "SELECT * FROM bdata where wid = $wid and type = 1 order by master,timestamp ASC";
        $result = mysql_query($q);
        $dbarray = mysql_fetch_array($result);
        $q = "UPDATE bdata SET timestamp = $time WHERE id = '" . $dbarray['id'] . "'";
        $this->query($q);
        $tribe = $this->getUserField($this->getVillageField($wid, "owner"), "tribe", 0);
        if ($tribe == 1) {
            $q2 = "SELECT * FROM bdata where wid = $wid and loopcon = 1 and field >= 19 order by master,timestamp ASC";
        } else {
            $q2 = "SELECT * FROM bdata where wid = $wid and loopcon = 1 order by master,timestamp ASC";
        }
        $result2 = mysql_query($q2);
        if (mysql_num_rows($result2) > 0) {
            $dbarray2 = mysql_fetch_array($result2);
            $wc_time = $dbarray['timestamp'];
            $q2 = "UPDATE bdata SET timestamp = timestamp - $wc_time WHERE id = '" . $dbarray2['id'] . "'";
            $this->query($q2);
        }
    }

    function getMasterJobs($wid)
    {
        $q = "SELECT * FROM bdata where wid = $wid and master = 1 order by master,timestamp ASC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getMasterJobsByField($wid, $field)
    {
        $q = "SELECT * FROM bdata where wid = $wid and field = $field and master = 1 order by master,timestamp ASC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getBuildingByField($wid, $field)
    {
        $q = "SELECT * FROM bdata where wid = $wid and field = $field and master = 0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getBuildingByField2($wid, $field)
    {
        $q = "SELECT * FROM bdata where wid = $wid and field = $field and master = 0";
        $result = mysql_query($q, $this->connection);
        return mysql_num_rows($result);
    }

    function getBuildingByType($wid, $type)
    {
        $q = "SELECT * FROM bdata where wid = $wid and type = $type and master = 0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getBuildingByType2($wid, $type)
    {
        $q = "SELECT * FROM bdata where wid = $wid and type = $type and master = 0";
        $result = mysql_query($q, $this->connection);
        return mysql_num_rows($result);
    }

    function getDorf1Building($wid)
    {
        $q = "SELECT * FROM bdata where wid = $wid and field < 19 and master = 0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getDorf2Building($wid)
    {
        $q = "SELECT * FROM bdata where wid = $wid and field > 18 and master = 0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function updateBuildingWithMaster($id, $time, $loop)
    {
        $q = "UPDATE bdata SET master = 0, timestamp = " . $time . ",loopcon = " . $loop . " WHERE id = " . $id . "";
        return mysql_query($q, $this->connection);
    }

    function getVillageByName($name)
    {
        $q = "SELECT wref FROM vdata where name = '$name' limit 1";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        return $dbarray['wref'];
    }

    /***************************
     * Function to set accept flag on market
     * References: id
     ***************************/
    function setMarketAcc($id)
    {
        $q = "UPDATE market set accept = 1 where id = $id";
        return mysql_query($q, $this->connection);
    }

    /***************************
     * Function to send resource to other village
     * Mode 0: Send
     * Mode 1: Cancel
     * References: Wood/ID, Clay, Iron, Crop, Mode
     ***************************/
    function sendResource($ref, $clay, $iron, $crop, $merchant, $mode)
    {
        if (!$mode) {
            $q = "INSERT INTO send values (0,$ref,$clay,$iron,$crop,$merchant)";
            mysql_query($q, $this->connection);
            return mysql_insert_id($this->connection);
        } else {
            $q = "DELETE FROM send where id = $ref";
            return mysql_query($q, $this->connection);
        }
    }

    /***************************
     * Function to get resources back if you delete offer
     * References: VillageRef (vref)
     * Made by: Dzoki
     ***************************/

    function getResourcesBack($vref, $gtype, $gamt)
    {
        //Xtype (1) = wood, (2) = clay, (3) = iron, (4) = crop
        if ($gtype == 1) {
            $q = "UPDATE vdata SET `wood` = `wood` + '$gamt' WHERE wref = $vref";
            return mysql_query($q, $this->connection);
        } else
            if ($gtype == 2) {
                $q = "UPDATE vdata SET `clay` = `clay` + '$gamt' WHERE wref = $vref";
                return mysql_query($q, $this->connection);
            } else
                if ($gtype == 3) {
                    $q = "UPDATE vdata SET `iron` = `iron` + '$gamt' WHERE wref = $vref";
                    return mysql_query($q, $this->connection);
                } else
                    if ($gtype == 4) {
                        $q = "UPDATE vdata SET `crop` = `crop` + '$gamt' WHERE wref = $vref";
                        return mysql_query($q, $this->connection);
                    }
    }

    /***************************
     * Function to get info about offered resources
     * References: VillageRef (vref)
     * Made by: Dzoki
     ***************************/

    function getMarketField($vref, $field)
    {
        $q = "SELECT $field FROM market where vref = '$vref'";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray[$field];
    }

    function removeAcceptedOffer($id)
    {
        $q = "DELETE FROM market where id = $id";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    /***************************
     * Function to add market offer
     * Mode 0: Add
     * Mode 1: Cancel
     * References: Village, Give, Amt, Want, Amt, Time, Alliance, Mode
     ***************************/
    function addMarket($vid, $gtype, $gamt, $wtype, $wamt, $time, $alliance, $merchant, $mode)
    {
        if (!$mode) {
            $q = "INSERT INTO market values (0,$vid,$gtype,$gamt,$wtype,$wamt,0,$time,$alliance,$merchant)";
            mysql_query($q, $this->connection);
            return mysql_insert_id($this->connection);
        } else {
            $q = "DELETE FROM market where id = $gtype and vref = $vid";
            return mysql_query($q, $this->connection);
        }
    }

    /***************************
     * Function to get market offer
     * References: Village, Mode
     ***************************/
    function getMarket($vid, $mode)
    {
        $alliance = $this->getUserField($this->getVillageField($vid, "owner"), "alliance", 0);
        if (!$mode) {
            $q = "SELECT * FROM market where vref = $vid and accept = 0";
        } else {
            $q = "SELECT * FROM market where vref != $vid and alliance = $alliance or vref != $vid and alliance = 0 and accept = 0";
        }
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    /***************************
     * Function to get market offer
     * References: ID
     ***************************/
    function getMarketInfo($id)
    {
        $q = "SELECT * FROM market where id = $id";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    function setMovementProc($moveid)
    {
        $q = "UPDATE movement set proc = 1 where moveid = $moveid";
        return mysql_query($q, $this->connection);
    }

    /***************************
     * Function to retrieve used merchant
     * References: Village
     ***************************/
    function totalMerchantUsed($vid)
    {
        $time = time();
        $q = "SELECT sum(send.merchant) from send, movement where movement.from = $vid and send.id = movement.ref and movement.proc = 0 and sort_type = 0";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        $q2 = "SELECT sum(ref) from movement where sort_type = 2 and movement.to = $vid and proc = 0";
        $result2 = mysql_query($q2, $this->connection);
        $row2 = mysql_fetch_row($result2);
        $q3 = "SELECT sum(merchant) from market where vref = $vid and accept = 0";
        $result3 = mysql_query($q3, $this->connection);
        $row3 = mysql_fetch_row($result3);
        return $row[0] + $row2[0] + $row3[0];
    }

    function getMovement($type, $village, $mode)
    {
        $time = time();
        if (!$mode) {
            $where = "from";
        } else {
            $where = "to";
        }
        switch ($type) {
            case 0:
                $q = "SELECT * FROM movement, send where movement." . $where . " = $village and movement.ref = send.id and movement.proc = 0 and movement.sort_type = 0 ORDER BY endtime ASC";
                break;
            case 1:
                $q = "SELECT * FROM movement, send where movement." . $where . " = $village and movement.ref = send.id and movement.proc = 0 and movement.sort_type = 6 ORDER BY endtime ASC";
                break;
            case 2:
                $q = "SELECT * FROM movement where movement." . $where . " = $village and movement.proc = 0 and movement.sort_type = 2 ORDER BY endtime ASC";
                break;
            case 3:
                $q = "SELECT * FROM movement, attacks where movement." . $where . " = $village and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 ORDER BY endtime ASC";
                break;
            case 4:
                $q = "SELECT * FROM movement, attacks where movement." . $where . " = $village and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 4 ORDER BY endtime ASC";
                break;
            case 5:
                $q = "SELECT * FROM movement where movement." . $where . " = $village and sort_type = 5 and proc = 0 ORDER BY endtime ASC";
                break;
            case 6:
                $q = "SELECT * FROM movement,odata, attacks where odata.wref = $village and movement.to = $village and movement.ref = attacks.id and attacks.attack_type != 1 and movement.proc = 0 and movement.sort_type = 3 ORDER BY endtime ASC";
                //$q = "SELECT * FROM movement,odata, attacks where odata.conqured = $village and movement.to = odata.wref and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 ORDER BY endtime ASC";
                break;
            case 7:
                $q = "SELECT * FROM movement where movement." . $where . " = $village and sort_type = 4 and ref = 0 and proc = 0 ORDER BY endtime ASC";
                break;
            case 8:
                $q = "SELECT * FROM movement, attacks where movement." . $where . " = $village and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 and attacks.attack_type = 1 ORDER BY endtime ASC";
                break;
            case 34:
                $q = "SELECT * FROM movement, attacks where movement." . $where . " = $village and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 or movement." . $where . " = $village and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 4 ORDER BY endtime ASC";
                break;
        }
        $result = mysql_query($q, $this->connection);
        $array = $this->mysql_fetch_all($result);
        return $array;
    }

    function addA2b($ckey, $timestamp, $to, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type)
    {
        $q = "INSERT INTO a2b (ckey,time_check,to_vid,u1,u2,u3,u4,u5,u6,u7,u8,u9,u10,u11,type) VALUES ('$ckey', '$timestamp', '$to', '$t1', '$t2', '$t3', '$t4', '$t5', '$t6', '$t7', '$t8', '$t9', '$t10', '$t11', '$type')";
        mysql_query($q, $this->connection);
        return mysql_insert_id($this->connection);
    }

    function getA2b($ckey, $check)
    {
        $q = "SELECT * from a2b where ckey = '" . $ckey . "' AND time_check = '" . $check . "'";
        $result = mysql_query($q, $this->connection);
        if ($result) {
            return mysql_fetch_assoc($result);
        } else {
            return false;
        }
    }

    function addMovement($type, $from, $to, $ref, $time, $endtime, $send = 1, $wood = 0, $clay = 0, $iron = 0, $crop = 0, $ref2 = 0)
    {
        $q = "INSERT INTO movement values (0,$type,$from,$to,$ref,$ref2,$time,$endtime,0,$send,$wood,$clay,$iron,$crop)";
        return mysql_query($q, $this->connection);
    }

    function addAttack($vid, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type, $ctar1, $ctar2, $spy, $b1 = 0, $b2 = 0, $b3 = 0, $b4 = 0, $b5 = 0, $b6 = 0, $b7 = 0, $b8 = 0)
    {
        $q = "INSERT INTO attacks values (0,$vid,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11,$type,$ctar1,$ctar2,$spy,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8)";
        mysql_query($q, $this->connection);
        return mysql_insert_id($this->connection);
    }

    function modifyAttack($aid, $unit, $amt)
    {
        $unit = 't' . $unit;
        $q = "UPDATE attacks set $unit = $unit - $amt where id = $aid";
        return mysql_query($q, $this->connection);
    }

    function modifyAttack2($aid, $unit, $amt)
    {
        $unit = 't' . $unit;
        $q = "UPDATE attacks set $unit = $unit + $amt where id = $aid";
        return mysql_query($q, $this->connection);
    }

    function modifyAttack3($aid, $units)
    {
        $q = "UPDATE attacks set $units WHERE id = $aid";
        return mysql_query($q, $this->connection);
    }

    function getRanking()
    {
        $q = "SELECT id,username,alliance,ap,apall,dp,dpall,access FROM users WHERE tribe<=3 AND access<" . (INCLUDE_ADMIN ? "10" : "8");
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getVRanking()
    {
        $q = "SELECT v.wref,v.name,v.owner,v.pop FROM vdata AS v,users AS u WHERE v.owner=u.id AND u.tribe<=3 AND v.wref != '' AND u.access<" . (INCLUDE_ADMIN ? "10" : "8");
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getARanking()
    {
        $q = "SELECT id,name,tag,oldrank,Aap,Adp FROM alidata where id != '' ORDER BY id DESC";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getUserByTribe($tribe)
    {
        $q = "SELECT * FROM users where tribe = $tribe";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getUserByAlliance($aid)
    {
        $q = "SELECT * FROM users where alliance = $aid";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getHeroRanking()
    {
        $q = "SELECT * FROM hero WHERE dead = 0";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getAllMember($aid)
    {
        $q = "SELECT * FROM users where alliance = $aid order  by (SELECT sum(pop) FROM vdata WHERE owner =  users.id) desc, users.id desc";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getAllMember2($aid)
    {
        $q = "SELECT * FROM users where alliance = $aid order  by (SELECT sum(pop) FROM vdata WHERE owner =  users.id) desc, users.id desc LIMIT 1";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function addUnits($vid)
    {
        $q = "INSERT into units (vref) values ($vid)";
        return mysql_query($q, $this->connection);
    }

    function getUnit($vid)
    {
        $q = "SELECT * from units where vref = $vid";
        $result = mysql_query($q, $this->connection);
        if (!empty($result)) {
            return mysql_fetch_assoc($result);
        } else {
            return NULL;
        }
    }

    function getUnitsNumber($vid)
    {
        $q = "SELECT * from units where vref = $vid";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_assoc($result);
        $totalunits = 0;
        $movingunits = $this->getVillageMovement($vid);
        for ($i = 1; $i <= 50; $i++) {
            $totalunits += $dbarray['u' . $i];
        }
        $totalunits += $dbarray['hero'];
        $movingunits = $this->getVillageMovement($vid);
        $reinforcingunits = $this->getEnforceArray($vid, 1);
        $owner = $this->getVillageField($vid, "owner");
        $ownertribe = $this->getUserField($owner, "tribe", 0);
        $start = ($ownertribe - 1) * 10 + 1;
        $end = ($ownertribe * 10);
        for ($i = $start; $i <= $end; $i++) {
            $totalunits += $movingunits['u' . $i];
            $totalunits += $reinforcingunits['u' . $i];
        }
        $totalunits += $movingunits['hero'];
        $totalunits += $reinforcingunits['hero'];
        return $totalunits;
    }

    function getHero($uid = 0, $all = 0)
    {
        if ($all) {
            $q = "SELECT * FROM hero WHERE uid=$uid";
        } elseif (!$uid) {
            $q = "SELECT * FROM hero";
        } else {
            $q = "SELECT * FROM hero WHERE dead=0 AND uid=$uid LIMIT 1";
        }
        $result = mysql_query($q, $this->connection);
        if (!empty($result)) {
            return $this->mysql_fetch_all($result);
        } else {
            return NULL;
        }
    }

    function getHeroField($uid, $field)
    {
        $q = "SELECT * FROM hero WHERE uid = $uid";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function modifyHero($column, $value, $heroid, $mode = 0)
    {
        if (!$mode) {
            $q = "UPDATE `hero` SET $column = $value WHERE heroid = $heroid";
        } elseif ($mode = 1) {
            $q = "UPDATE `hero` SET $column = $column + $value WHERE heroid = $heroid";
        } else {
            $q = "UPDATE `hero` SET $column = $column - $value WHERE heroid = $heroid";
        }
        return mysql_query($q, $this->connection);
    }

    function modifyHeroByOwner($column, $value, $uid, $mode = 0)
    {
        if (!$mode) {
            $q = "UPDATE `hero` SET $column = $value WHERE uid = $uid";
        } elseif ($mode = 1) {
            $q = "UPDATE `hero` SET $column = $column + $value WHERE uid = $uid";
        } else {
            $q = "UPDATE `hero` SET $column = $column - $value WHERE uid = $uid";
        }
        return mysql_query($q, $this->connection);
    }

    function modifyHeroXp($column, $value, $heroid)
    {
        $q = "UPDATE hero SET $column = $column + $value WHERE uid=$heroid";
        return mysql_query($q, $this->connection);
    }

    function addTech($vid)
    {
        $q = "INSERT into tdata (vref) values ($vid)";
        return mysql_query($q, $this->connection);
    }

    function addABTech($vid)
    {
        $q = "INSERT into abdata (vref) values ($vid)";
        return mysql_query($q, $this->connection);
    }

    function getABTech($vid)
    {
        $q = "SELECT * FROM abdata where vref = $vid";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    function addResearch($vid, $tech, $time)
    {
        $q = "INSERT into research values (0,$vid,'$tech',$time)";
        return mysql_query($q, $this->connection);
    }

    function getResearching($vid)
    {
        $q = "SELECT * FROM research where vref = $vid";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function checkIfResearched($vref, $unit)
    {
        $q = "SELECT $unit FROM tdata WHERE vref = $vref";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray[$unit];
    }

    function getTech($vid)
    {
        $q = "SELECT * from tdata where vref = $vid";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    function getTraining($vid)
    {
        $q = "SELECT * FROM training where vref = $vid ORDER BY id";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function countTraining($vid)
    {
        $q = "SELECT * FROM training WHERE vref = $vid";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        return $row[0];
    }

    function trainUnit($vid, $unit, $amt, $pop, $each, $time, $mode)
    {
        global $village, $building, $session, $technology;

        if (!$mode) {
            $barracks = array(1, 2, 3, 11, 12, 13, 14, 21, 22, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44);
            // fix by brainiac - THANK YOU
            $greatbarracks = array(61, 62, 63, 71, 72, 73, 74, 81, 82, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104);
            $stables = array(4, 5, 6, 15, 16, 23, 24, 25, 26, 45, 46);
            $greatstables = array(64, 65, 66, 75, 76, 83, 84, 85, 86, 105, 106);
            $workshop = array(7, 8, 17, 18, 27, 28, 47, 48);
            $greatworkshop = array(67, 68, 77, 78, 87, 88, 107, 108);
            $residence = array(9, 10, 19, 20, 29, 30, 49, 50);
            $trapper = array(99);

            if (in_array($unit, $barracks)) {
                $queued = $technology->getTrainingList(1);
            } elseif (in_array($unit, $stables)) {
                $queued = $technology->getTrainingList(2);
            } elseif (in_array($unit, $workshop)) {
                $queued = $technology->getTrainingList(3);
            } elseif (in_array($unit, $residence)) {
                $queued = $technology->getTrainingList(4);
            } elseif (in_array($unit, $greatstables)) {
                $queued = $technology->getTrainingList(6);
            } elseif (in_array($unit, $greatbarracks)) {
                $queued = $technology->getTrainingList(5);
            } elseif (in_array($unit, $greatworkshop)) {
                $queued = $technology->getTrainingList(7);
            } elseif (in_array($unit, $trapper)) {
                $queued = $technology->getTrainingList(8);
            }
            $now = time();

            $uid = $this->getVillageField($vid, "owner");
            $artefact = count($this->getOwnUniqueArtefactInfo2($uid, 5, 3, 0));
            $artefact1 = count($this->getOwnUniqueArtefactInfo2($vid, 5, 1, 1));
            $artefact2 = count($this->getOwnUniqueArtefactInfo2($uid, 5, 2, 0));
            if ($artefact > 0) {
                $time = $now + round(($time - $now) / 2);
                $each /= 2;
                $each = round($each);
            } else if ($artefact1 > 0) {
                $time = $now + round(($time - $now) / 2);
                $each /= 2;
                $each = round($each);
            } else if ($artefact2 > 0) {
                $time = $now + round(($time - $now) / 4 * 3);
                $each /= 4;
                $each = round($each);
                $each *= 3;
                $each = round($each);
            }
            $foolartefact = $this->getFoolArtefactInfo(5, $vid, $uid);
            if (count($foolartefact) > 0) {
                foreach ($foolartefact as $arte) {
                    if ($arte['bad_effect'] == 1) {
                        $each *= $arte['effect2'];
                    } else {
                        $each /= $arte['effect2'];
                        $each = round($each);
                    }
                }
            }
            if ($each == 0) {
                $each = 1;
            }
            $time2 = $now + $each;
            if (count($queued) > 0) {
                $time += $queued[count($queued) - 1]['timestamp'] - $now;
                $time2 += $queued[count($queued) - 1]['timestamp'] - $now;
            }
            // TROOPS MAKE SUM IN BARAKS , ETC
            //if($queued[count($queued) - 1]['unit'] == $unit){
            //$time = $amt*$queued[count($queued) - 1]['eachtime'];
            //$q = "UPDATE training SET amt = amt + $amt, timestamp = timestamp + $time WHERE id = ".$queued[count($queued) - 1]['id']."";
            //}else{
            $q = "INSERT INTO training values (0,$vid,$unit,$amt,$pop,$time,$each,$time2)";
            //}
        } else {
            $q = "DELETE FROM training where id = $vid";
        }
        return mysql_query($q, $this->connection);
    }

    function updateTraining($id, $trained, $each)
    {
        $q = "UPDATE training set amt = amt - $trained, timestamp2 = timestamp2 + $each where id = $id";
        return mysql_query($q, $this->connection);
    }

    function modifyUnit($vref, $array_unit, $array_amt, $array_mode)
    {
        $i = -1;
        $units = '';
        $number = count($array_unit);
        foreach ($array_unit as $unit) {
            if ($unit == 230) {
                $unit = 30;
            }
            if ($unit == 231) {
                $unit = 31;
            }
            if ($unit == 120) {
                $unit = 20;
            }
            if ($unit == 121) {
                $unit = 21;
            }
            if ($unit == "hero") {
                $unit = 'hero';
            } else {
                $unit = 'u' . $unit;
            }
            ++$i;
            //Fixed part of negativ troops (double troops) - by InCube
            $array_amt[$i] = $array_amt[$i] < 0 ? 0 : $array_amt[$i];
            //Fixed part of negativ troops (double troops) - by InCube
            $units .= $unit . ' = ' . $unit . ' ' . (($array_mode[$i] == 1) ? '+' : '-') . '  ' . $array_amt[$i] . (($number > $i + 1) ? ', ' : '');
        }
        $q = "UPDATE units set $units WHERE vref = $vref";
        return mysql_query($q, $this->connection);
    }

    function getEnforce($vid, $from)
    {
        $q = "SELECT * from enforcement where `from` = $from and vref = $vid";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    function getOasisEnforce($ref, $mode = 0)
    {
        if (!$mode) {
            $q = "SELECT e.*,o.conqured FROM enforcement as e LEFT JOIN odata as o ON e.vref=o.wref where o.conqured = $ref AND e.from !=$ref";
        } else {
            $q = "SELECT e.*,o.conqured FROM enforcement as e LEFT JOIN odata as o ON e.vref=o.wref where o.conqured = $ref";
        }
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getOasisEnforceArray($id, $mode = 0)
    {
        if (!$mode) {
            $q = "SELECT e.*,o.conqured FROM enforcement as e LEFT JOIN odata as o ON e.vref=o.wref where e.id = $id";
        } else {
            $q = "SELECT e.*,o.conqured FROM enforcement as e LEFT JOIN odata as o ON e.from=o.wref where e.id =$id";
        }
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    function getEnforceControllTroops($vid)
    {
        $q = "SELECT * from enforcement where  vref = $vid";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    function addEnforce($data)
    {
        $q = "INSERT into enforcement (vref,`from`) values (" . $data['to'] . "," . $data['from'] . ")";
        mysql_query($q, $this->connection);
        $id = mysql_insert_id($this->connection);
        $owntribe = $this->getUserField($this->getVillageField($data['from'], "owner"), "tribe", 0);
        $start = ($owntribe - 1) * 10 + 1;
        $end = ($owntribe * 10);
        //add unit
        $j = '1';
        for ($i = $start; $i <= $end; $i++) {
            $this->modifyEnforce($id, $i, $data['t' . $j . ''], 1);
            $j++;
        }
        $this->modifyEnforce($id, 'hero', $data['t11'], 1);
        return mysql_insert_id($this->connection);
    }

    function addEnforce2($data, $tribe, $dead1, $dead2, $dead3, $dead4, $dead5, $dead6, $dead7, $dead8, $dead9, $dead10, $dead11)
    {
        $q = "INSERT into enforcement (vref,`from`) values (" . $data['to'] . "," . $data['from'] . ")";
        mysql_query($q, $this->connection);
        $id = mysql_insert_id($this->connection);
        $owntribe = $this->getUserField($this->getVillageField($data['from'], "owner"), "tribe", 0);
        $start = ($owntribe - 1) * 10 + 1;
        $end = ($owntribe * 10);
        $start2 = ($tribe - 1) * 10 + 1;
        $start3 = ($tribe - 1) * 10;
        if ($start3 == 0) {
            $start3 = "";
        }
        $end2 = ($tribe * 10);
        //add unit
        $j = '1';
        for ($i = $start; $i <= $end; $i++) {
            $this->modifyEnforce($id, $i, $data['t' . $j . ''], 1);
            $this->modifyEnforce($id, $i, ${dead . $j}, 0);
            $j++;
        }
        $this->modifyEnforce($id, 'hero', $data['t11'], 1);
        $this->modifyEnforce($id, 'hero', $dead11, 0);
        return mysql_insert_id($this->connection);
    }

    function modifyEnforce($id, $unit, $amt, $mode)
    {
        if ($unit != 'hero') {
            $unit = 'u' . $unit;
        }
        if (!$mode) {
            $q = "UPDATE enforcement set $unit = $unit - $amt where id = $id";
        } else {
            $q = "UPDATE enforcement set $unit = $unit + $amt where id = $id";
        }
        mysql_query($q, $this->connection);
    }

    function getEnforceArray($id, $mode)
    {
        if (!$mode) {
            $q = "SELECT * from enforcement where id = $id";
        } else {
            $q = "SELECT * from enforcement where `from` = $id";
        }
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_assoc($result);
    }

    function getEnforceVillage($id, $mode)
    {
        if (!$mode) {
            $q = "SELECT * from enforcement where vref = $id";
        } else {
            $q = "SELECT * from enforcement where `from` = $id";
        }
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getVillageMovement($id)
    {
        $vinfo = $this->getVillage($id);
        $vtribe = $this->getUserField($vinfo['owner'], "tribe", 0);
        $movingunits = array();
        $outgoingarray = $this->getMovement(3, $id, 0);
        if (!empty($outgoingarray)) {
            foreach ($outgoingarray as $out) {
                for ($i = 1; $i <= 10; $i++) {
                    $movingunits['u' . (($vtribe - 1) * 10 + $i)] += $out['t' . $i];
                }
                $movingunits['hero'] += $out['t11'];
            }
        }
        $returningarray = $this->getMovement(4, $id, 1);
        if (!empty($returningarray)) {
            foreach ($returningarray as $ret) {
                if ($ret['attack_type'] != 1) {
                    for ($i = 1; $i <= 10; $i++) {
                        $movingunits['u' . (($vtribe - 1) * 10 + $i)] += $ret['t' . $i];
                    }
                    $movingunits['hero'] += $ret['t11'];
                }
            }
        }
        $settlerarray = $this->getMovement(5, $id, 0);
        if (!empty($settlerarray)) {
            $movingunits['u' . ($vtribe * 10)] += 3 * count($settlerarray);
        }
        return $movingunits;
    }

    ################# -START- ##################
    ##   WORLD WONDER STATISTICS FUNCTIONS!   ##
    ############################################

    /***************************
     * Function to get all World Wonders
     * Made by: Dzoki
     ***************************/

    function getWW()
    {
        $q = "SELECT * FROM fdata WHERE f99t = 40";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    /***************************
     * Function to get world wonder level!
     * Made by: Dzoki
     ***************************/

    function getWWLevel($vref)
    {
        $q = "SELECT f99 FROM fdata WHERE vref = $vref";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray['f99'];
    }

    /***************************
     * Function to get world wonder owner ID!
     * Made by: Dzoki
     ***************************/

    function getWWOwnerID($vref)
    {
        $q = "SELECT owner FROM vdata WHERE wref = $vref";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray['owner'];
    }

    /***************************
     * Function to get user alliance name!
     * Made by: Dzoki
     ***************************/

    function getUserAllianceID($id)
    {
        $q = "SELECT alliance FROM users where id = $id";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray['alliance'];
    }

    /***************************
     * Function to get WW name
     * Made by: Dzoki
     ***************************/

    function getWWName($vref)
    {
        $q = "SELECT wwname FROM fdata WHERE vref = $vref";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray['wwname'];
    }

    /***************************
     * Function to change WW name
     * Made by: Dzoki
     ***************************/

    function submitWWname($vref, $name)
    {
        $q = "UPDATE fdata SET `wwname` = '$name' WHERE fdata.`vref` = $vref";
        return mysql_query($q, $this->connection);
    }

    //medal functions
    function addclimberpop($user, $cp)
    {
        $q = "UPDATE users set Rc = Rc + '$cp' where id = $user";
        return mysql_query($q, $this->connection);
    }

    function addclimberrankpop($user, $cp)
    {
        $q = "UPDATE users set clp = clp + '$cp' where id = $user";
        return mysql_query($q, $this->connection);
    }

    function removeclimberrankpop($user, $cp)
    {
        $q = "UPDATE users set clp = clp - '$cp' where id = $user";
        return mysql_query($q, $this->connection);
    }

    function setclimberrankpop($user, $cp)
    {
        $q = "UPDATE users set clp = '$cp' where id = $user";
        return mysql_query($q, $this->connection);
    }

    function updateoldrank($user, $cp)
    {
        $q = "UPDATE users set oldrank = '$cp' where id = $user";
        return mysql_query($q, $this->connection);
    }

    function removeclimberpop($user, $cp)
    {
        $q = "UPDATE users set Rc = Rc - '$cp' where id = $user";
        return mysql_query($q, $this->connection);
    }

    // ALLIANCE MEDAL FUNCTIONS
    function addclimberpopAlly($user, $cp)
    {
        $q = "UPDATE alidata set Rc = Rc + '$cp' where id = $user";
        return mysql_query($q, $this->connection);
    }

    function addclimberrankpopAlly($user, $cp)
    {
        $q = "UPDATE alidata set clp = clp + '$cp' where id = $user";
        return mysql_query($q, $this->connection);
    }

    function removeclimberrankpopAlly($user, $cp)
    {
        $q = "UPDATE alidata set clp = clp - '$cp'' where id = $user";
        return mysql_query($q, $this->connection);
    }

    function updateoldrankAlly($user, $cp)
    {
        $q = "UPDATE alidata set oldrank = '$cp' where id = $user";
        return mysql_query($q, $this->connection);
    }

    function removeclimberpopAlly($user, $cp)
    {
        $q = "UPDATE alidata set Rc = Rc - '$cp' where id = $user";
        return mysql_query($q, $this->connection);
    }

    function getTrainingList()
    {
        $q = "SELECT * FROM training where vref != ''";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getNeedDelete()
    {
        $time = time();
        $q = "SELECT uid FROM deleting where timestamp < $time";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function countUser()
    {
        $q = "SELECT count(id) FROM users where id > 5";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        return $row[0];
    }

    function countAlli()
    {
        $q = "SELECT count(id) FROM alidata where id != 0";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        return $row[0];
    }

    /***************************
     * Function to process MYSQLi->fetch_all (Only exist in MYSQL)
     * References: Result
     ***************************/
    function mysql_fetch_all($result)
    {
        $all = array();
        if ($result) {
            while ($row = mysql_fetch_assoc($result)) {
                $all[] = $row;
            }
            return $all;
        }
    }

    function query_return($q)
    {
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    /***************************
     * Function to do free query
     * References: Query
     ***************************/
    function query($query)
    {
        return mysql_query($query, $this->connection);
    }

    function RemoveXSS($val)
    {
        return htmlspecialchars($val, ENT_QUOTES);
    }

    //MARKET FIXES
    function getWoodAvailable($wref)
    {
        $q = "SELECT wood FROM vdata WHERE wref = $wref";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray['wood'];
    }

    function getClayAvailable($wref)
    {
        $q = "SELECT clay FROM vdata WHERE wref = $wref";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray['clay'];
    }

    function getIronAvailable($wref)
    {
        $q = "SELECT iron FROM vdata WHERE wref = $wref";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray['iron'];
    }

    function getCropAvailable($wref)
    {
        $q = "SELECT crop FROM vdata WHERE wref = $wref";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);
        return $dbarray['crop'];
    }

    function Getowner($vid)
    {
        $s = "SELECT owner FROM vdata where wref = $vid";
        $result1 = mysql_query($s, $this->connection);
        $row1 = mysql_fetch_row($result1);
        return $row1[0];
    }

    public function debug($time, $uid, $debug_info)
    {
        $q = "INSERT INTO debug_info (time,uid,debug_info) VALUES ($time,$uid,$debug_info)";
        if (mysql_query($q, $this->connection)) {
            return mysql_insert_id($this->connection);
        } else {
            return false;
        }
    }

    function populateOasisdata()
    {
        $q2 = "SELECT * FROM wdata where oasistype != 0";
        $result2 = mysql_query($q2, $this->connection);
        while ($row = mysql_fetch_array($result2)) {
            $wid = $row['id'];
            $basearray = $this->getOMInfo($wid);
            if ($basearray['oasistype'] < 4) {
                $high = 1;
            } else if ($basearray['oasistype'] < 10) {
                $high = 2;
            } else {
                $high = 0;
            }
            //We switch type of oasis and instert record with apropriate infomation.
            $q = "INSERT into odata VALUES ('" . $basearray['id'] . "'," . $basearray['oasistype'] . ",0,800,800,800,800,800,800," . time() . "," . time() . ",100,2,'Unoccupied Oasis'," . $high . ")";
            $result = mysql_query($q, $this->connection);
        }
    }

    public function getAvailableExpansionTraining()
    {
        global $building, $session, $technology, $village;
        $q = "SELECT (IF(exp1=0,1,0)+IF(exp2=0,1,0)+IF(exp3=0,1,0)) FROM vdata WHERE wref = $village->wid";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        $maxslots = $row[0];
        $residence = $building->getTypeLevel(25);
        $palace = $building->getTypeLevel(26);
        if ($residence > 0) {
            $maxslots -= (3 - floor($residence / 10));
        }
        if ($palace > 0) {
            $maxslots -= (3 - floor(($palace - 5) / 5));
        }

        $q = "SELECT (u10+u20+u30) FROM units WHERE vref = $village->wid";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        $settlers = $row[0];
        $q = "SELECT (u9+u19+u29) FROM units WHERE vref = $village->wid";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        $chiefs = $row[0];

        $settlers += 3 * count($this->getMovement(5, $village->wid, 0));
        $current_movement = $this->getMovement(3, $village->wid, 0);
        if (!empty($current_movement)) {
            foreach ($current_movement as $build) {
                $settlers += $build['t10'];
                $chiefs += $build['t9'];
            }
        }
        $current_movement = $this->getMovement(3, $village->wid, 1);
        if (!empty($current_movement)) {
            foreach ($current_movement as $build) {
                $settlers += $build['t10'];
                $chiefs += $build['t9'];
            }
        }
        $current_movement = $this->getMovement(4, $village->wid, 0);
        if (!empty($current_movement)) {
            foreach ($current_movement as $build) {
                $settlers += $build['t10'];
                $chiefs += $build['t9'];
            }
        }
        $current_movement = $this->getMovement(4, $village->wid, 1);
        if (!empty($current_movement)) {
            foreach ($current_movement as $build) {
                $settlers += $build['t10'];
                $chiefs += $build['t9'];
            }
        }
        $q = "SELECT (u10+u20+u30) FROM enforcement WHERE `from` = $village->wid";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        if (!empty($row)) {
            foreach ($row as $reinf) {
                $settlers += $reinf[0];
            }
        }
        $q = "SELECT (u9+u19+u29) FROM enforcement WHERE `from` = $village->wid";
        $result = mysql_query($q, $this->connection);
        $row = mysql_fetch_row($result);
        if (!empty($row)) {
            foreach ($row as $reinf) {
                $chiefs += $reinf[0];
            }
        }
        $trainlist = $technology->getTrainingList(4);
        if (!empty($trainlist)) {
            foreach ($trainlist as $train) {
                if ($train['unit'] % 10 == 0) {
                    $settlers += $train['amt'];
                }
                if ($train['unit'] % 10 == 9) {
                    $chiefs += $train['amt'];
                }
            }
        }
        // trapped settlers/chiefs calculation required

        $settlerslots = $maxslots * 3 - $settlers - $chiefs * 3;
        $chiefslots = $maxslots - $chiefs - floor(($settlers + 2) / 3);

        if (!$technology->getTech(($session->tribe - 1) * 10 + 9)) {
            $chiefslots = 0;
        }
        $slots = array("chiefs" => $chiefslots, "settlers" => $settlerslots);
        return $slots;
    }

    function addArtefact($vref, $owner, $type, $size, $name, $desc, $effect, $img)
    {
        $q = "INSERT INTO `artefacts` (`vref`, `owner`, `type`, `size`, `conquered`, `name`, `desc`, `effect`, `img`, `active`) VALUES ('$vref', '$owner', '$type', '$size', '" . time() . "', '$name', '$desc', '$effect', '$img', '0')";
        return mysql_query($q, $this->connection);
    }

    function getOwnArtefactInfo($vref)
    {
        $q = "SELECT * FROM artefacts WHERE vref = $vref";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function getOwnArtefactInfo2($vref)
    {
        $q = "SELECT * FROM artefacts WHERE vref = $vref";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getOwnArtefactInfo3($uid)
    {
        $q = "SELECT * FROM artefacts WHERE owner = $uid";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getOwnArtefactInfoByType($vref, $type)
    {
        $q = "SELECT * FROM artefacts WHERE vref = $vref AND type = $type order by size";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function getOwnArtefactInfoByType2($vref, $type)
    {
        $q = "SELECT * FROM artefacts WHERE vref = $vref AND type = $type";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getOwnUniqueArtefactInfo($id, $type, $size)
    {
        $q = "SELECT * FROM artefacts WHERE owner = $id AND type = $type AND size=$size";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function getOwnUniqueArtefactInfo2($id, $type, $size, $mode)
    {
        if (!$mode) {
            $q = "SELECT * FROM artefacts WHERE owner = $id AND active = 1 AND type = $type AND size=$size";
        } else {
            $q = "SELECT * FROM artefacts WHERE vref = $id AND active = 1 AND type = $type AND size=$size";
        }
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getFoolArtefactInfo($type, $vid, $uid)
    {
        $q = "SELECT * FROM artefacts WHERE vref = $vid AND type = 8 AND kind = $type OR owner = $uid AND size > 1 AND active = 1 AND type = 8 AND kind = $type";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function claimArtefact($vref, $ovref, $id)
    {
        $time = time();
        $q = "UPDATE artefacts SET vref = $vref, owner = $id, conquered = $time, active = 1 WHERE vref = $ovref";
        return mysql_query($q, $this->connection);
    }

    public function canClaimArtifact($from, $vref, $size, $type)
    {
        //fix by Ronix
        global $session, $form;
        $size1 = $size2 = $size3 = 0;

        $artifact = $this->getOwnArtefactInfo($from);
        if (!empty($artifact)) {
            $form->addError("error", "Treasury is full. Your hero could not claim the artefact");
            return false;
        }
        $uid = $session->uid;
        $q = "SELECT Count(size) AS totals,
    SUM(IF(size = '1',1,0)) small,
    SUM(IF(size = '2',1,0)) great,
    SUM(IF(size = '3',1,0)) `unique`
    FROM artefacts WHERE owner = " . $uid;
        $result = mysql_query($q, $this->connection);
        $artifact = $this->mysql_fetch_all($result);

        if ($artifact['totals'] < 3 || $type == 11) {
            $DefenderFields = $this->getResourceLevel($vref);
            $defcanclaim = TRUE;
            for ($i = 19; $i <= 38; $i++) {
                if ($DefenderFields['f' . $i . 't'] == 27) {
                    $defTresuaryLevel = $DefenderFields['f' . $i];
                    if ($defTresuaryLevel > 0) {
                        $defcanclaim = FALSE;
                        $form->addError("error", "Treasury has not been destroyed. Your hero could not claim the artefact");
                        return false;
                    } else {
                        $defcanclaim = TRUE;
                    }
                }
            }
            $AttackerFields = $this->getResourceLevel($from, 2);
            for ($i = 19; $i <= 38; $i++) {
                if ($AttackerFields['f' . $i . 't'] == 27) {
                    $attTresuaryLevel = $AttackerFields['f' . $i];
                    if ($attTresuaryLevel >= 10) {
                        $villageartifact = TRUE;
                    } else {
                        $villageartifact = FALSE;
                    }
                    if ($attTresuaryLevel >= 20) {
                        $accountartifact = TRUE;
                    } else {
                        $accountartifact = FALSE;
                    }
                }
            }
            if (($artifact['great'] > 0 || $artifact['unique'] > 0) && $size > 1) {
                $form->addError("error", "Max num. of great/unique artefacts. Your hero could not claim the artefact");
                return FALSE;
            }
            if (($size == 1 && ($villageartifact || $accountartifact)) || (($size == 2 || $size == 3) && $accountartifact)) {
                return true;
                /*
	if($this->getVillageField($from,"capital")==1 && $type==11) {
                $form->addError("error","Ancient Construction Plan cannot kept in capital village");
                return FALSE;
            }else{
                return TRUE;
            }
*/
            } else {
                $form->addError("error", "Your level treasury is low. Your hero could not claim the artefact");
                return FALSE;
            }
        } else {
            $form->addError("error", "Max num. of artefacts. Your hero could not claim the artefact");
            return FALSE;
        }
    }

    function getArtefactDetails($id)
    {
        $q = "SELECT * FROM artefacts WHERE id = " . $id . "";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function getMovementById($id)
    {
        $q = "SELECT * FROM movement WHERE moveid = " . $id . "";
        $result = mysql_query($q);
        $array = $this->mysql_fetch_all($result);
        return $array;
    }

    function getLinks($id)
    {
        $q = 'SELECT * FROM `links` WHERE `userid` = ' . $id . ' ORDER BY `pos` ASC';
        return mysql_query($q, $this->connection);
    }

    function removeLinks($id, $uid)
    {
        $q = "DELETE FROM links WHERE `id` = " . $id . " and `userid` = " . $uid . "";
        return mysql_query($q, $this->connection);
    }

    function getVilFarmlist($wref)
    {
        $q = 'SELECT * FROM farmlist WHERE wref = ' . $wref . ' ORDER BY wref ASC';
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);

        if ($dbarray['id'] != 0) {
            return true;
        } else {
            return false;
        }

    }

    function getRaidList($id)
    {
        $q = "SELECT * FROM raidlist WHERE id = " . $id . "";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function delFarmList($id, $owner)
    {
        $q = "DELETE FROM farmlist where id = $id and owner = $owner";
        return mysql_query($q, $this->connection);
    }

    function delSlotFarm($id)
    {
        $q = "DELETE FROM raidlist where id = $id";
        return mysql_query($q, $this->connection);
    }

    function createFarmList($wref, $owner, $name)
    {
        $q = "INSERT INTO farmlist (`wref`, `owner`, `name`) VALUES ('$wref', '$owner', '$name')";
        return mysql_query($q, $this->connection);
    }

    function addSlotFarm($lid, $towref, $x, $y, $distance, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10)
    {
        $q = "INSERT INTO raidlist (`lid`, `towref`, `x`, `y`, `distance`, `t1`, `t2`, `t3`, `t4`, `t5`, `t6`, `t7`, `t8`, `t9`, `t10`) VALUES ('$lid', '$towref', '$x', '$y', '$distance', '$t1', '$t2', '$t3', '$t4', '$t5', '$t6', '$t7', '$t8', '$t9', '$t10')";
        return mysql_query($q, $this->connection);
    }

    function editSlotFarm($eid, $lid, $wref, $x, $y, $dist, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10)
    {
        $q = "UPDATE raidlist set lid = '$lid', towref = '$wref', x = '$x', y = '$y', t1 = '$t1', t2 = '$t2', t3 = '$t3', t4 = '$t4', t5 = '$t5', t6 = '$t6', t7 = '$t7', t8 = '$t8', t9 = '$t9', t10 = '$t10' WHERE id = $eid";
        return mysql_query($q, $this->connection);
    }

    function getArrayMemberVillage($uid)
    {
        $q = 'SELECT a.wref, a.name, b.x, b.y from vdata AS a left join wdata AS b ON b.id = a.wref where owner = ' . $uid . ' order by capital DESC,pop DESC';
        $result = mysql_query($q, $this->connection);
        $array = $this->mysql_fetch_all($result);
        return $array;
    }

    function addPassword($uid, $npw, $cpw)
    {
        $q = "REPLACE INTO `password`(uid, npw, cpw) VALUES ($uid, '$npw', '$cpw')";
        mysql_query($q, $this->connection));
    }

    function resetPassword($uid, $cpw)
    {
        $q = "SELECT npw FROM `password` WHERE uid = $uid AND cpw = '$cpw' AND used = 0";
        $result = mysql_query($q, $this->connection));
        $dbarray = mysql_fetch_array($result);

        if (!empty($dbarray)) {
            if (!$this->updateUserField($uid, 'password', md5($dbarray['npw']), 1)) return false;
            $q = "UPDATE `password` SET used = 1 WHERE uid = $uid AND cpw = '$cpw' AND used = 0";
            mysql_query($q, $this->connection));
            return true;
        }

        return false;
    }

    function getCropProdstarv($wref)
    {
        global $bid4, $bid8, $bid9, $sesion, $technology;

        $basecrop = $grainmill = $bakery = 0;
        $owner = $this->getVrefField($wref, 'owner');
        $bonus = $this->getUserField($owner, 'b4', 0);

        $buildarray = $this->getResourceLevel($wref);
        $cropholder = array();
        for ($i = 1; $i <= 38; $i++) {
            if ($buildarray['f' . $i . 't'] == 4) {
                array_push($cropholder, 'f' . $i);
            }
            if ($buildarray['f' . $i . 't'] == 8) {
                $grainmill = $buildarray['f' . $i];
            }
            if ($buildarray['f' . $i . 't'] == 9) {
                $bakery = $buildarray['f' . $i];
            }
        }
        $q = "SELECT type FROM `odata` WHERE conqured = $wref";
        $oasis = $this->query_return($q);
        foreach ($oasis as $oa) {
            switch ($oa['type']) {
                case 1:
                case 2:
                    $wood += 1;
                    break;
                case 3:
                    $wood += 1;
                    $cropo += 1;
                    break;
                case 4:
                case 5:
                    $clay += 1;
                    break;
                case 6:
                    $clay += 1;
                    $cropo += 1;
                    break;
                case 7:
                case 8:
                    $iron += 1;
                    break;
                case 9:
                    $iron += 1;
                    $cropo += 1;
                    break;
                case 10:
                case 11:
                    $cropo += 1;
                    break;
                case 12:
                    $cropo += 2;
                    break;
            }
        }
        for ($i = 0; $i <= count($cropholder) - 1; $i++) {
            $basecrop += $bid4[$buildarray[$cropholder[$i]]]['prod'];
        }
        $crop = $basecrop + $basecrop * 0.25 * $cropo;
        if ($grainmill >= 1 || $bakery >= 1) {
            $crop += $basecrop / 100 * ($bid8[$grainmill]['attri'] + $bid9[$bakery]['attri']);
        }
        if ($bonus > time()) {
            $crop *= 1.25;
        }
        $crop *= SPEED;
        return $crop;
    }

    //general statistics

    function addGeneralAttack($casualties)
    {
        $time = time();
        $q = "INSERT INTO general values (0,'$casualties','$time',1)";
        return mysql_query($q, $this->connection));
    }

    function getAttackByDate($time)
    {
        $q = "SELECT * FROM general where shown = 1";
        $result = $this->query_return($q);
        $attack = 0;
        foreach ($result as $general) {
            if (date("j. M", $time) == date("j. M", $general['time'])) {
                $attack += 1;
            }
        }
        return $attack;
    }

    function getAttackCasualties($time)
    {
        $q = "SELECT * FROM general where shown = 1";
        $result = $this->query_return($q);
        $casualties = 0;
        foreach ($result as $general) {
            if (date("j. M", $time) == date("j. M", $general['time'])) {
                $casualties += $general['casualties'];
            }
        }
        return $casualties;
    }

    //end general statistics

    function addFriend($uid, $column, $friend)
    {
        $q = "UPDATE users SET $column = $friend WHERE id = $uid";
        return mysql_query($q, $this->connection);
    }

    function deleteFriend($uid, $column)
    {
        $q = "UPDATE users SET $column = 0 WHERE id = $uid";
        return mysql_query($q, $this->connection);
    }

    function checkFriends($uid)
    {
        $user = $this->getUserArray($uid, 1);
        for ($i = 0; $i <= 19; $i++) {
            if ($user['friend' . $i] == 0 && $user['friend' . $i . 'wait'] == 0) {
                for ($j = $i + 1; $j <= 19; $j++) {
                    $k = $j - 1;
                    if ($user['friend' . $j] != 0) {
                        $friend = $this->getUserField($uid, "friend" . $j, 0);
                        $this->addFriend($uid, "friend" . $k, $friend);
                        $this->deleteFriend($uid, "friend" . $j);
                    }
                    if ($user['friend' . $j . 'wait'] == 0) {
                        $friendwait = $this->getUserField($uid, "friend" . $j . "wait", 0);
                        $this->addFriend($sessionuid, "friend" . $k . "wait", $friendwait);
                        $this->deleteFriend($uid, "friend" . $j . "wait");
                    }
                }
            }
        }
    }

    function setVillageEvasion($vid)
    {
        $village = $this->getVillage($vid);
        if ($village['evasion'] == 0) {
            $q = "UPDATE vdata SET evasion = 1 WHERE wref = $vid";
        } else {
            $q = "UPDATE vdata SET evasion = 0 WHERE wref = $vid";
        }
        return mysql_query($q, $this->connection);
    }

    function addPrisoners($wid, $from, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11)
    {
        $q = "INSERT INTO prisoners values (0,$wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11)";
        mysql_query($q, $this->connection);
        return mysql_insert_id($this->connection);
    }

    function updatePrisoners($wid, $from, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11)
    {
        $q = "UPDATE prisoners set t1 = t1 + $t1, t2 = t2 + $t2, t3 = t3 + $t3, t4 = t4 + $t4, t5 = t5 + $t5, t6 = t6 + $t6, t7 = t7 + $t7, t8 = t8 + $t8, t9 = t9 + $t9, t10 = t10 + $t10, t11 = t11 + $t11 where wref = $wid and prisoners.from = $from";
        return mysql_query($q, $this->connection));
    }

    function getPrisoners($wid, $mode = 0)
    {
        if (!$mode) {
            $q = "SELECT * FROM prisoners where wref = $wid";
        } else {
            $q = "SELECT * FROM prisoners where `from` = $wid";
        }
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getPrisoners2($wid, $from)
    {
        $q = "SELECT * FROM prisoners where wref = $wid and prisoners.from = $from";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function getPrisonersByID($id)
    {
        $q = "SELECT * FROM prisoners where id = $id";
        $result = mysql_query($q, $this->connection);
        return mysql_fetch_array($result);
    }

    function getPrisoners3($from)
    {
        $q = "SELECT * FROM prisoners where prisoners.from = $from";
        $result = mysql_query($q, $this->connection);
        return $this->mysql_fetch_all($result);
    }

    function deletePrisoners($id)
    {
        $q = "DELETE from prisoners where id = '$id'";
        mysql_query($q, $this->connection);
    }

    /*****************************************
     * Function to vacation mode - by advocaite
     * References:
     *****************************************/

    function setvacmode($uid, $days)
    {
        $days1 = 60 * 60 * 24 * $days;
        $time = time() + $days1;
        $q = "UPDATE users SET vac_mode = '1' , vac_time=" . $time . " WHERE id=" . $uid . "";
        $result = mysql_query($q, $this->connection);
    }

    function removevacationmode($uid)
    {
        $q = "UPDATE users SET vac_mode = '0' , vac_time='0' WHERE id=" . $uid . "";
        $result = mysql_query($q, $this->connection);
    }

    function getvacmodexy($wref)
    {
        $q = "SELECT id,oasistype,occupied FROM wdata where id = $wref";
        $result = mysql_query($q, $this->connection);
        $dbarray = mysql_fetch_array($result);
        if ($dbarray['occupied'] != 0 && $dbarray['oasistype'] == 0) {
            $q1 = "SELECT owner FROM vdata where wref = " . $dbarray['id'] . "";
            $result1 = mysql_query($q1, $this->connection);
            $dbarray1 = mysql_fetch_array($result1);
            if ($dbarray1['owner'] != 0) {
                $q2 = "SELECT vac_mode,vac_time FROM users where id = " . $dbarray1['owner'] . "";
                $result2 = mysql_query($q2, $this->connection);
                $dbarray2 = mysql_fetch_array($result2);
                if ($dbarray2['vac_mode'] == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    /*****************************************
     * Function to vacation mode - by advocaite
     * References:
     *****************************************/

    /***************************
     * Function to get Hero Dead
     * Made by: Shadow and brainiacX
     ***************************/

    function getHeroDead($id)
    {
        $q = "SELECT dead FROM hero WHERE `uid` = $id";
        $result = mysql_query($q, $this->connection);
        $notend = mysql_fetch_array($result);
        return $notend['dead'];
    }

    /***************************
     * Function to get Hero In Revive
     * Made by: Shadow
     ***************************/

    function getHeroInRevive($id)
    {
        $q = "SELECT inrevive FROM hero WHERE `uid` = $id";
        $result = mysql_query($q, $this->connection);
        $notend = mysql_fetch_array($result);
        return $notend['inrevive'];
    }

    /***************************
     * Function to get Hero In Training
     * Made by: Shadow
     ***************************/

    function getHeroInTraining($id)
    {
        $q = "SELECT intraining FROM hero WHERE `uid` = $id";
        $result = mysql_query($q, $this->connection);
        $notend = mysql_fetch_array($result);
        return $notend['intraining'];
    }

    /***************************
     * Function to check Hero Not in Village
     * Made by: Shadow and brainiacX
     ***************************/

    function HeroNotInVil($id)
    {
        $heronum = 0;
        $outgoingarray = $this->getMovement(3, $id, 0);
        if (!empty($outgoingarray)) {
            foreach ($outgoingarray as $out) {
                $heronum += $out['t11'];
            }
        }
        $returningarray = $this->getMovement(4, $id, 1);
        if (!empty($returningarray)) {
            foreach ($returningarray as $ret) {
                if ($ret['attack_type'] != 1) {
                    $heronum += $ret['t11'];
                }
            }
        }
        return $heronum;
    }

    /***************************
     * Function to Kill hero if not found
     * Made by: Shadow and brainiacX
     ***************************/

    function KillMyHero($id)
    {
        $q = "UPDATE hero set dead = 1 where uid = " . $id;
        return mysql_query($q, $this->connection);
    }

    /***************************
     * Function to find Hero place
     * Made by: ronix
     ***************************/
    function FindHeroInVil($wid)
    {
        $result = $this->query("SELECT * FROM units WHERE hero>0 AND vref='" . $wid . "'");
        if (!empty($result)) {
            $dbarray = mysql_fetch_array($result);
            if (isset($dbarray['hero'])) {
                $this->query("UPDATE units SET hero=0 WHERE vref='" . $wid . "'");
                unset($dbarray);
                return true;
            }
        }
        return false;
    }

    function FindHeroInDef($wid)
    {
        $delDef = true;
        $result = $this->query_return("SELECT * FROM enforcement WHERE hero>0 AND `from` = " . $wid);
        if (!empty($result)) {
            $dbarray = mysql_fetch_array($result);
            if (isset($dbarray['hero'])) {
                $this->query("UPDATE enforcement SET hero=0 WHERE `from` = " . $wid);
                for ($i = 0; $i < 50; $i++) {
                    if ($dbarray['u' . $i] > 0) {
                        $delDef = false;
                        break;
                    }
                }
                if ($delDef) $this->deleteReinf($wid);
                unset($dbarray);
                return true;
            }
        }
        return false;
    }

    function FindHeroInOasis($uid)
    {
        $delDef = true;
        $dbarray = $this->query_return("SELECT e.*,o.conqured,o.owner FROM enforcement as e LEFT JOIN odata as o ON e.vref=o.wref where o.owner=" . $uid . " AND e.hero>0");
        if (!empty($dbarray)) {
            foreach ($dbarray as $defoasis) {
                if ($defoasis['hero'] > 0) {
                    $this->query("UPDATE enforcement SET hero=0 WHERE `from` = " . $defoasis['from']);
                    for ($i = 0; $i < 50; $i++) {
                        if ($dbarray['u' . $i] > 0) {
                            $delDef = false;
                            break;
                        }
                    }
                    if ($delDef) $this->deleteReinf($defoasis['from']);
                    unset($dbarray);
                    return true;
                }
            }
        }
        return 0;
    }

    function FindHeroInMovement($wid)
    {
        $outgoingarray = $this->getMovement(3, $wid, 0);
        if (!empty($outgoingarray)) {
            foreach ($outgoingarray as $out) {
                if ($out['t11'] > 0) {
                    $dbarray = $this->query("UPDATE attacks SET t11=0 WHERE `id` = " . $out['ref']);
                    return true;
                    break;
                }
            }
        }
        $returningarray = $this->getMovement(4, $wid, 1);
        if (!empty($returningarray)) {
            foreach ($returningarray as $ret) {
                if ($ret['attack_type'] != 1 && $ret['t11'] > 0) {
                    $dbarray = $this->query("UPDATE attacks SET t11=0 WHERE `id` = " . $ret['ref']);
                    return true;
                    break;
                }
            }
        }
        return false;
    }

    /***************************
     * Function checkAttack
     * Made by: Shadow
     ***************************/

    function checkAttack($wref, $toWref)
    {
        $q = "SELECT * FROM movement, attacks where movement.from = $wref and movement.to = $toWref and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 and (attacks.attack_type = 3 or attacks.attack_type = 4) ORDER BY endtime ASC";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    /***************************
     * Function checkEnforce
     * Made by: Shadow
     ***************************/

    function checkEnforce($wref, $toWref)
    {
        $q = "SELECT * FROM movement, attacks where movement.from = $wref and movement.to = $toWref and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 and attacks.attack_type = 2 ORDER BY endtime ASC";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    /***************************
     * Function checkScout
     * Made by: yi12345
     ***************************/

    function checkScout($wref, $toWref)
    {
        $q = "SELECT * FROM movement, attacks where movement.from = $wref and movement.to = $toWref and movement.ref = attacks.id and movement.proc = 0 and movement.sort_type = 3 and attacks.attack_type = 1 ORDER BY endtime ASC";
        $result = mysql_query($q, $this->connection);
        if (mysql_num_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

}

;

$database = new MYSQL_DB;

?>
