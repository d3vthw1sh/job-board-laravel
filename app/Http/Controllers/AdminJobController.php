<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    public function index()
    {
        // Manual admin check
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect('/');
        }

        $jobs = Job::with('employer')->latest()->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function destroy($id)
    {
        // Manual admin check
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect('/');
        }

        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
    }
}
