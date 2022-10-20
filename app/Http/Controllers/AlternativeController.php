<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use RealRashid\SweetAlert\Facades\Alert;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alternative = Alternative::all();
        // dd($alternative);
        return view('dashboard.alternative.show', [
            "alternatives" => $alternative
        ]);
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
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($request->criteria);
        $input['slug'] = SlugService::createSlug(Alternative::class, 'slug', $request->alternative);

        $validator = Validator::make($input, [
            'alternative' => 'required',
            'slug' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal menambahkan data');
        }

        $validator->validate();
        Alternative::create($request->all());
        return redirect()->back()->with('success', 'Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function show(Alternative $alternative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternative $alternative)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alternative $alternative)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'alternative' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal mengubah data')->autoClose(false);
            return back();
        }

        $rules = [
            'alternative' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['slug'] = SlugService::createSlug(Alternative::class, 'slug', $request->alternative);

        Alternative::where('id', $alternative->id)->update($validatedData);

        return redirect()->back()->with('success', 'Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternative $alternative)
    {
        Alternative::destroy($alternative->id);

        return redirect()->back()->with('success', "Data $alternative->alternative berhasil di hapus");
    }
}
