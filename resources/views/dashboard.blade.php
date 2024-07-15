<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("ログインしました！") }}<br>
                    <br>
                    <div class="font-bold">
                    {{ __("このアプリは大企業で新しいことに挑戦する人たちが集まって") }}<br>
                    {{ __("期間限定の匿名小集団の中で、お互いの挑戦や失敗を共有して相互応援しながら成長していくコミュニティです") }}<br>
                    </div>
                    <br>
                    {{ __("★「チーム」　・・・あなたのチーム情報を参照できます") }}<br>
                    {{ __("★「チャット」　・・・チームにエントリーしてチャットできます") }}<br>
                    {{ __("★「プロフィール」　・・・プロフィールを編集できます") }}<br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
