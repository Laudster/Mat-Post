<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
</head>
<body>
    <h3> Register </h3>

    <form action="/register" method="POST">
        @csrf

        <input type="text" name="name" placeholder="name">
        <input type="password" name="password" placeholder="password">
        
        <input type="submit">
    </form>
</body>
</html>