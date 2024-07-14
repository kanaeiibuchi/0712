<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ユーザーとチームの一覧を取得
        $users = User::all();
        $teams = Team::orderBy('created_at', 'ASC')->get();
        // ビューにデータを渡す
        return view('teams.index', compact('users','teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //データのチェック（バリデーション）
         $request->validate([
            'team'=>'required|max:255'
            ]);
            
        //データの保存
         $request->user()->teams()->create($request->only('team'));
        
        //teamカラムをnameにした一番最初の時のコード 
        //$request->user()->teams()->create(['name' => $request->input('team')]);
         
        
        // indexのメソッドにリダイレクト
        return redirect()->route('teams.index')->with('success','チームが作成されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
        return view('teams.show',compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
        return view('teams.edit',compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
           //データのチェック(バリエーション）
        $request->validate([
            'team'=>'required|max:255'
            ]);
        
          //上書き
        $team->update($request->only('team'));
    
        // indexのメソッドにリダイレクト
        return redirect()->route('teams.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //削除
        $team->delete();
        
        //一覧画面にリダイレクト
        return redirect()->route('teams.index');
    }

    /**
     * チームにエントリーするメソッド
     */
    public function entry(Request $request)
    {
        $user = $request->user();

        // エントリー可能なチームを取得
        $teams = Team::where('life_flg', 1)
            ->whereNull('user_id_5')
            ->get();

        if ($teams->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'エントリー可能なチームがありません。']);
        }

        // ランダムにチームを選択
        $team = $teams->random();

        // チームにユーザーを割り当て
        if (is_null($team->user_id_1)) {
            $team->user_id_1 = $user->id;
        } elseif (is_null($team->user_id_2)) {
            $team->user_id_2 = $user->id;
        } elseif (is_null($team->user_id_3)) {
            $team->user_id_3 = $user->id;
        } elseif (is_null($team->user_id_4)) {
            $team->user_id_4 = $user->id;
        } elseif (is_null($team->user_id_5)) {
            $team->user_id_5 = $user->id;
        }

        $team->save();

        // ユーザーのチームIDを更新
        $user->team_id = $team->id;
        $user->save();

        return response()->json(['success' => true, 'message' => 'チームにエントリーされました！']); 
    }
}