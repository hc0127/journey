<?php
    require_once('./../config/connect.php');
    session_start();
?>
<style>
    form{
        width:500px;
        height:300px;
        text-align:center;
        margin:auto;
    }
    div{
        height:50px;
        width:300px;
        margin:auto;
    }
    div input{
        font-size:1.2em;
    }
    input.login{
        margin-top:1em;
    }
</style>
<form action="./login.php" method="post">
    <h1>Login here</h1>
    <div>
        <input type="text" name="username" required="required" placeholder="Username" autofocus required></input>
    </div>
    <div>
       <input type="password" name="password" required="required" placeholder="Password" required></input>        
    <div>
    <div>
        <input type="submit" class="login" name="login" value="Login"></input>
    </div>
</form>
<?php
  if (isset($_POST['login']))
    {
      foreach($userlist as $user){
        print_r($user);
        if($user['username'] == $_POST['username']){
          if($user['password'] == $_POST['password']){
            $_SESSION['username']=$user['username'];
            $_SESSION['password']=$user['password'];
?>
<script type="text/javascript">window.location.href='http://turskatt.online/journey/index.php';</script>
<?php
            break;
          }else{
            break;
          }
        }
      }
      echo 'Invalid Username and Password Combination';
    }
?>