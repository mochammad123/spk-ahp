<?php

namespace App\Http\Controllers;

use App\Models\Subcriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Criteria;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class SubcriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($input);
        $input['slug'] = SlugService::createSlug(Subcriteria::class, 'slug', $request->subcriteria);

        $validator = Validator::make($input, [
            'subcriteria' => 'required',
            "description" => 'required',
            'slug' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal menambahkan data');
        }

        $validator->validate();
        Subcriteria::create($request->all());
        return redirect()->back()->with('success', 'Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcriteria  $subcriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Subcriteria $subcriteria, $criteriaId)
    {
        $criterias = Criteria::where('slug', '=', $criteriaId)->first();
        $title = $criterias->criteria;
        $id = $criterias->id;
        $slug = $criterias->slug;
        $subcriterias = Subcriteria::where('criteria_id', '=', $id)->get();

        return view('dashboard.subcriteria.show', [
            "title" => $title,
            "id" => $id,
            "slug" => $slug,
            "subcriterias" => $subcriterias
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcriteria  $subcriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcriteria $subcriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcriteria  $subcriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcriteria $subcriteria)
    {
        $input = $request->all();
        // dd($input);

        $validator = Validator::make($input, [
            'subcriteria' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal mengubah data')->autoClose(false);
            return back();
        }

        $rules = [
            'subcriteria' => 'required',
            'description' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['slug'] = SlugService::createSlug(Subcriteria::class, 'slug', $request->subcriteria);

        Subcriteria::where('id', $subcriteria->id)->update($validatedData);

        return redirect()->back()->with('success', 'Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcriteria  $subcriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcriteria $subcriteria)
    {
        Subcriteria::destroy($subcriteria->id);

        return redirect()->back()->with('success', "Data $subcriteria->subcriteria berhasil di hapus");
    }
}
