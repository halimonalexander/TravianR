<div id="footer">
    <div id="mfoot">
        <div class="footer-menu">
            <center><br/>
                <div class="copyright">&copy; 2010 -
                    2014 <?php echo defined('SERVER_NAME') ? SERVER_NAME : 'TravianZ'; ?> All rights reserved
                </div>
                <?php
                if ($session->uid !== null):
                ?>
                <div class="copyright">Server running on: <a href="version.php"><b><font color="Red">v.8.0 FINAL
                                TEST</font></b></a>
                </div>
                <?php
                endif;
                ?>
        </div>
    </div>
    </center>
    <div id="cfoot">
    </div>
</div>
