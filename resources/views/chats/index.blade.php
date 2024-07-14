<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('チャット') }}
        </h2>
    </x-slot>
    
    
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (empty(auth()->user()->team_id))
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- チームエントリーボタン -->
                    <div class="mt-4 mb-4">
                        <button type="button" class="btn btn-primary" id="entry-button">チームにエントリーする</button>
                    </div>
                </div>
                @else
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- 所属チーム名表示 -->
                    <div class="mt-4 mb-4">
                        @php
                            $team = \App\Models\Team::find(auth()->user()->team_id);
                        @endphp
                        <p>{{ $team->team }}チーム</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- チャット一覧 -->
                    <div id="chat-container" class="chat-container bg-gray-200 mt-4 rounded-lg p-4 h-96 overflow-y-auto">
                        @foreach($chats as $chat)
                        <a href="{{ route('chats.show', $chat) }}">
                            @if($chat->user_id == auth()->user()->id)
                            <div class="w-full flex justify-end">
                                <div class="w-1/2 text-right">
                                    <div class="bg-blue-200 text-black rounded-lg mt-4 p-4">
                                        <p>({{ $chat->created_at }})</p>
                                        <p>{{ $chat->user->nickname }}</p>
                                        <p>{{ $chat->chat }}</p>
                                    </div>
                                    <div class="flex justify-end gap-4 mt-2">
                                        <a href="{{ route('chats.edit', $chat) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">編集</a>
                                        <form action="{{ route('chats.destroy', $chat) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">削除</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="bg-gray-100 text-black rounded-lg mt-4 p-4">
                                <p>({{ $chat->created_at }})</p>
                                <p>{{ $chat->user->nickname }}</p>
                                <p>{{ $chat->chat }}</p>
                            </div>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('chats.store') }}" method="POST" class="flex items-center">
                        @csrf
                        <div class="w-full">
                            <input type="text" name="chat" class="w-full sm:w-1/2 md:w-3/4 p-2 border rounded-lg">
                            <button class="ml-2 p-2 w-24 bg-blue-300 text-black rounded-lg">投稿</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#entry-button').click(function() {
                $.ajax({
                    url: '{{ route('teams.entry') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('チームにエントリーされました！');
                            location.reload();
                        } else {
                            alert('エントリーに失敗しました。もう一度お試しください。');
                        }
                    },
                    error: function() {
                        alert('エラーが発生しました。');
                    }
                });
            });
        });
    </script>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chatContainer = document.getElementById('chat-container');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        });
    </script>
</x-app-layout>
