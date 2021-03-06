<?php

namespace App\Http\Controllers;

use App\Service;
use App\Link;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 
use View;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Service $service)
    {
        //
        $links = Links::all();

         return View::make('services.show')
            ->with('service', $service)
            ->with('links', $links);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $link = new link;
        $service_id = Input::get('service_id');
        $link->service_id = Input::get('service_id');

        $link->title = Input::get('title');
        $link->description = Input::get('description');
        $link->link = Input::get('link');

        if($request->link_photo!=null) 
            {
                $photoName = time().'.'.$request->link_photo->getClientOriginalExtension();
                $link->logo = $photoName;
                $request->link_photo->move(public_path('images/link_photos/'), $photoName);
            }


        $link->save();

        Session::flash('message', 'Successfully added a new link!');
        return Redirect::to('services/'.$service_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        return View::make('links.edit')
             ->with('link', $link);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        //
        $service_id =  $link->service_id;

        $link->title = Input::get('title');
        $link->description = Input::get('description');
        $link->link = Input::get('link');

        if($request->link_photo!=null) 
        {
            $photoName = time().'.'.$request->link_photo->getClientOriginalExtension();
            $link->logo = $photoName;
            $request->link_photo->move(public_path('images/link_photos/'), $photoName);
        }


        $link->save();

        Session::flash('message', 'Successfully added a new link!');
        return Redirect::to('services/'.$service_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $service_id = $link->service_id;
        $link->delete();

        Session::flash('message', 'Successfully deleted Link!');
        return Redirect::to('Link/'.$service_id);
    }
}
