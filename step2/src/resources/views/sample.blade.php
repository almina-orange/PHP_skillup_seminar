<!-- Show $name posted from userController -->
@foreach ($users as $user)
    <h2>Your name is {{$user->name}}. Your password is {{$user->password}}.</h2>
@endforeach