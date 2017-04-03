<?php                                                                           
  require_once('credentials.php');   
  global $conn;                                           
                                                                                                                                            
    $conn = mysqli_connect(SERVER_URL, USER, PASSWORD, DB_NAME);            
    if(mysqli_connect_errno()) {                                                   
      $err_msg = "Connection failed: ".mysqli_connect_error();                                                                  
      exit($err_msg);                                                                  
    }                                                                              
?>