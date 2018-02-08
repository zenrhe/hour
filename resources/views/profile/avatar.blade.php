<s!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Avatar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
        body, html {height:100%;}

        body
            {
                display:flex;
                justify-content:center;
                alitgn-items:center;
            }
    </style>
</head>
<body>
    <!-- Simplet Test file uploa-->
<img src="{{asset('avatars/11/avatar.jpeg')}}"/>
<img src="{{asset('avatars/{{$user->id}}/avatar.jpeg')}}"/>
<form method="POST" action="/avatars" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="file" name="avatar"></input>
 
    <button type="submit">Save Avatar</button>

</form> 
</body>
</html>