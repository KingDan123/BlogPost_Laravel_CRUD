<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Home Page</h1>

    @auth

<p>You are logged in </p>
<form action="/logout" method="post">
@csrf
<button>LogOut</button>
</form>

<div style="border: 3px solid blue ">
    <h2>Create New Post</h2>
<form action="/create-post" method="post">
@csrf
<input type="text" name="title" placeholder="post title">
<textarea name="body" placeholder="body content---"></textarea>
<button>Save</button>
</form>
</div>
<div style="border: 3px solid rgb(0, 255, 64) ">
    <h2>All Posts</h2>
    @foreach ($posts as $post)
        <table style="background-color: cornsilk; border: 1px black;">
            <tr>
                <td><h3>{{$post['title']}} by {{$post->user->name}}</h3></td>
                <td>{{$post['body']}}</td>
                <td><button style="color: darkgreen"><a href="/edit-post/{{$post->id}}">Edit </a></button></td>
                <td>
                    <form action="/delete-post/{{$post->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button style="color: crimson">Delete</button>
                    </form>
                    </td>
            </tr>
        </table>
    @endforeach

</div>


    @else

    <div style="border: 3px solid black;">
        <h2>Registration form</h2>
        <form action="/register" method="POST">
            @csrf 
            <div>
                <label for="">Name</label>
                <input name="name" type="text" placeholder="name">
        </div>
        <div>
                <label for="">E-mail</label>
                <input name="email" type="text" placeholder="e-mail">
        </div>
        <div>
                <label for="">Password</label>
                <input name="password" type="password" placeholder="password">
        </div>
        <div>
            <button>Register</button>
        </div>
        </form>
    </div>
    <div style="border: 3px solid black;">
        <h2>LogIn form</h2>
        <form action="/login" method="POST">
            @csrf 
            <div>
                <label for="">User Name</label>
                <input name="loginname" type="text" placeholder="name">
        </div>
        <div>
                <label for="">User Password</label>
                <input name="loginpassword" type="password" placeholder="password">
        </div>
        <div>
            <button>LogIn</button>
        </div>
        </form>
    </div>

    @endauth

    
</body>
</html>