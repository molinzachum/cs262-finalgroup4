<h1>{{ $user->name }}</h1>

<form method="POST"
      action="{{ route('admin.users.update', $user) }}">

    @csrf
    @method('PATCH')

    <label>Name</label>
    <input
        type="text"
        name="name"
        value="{{ $user->name }}">

    <br><br>

    <label>Email</label>
    <input
        type="email"
        name="email"
        value="{{ $user->email }}">

    <br><br>

    <label>Role</label>

    <select name="role">

        <option value="0"
            {{ $user->role == 0 ? 'selected' : '' }}>
            Member
        </option>

        <option value="1"
            {{ $user->role == 1 ? 'selected' : '' }}>
            Admin
        </option>

    </select>

    <br><br>

    <label>Description</label>

    <textarea name="description">{{ $user->description }}</textarea>

    <br><br>

    <label>DOB</label>

    <input
        type="date"
        name="dob"
        value="{{ $user->dob }}">

    <br><br>

    <label>Profile Picture</label>

    <input
        type="text"
        name="profile_picture"
        value="{{ $user->profile_picture }}">

    <br><br>

    <button type="submit">
        Save Changes
    </button>

</form>

<hr>

<form method="POST"
      action="{{ route('admin.users.destroy', $user) }}">

    @csrf
    @method('DELETE')

    <button type="submit">
        Delete Account
    </button>

</form>