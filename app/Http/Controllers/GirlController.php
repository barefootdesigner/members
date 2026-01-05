<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GirlController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Girl::where('is_active', true);

        // Filter by Day
        if ($request->filled('day')) {
            $query->whereJsonContains('availability', $request->day);
        }

        // Filter by Hair
        if ($request->filled('hair')) {
            $query->where('hair', $request->hair);
        }

        // Filter by Nationality
        if ($request->filled('nationality')) {
            $query->where('nationality', $request->nationality);
        }

        // Filter by Eyes
        if ($request->filled('eyes')) {
            $query->where('eyes', $request->eyes);
        }

        // Filter by Age
        if ($request->filled('age')) {
            $query->where('age', $request->age);
        }

        // Filter by Height
        if ($request->filled('height')) {
            $query->where('height', $request->height);
        }

        // Filter by Dress Size
        if ($request->filled('dress_size')) {
            $query->where('dress_size', $request->dress_size);
        }

        // Filter by Bust Size
        if ($request->filled('bust_size')) {
            $query->where('bust_size', $request->bust_size);
        }

        $girls = $query->get();

        // Get unique values for filters
        $filterData = [
            'days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'hair' => \App\Models\Girl::where('is_active', true)->whereNotNull('hair')->where('hair', '!=', '')->pluck('hair')->unique()->sort()->values(),
            'nationality' => \App\Models\Girl::where('is_active', true)->whereNotNull('nationality')->where('nationality', '!=', '')->pluck('nationality')->unique()->sort()->values(),
            'eyes' => \App\Models\Girl::where('is_active', true)->whereNotNull('eyes')->where('eyes', '!=', '')->pluck('eyes')->unique()->sort()->values(),
            'age' => \App\Models\Girl::where('is_active', true)->whereNotNull('age')->where('age', '!=', '')->pluck('age')->unique()->sort()->values(),
            'height' => \App\Models\Girl::where('is_active', true)->whereNotNull('height')->where('height', '!=', '')->pluck('height')->unique()->sort()->values(),
            'dress_size' => \App\Models\Girl::where('is_active', true)->whereNotNull('dress_size')->where('dress_size', '!=', '')->pluck('dress_size')->unique()->sort()->values(),
            'bust_size' => \App\Models\Girl::where('is_active', true)->whereNotNull('bust_size')->where('bust_size', '!=', '')->pluck('bust_size')->unique()->sort()->values(),
        ];

        return view('girls.index', compact('girls', 'filterData'));
    }

    public function show(\App\Models\Girl $girl)
    {
        if (!$girl->is_active) {
            abort(404);
        }
        return view('girls.show', compact('girl'));
    }

    public function week()
    {
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        $weekSchedule = [];

        foreach ($daysOfWeek as $day) {
            $weekSchedule[$day] = \App\Models\Girl::where('is_active', true)
                ->whereJsonContains('availability', $day)
                ->get();
        }

        return view('girls.week', compact('weekSchedule', 'daysOfWeek'));
    }
}
