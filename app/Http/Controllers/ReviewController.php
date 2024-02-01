<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'content' => ['string', 'required', 'min:3'],
            'menu_id' => ['required']
        ]);
        $user = $request->user();

        Review::create([
            'content' => $validateData['content'],
            'user_id' => $user->id,
            'menu_id' => $validateData['menu_id']
        ]);

        return back()->with('success', 'Reviewed the food!');
    }
}
