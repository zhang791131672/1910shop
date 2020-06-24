<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人中心</title>
</head>
<body>
    个人中心<br/>
    {{Cookie::get('user_name')}},欢迎回来<br/>
    您的Email为{{$user_info->user_email}}<br/>
    注册时间为{{date('Y-m-d H:i:s',$user_info->reg_time)}}<br/>
    最后一次登录时间为
</body>
</html>