<x-app-layout>
    @if(session('success'))
        <x-slot name="header">
            <x-task-alert type="success"/>
        </x-slot>
    @elseif (session('error'))
        <x-slot name="header">
            <x-task-alert type="error"/>
        </x-slot>
    @endif
    <x-task-container>
        <div class="flex justify-between">
            <div>
                <x-task-info message="Total tasks" :tasks_count="$total = $tasks->count()" color="blue"/>
                <x-task-info message="Finished Tasks" :tasks_count="$finished = $tasks->where('status', 1)->count()" color="green"/>
                <x-task-info message="Unfinished tasks" :tasks_count="$total-$finished" color="gray"/>
                <x-task-link href="{{route('tasks.create')}}">Create task</x-task-link>
            </div>
            <div>
                <h1 class="text-xl font-bold">Filters:</h1>
                <form action="{{ route('tasks.index') }}" method="GET">
                    <div class="flex my-4">
                        <div class="self-center mr-3">
                            <label for="priority" class="block text-gray-700 font-semibold">Priority</label>
                            <select name="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="" {{ old('priority-filter') === '' ? 'selected' : '' }}>All</option>
                                <option value="1" {{ old('priority-filter') == '1' ? 'selected' : '' }}>Low</option>
                                <option value="2" {{ old('priority-filter') == '2' ? 'selected' : '' }}>Medium</option>
                                <option value="3" {{ old('priority-filter') == '3' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div class="self-center">
                            <label for="status" class="block text-gray-700 font-semibold">Status</label>
                            <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="" {{ old('status-filter') === '' ? 'selected' : '' }}>All</option>
                                <option value="0" {{ old('status-filter') == '0' ? 'selected' : '' }}>Unfinished</option>
                                <option value="1" {{ old('status-filter') == '1' ? 'selected' : '' }}>Finished</option>
                            </select>
                        </div>
                    </div>

                    <x-task-button color='blue' class="w-full justify-center">
                        {{ __('Apply') }}
                    </x-task-button>
                </form>
            </div>
        </div>
        <ul>
            @foreach ($tasks as $task)
                <li>
                    <div class="
                        border {{$task->status? 'border-green-500 bg-green-100' : 'border-black bg-gray-100'}} border-2 rounded-md my-3
                        flex justify-between p-3
                        ">
                        <h1 class="self-center text-xl">{{$task->title}}</h1>
                        <h1 class="self-center">Priority:{{$task->priority}}</h1>
                        <h1 class="self-center">Status:{{$task->status}}</h1>
                        <div class="flex">
                            <x-task-link href="{{route('tasks.edit', $task->id)}}" >Edit</x-task-link>
                            <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="true">
                                <x-task-button color="green" :disabled="$task->status">
                                    {{ __('Done') }}
                                </x-task-button>
                            </form>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-task-button color="red">
                                    {{ __('Delete') }}
                                </x-task-button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        <li>
    </x-task-contaiener>
</x-app-layout>
