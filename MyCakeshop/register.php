<?php

$u = $_POST['username'];
$e = $_POST['email'];
$p = $_POST['password'];

$con = mysqli_connect("localhost", "root", "", "register");

if($con)
{
    echo "connection success";
}
else
{
    echo "connection error";
}

$res = mysqli_query($con, "insert into user
                    (username, email, password)
                    values('$u', '$e', '$p')");

echo "<br>";

if($res)
{
    echo "databae query insert success";
}
else
{
    echo "databae query insert failed";
}

?>