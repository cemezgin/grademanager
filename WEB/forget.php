<?php
include "dbconnection.php";
if(isset($_GET['email']))
{
    $email = $_GET['email'];
    $stmt = $db->prepare("SELECT userid FROM users WHERE email=?");
    $stmt->execute(array($email));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($rows)
    {
        function makepassword($length)
        {
            $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
            $validCharNumber = strlen($validCharacters);
            $result ="";
            for ($i = 0; $i < $length; $i++)
            {
                $index = mt_rand(0, $validCharNumber - 1);
                $result .= $validCharacters[$index];
            }
            return $result;
        }
        $random_password = makepassword(10);
        $forgetting = 1;
        $stmt = $db->prepare("UPDATE users SET password=?, forget=? WHERE userid=?");
        $stmt->execute(array($random_password,$forgetting,$rows[0]["userid"]));
        $subject = 'the subject';
        $message = 'şifreniz'.$random_password;
        $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
    }
    else
    {
        echo  "Email Not Found";
    }
}
?>