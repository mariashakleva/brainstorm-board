<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\StoreBoard;
use Illuminate\Http\Request;
use Response;

class BoardsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $boards = Board::with('user')->get();
        return response()->json($boards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoard $request)
    {

        $validated = $request->validated();
        $boards = new Board;
        $boards->title = request('title');
        $boards->user_id = auth()->id();
        $boards->save();
        return response()->json($boards);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $board = Board::findOrFail($id);
        return response()->json($board);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBoard $request, $id)
    {

        $validated = $request->validated();
        $boards = Board::findOrFail($id);
        $boards->update($request->all());
        return response()->json($boards);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Board::findOrFail($id)->delete();
        return response()->json(['status' => 'success'], 204);
    }
}
