<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class AdminEducationsController extends Controller
{
    /**
     * AdminEducationsController constructor for authorization.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('adminEducations.index',[
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
        return view( 'adminEducations.show', ['educations' => $education]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('adminEducations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $id
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $id)
    {
        request()->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $education = Education::find($id);
        $education->name = request('name');
        $education->description = request('description');
        $education->body = request('body');
        $education->save();

        return redirect('adminEducations.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Education $id
     * @return Application|Factory|View
     */
    public function edit(Education $id)
    {
        $education = Education::find($id);
        return view('adminEducations.edit',['educations' => $education]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Education $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Education $id)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $education = Education::find($id);
        $education->name = request('name');
        $education->description = request('description');
        $education->body = request('body');
        $education->save();

        return redirect('adminEducations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Education $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Education $id)
    {
        $education = Education::find($id);
        $education->delete();

        return redirect('/adminEducations.index');
    }
}
