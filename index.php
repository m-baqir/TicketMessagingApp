<?php
session_start();
$xml = simplexml_load_file("xml/users.xml");
//**newpasswords: first one is admin $newpass = array('abcd', 1234,5678);
//var_dump($xml->user['id']);
if(isset($_POST['login'])) {
    //once user clicks login, grab field inputs
    $username = $_POST["username"];
    $password = $_POST["password"];
    foreach ($xml->children() as $u){
        //searches for user and password in the xml
        $userinxml = $u->username;
        $passinxml = $u->password;
        //grab attributes of xml children
        $userid = $u['id'];
        $accounttype = $u['type'];
        //compares the hashed password against form input
        $checkpass = password_verify($password,$passinxml);
        if($username == $userinxml && $checkpass==true){
            //if the user is in xml and the passwords match
            //echo 'success';
            $_SESSION["userid"] = (string)$userid;
            $_SESSION["username"] = $username;
            $_SESSION["type"] = (string)$accounttype;
            //print_r($_SESSION);
            //then admin gets redirected to ticket-listing page for all tickets, and user goes to userspecific page
            if($accounttype == "admin")
                header("Location: ticket-listing.php");
            elseif($accounttype == "client")
                header("Location: ticket-listing-user.php");
            else
                echo 'invalid username or password';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css" />
    <meta name="viewport" content="width=device-width">
    <title>My basic HTML page</title>
</head>

<body>
<header>
    <a href="login.php">Login</a>
    <a href="redirect.php">Tickets</a>
</header>


<h4>Login Below</h4>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" />
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" />
        <input type="submit" name="login" id="login" value="Submit" />
    </form>

<footer>
    <a href="login.php">Login</a>
    <a href="redirect.php">Tickets</a>
</footer>
</body>


</html>

