<?php 
    require_once('./../config/connect.php');
    require_once('./../header.php')
?>
<style>
    table{
        width:500px;
        margin:auto;
    }
    form{
        width:400px;
        margin:auto;
        margin-top:20px;
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
    }
    a{
        text-decoration:none;
        font-size:1.2em;
        margin:1.5em;
    }
</style>
<center><h1>Welcome:PostRegistration</h1></center>
<a href="http://turskatt.online/journey/page/tokenlogin.php">to tokenlogin</a>
<a href="http://turskatt.online/journey/index.php">to index</a>
<div class="form-wrapper"> 
    <div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>id</th>
                    <th>journeyTokenLoginId</th>
                    <th>result1</th>
                    <th>result2</th>
                    <th>reviewComment</th>
                    <th>status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($posts){
                    foreach($posts as $ind=>$post){
                ?>
                    <tr>
                        <form action='./index.php' method='post'>
                        <td><?php echo $ind+1 ?></td>
                        <td><input type="text" id='id' name="id" value = "<?php echo $post['id']?>" /></td> 
                        <td><input type="text" id='journeyTokenLoginId' name="journeyTokenLoginId" value = "<?php echo $post['journeyTokenLoginId']?>" /></td> 
                        <td><input type="number" id='result1' name="result1" value="<?php echo $post['result1']?>" /></td>
                        <td><input type="number" id='result2' name="result2" value="<?php echo $post['result2'] ?>" /></td>
                         <td><input type="text" id='reviewComment' name="reviewComment" value="<?php echo $post['reviewComment'] ?>" /></td>
                         <td><input type="number" id='statusId' name="statusId" value="<?php echo $post['statusId'] ?>" /></td>
                        <td>
                            <input type='submit' id='edit' name='edit' value='edit'>
                        </td>
                    </form>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>

<?php
if(isset($_POST['edit'])){
    $sql = "UPDATE `journeypostregistration` SET
     result1='".$_POST['result1']."',
     result2='".$_POST['result2']."',
     reviewComment='".$_POST['reviewComment']."',
     statusId='".$_POST['statusId']."' WHERE  id = '".$_POST['id']."'";
    $posts    = $conn->query($sql);
?>
<script type="text/javascript">window.location.href='http://turskatt.online/journey/page/postregistration.php';</script>
<?php } ?>