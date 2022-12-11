<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function index()
    {
        $sliders= Slide::orderBy('id', 'desc')->get();
        return view('backend.pages.slide.index', compact('sliders'));
    }

    public function create()
    {
        return view('backend.pages.slide.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'=>'required | mimes:jpg,png'
        ]);

        $image=$request->file('image');
        $imageName=time().$image->getClientOriginalName();
        $image->move('images/slider/', $imageName);

        Slide::create([
            'image'=>$imageName
        ]);

        notify()->success('Slider Created Successfully!!!');

        return redirect()->route('admin.slider');
    }

    public function delete($id)
    {
        $slider=Slide::find($id);
        unlink('images/slider/'. $slider->image);
        $slider->delete();

        notify()->success('Slider Deleted Successfully!!!');

        return redirect()->route('admin.slider');
    }
}
