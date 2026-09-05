<?php

namespace App\Http\Controllers;

use App\Models\AccountTypeModel;
use App\Models\SavsoftCategoryModel;
use App\Models\SavsoftGroupModel;
use App\Models\SavsoftLevelModel;
use App\Models\SavsoftPaymentModel;
use App\Models\SavsoftQbankModel;
use App\Models\SavsoftQuizModel;
use App\Models\SavsoftUsersModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = SavsoftUsersModel::count();
        $examCount = SavsoftQuizModel::count();
        $questionCount = SavsoftQbankModel::count();
        $activeUserCount = SavsoftUsersModel::where('user_status', 'Active')->count();
        $inactiveUserCount = SavsoftUsersModel::where('user_status', 'Inactive')->count();

        $recentUsers = SavsoftUsersModel::query()
            ->leftJoin('savsoft_group', 'savsoft_group.gid', '=', 'savsoft_users.gid')
            ->select('savsoft_users.*', 'savsoft_group.group_name')
            ->orderBy('savsoft_users.uid', 'desc')
            ->limit(15)
            ->get();

        return view('dashboard', compact('userCount', 'examCount', 'questionCount', 'activeUserCount', 'inactiveUserCount', 'recentUsers'));
    }

    public function addUser(Request $request)
    {

        return view('users.add');
    }

    public function listUser(Request $request)
    {
        $search = $request->input('search');

        $users = SavsoftUsersModel::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('email', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                });
            })
            ->orderBy('uid', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('users.list', compact('users', 'search'));
    }

    public function viewUser(Request $request)
    {
        return view('users.view');
    }

    public function editUser(Request $request, $id)
    {
        $user = SavsoftUsersModel::findOrFail($id);
        $groups = SavsoftGroupModel::all();
        $accountTypes = AccountTypeModel::all();
        $payments = SavsoftPaymentModel::where('uid', $id)
            ->orderBy('paid_date', 'desc')
            ->get();

        return view('users.edit', compact('user', 'groups', 'accountTypes', 'payments'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = SavsoftUsersModel::findOrFail($id);

        $validated = $request->validate([
            'email'                 => 'required|email|max:255',
            'password'              => 'nullable|string|min:6',
            'first_name'            => 'nullable|string|max:255',
            'last_name'             => 'nullable|string|max:255',
            'contact_no'            => 'nullable|string|max:20',
            'skype_id'              => 'nullable|string|max:255',
            'gid'                   => 'nullable|integer',
            'subscription_expired'  => 'nullable|date',
            'su'                    => 'nullable|integer',
            'user_status'           => 'required|in:Active,Inactive',
        ]);

        $user->email                = $validated['email'];
        $user->first_name           = $validated['first_name'] ?? '';
        $user->last_name            = $validated['last_name'] ?? '';
        $user->contact_no           = $validated['contact_no'] ?? '';
        $user->skype_id             = $validated['skype_id'] ?? '';
        $user->gid                  = $validated['gid'] ?? null;
        $user->subscription_expired = $validated['subscription_expired'] ?? null;
        $user->su                   = $validated['su'] ?? null;
        $user->user_status          = $validated['user_status'];

        // Only update the password if a new one was actually entered
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('listUser', $id)->with('success', 'User updated successfully.');
    }

    public function deleteUser(Request $request)
    {
        // Logic to delete a user
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
        $categories = SavsoftCategoryModel::all();
        $levels = SavsoftLevelModel::all();

        $search = $request->input('search');
        $cid = $request->input('cid');
        $lid = $request->input('lid');

        $questions = SavsoftQbankModel::query()
            ->leftJoin('savsoft_category', 'savsoft_category.cid', '=', 'savsoft_qbank.cid')
            ->leftJoin('savsoft_level', 'savsoft_level.lid', '=', 'savsoft_qbank.lid')
            ->select(
                'savsoft_qbank.*',
                'savsoft_category.category_name',
                'savsoft_level.level_name'
            )
            ->when($search, function ($query, $search) {
                $query->where('savsoft_qbank.question', 'like', "%{$search}%");
            })
            ->when($cid, function ($query, $cid) {
                $query->where('savsoft_qbank.cid', $cid);
            })
            ->when($lid, function ($query, $lid) {
                $query->where('savsoft_qbank.lid', $lid);
            })
            ->orderBy('savsoft_qbank.qid', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('question_bank.list', compact('categories', 'levels', 'questions', 'search', 'cid', 'lid'));
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

    public function editExam(Request $request, $id)
    {
        $quiz = SavsoftQuizModel::findOrFail($id);
        $groups = SavsoftGroupModel::all();
        $users = SavsoftUsersModel::all();

        $selectedGroupIds = $quiz->gids ? explode(',', $quiz->gids) : [];
        $selectedUserIds  = $quiz->uids ? explode(',', $quiz->uids) : [];

        return view('exam.edit', compact('groups', 'users', 'quiz', 'selectedGroupIds', 'selectedUserIds'));
    }

    public function updateExam(Request $request, $id)
    {
        $quiz = SavsoftQuizModel::findOrFail($id);

        $validated = $request->validate([
            'quiz_name'         => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
            'duration'          => 'required|integer',
            'maximum_attempts'  => 'required|integer',
            'pass_percentage'   => 'required|numeric',
            'correct_score'     => 'required|numeric',
            'incorrect_score'   => 'required|numeric',
            'ip_address'        => 'nullable|string',
            'view_answer'       => 'required|in:0,1',
            'with_login'        => 'required|in:0,1',
            'show_chart_rank'   => 'required|in:0,1',
            'camera_req'        => 'required|in:0,1',
            'quiz_template'     => 'required|string',
            'quiz_price'        => 'required|numeric',
            'gen_certificate'   => 'required|in:0,1',
            'certificate_text'  => 'nullable|string',
            'gids'              => 'nullable|array',
            'uids'              => 'nullable|array',
        ]);

        $validated['start_date'] = \Carbon\Carbon::parse($validated['start_date'])->timestamp;
        $validated['end_date']   = \Carbon\Carbon::parse($validated['end_date'])->timestamp;

        $quiz->update([
            'quiz_name'        => $validated['quiz_name'],
            'description'      => $validated['description'] ?? '',
            'start_date'       => $validated['start_date'],
            'end_date'         => $validated['end_date'],
            'duration'         => $validated['duration'],
            'maximum_attempts' => $validated['maximum_attempts'],
            'pass_percentage'  => $validated['pass_percentage'],
            'correct_score'    => $validated['correct_score'],
            'incorrect_score'  => $validated['incorrect_score'],
            'ip_address'       => $validated['ip_address'] ?? '',
            'view_answer'      => $validated['view_answer'],
            'with_login'       => $validated['with_login'],
            'show_chart_rank'  => $validated['show_chart_rank'],
            'camera_req'       => $validated['camera_req'],
            'quiz_template'    => $validated['quiz_template'],
            'quiz_price'       => $validated['quiz_price'],
            'gen_certificate'  => $validated['gen_certificate'],
            'certificate_text' => $validated['certificate_text'] ?? '',
            'gids'             => isset($validated['gids']) ? implode(',', $validated['gids']) : null,
            'uids'             => isset($validated['uids']) ? implode(',', $validated['uids']) : null,
        ]);

        return redirect()->route('listExam', $id)->with('success', 'Exam updated successfully.');
    }

    public function deleteExam(Request $request) {}

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

    public function addNotification(Request $request)
    {
        return view('notification.add');
    }

    public function listUserGroup(Request $request)
    {
        return view('user_group.list');
    }

    public function addUserGroup(Request $request)
    {
        return view('user_group.add');
    }

    public function editUserGroup(Request $request)
    {
        return view('user_group.edit');
    }

    public function listCategory(Request $request)
    {
        return view('category.list');
    }

    public function listLevel(Request $request)
    {
        return view('level.list');
    }

    public function listAccountType(Request $request)
    {
        return view('account_type.list');
    }

    public function editAccountType(Request $request)
    {
        return view('account_type.edit');
    }

    public function listCustomFields(Request $request)
    {
        return view('custom_fields.list');
    }

    public function addCustomFields(Request $request)
    {
        return view('custom_fields.add');
    }
}
