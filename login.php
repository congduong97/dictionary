<?php
 $dataError = "";
//Khai báo sử dụng session

session_start();
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

//Xử lý đăng nhập
if (isset($_POST['dangnhap'])) 
{
   
    //Kết nối tới database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "demo_dictionary";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     
    //Lấy dữ liệu nhập vào
    $username = addslashes($_POST['txtUsername']);
    $password = addslashes($_POST['txtPassword']);
     
    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$username || !$password) {
        $dataError =  "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu";
        
    }
     
    // mã hóa pasword
    // $password = md5($password);
     
    //Kiểm tra tên đăng nhập có tồn tại không
    $result = $conn->query("SELECT username, password FROM user WHERE username='$username'");
    if ($result->num_rows > 0) {
        // output data of each row
    
       //Lấy mật khẩu trong database ra
       while($row = $result->fetch_assoc()) {
         //So sánh 2 mật khẩu có trùng khớp hay không
         if ($password != $row['password']) {
            $dataError  =  "Mật khẩu không đúng. Vui lòng nhập lại.";
            die();  
            }    
        //Lưu tên đăng nhập
        $_SESSION['username'] = $username;
        header("Location: http://localhost/dictionary/index.php");
        die();
        }
         
      } else {
        $dataError  =  "Mật khẩu không đúng. Vui lòng nhập lại.";
      }
      $conn->close();
      
    
}
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        .main-content {
            margin: 100px auto;
            width: 50%;
            border: 3px solid green;
            padding: 10px;
           

        }
    
    </style>
</head>

<body>
    <div class="main-content">
        <form action='login.php' method='POST' style="text-align: center;">
            <div style="padding: 10px 0;">
                <label>
                    Tên đăng nhập :
                </label>
                <input type='text' name='txtUsername' />
            </div>
            <div style="padding: 10px 0; padding-left:34px; ">
                <label>
                    Mật khẩu :
                </label>
                <input type='password' name='txtPassword' />
            </div>

            <input type='submit' name="dangnhap" value='Đăng nhập'  />
            <!-- <a href='dangky.php' title='Đăng ký'>Đăng ký</a> -->
        </form>
        <p style="text-align: center; color:red; "><?php echo($dataError)?></p>
    </div>
</body>

</html>