@section('title',auth()->user()->firstName . ' '. auth()->user()->lastName)
<x-layout>
    {{ auth()->user()->id }}<br>
    {{ auth()->user()->firstName }}<br>
    {{ auth()->user()->lastName }}<br>
    {{ auth()->user()->email }}<br>
</x-layout>