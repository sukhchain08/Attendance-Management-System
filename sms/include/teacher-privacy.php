<?php   
    // autometic logout hon de timing 
    ini_set('session.gc_maxlifetime', 3600); 
    session_set_cookie_params(3600);
    
    session_start();

    if(!isset($_SESSION['teacher_login_success']) || $_SESSION['teacher_login_success'] !== true)
    {
        echo "<script>window.open('login.php', '_self')</script>";
        exit();
    }
?>