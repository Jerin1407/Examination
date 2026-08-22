<?php

namespace App\Http\Controllers;

use App\Models\SavsoftGroupModel;
use App\Models\SavsoftQuizModel;
use App\Models\SavsoftUsersModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function addUser(Request $request)
    {

        return view('users.add');
    }

    public function listUser(Request $request)
    {
        return view('users.list');
    }

    public function showAppointment(Request $request)
    {
        return view('users.appoinment');
    }

    public function addQuestion(Request $request)
    {
        return view('question_bank.add');
    }

    public function listQuestion(Request $request)
    {
        return view('question_bank.list');
    }

    public function addExam(Request $request)
    {
        $groups = SavsoftGroupModel::all();
        $users = SavsoftUsersModel::all();

        return view('exam.add', compact('groups', 'users'));
    }

    public function saveExam(Request $request)
    {
        // Check login session
        if (!session()->has('uid')) {
            return redirect()->route('login')->with('error', 'Please login before adding a exam.');
        }

        $validated = $request->validate([
            'quiz_name'          => 'required|string|max:255',
            'description'        => 'nullable|string',
            'start_date'         => 'required|date',
            'end_date'           => 'required|date|after:start_date',
            'duration'           => 'required|integer|min:1',
            'maximum_attempts'   => 'required|integer|min:1',
            'pass_percentage'    => 'required|numeric|min:0|max:100',
            'correct_score'      => 'required|numeric',
            'incorrect_score'    => 'required|numeric',
            'ip_address'         => 'nullable|string',
            'view_answer'        => 'required|in:0,1',
            'with_login'         => 'required|in:0,1',
            'show_chart_rank'    => 'required|in:0,1',
            'camera_req'         => 'required|in:0,1',
            'gids'               => 'nullable|array',
            'gids.*'             => 'integer',
            'uids'               => 'nullable|array',
            'uids.*'             => 'integer',
            'quiz_template'      => 'required|string',
            'question_selection' => 'required|in:0,1',
            'quiz_price'         => 'required|numeric|min:0',
            'gen_certificate'    => 'required|in:0,1',
            'certificate_text'   => 'nullable|string',
        ]);

        $exam = SavsoftQuizModel::create([
            'quiz_name'          => $validated['quiz_name'],
            'description'        => $validated['description'] ?? '',
            'start_date'         => strtotime($validated['start_date']),
            'end_date'           => strtotime($validated['end_date']),
            'gids'               => !empty($validated['gids']) ? implode(',', $validated['gids']) : '',
            'qids'               => '',
            'noq'                => 0,
            'correct_score'      => $validated['correct_score'],
            'incorrect_score'    => $validated['incorrect_score'],
            'ip_address'         => $validated['ip_address'] ?? '',
            'duration'           => $validated['duration'],
            'maximum_attempts'   => $validated['maximum_attempts'],
            'pass_percentage'    => $validated['pass_percentage'],
            'view_answer'        => $validated['view_answer'],
            'camera_req'         => $validated['camera_req'],
            'question_selection' => $validated['question_selection'],
            'gen_certificate'    => $validated['gen_certificate'],
            'certificate_text'   => $validated['certificate_text'] ?? '',
            'with_login'         => $validated['with_login'],
            'quiz_template'      => $validated['quiz_template'],
            'uids'               => !empty($validated['uids']) ? implode(',', $validated['uids']) : '',
            'inserted_by'        => session('uid'),
            'inserted_by_name'   => session('first_name') . ' ' . session('last_name'),
            'show_chart_rank'    => $validated['show_chart_rank'],
            'quiz_price'         => $validated['quiz_price'],
        ]);

        return redirect()->route('listExam')->with('success', 'Exam created successfully.');
    }

    public function listExam(Request $request)
    {
        $query = SavsoftQuizModel::query();

        if ($request->filled('search')) {
            $query->where('quiz_name', 'like', '%' . $request->search . '%');
        }

        $status = $request->get('status');
        $now = now()->timestamp;

        if ($status === 'active') {
            $query->where('start_date', '<=', $now)
                ->where('end_date', '>=', $now);
        } elseif ($status === 'upcoming') {
            $query->where('start_date', '>', $now);
        } elseif ($status === 'archived') {
            $query->where('end_date', '<', $now);
        }

        $exams = $query->orderBy('quid', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Counts for the summary cards
        $activeCount = SavsoftQuizModel::where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->count();

        $upcomingCount = SavsoftQuizModel::where('start_date', '>', $now)
            ->count();

        $archivedCount = SavsoftQuizModel::where('end_date', '<', $now)
            ->count();

        return view('exam.list', compact('exams', 'activeCount', 'upcomingCount', 'archivedCount', 'status'));
    }

    public function listMark(Request $request)
    {
        return view('valuation.list');
    }

    public function addStudyMaterial(Request $request)
    {
        return view('study_material.add');
    }

    public function listStudyMaterial(Request $request)
    {
        return view('study_material.list');
    }

    public function editStudyMaterial(Request $request)
    {
        return view('study_material.edit');
    }

    public function viewStudyMaterial(Request $request)
    {
        return view('study_material.view');
    }

    public function editSetting(Request $request)
    {
        return view('setting.edit');
    }

    public function listNotification(Request $request)
    {
        return view('notification.list');
    }
}
