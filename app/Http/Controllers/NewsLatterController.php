<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsLatterRequest;
use App\Http\Requests\UpdateNewsLatterRequest;
use App\Models\NewsLatter;
use Illuminate\Http\Request;

class NewsLatterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = NewsLatter::latest()->paginate(10);
        // dd($subscribers);
        return view('admin.newsletter.index', compact('subscribers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsLatterRequest $request)
    {
        try{
            $newsLatter = NewsLatter::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'NewsLatter created successfully',
                'data' => $newsLatter
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create NewsLatter',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsLatter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsLatter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsLatterRequest $request, NewsLatter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsLatter $newsletter)
    {
        $newsletter->delete();
        return redirect()->back()->with('success', 'Subscriber deleted successfully');
    }
}
