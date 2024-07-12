<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('編集画面') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <form action="{{route('chats.update', $chat)}}" method="POST">
            @csrf
            @method('PUT')
             <div class="w-full">
                <input type="text" name="chat" class="w-full sm:w-1/2 md:w-3/4 p-2 border rounded-lg" value="{{$chat->chat}}">
                <button class="ml-2 p-2 w-24 bg-blue-300 text-black rounded-lg">更新</button>
             </div>
          </form>
          <button class="ml-2 mt-2 p-2 w-24 bg-gray-200 text-black rounded-lg"><a href= "{{route('chats.index', $chat)}}" >戻る</a></button>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
