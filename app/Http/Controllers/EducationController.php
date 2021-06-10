<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(){
        return view('educations.index',[
            'educations'=> Education::latest()->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Education $id
     * @return Application|Factory|View
     */
    public function show(Education $id)
    {
        $education = Education::find($id);

        return view( 'educations.show', ['education' => $education]);
    }
}

