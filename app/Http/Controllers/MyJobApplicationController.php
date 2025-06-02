<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class MyJobApplicationController extends Controller
{
    /**
     * Display a listing of the user's job applications.
     *
     * @return View
     */
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $applications = $user->jobApplications()
            ->with([
                'job' => fn($query) => $query->withCount('jobApplications')
                    ->withAvg('jobApplications', 'expected_salary')
                    ->withTrashed(),
                'job.employer'
            ])
            ->latest()->get();

        return view('my_job_application.index', [
            'applications' => $applications
        ]);
    }

    /**
     * Remove the specified job application from storage.
     *
     * @param  \App\Models\JobApplication  $myJobApplication
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(JobApplication $myJobApplication)
    {
        $myJobApplication->delete();

        return redirect()->back()->with(
            'success',
            'Job application removed.'
        );
    }
}
