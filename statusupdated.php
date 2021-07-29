<?php
session_start();
$accounttype=$_SESSION["type"];

$xml = simplexml_load_file("xml/tickets.xml");
    if(isset($_POST['status'])) {
        if ($accounttype == "admin"){
            $id = $_POST['id'];
            //var_dump($id);
            $selected_status = $_POST['statustype'];
            //var_dump($selected_status);
            $selected_ticket = $xml->xpath("//ticket[@id='$id']");
            $selected_ticket[0]->attributes()->status = $selected_status;
            //var_dump($selected_ticket[0]);
            $xml->saveXML("xml/tickets.xml");
            echo'status updated';
        }
        elseif ($accounttype == "client")
            echo 'you do not have permission to perform this action';

    }


?>
<a href="redirect.php">  Return to ticket list</a>
