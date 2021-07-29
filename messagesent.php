<?php
session_start();
$userid = $_SESSION["userid"];
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $messagetext = filter_input(INPUT_POST,'message');
    $xml = simplexml_load_file("xml/tickets.xml");
    $selected_ticket = $xml->xpath("//ticket[@id='$id']");
    //var_dump($selected_ticket[0]->message);
    $newmessage = $selected_ticket[0]->addChild('message',"$messagetext");
    $datenow = date("Y-m-d\\TH:i:s");
    $newmessage->addAttribute('timestamp',$datenow);
    $user=$userid;
    $newmessage->addAttribute('sentby_userid',$user);
    $xml->saveXML("xml/tickets.xml");
}


?>
<a href="redirect.php">Return to ticket listing</a>
