<?php
############ Check Update #############
//copy("http://travian.gamingcrazy.net/Update/update_latest.tpl", "Templates/update_latest.php");

?>
<div align="center">
    <img src="../img/admin/admin.gif" width="468" height="60" border="0">
</div>

<img src="../<?php echo GP_LOCATE; ?>lang/en/t1/login.gif">

<form method="post" action="admin.php">
    <input type="hidden" name="action" value="login">
    <p class="old_p1">
    <table width="75%" cellspacing="1" cellpadding="0" id="profile">
        <thead>
        <tr>
            <th colspan="2">Server Admin Login</th>
            </td>
        </thead>
        <tbody>
        <tr>
            <td>Username</td>
            <td>
                <input class="fm fm110" type="text" name="name" value="<?php echo $_SESSION['username'] ?>"
                       maxlength="20">
            </td>
        </tr>
        <tr>
            <td>Password:</td>
            <td>
                <input class="fm fm110" type="password" name="pw" value="" maxlength="20">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <center>
                    <input type="image" border="0" src="../img/admin/b/l1.gif" width="80" height="20">
                </center>
            </td>
        </tr>
        </tbody>
    </table>
    </p>
    <img align="right" src="../<?php echo GP_LOCATE; ?>img/new/background_plus.png" width="500">
</form>