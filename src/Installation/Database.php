<?php

declare(strict_types=1);

namespace Travian\Installation;

class Database
{
    private \mysqli $connection;

    function __construct()
    {
        $this->connection = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB);
    }

    public function getConnection(): \mysqli
    {
        return $this->connection;
    }

    public function multi_query(string $sqls): bool
    {
        return $this->connection->multi_query($sqls);
    }

    function query($query)
    {
        return mysqli_query($this->connection, $query);
    }
}
