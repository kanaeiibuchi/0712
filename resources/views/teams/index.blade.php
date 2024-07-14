<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if(auth()->user()->roll_flg == 1)
            {{ __('オーナー管理') }}
            @else
            {{ __('チーム情報') }}
            @endif
        </h2>
    </x-slot>
    
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("チーム作成") }}
                    <form action="{{route('teams.store')}}" method="POST">
                        @csrf
                        <input type="text" name="team">
                        <button>作成</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{__("チーム一覧")}}
                    <div class="team-container bg-gray-200 mt-4 rounded-lg p-4 h-96 overflow-y-auto">
                    @foreach($teams as $team)
                           <div class="flex gap-4 bg-blue-200 text-black rounded-lg mt-4 p-4">
                            @if($team->user_id == auth()->user()->id)
                                <div>
                                    <p> NO.{{ $team->id }}  {{ $team->team }}</p>
                                    <p> 作成者：{{ $team->user->name }} / 作成日時：{{ $team->updated_at }}</p>
                                </div>
                                <div class="flex gap-4">
                                    <a href="{{route('teams.edit',$team)}}">編集</a>
                                    <form action="{{route('teams.destroy',$team)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button>削除</button>
                                    </form>
                                </div>
                            @endif
                            </div>
                    @endforeach
                    @foreach($teams as $team)
                            <div class="flex gap-4 bg-blue-200 text-black rounded-lg mt-4 p-4">
                                @if(in_array(auth()->user()->id, [$team->user_id_1, $team->user_id_2, $team->user_id_3, $team->user_id_4, $team->user_id_5]))
                                <div>
                                    <p> NO.{{ $team->id }}  {{ $team->team }}</p>
                                    <p> 作成日時：{{ $team->updated_at }}</p>
                                </div>
                                @endif
                            </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>
</x-app-layout>