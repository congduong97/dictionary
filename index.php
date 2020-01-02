<?php
$data = "";
$word = "";
  session_start();
  header("Cache-Control: no cache");

  if(isset($_POST["save"])){
    
    $word = $_POST["word"];
    $data .=$word." : ";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "demo_dictionary";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT * FROM dictionarydata WHERE word='$word'";
$result = $conn->query($sql);
$count = 0;
if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {
      if($count == 0){
        $data .= $row["spelling"]."<br><br>".$row["type"]."<br>".$row["meaning"]."<br>";
      }
      else{
        $data .= "<br><br>".$row["type"]."<br>".$row["meaning"]."<br>";
      }
      
      $count++;
    }

  } else {
    $data="This word is not founded !!!";
  }

  $conn->close();
  
  }
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <!-- <link rel="stylesheet" type="text/css" href="./style.css" /> -->
  <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
  <title>Dictionary</title>
</head>

<body>
  <div id="main-content">
    <div id="header">
      <h1 class="title">Tra Từ</h1>
      <?php 
       if (isset($_SESSION['username']) && $_SESSION['username']){
           echo '<a class="log-btn" href="logout.php">Logout</a>';
       }
       else{
           echo '<a class="log-btn" href="login.php">Log in</a>';
       }
       ?>
      <div class="content">
        <!-- <select>
            <option value="EV">English - Vietnamese</option>
            <option value="VE">Vietnamese - English</option>
          </select> -->
        <form action="index.php" method="post">
          <input type="text" name="word" size="40" />
          <!-- <input type="text" name="word" size="40" value= <?php echo $word; ?> /> -->
          <input type="submit" value="Tìm kiếm" class="searchBtn" name="save" />
        </form>
      </div>
    </div>

  <?php
    if(strlen($data) > 0){
      echo '
      <div id="data">
      <p>'.$data.'</p>
      <a class="edit-btn" href="editword.php?word='.$word.'">Edit<a>
    </div>
      ';
    }
  ?>
   
  </div>

</body>

</html>