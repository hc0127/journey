<?php
    session_start();
    if(isset($_SESSION) && isset($_SESSION['username']) && $_SESSION['username'] != "")
    {
?>
<?php
    }else{
?>
<script type="text/javascript">window.location.href='http://turskatt.online/journey/page/login.php';</script>
<?php } ?>