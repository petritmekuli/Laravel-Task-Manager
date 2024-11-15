<x-app-layout>
  <x-task-container>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title',$task->title)" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-area-input id="description" name="description" :value="old('description', $task->description)"/>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="col-span-full my-4">
                <label for="status" class="block text-sm font-medium text-gray-900">Status</label>
                <div class="mt-2 flex items-center">
                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                        {{ old('status', $task->status) ? 'checked' : '' }}
                    >
                    <span class="ml-3 text-sm text-gray-700">Mark as Completed</span>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-3">
                <x-task-link href="{{route('tasks.index')}}" color="gray">Cancel</x-task-link>
                <x-task-button color="blue">Update</x-task-button>
            </div>
        </form>
    </x-task-container>
  </x-app-layout>
