<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TNT-Email</title>
    <style>
        .title-all {
            font-weight: 700;
            font-size: 23px
        }
        .content{
            width: 600px;
            padding: 20px;
            background: #f1f1f1;
        }
    </style>
</head>

<body>
    <div class="content">
        <h1 class="title-all">TNT-SCHOOL xin gửi lời chào bạn</h1>
        <h2 class="">Thông tin mã số và tài khoản của bạn</h2>
        <h3 class="">Mã số : {{ $data['code'] }}</h3>
        <h3 class="">Tài khoản : {{ $data['username'] }}</h3>
        <h3 class="">Mật khẩu : {{ $data['password'] }}</h3>
        <h2 class="">Cảm ơn bạn vì đã làm việc với chúng tôi , chung ta sẽ cùng nhau xây dựng sự nghiệp công việc</h2>
    </div>
</body>

</html>
