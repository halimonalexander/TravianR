<?php

include_once("config.php");

switch (DB_TYPE) {
    case 1:
        include("Database/db_MYSQLi.php");
        break;
    //case 2:
    //include("Database/db_MSSQL.php");
    //break;
    default:
        include("Database/db_MYSQL.php");
        break;
}
## Security
include("Protection.php");

