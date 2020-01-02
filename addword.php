<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action='login.php' method='POST' style="text-align: center;">
            <div style="padding: 10px 0;">
                <label>
                    Từ :
                </label>
                <input type='text' name='txtWord' />
            </div>
            <div style="padding: 10px 0; padding-left:34px; ">
                <label>
                   Phát âm :
                </label>
                <input type='password' name='txtPass' />
            </div>
            <div style="padding: 10px 0; padding-left:34px; ">
                <label>
                  Từ loại :
                </label>
                <input type='password' name='txtType' />
            </div>
            <div style="padding: 10px 0; padding-left:34px; ">
                <label>
                  Nghĩa :
                </label>
                <input type='password' name='txtMean' />
            </div>

            <input type='submit' name="Add" value='Thêm'  />
            <!-- <a href='dangky.php' title='Đăng ký'>Đăng ký</a> -->
        </form>
</body>
</html>