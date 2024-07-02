<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\API\SlideShowController as APISlideShowController;
use App\Http\Controllers\Controller;
use App\Models\SlideShow;
use Illuminate\Http\Request;

class SlideShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slideshow = SlideShow::all();
        return view('setting.slideshow.index', compact('slideshow'));
    }

  

    public function create()
    {
        return view('setting.fields.create');
    }

    public function store(Request $request)
    {
///       
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request, $id)
    {
    //    

    }


    public function destroy($id)
    {
    //   
    }
}
