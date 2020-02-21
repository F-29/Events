<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div style="text-align: center; padding: 25px;">
    <form action="{{ route("create-user") }}" method="post">
        <lable for="name">name</lable>
        <input type="text" name="name" id="name">
        <br/>
        <lable for="email">email</lable>
        <input type="email" name="email" id="email">
        <br/>
        <lable for="password">password</lable>
        <input type="password" name="password" id="password">
        <br/>
        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>
