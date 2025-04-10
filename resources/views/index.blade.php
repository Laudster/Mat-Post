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
            <div class="topbar">
                <h1> Mat Poster </h1>

                <div>
                    <p> User: {{auth()->user()->name}} </p>
                    <form action="/logout" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Vil du logge ut?')"> Loggut </button>
                    </form> <br>

                    <form action="/slett-bruker" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="slett" onclick="return confirm('Er du sikker på at du vil slette brukeren din?')"> Slett bruker </button>
                    </form>
                </div>
            </div>

            <button id="newPost"> Ny Post </button>

            <div id="postModal" class="postModal">
                <div class="postContent">
                    <form action="/post" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="topbar">
                            <input type="text" name="message" placeholder="message"><br>
                            <button id="closeButton" type="button">
                                Close
                            </button>
                        </div>
                        <input type="file" accept="image/*" capture="environment" name="image"><br>
                        <input type="submit">
                    </form>
                </div>
            </div>

            <ul>
                @foreach ($posts as $post)
                    <li>
                        <p> {{$post["message"]}} </p>
                        <img class="post-image" src="{{ asset($post['image']) }}" alt="Post Image">
                        <p> {{App\Models\User::find($post["creator"])->name}} </p>
                        <p> {{Carbon\Carbon::parse($post["created_at"])->diffForHumans()}} </p>
                    </li>
                @endforeach
            </ul>
        @endauth
    </body>

    <style>
        .post-image
        {
            max-width: 300px;
        }

        .post:hover
        {
            background-color: rgb(230, 230, 230);
        }

        nav 
        {
            display: flex;
            gap: 2rem;
        }

        li
        {
            list-style-type: none;
        }

        .postModal
        {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }

        .postContent
        {
            margin: 30vh auto;
            padding: 1rem;
            border: 1px solid;
            width: 20rem;
            background-color: rgb(255, 255, 255);
        }

        .topbar
        {
            display: flex;
            justify-content: space-between;
        }

        .slett
        {
            background-color: rgb(200, 50, 50);
            color: white;
            cursor: pointer;
        }
    </style>
    
    <script>
        document.getElementById("newPost").onclick = () => {
            document.getElementById("postModal").style.display = "block";
        }

        document.getElementById("closeButton").onclick = () => {
            document.getElementById("postModal").style.display = "none";
        }
    </script>
</html>
