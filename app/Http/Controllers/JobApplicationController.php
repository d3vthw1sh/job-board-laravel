<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobApplicationController extends Controller
{
    public function create(Job $job)
    {
        Gate::authorize('apply', $job);
        return view('job_application.create', ['job' => $job]);
    }

    public function store(Job $job, Request $request)
    {
        Gate::authorize('apply', $job);

        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

        // Store file in storage/app/public/cvs
        $file = $request->file('cv');
        $path = $file->store('cvs', 'public'); // saves to storage/app/public/cvs

        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path
        ]);

        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job application submitted.');
    }

    // Download CV
    public function downloadCV(JobApplication $application)
    {
        // Optional: Only allow employer to download (add logic if needed)
        // if (auth()->id() !== $application->job->employer_id) {
        //     abort(403, 'Unauthorized');
        // }

        $path = storage_path('app/public/' . $application->cv_path);

        if (!file_exists($path)) {
            abort(404, 'CV file not found.');
        }

        return response()->download($path);
    }

    // Approve an applicant for interview
    public function approveForInterview($id)
    {
        // Only allow admin to approve (change this logic as needed)
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $application = JobApplication::findOrFail($id);
        $application->approved_for_interview = true;
        $application->save();

        return back()->with('success', 'Applicant approved for interview.');
    }

    public function destroy(string $id)
    {
        //
    }
}
