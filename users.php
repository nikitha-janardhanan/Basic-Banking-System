<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css">
    <title>Credit Supervisor</title>
  </head>
  <body>
      <?php
        require 'config.php';
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn,$query);
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
    </div>
    </div>
  </header>
  <section>
    <div class="content">
      <h3>Customer List</h3>
      <div class="table">
       <table class="table-head">
         <thead>
         <tr>
           <th>Name</th>
           <th>Balance</th>
           <th>Details</th>
         </tr>
         </thead>
         <tbody>
            <?php
                while($rows=mysqli_fetch_array($result)){
             ?>
           <tr>
             <td><?php echo $rows['username']?></td>
             <td><?php echo $rows['credits']?></td>
             <td><a href="userdetail.php?id= <?php echo $rows['id'] ;?>"> <button type="button" class="button" style="background-color: #0f3057;border-radius:15px; color:white; border:none; width:80px;">Details</button></a></td>
           </tr>
              <?php
                   }
              ?>
         </tbody>
       </table>
      </div>
    </div>
  </section>
</body>
</html>
