<?php session_start(); 
 
if (isset($_SESSION['username'])){
    unset($_SESSION['username']); // xóa session login
}
header("Location: http://localhost/dictionary/index.php");

?>
