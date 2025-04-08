<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        @guest
        <nav>
            <a href="/login"> Login </a>
            <a href="/register"> Register </a>
        </nav>
        @endguest

        @auth
            <p> User: {{auth()->user()->name}} </p>

            <form action="/logout" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Logg ut">
            </form>
        @endauth
    </body>

    <style>
        nav 
        {
            display: flex;
            gap: 2rem;
        }
    </style>
</html>
