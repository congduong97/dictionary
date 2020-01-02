<?php
    $word = $_GET['word'];
    $spell="";
    $type="";
    $meaning="";
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form>
        <table>
            <tr>
                <td><input type="text" name="id" value=""></td>
            </tr>
            <tr>
                <td><input type="text" name="id" value="""></td>
            </tr>
            <tr>
                <td><input type="text" name="id" value=""></td>
            </tr>
            <tr>
                <td><textarea rows="4" cols="50">
                        At w3schools.com you will learn how to make a website. We offer free tutorials in all web development technologies.
                </textarea></td>
            </tr>
        </table>
    </form>
</body>

</html>