<?php
session_start();
//include 'ticket-listing.php';
$xml = simplexml_load_file("xml/tickets.xml");
$userid = $_SESSION["userid"];
$accounttype = $_SESSION["type"];
$id = $_POST['id'];
//grabbing the current ticket based on ticket id
$currentticket = $xml->xpath("//ticket[@id='$id']");
//grabbing the current ticket based on userid
$ticketstarter = $xml->xpath("//ticket[@initiatedbyuserid='$userid']");
if($accounttype == "client") {
    //clients get access to tickets based on their userid
    foreach ($ticketstarter as $ticket) {
        if ($ticket['id'] == $id) {
            $msgprint = '';
            $messages = $xml->xpath("//ticket[@id='$id']");
            for ($i = 0; $i < count($messages[0]->message); $i++) {
                $msgprint .= '<tr>';
                $tstamp = $messages[0]->message[$i]['timestamp'];
                $sentby = $messages[0]->message[$i]['sentby_userid'];
                $msg = $messages[0]->message[$i];
                $msgprint .= '<td>' . $tstamp . '</td>';
                $msgprint .= '<td>' . $sentby . '</td>';
                $msgprint .= '<td>' . $msg . '</td>';
                $msgprint .= '</tr>';
            }

        }
    }
}
elseif ($accounttype == "admin"){
    //admins get access to tickets based on ticketid
    foreach ($currentticket as $ticket) {
        if ($ticket['id'] == $id) {
            $msgprint = '';
            $messages = $xml->xpath("//ticket[@id='$id']");
            for ($i = 0; $i < count($messages[0]->message); $i++) {
                $msgprint .= '<tr>';
                $tstamp = $messages[0]->message[$i]['timestamp'];
                $sentby = $messages[0]->message[$i]['sentby_userid'];
                $msg = $messages[0]->message[$i];
                $msgprint .= '<td>' . $tstamp . '</td>';
                $msgprint .= '<td>' . $sentby . '</td>';
                $msgprint .= '<td>' . $msg . '</td>';
                $msgprint .= '</tr>';
            }

        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="#"></script>
    <link rel="stylesheet" href="css/styles.css" />
    <meta name="viewport" content="width=device-width">
    <title>My basic HTML page</title>
</head>

<body>
<header>
    <a href="login.php">Login</a>
    <a href="redirect.php">Tickets</a>
</header>


<table>
    <thead>
    <tr>
        <th>Timestamp</th>
        <th>Sent by User</th>
        <th>Message</th>
    </tr>
    </thead>
    <tbody>
    <?php print $msgprint; ?>
    </tbody>
</table>
<form method="post" action="messagesent.php">
    <fieldset>
        <legend>Send new message</legend>
        <input type="hidden" name="id" value="<?=$id ?>">
        <input type="text" name="message" id="message"/>
        <input type="submit" name="submit" value="Send message"/>
    </fieldset>
</form>
<footer>
    <a href="login.php">Login</a>
    <a href="redirect.php">Tickets</a>
</footer>
</body>


</html>
