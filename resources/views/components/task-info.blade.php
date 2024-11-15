@props(['message', 'tasks_count', 'color'=>"blue"])
<h1 class="mb-2">{{$message}}: <span class='bg-{{$color}}-200 border border-black rounded-md p-1'>{{$tasks_count}}<span></h1>
