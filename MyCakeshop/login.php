<?php

$u = $_POST['username'];
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

$res = mysqli_query($con, "select *
                           from user
                           where username = '$u' AND password = '$p'");

$b = false;

while($row = mysqli_fetch_array($res))
{
    $b = true;
}

if($b)
{
    header("location: CakeShop");
}
else
{
    echo "Invalid username or password";
}

?>