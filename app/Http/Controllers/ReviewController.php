<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

/**
 * Class ReviewController
 * @package App\Http\Controllers
 */
class ReviewController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getReviews()
    {
        $reviews = Review::orderBy('id', 'desc')->get();
        return view('admin.pages.reviews', ['reviews' => $reviews]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function approveReview(int $id)
    {
        Review::where('id', $id)->update(['isApproved' => 1]);
        return $this->getReviews();
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteReview(int $id)
    {
        Review::where('id', $id)->delete();
        return redirect()->back();
    }
}
