<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ユーザーのteam_idを取得
       $team_id = auth()->user()->team_id;
        
        //team_idに基づいてチャットをフィルタリング
       $chats = Chat::where('team_id', $team_id)->orderBy('created_at','ASC')->get();
        
        //普通のデータ取得
       //$chats = Chat::orderBy('created_at', 'ASC')->get();
       
       //データをビューに渡す
       return view('chats.index', compact('chats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //新規作成画面を表示
        return view('chats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //データのチェック(バリエーション）
        $request->validate([
            'chat'=>'required|max:255'
            ]);
            
            
        $request->user()->chats()->create([
            'chat' => $request->input('chat'),
            'team_id' => $request->user()->team_id // チームIDを追加
        ]);    
        //データの保存
        //$request->user()->chats()->create($request->only('chat'));
        
        // indexのメソッドにリダイレクト
        return redirect()->route('chats.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
        return view('chats.show',compact('chat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
        return view('chats.edit',compact('chat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat $chat)
    {
         //データのチェック(バリエーション）
        $request->validate([
            'chat'=>'required|max:255'
            ]);
        
        //上書き
        $chat->update($request->only('chat'));
        
        // indexのメソッドにリダイレクト
        return redirect()->route('chats.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //削除
        $chat->delete();
        
        //一覧画面にリダイレクト
        return redirect()->route('chats.index');
        
    }
}