<div class="container center">
    <h2>Sent Mail</h2>
    <form class="form-horizontal" method="post">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <textarea rows="10" name="message" name="message"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="sent">Submit</button>
            </div>
        </div>
    </form>
</div>

<?php
    if(isset($_POST['sent'])){
        $msg=$_POST['message'];
        try{
            include('mysql_connect.php');
            $sql=$conn->prepare("SELECT email FROM users");
            $sql->execute();
            $result=$sql->fetchAll();
            foreach ($result as $res) {
                echo($res['email']);
                $email=$res['email'];
                sentmyMail($email,$msg);
            }


        }catch(PDOException $e){

        }
        echo'Ok';
    }

function sentmyMail($email,$msg){
    try{
        $to = $email;
        $subject = "My subject";
        $txt = $msg;
        $headers = "From: memotiur@gmail.com";

        mail($to,$subject,$txt,$headers);
    }catch (PDOException $e){
        echo'Problem';
    }

}
?>