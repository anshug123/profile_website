

<?php
session_start();
if(isset($_SESSION['otp'] ) ){
    $otp= $_SESSION['otp'];
    $otp1 = $_POST['otp1'];
    if( $otp1 == $otp){
        $tq="tq";
        $_SESSION["tq"]=$tq;
    header("location: transaction.php");
    
}
else{
    $error='eeeee';
    $_SESSION["error"] = $error;
    header("location: transaction.php");
}
}
?>




