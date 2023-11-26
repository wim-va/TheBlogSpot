@section('title','Edit user')
{{-- @section('title','Edit user ' . auth()->user()->id) --}}
<x-layout>
    <h1>Edit user</h1>
    <form action="{{ route('users.update',auth()->user()->id) }}" method="POST">
        {{-- <form action="{{ route('users.') }}" method="POST"> --}}
            {{-- TODO: adjust type for password & confirmation --}}
            @csrf
            @method('PATCH')
            @foreach ($params as $param => $token)
            <div class="{{ $param }}">
                <label for="{{ $param }}">{{ $token }}:</label>
                <input type="text" name="{{ $param }}" id="{{ $param }}" value="{{ old($param) ?: $user->$param }}">
            </div>
            @error($param)
            {{ $message }}
            @enderror
            @endforeach
            <button type="submit">Update user</button>
        </form>
</x-layout>