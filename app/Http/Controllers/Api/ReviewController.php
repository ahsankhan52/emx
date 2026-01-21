<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        // Eager load User relationship
        $reviews = Review::with('user')->latest()->get();
        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::create($request->all());

        // Reload to include user data in response
        $review->load('user');

        return response()->json([
            'message' => 'Review created successfully',
            'data' => $review
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
        ]);

        $review->update($request->all());
        $review->load('user');

        return response()->json([
            'message' => 'Review updated successfully',
            'data' => $review
        ]);
    }

    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully']);
    }
}
