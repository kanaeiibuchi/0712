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
          <h2>■チーム名</h2>
          <form action="{{route('teams.update', $team)}}" method="POST">
            @csrf
            @method('PUT')
             <div class="w-full">
                <input type="text" name="team" class="w-full sm:w-1/2 md:w-3/4 p-2 border rounded-lg" value="{{$team->team}}">
                <button type="submit" class="ml-2 p-2 w-24 bg-blue-300 text-black rounded-lg">更新</button>
             </div>
          </form>
          
          <div class="mt-4">
            <h2>■チームメンバー</h2>
              <ul>
                 @foreach($team->members as $member)
                <li class="flex items-center">
                  <div>&nbsp;&nbsp;{{ $member->nickname }}</div>
                  <form action="{{ route('teams.removeMember', ['team' => $team->id, 'member' => $member->id]) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="ml-2 p-2 rounded-lg" style="color: red;">削除</button>
                  </form>
                </li>
                 @endforeach
                </ul>
          </div>
          <div class="mt-2">
            <a href="{{ route('teams.index') }}" class="block w-24 p-2 bg-gray-200 text-black rounded-lg text-center">戻る</a>
          </div>
        </div>
    </div>
  </div>
</x-app-layout>