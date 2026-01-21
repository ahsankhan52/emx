<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return response()->json(Page::all());
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return response()->json($page);
    }

    public function update(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        $request->validate([
            'content' => 'nullable|array',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
        ]);

        // We can either replace content entirely or merge. 
        // For a full page save form, replacing is standard.
        // However, if we want to update only specific sections, we might need logic.
        // Given the UI is "Save Page", full update is expected.

        $data = $request->only(['seo_title', 'seo_description']);

        if ($request->has('content')) {
            $data['content'] = $request->input('content');
        }

        $page->update($data);

        return response()->json([
            'message' => 'Page updated successfully',
            'data' => $page
        ]);
    }
}
