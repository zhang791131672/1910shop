<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
</head>
<body>
    <form action="{{url('user/reg')}}" method="post">
        用户名:<input type="text" name="user_name"><br/>
        Email:<input type="email" name="user_email"><br/>
        密码: <input type="password" name="password1"><br/>
        确认密码: <input type="password" name="password2"><br/>
        <input type="submit" value="注册">
    </form>
</body>
</html>