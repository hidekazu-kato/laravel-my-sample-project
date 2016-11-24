<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widget;
use Illuminate\Support\Facades\Redirect;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        return view('widget.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        return view('widget.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $this->validate($request, [

            'name' => 'required|unique:widgets|string|max:30',

        ]);

        $widget = Widget::create(['name' => $request->name]);

        $widget->save();

        return Redirect::route('widget.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $widget = Widget::findOrFail($id);

        return view('widget.show', compact('widget'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $widget = Widget::findOrFail($id);

        return view('widget.edit', compact('widget'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name' => 'required|string|max:40|unique:widgets,name,' .$id

        ]);

        $widget = Widget::findOrFail($id);

        $widget->update(['name' => $request->name]);


        return Redirect::route('widget.show', ['widget' => $widget]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Widget::destroy($id);

        return Redirect::route('widget.index');

    }
}