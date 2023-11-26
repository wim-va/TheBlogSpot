@section('title','Log In')
<x-layout>
    @if (session('error'))
    {{ session('error') }}
    @endif
    <h1>User Log In</h1>
    <form action="/users/login" method="POST">
        @csrf
        @foreach ($params as $param => $token)
        <div class="{{ $param }}">
            <label for="{{ $param }}">{{ $token }}:</label>
            <input type="text" name="{{ $param }}" id="{{ $param }}" value="{{ old($param) }}">
        </div>
        @error($param)
        {{ $message }}
        @enderror
        @endforeach
        <button type="submit">Log in</button>
    </form>
</x-layout>