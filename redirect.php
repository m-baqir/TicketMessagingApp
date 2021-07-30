<?php
session_start();
//page router based on type of user that logs in
$accounttype = (string)$_SESSION["type"];
if($accounttype == "admin")
    header("Location: ticket-listing.php");
elseif($accounttype == "client")
    header("Location: ticket-listing-user.php");
else
    echo 'please login';

