<h1>Accounts</h1>

@foreach($users as $user)

<div>

    <p>ID: {{ $user->id }}</p>

    <p>Name: {{ $user->name }}</p>

    <p>Email: {{ $user->email }}</p>

    <p>Role:
        {{ $user->role == 1 ? 'Admin' : 'Member' }}
    </p>

    <a href="{{ route('admin.users.show', $user) }}">
        View Account
    </a>

</div>

<hr>

@endforeach