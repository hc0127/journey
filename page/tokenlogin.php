<?php 
    require_once('./../config/connect.php');
    require_once('./../header.php')
?>
<style>
    .generate_box{
        border:1px solid black;
        width:400px;
        height:200px;
    }
    form div{
        margin:10px auto;
        text-align:center;
    }
    form div label{
        width:200px;
        font-size:1.3em;
        text-align:left;
    }
    form div input{
        float:right;
        font-size:1.2em;
        margin-right:1em;
    }

    table{
        width:1000px;
        border-collapse: collapse;
    }
    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }
    a{
        text-decoration:none;
        font-size:1.2em;
        margin:1.5em;
    }

</style>
<center><h1>Welcome: JourneyTokenLogins</h1></center>
<a href="http://turskatt.online/journey/page/postregistration.php">to postregistration</a>
<a href="http://turskatt.online/journey/index.php">to index</a>
<div class="form-wrapper">
    <form class="generate_box" method="post" action="./tokenlogin.php">
        <h4>Generate new JourneyTokenLogin</h4>
        <div>
            <label for="">JourneyID</label>
            <input name="journeyID" type="number">
        </div>
        <div>
            <label for="">Inventory</label>
            <input name="inventory" type="text">
        </div>
        <div>
            <label for="">General1</label>
            <input name="general1" type="text">
        </div>
        <div class='create_box'>
            <label for="">Howmany</label>
            <input name="create" type="submit"  value="Create" class="create">
            <input name="howmany" type="number" value="1" min="1" max="100" class="howmany">
        </div>
    </form>
    <h3>Last 200 JourneyTokenLogin(Newest first)</h3>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Password</th>
                    <th>Used</th>
                    <th>Journeyid</th>
                    <th>Inventory</th>
                    <th>General1</th>
                    <th>General2</th>
                    <th>LastNavigatorFingerPrintId</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($logins){
                    foreach($logins as $ind=>$login){
                ?>
                    <tr>
                        <td><?php echo $login['id']?></td> 
                        <td><?php echo $login['password']?></td> 
                        <td><?php echo $login['used']?></td> 
                        <td><?php echo $login['journeyId']?></td> 
                        <td><?php echo $login['inventory']?></td> 
                        <td><?php echo $login['general1']?></td> 
                        <td><?php echo $login['general2']?></td> 
                        <td><?php echo $login['lastNavigatorFingerPrintId']?></td> 
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    function guidv4($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

if(isset($_POST['create'])){
   if($_POST['howmany'] > 100){
?>
    <script>alert('Overcount Logins');</script>
<?php
    }else{
        for ($i=0; $i < $_POST['howmany']; $i++) { 
            $myuuid = guidv4();
            $myupwd = guidv4();
            $today = date("Y-m-d H:i:s");
            $sql = "INSERT INTO `journeytokenlogin`(id,password,journeyID,Inventory,general1,created) VALUES('".$myuuid."','".$myupwd."','".$_POST['journeyID']."','".$_POST['inventory']."','".$_POST['general1']."','".$today."')";
            $logins    = $conn->query($sql);
        }
    }
?>

<script type="text/javascript">window.location.href='http://turskatt.online/journey/page/tokenlogin.php';</script>
<?php } ?>
