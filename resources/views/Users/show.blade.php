<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
</head>

<body>
    <h2>User "{{ $user->name }}"</h2>
    <div>
        @include('Users.partials.user_fields', ['mode' => 'show'])
    </div>
</body>

</html>