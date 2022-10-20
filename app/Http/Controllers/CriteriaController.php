<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Decision;
use App\Models\Subcriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use RealRashid\SweetAlert\Facades\Alert;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criteria = Criteria::all();

        return view('dashboard.criteria.show', [
            "criterias" => $criteria
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'criteria' => Criteria::all()
        ]);
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
        $input['slug'] = SlugService::createSlug(Criteria::class, 'slug', $request->criteria);

        $validator = Validator::make($input, [
            'criteria' => 'required',
            'slug' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal menambahkan data');
        }

        $validator->validate();
        Criteria::create($request->all());
        return redirect()->back()->with('success', 'Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Criteria $criteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criteria $criteria)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'criteria' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal mengubah data')->autoClose(false);
            return back();
        }

        $rules = [
            'criteria' => 'required'
        ];


        // if ($request->criteria === ($rules['criteria'] <= 'min:5') && ($rules['criteria'] >= 'max:255')) {
        //     Alert::error('Gagal mengubah data', 'Pastikan jumlah karakter pada nama keputusan min >= 5 atau max <=255')->autoClose(false);
        //     return back();
        // }

        $validatedData = $request->validate($rules);

        $validatedData['slug'] = SlugService::createSlug(Criteria::class, 'slug', $request->criteria);

        Criteria::where('id', $criteria->id)->update($validatedData);

        return redirect()->back()->with('success', 'Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criteria $criteria)
    {
        Criteria::destroy($criteria->id);

        return redirect()->back()->with('success', 'Data telah dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Decision::class, 'slug', $request->decision);
        return response()->json(['slug' => $slug]);
    }
}
