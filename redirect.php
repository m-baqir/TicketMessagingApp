<?php
session_start();
//page router
$accounttype = (string)$_SESSION["type"];
if($accounttype == "admin")
    header("Location: ticket-listing.php");
elseif($accounttype == "client")
    header("Location: ticket-listing-user.php");
else
    echo 'please login';

