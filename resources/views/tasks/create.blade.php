<x-app-layout>
   <x-task-container>
        <form action="{{route('tasks.store')}}" method="POST">
            @csrf
            @method('POST')
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-area-input id="description" name="description" :value="old('description')"/>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-3">
                <x-task-link href="{{route('tasks.index')}}" color="gray">Cancel</x-task-link>
                <x-task-button color="blue">Save</x-task-button>
            </div>
        </form>
   </x-task-container>
</x-app-layout>
