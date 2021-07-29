<?php
session_start();
$rows = '';
$xml = simplexml_load_file("xml/tickets.xml");
$userid = $_SESSION["userid"];
//print_r($_SESSION);
$ticketstarter = $xml->xpath("//ticket[@initiatedbyuserid='$userid']");
//print_r($ticketstarter);

foreach ($ticketstarter as $p) {
    $att = $p->attributes();
    $rows .= '<tr>';
    $rows .= '<td>'.$att[0].'</td>';
    $rows .= '<td>'.$att[1].'</td>';
    $rows .= '<td>'."$p->issuedate".'</td>';
    $rows .= '<td>'."$p->subject".'</td>';
    $rows .= '<td>'.'<form action="details.php"'.' method="post"'.'>'.'<input type="hidden"'.' name="id"'.'value="'.$att[0].'"/>'.'<input type="submit"'.' name="details"'.' value="details"'.'/>'.'</form>'.'</td>';
    $rows .= '<td>'.'<form action="statusupdated.php"'.' method="post"'.'>'.'<input type="hidden"'.' name="id"'.'value="'.$att[0].'"/>'.'<select name="statustype">'.'<option value="">Select Status</option>'.'<option value="on-going">On-going</option>'.'<option value="resolved">Resolved</option>'.'</select>'.'<input type="submit"'.' name="status"'.' value="Update"'.'/>'.'</form>'.'</td>';
    $rows .= '</tr>';
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
        <th>TicketID</th>
        <th>Status</th>
        <th>Issue Date</th>
        <th>Ticket Subject</th>
        <th></th>
        <th>Update Status</th>
    </tr>
    </thead>
    <tbody>
    <?php print $rows; ?>
    </tbody>
</table>
<footer>
    <a href="login.php">Login</a>
    <a href="redirect.php">Tickets</a>
</footer>
</body>


</html>
