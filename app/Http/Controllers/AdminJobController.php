<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class AdminJobController extends Controller
{
    public function index(Request $request)
    {
        // Manual admin check
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/');
        }

        $query = Job::with('employer')->latest();

        // Filter by job title if search query is present
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $jobs = $query->paginate(10)->withQueryString();

        return view('admin.jobs.index', compact('jobs'));
    }

    public function destroy($id)
    {
        // Manual admin check
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/');
        }

        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
    }
}
