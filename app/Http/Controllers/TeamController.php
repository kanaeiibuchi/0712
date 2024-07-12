<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $teams = Team::orderBy('created_at', 'ASC')->get();
        return view('teams.index', compact('teams'));

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
}
