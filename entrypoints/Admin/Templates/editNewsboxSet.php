<?php

if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);
?>
<h2>
    <center>Server Configuration</center>
</h2>
<form action="../GameEngine/Admin/Mods/editNewsboxSet.php" method="POST">
    <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
    <br/>
    <table id="profile" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th colspan="2">Edit Newsbox Settings</th>
        </tr>
        </thead>
    </table>
    <br/>
    <table width="100%">
        <tr>
            <td align="left"><a href="../Admin/admin.php?p=config"><< back</a></td>
            <td align="right"><input type="image" border="0" src="../img/admin/b/ok1.gif"></td>
        </tr>
    </table>
</form>
