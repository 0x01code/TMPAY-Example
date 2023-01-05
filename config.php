<?php


$con = new mysqli('localhost', 'root', '', '0x01code');
$con->set_charset('utf8');

if ($con->connect_errno) {
    die('Connect Error');
}
