<?php
namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    // Show paginated list of jobs for admin
    public function index()
    {
        $jobs = Job::paginate(15);
        return view('admin.jobs.index', compact('jobs'));
    }

    // Delete a job by admin
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
    }
}
