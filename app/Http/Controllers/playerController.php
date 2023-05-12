<?php

namespace App\Http\Controllers;

use App\Models\player;
use Illuminate\Http\Request;
use Session;

class playerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $totalrow = 4;
        if(strlen($keyword)){
            $data = player::where('playerid', 'like', "%$keyword%")
                    ->orWhere('name', 'like', "%$keyword%")
                    ->orWhere('team', 'like', "%$keyword%")
                    ->paginate($totalrow);
        }else {
            $data = player::orderBy('playerid', 'desc')->paginate($totalrow);
        }
        return view('player.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('player.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('playerid',$request->playerid);
        Session::flash('name',$request->name);
        Session::flash('team',$request->team);

        $request->validate([
            'playerid'=>'required|numeric|unique:player,playerid',
            'name'=>'required',
            'team'=>'required',
        ],[
            'playerid.required'=>'Please input your Player ID!',
            'playerid.numeric'=>'Player ID must be inputted in numbers!',
            'playerid.unique'=>'Player ID is already used!',
            'name.required'=>'Please enter your Name!',
            'team.required'=>'Please input your Team Name!',
        ]);
        $data = [
            'playerid'=>$request->playerid,
            'name'=>$request->name,
            'team'=>$request->team,
        ];
        player::create($data);
        return redirect()->to('player')->with('success','Data has been successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $playerid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $playerid)
    {
        $data = player::where('playerid', $playerid)->first();
        return view('player.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $playerid)
    {
        $request->validate([
            'name'=>'required',
            'team'=>'required',
        ],[
            'name.required'=>'Please enter your Name!',
            'team.required'=>'Please input your Team Name!',
        ]);
        $data = [
            'name'=>$request->name,
            'team'=>$request->team,
        ];
        player::where('playerid', $playerid)->update($data);
        return redirect()->to('player')->with('success','Data has been edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $playerid)
    {
        player::where('playerid', $playerid)->delete();
        return redirect()->to('player')->with('success', 'Data has successfully deleted!');
    }
}
