<?php

try {
        $db = new PDO("pgsql:dbname=;host=", "", "" );
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>