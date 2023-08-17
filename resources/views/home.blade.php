<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>

    @auth
    {{-- shows if user is logged in --}}
    <p>Congrats you are logged in</p>
    <form action="/logout" method="POST">
    @csrf
    <button>Log out</button>
    </form>
    <div style="border: 3px solid black">
        <h2>Create a New Post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <label for="title">Title</label>
            <input type="text" name="title">
            <label for="body">Body</label>
            <textarea name="body" placeholder="body content..."></textarea>
            <button type="submit">Create new post</button>
        </form>
    </div>
    <div style="border: 3px solid black;">
        <h2>All posts</h2>
        @foreach ($posts as $post)
        <div style="background-color: gray; padding: 10px; margin: 10px;">
            <h3>{{$post["title"]}} by {{$post->user->name}}</h3>
            {{$post["body"]}}
            <p>
                <a href="/edit-post/{{$post->id}}">Edit</a>
            </p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>       
        </div>
        @endforeach
    </div>

    @else
    {{-- if user is not logged in, show this --}}
    <div style="border: 3px solid black;">
        <h2>register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button>Register</button>
        </form>
    </div>
    <div style="border: 3px solid black;">
        <h2>login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="name">  
            <input name="loginpassword" type="password" placeholder="password">
            <button>Login</button>
        </form>
    </div>
    @endauth
    
</body>
</html>