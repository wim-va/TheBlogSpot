@section('title','Create user')
<x-layout>
    <h1>Create user</h1>
    <form action="{{ route('users.store') }}" method="POST">
        {{-- <form action="{{ route('users.') }}" method="POST"> --}}
            {{-- TODO: adjust type for password & confirmation --}}
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
            <button type="submit">Create user</button>
        </form>
</x-layout>


{{--
((
[A-Z]{2}
)
&
(
[a-z]{3}
)
&
(
[0-9]{5}
)
){3,65}

(([A-Z]{2,})([a-z]{3})([0-9]{3})){3,65}
/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).(?=\W)+$/gm
/^((?:\W+).(?:\w+).(?:\d+))$/gm

^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W+).+$
--}}