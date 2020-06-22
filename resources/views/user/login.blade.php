<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
</head>
<body>
    <form action="{{url('/user/login')}}" method="post">
        用户名: <input type="text" name="user_name" placeholder="用户名/Email"><br/>
        密码: <input type="password" name="password"><br/>
        <input type="submit" value="登录">
    </form>
</body>
</html>