@section('title','All users')
<x-layout>
    @auth
    {{
    auth()->user()->firstName
    }}
    @endauth

    <h1>Users</h1>
    <table>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->firstName}}</td>
            <td>{{ $user->lastName}}</td>
            <td>{{ $user->email }}</td>
        </tr>
        @endforeach
    </table>
</x-layout>