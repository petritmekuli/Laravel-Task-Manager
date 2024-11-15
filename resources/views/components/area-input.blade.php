@props(['disabled' => false, 'id', 'name', 'value', 'rows' => 3])

<textarea @disabled($disabled) id="{{$id}}" name="{{ $name }}" rows="{{$rows}}" {{$attributes->merge(['class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm']) }}>{{$value}}</textarea>
