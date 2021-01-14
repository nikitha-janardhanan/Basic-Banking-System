<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $toUser = $_POST['touser'];
    $amnt = $_POST['credit'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query);

    $sql = "SELECT * from users where id=$toUser";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);


 if($amnt > $sql1['credits'])
    {

        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance")';
        echo '</script>';
    }

     else if($amnt == 0 ){
       echo "<script type='text/javascript'>alert('Enter Amount Greater than Zero');
   </script>";
 }
    else {


        $newCredit = $sql1['credits'] - $amnt;
        $sql = "UPDATE users set credits=$newCredit where id=$from";
        mysqli_query($conn,$sql);



        $newCredit = $sql2['credits'] + $amnt;
        $sql = "UPDATE users set credits=$newCredit where id=$toUser";
        mysqli_query($conn,$sql);

        if($newCredit){
         echo "<script type='text/javascript'>
                  alert('Transaction Successfull!');
                  window.location='users.php';
              </script>";
      }
        $newCredit= 0;
        $amnt =0;

    }

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Credit Supervisor</title>
  </head>
  <body>
          <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$sid";
                $query=mysqli_query($conn,$sql);
                if(!$query)
                {
                    echo "Error ".$sql."<br/>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_array($query);
                ?>
    <header>
    <div class="nav">
    <div class="nav-header">
    <div class="nav-title">
      Credit Supervisor
    </div>
    </div>

    <div class="nav-links">
     <a href="index.php">Home</a>
      <a href="users.php">View Users</a>
    </div>
    </div>
  </header>
<div class="name">
  <h3><?php echo $rows['username']?></h3><hr>
  <div class=" details">
  <h4>Details</h4>
  <p>Account Number:    <?php echo $rows['account_no']?></p>
  <p>Email ID:          <?php echo $rows['email']?></p>
  <p>Phone Number:      <?php echo $rows['phone']?></p>
  <h5>Account Balance:  <?php echo $rows['credits']?></h5>
  </div>
   <button onclick="showForm()" type="button" class="btn btn-primary btn-lg">Credit</button>
   <br><br>
   <form method="post" name="tcredit" id="formElement"class="form-ele" style="display: none; width:50%;">
     <label class="col-sm-3 col-form-label text-right">Username<span
                                    style="color: red;">*</span>:</label>
       <select id="touser" name="touser" required>
         <option value="" disabled selected>Select</option>
         <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $query=mysqli_query($conn,$sql);
                if(!$query)
                {
                    echo "Error ".$sql."<br/>".mysqli_error($conn);
                }
            while($rows = mysqli_fetch_array($query)) {
          ?>
           <option value="<?php echo $rows['id'];?>" ><?php echo $rows['username']?></option>
       <?php }
        ?>
       </select>
       <br><br>
              <div class="form-group row">
                   <label class="col-sm-3 col-form-label text-right">Credit(s)<span
                             style="color: red;">*</span>:</label>
                   <input class="col-sm-8" type="number" id="credit" name="credit" required><br/><br/>
                   <button name="submit" type="submit" class="btn btn-success" style="margin-left:550px;">Submit</button>
              </div>
   </form>
</div>

<script type="text/javascript">
    function showForm() {
        document.getElementById('formElement').style.display = 'block';

    }

</script>
</body>
</html>
