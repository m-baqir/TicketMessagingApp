<?php
session_start();
    $rows = '';
    $xml = simplexml_load_file("xml/tickets.xml");

    //the main ticket listing page for admin where all tickets are listed
    foreach ($xml->children() as $p) {
        //grab attributes of childern
        $att = $p->attributes();
        $rows .= '<tr>';
        //first item in the attribute array is ticket id
        $rows .= '<td>'.$att[0].'</td>';
        //2nd item is the ticket status
        $rows .= '<td>'.$att[1].'</td>';
        //then display the issue date of ticket and the ticket subject
        $rows .= '<td>'."$p->issuedate".'</td>';
        $rows .= '<td>'."$p->subject".'</td>';
        //2 columns here, one for details of the ticket and another for updating status of the ticket
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
