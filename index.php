<?php
    require_once('header.php')
?>
<style>
    div{
        text-align:center;
        margin:auto;
    }
    a{
        text-align:center;
        margin:1.5em;
        font-size:1.5em;
    }
</style>
<center><h1>Welcome: <?php echo $_SESSION['username']; ?> </h1></center>
<form  action='./index.php' method='post'>
    <input type="submit" name='logout' style="position:absolute;left:70%;top:10px;" value="logout" >
</form>
<div>
    <a href="http://turskatt.online/journey/page/postregistration.php">postregistration</a>
    <a href="http://turskatt.online/journey/page/tokenlogin.php">tokenlogin</a>
</div>
<?php
if(isset($_POST['logout'])){
    session_unset();
?>
    <script type="text/javascript">window.location.href='http://turskatt.online/journey/page/login.php';</script>
<?php
    } 
 ?>