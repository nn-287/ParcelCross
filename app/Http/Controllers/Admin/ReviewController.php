<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Review;

class ReviewController extends Controller
{
    public function list()
    {
        $reviews = Review::all();
        return view('admin-views.reviews.list', compact('reviews'));
    }

    
}
