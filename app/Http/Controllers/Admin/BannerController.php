<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Model\Banner;

class BannerController extends Controller
{
    public function list()
    {
        $banners=Banner::latest()->paginate();
        return view('admin-views.banner.list',compact('banners'));
    }


    function Addnew()
    {
        return view('admin-views.banner.add-new');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required',
        ], [
            'title.required' => 'Title is required!',
        ]);

        if (!empty($request->file('image'))) {
            $image_name = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';
            if (!Storage::disk('public')->exists('banner')) {
                Storage::disk('public')->makeDirectory('banner');
            }
            $note_img = Image::make($request->file('image'))->stream();
            Storage::disk('public')->put('banner/' . $image_name, $note_img);
        } else {
            $image_name = 'def.png';
        }

        $banner = new Banner;
        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->image = $image_name;
        $banner->save();
        Toastr::success('Banner added successfully!');
        return redirect('admin/banner/list');
    }



    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin-views.banner.edit', compact('banner'));
        
    }

    

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Title is required!',
            'description' => 'required',
        ], [
            'description.required' => 'Description is required!',

        ]);

        $banner = Banner::find($id);

        if (!empty($request->file('image'))) {
            $image_name = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';
            if (!Storage::disk('public')->exists('banner')) {
                Storage::disk('public')->makeDirectory('banner');
            }
            if (Storage::disk('public')->exists('banner/' . $banner['image'])) {
                Storage::disk('public')->delete('banner/' . $banner['image']);
            }
            $note_img = Image::make($request->file('image'))->stream();
            Storage::disk('public')->put('banner/' . $image_name, $note_img);
        } else {
            $image_name = $banner['image'];
        }

        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->image = $image_name;
        $banner->save();
        Toastr::success('Banner updated successfully!');
        return redirect('admin/banner/list');
    }



    public function delete(Request $request)
    {
        $banner = Banner::find($request->id);
        if (Storage::disk('public')->exists('banner/' . $banner['image'])) {
            Storage::disk('public')->delete('banner/' . $banner['image']);
        }
        $banner->delete();
        Toastr::success('Banner removed successfully!');
        return back();
    }

}
