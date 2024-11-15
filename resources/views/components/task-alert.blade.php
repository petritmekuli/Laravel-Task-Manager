@props(['type'])
@php
    if($type === 'success'){
        $color='green';
    }else if($type === "error"){
        $color='red';
    }
@endphp
<div id="success-alert" class='border-2 border-{{$color}}-500 bg-{{$color}}-200 h-16 rounded-lg flex justify-between items-center'>
    <h1 class="ml-4">{{ session($type) }}</h1>
    {{-- <button class="mr-4">X</button> --}}
</div>
