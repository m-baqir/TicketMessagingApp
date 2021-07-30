<?php
session_start();
$userid = $_SESSION["userid"];
if(isset($_POST['submit'])) {
    //once send message is clicked
    $id = $_POST['id'];
    //grab the user input of message text
    $messagetext = filter_input(INPUT_POST,'message');
    $xml = simplexml_load_file("xml/tickets.xml");
    //grab the specific ticket based on id
    $selected_ticket = $xml->xpath("//ticket[@id='$id']");
    //var_dump($selected_ticket[0]->message);
    //add child for the new message
    $newmessage = $selected_ticket[0]->addChild('message',"$messagetext");
    //grab datetime now with T between date and time
    $datenow = date("Y-m-d\\TH:i:s");
    //add date time to attribute of new message
    $newmessage->addAttribute('timestamp',$datenow);
    $user=$userid;
    //add sentby_userid attribute
    $newmessage->addAttribute('sentby_userid',$user);
    $xml->saveXML("xml/tickets.xml");
}


?>
<a href="redirect.php">Return to ticket listing</a>
