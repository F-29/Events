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
    <form action="{{ route("create-article") }}" method="post">
        <lable for="title">Title</lable>
        <input type="text" name="title" id="title">
        <br/>
        <lable for="body">Body</lable>
        <input type="text" name="body" id="body">
        <br/>
        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>
