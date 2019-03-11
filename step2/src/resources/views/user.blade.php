<!-- Show $name posted from userController -->
@foreach ($users as $user)
    <h2>Your name is {{$user->name}}. Your mail address is {{$user->email}}</h2>
@endforeach