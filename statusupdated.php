<?php
session_start();
//only admins can update the status of a ticket
$accounttype=$_SESSION["type"];

$xml = simplexml_load_file("xml/tickets.xml");
    if(isset($_POST['status'])) {
        //once update status is clicked, if the accountype of user is admin then it updates status
        if ($accounttype == "admin"){
            $id = $_POST['id'];
            //var_dump($id);
            //grabs the selected status from the dropdown
            $selected_status = $_POST['statustype'];
            //var_dump($selected_status);
            //grabs the specific ticket based on id
            $selected_ticket = $xml->xpath("//ticket[@id='$id']");
            //sets the status attribute of the ticket to the selected_status
            $selected_ticket[0]->attributes()->status = $selected_status;
            //var_dump($selected_ticket[0]);
            $xml->saveXML("xml/tickets.xml");
            echo'status updated';
        }
        //if accountype is client then user gets a message
        elseif ($accounttype == "client")
            echo 'you do not have permission to perform this action';

    }


?>
<a href="redirect.php">  Return to ticket list</a>
