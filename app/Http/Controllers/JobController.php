<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyJobData;
use App\Http\Requests\StoreJobData;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class JobController extends Controller
{

    /**
     * Search a job.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected function generateJobId($numChars)
    {
        $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //Return the job id.
        return  'FJB-' . mt_rand(100000, 999999) . '-' . substr(str_shuffle($string), 0, $numChars);
    }

    /**
     * Display a list of  jobs.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function showJobs()
    {
        return  Job::all();
    }
    public function allApplications($job_id)
    {
        return  Application::where('job_id', $job_id)->paginate(20);
    }

    public function allJobs(Request $request)
    {
        try {
            $search = $request->query('q');
            if (is_null($search)) {
                return  Job::all();
            }
            return Job::where("title", "LIKE", "%$search%")->latest()->get();;
        } catch (\Throwable $th) {
            throw $th;
        }
    }




    public function searchJob(Request $request)
    {
        if (is_null($request->query('q'))) {
            return 'empty';
        }
        return 'full';
    }

    /**
     * Apply a  job.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function applyJob(ApplyJobData $request, $job_id)
    {

        try {
            $validated = $request->validated();

            $checkJob = Job::find($job_id);
            $Applied = Application::where('email', $request->email)->where('job_id', $job_id)->first();
            if (!is_null($checkJob)) {
                if (is_null($Applied)) {
                    $job = Application::create([
                        'job_id' => $job_id,
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'location' => $request->location,
                        'cv' => $request->cv,

                    ]);

                    return response()->json([
                        'status' => "Success",
                        'message' => "Application Successfully Submitted!",
                        'data' => $job
                    ]);
                }
                return response()->json([
                    'status' => "Failed",
                    'message' => "Already Applied For Job!",

                ]);
            }
            return response()->json([
                'status' => "Failed",
                'message' => "Job Not Found!",

            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    /**
     * Store a newly created job in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeJob(StoreJobData $request)
    {
        try {
            $validated = $request->validated();


            $id = $this->generateJobId(2);
            $checkId = Job::find($id);
            while (!is_null($checkId)) {
                $id = $this->generateJobId(2);
                $checkId = Job::find($id);
            }


            $job = Job::create([
                'id' => $id,
                'title' => $request->title,
                'description' => $request->description,
                'company' => $request->company,
                'company_logo' => $request->company_logo,
                'category' => $request->category,
                'benefits' => $request->benefits,
                'location' => $request->location,
                'work_condition' => $request->work_condition,
                'salary' => $request->salary,
                'type' => $request->type,
            ]);

            return response()->json([
                'status' => "success",
                'message' => "Job Successfully Created!",
                'data' => $job
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified job.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function showJob(Request $request, $job_id)
    {
        try {

            return Job::find($job_id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }




    /**
     * Update the specified job in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function updateJob(Request $request, $job_id)
    {

        try {
            $job = Job::find($job_id);
            $job->title = $request->title;
            $job->description = $request->description;
            $job->company = $request->company;
            $job->company_logo = $request->company_logo;
            $job->category = $request->category;
            $job->benefits = $request->benefits;
            $job->location = $request->location;
            $job->work_condition = $request->work_condition;
            $job->salary = $request->salary;
            $job->type = $request->type;
            $job->save();

            return response()->json([
                'status' => "success",
                'message' => "Job Successfully Updated!",
                'data' => $job
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified job from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroyJob($job_id)
    {
        try {
            $job = Job::find($job_id);
            $job->delete();

            return response()->json([
                'status' => "success",
                'message' => "Job Successfully Deleted!",
            ]);
        } catch (\Throwable $th) {
            //  throw $th;
            return response()->json([
                'status' => "success",
                'message' => "Job Already Deleted!",
            ]);
        }
    }
}
