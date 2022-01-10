<?php
    // connect to database
    // $host = 'remotemysql.com';
    // $user = 'r92Nd5JzAL';
    // $pass = '3YScpMDSY0';
    // $db_name = 'r92Nd5JzAL';

    $host = 'db';
    $user = 'admin';
    $pass = 'admin';
    $db_name = 'thehours';

    $conn = new MySQLi($host, $user, $pass, $db_name);

    if ($conn->connect_error) {
        die('Database connection error: ' . $conn->connect_error);
    }
