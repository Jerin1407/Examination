<?php

namespace App\Http\Controllers;

use App\Models\AccountTypeModel;
use App\Models\AppointmentRequestModel;
use App\Models\SavsoftCategoryModel;
use App\Models\SavsoftGroupModel;
use App\Models\SavsoftPaymentModel;
use App\Models\SavsoftQbankModel;
use App\Models\SavsoftQuizModel;
use App\Models\SavsoftUsersModel;
use App\Models\StudyMaterialModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

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
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $groups = SavsoftGroupModel::all();
        $accountTypes = AccountTypeModel::all();

        return view('users.add', compact('groups', 'accountTypes'));
    }

    public function saveUser(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $validated = $request->validate([
            'email'                 => 'required|email|max:255|unique:savsoft_users,email',
            'password'              => 'required|string|min:6',
            'first_name'            => 'nullable|string|max:255',
            'last_name'             => 'nullable|string|max:255',
            'contact_no'            => 'nullable|string|max:20',
            'gid'                   => 'nullable|integer',
            'subscription_expired'  => 'nullable|date',
            'su'                    => 'nullable|integer',
        ]);

        SavsoftUsersModel::create([
            'email'                => $validated['email'],
            'password'             => bcrypt($validated['password']),
            'first_name'           => $validated['first_name'] ?? '',
            'last_name'            => $validated['last_name'] ?? '',
            'contact_no'           => $validated['contact_no'] ?? '',
            'gid'                  => $validated['gid'] ?? null,
            'subscription_expired' => !empty($validated['subscription_expired'])
                ? \Carbon\Carbon::parse($validated['subscription_expired'])->timestamp
                : null,
            'su'                   => $validated['su'] ?? null,
            'user_status'          => 'Active',
            'inserted_by'          => session('uid'),
            'registered_date'      => now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('listUser')->with('success_add', 'User created successfully.');
    }

    public function listUser(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

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

    public function viewUser(Request $request, $id)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $user = SavsoftUsersModel::findOrFail($id);
        $group = SavsoftGroupModel::find($user->gid);
        $accountType = AccountTypeModel::find($user->su);

        $payments = SavsoftPaymentModel::where('uid', $id)
            ->orderBy('paid_date', 'desc')
            ->get();

        return view('users.view', compact('user', 'group', 'accountType', 'payments'));

        return view('users.view');
    }

    public function editUser(Request $request, $id)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

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
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

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
        $user->subscription_expired = !empty($validated['subscription_expired'])
            ? \Carbon\Carbon::parse($validated['subscription_expired'])->timestamp
            : null;
        $user->su                   = $validated['su'] ?? null;
        $user->user_status          = $validated['user_status'];
        $user->inserted_by          = session('uid');

        // Only update the password if a new one was actually entered
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('listUser', $id)->with('success_update', 'User updated successfully.');
    }

    public function deleteUser(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        // Logic to delete a user
    }

    public function showAppointment(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $uid = session('uid');

        $appointments = AppointmentRequestModel::query()
            ->where('request_by', $uid)
            ->orWhere('to_id', $uid)
            ->leftJoin('savsoft_users as requester', 'requester.uid', '=', 'appointment_request.request_by')
            ->leftJoin('savsoft_users as recipient', 'recipient.uid', '=', 'appointment_request.to_id')
            ->select(
                'appointment_request.*',
                'requester.first_name as requester_first_name',
                'requester.last_name as requester_last_name',
                'requester.skype_id as requester_skype',
                'recipient.first_name as recipient_first_name',
                'recipient.last_name as recipient_last_name',
                'recipient.skype_id as recipient_skype'
            )
            ->orderBy('appointment_request.appointment_id', 'desc')
            ->paginate(15);

        return view('users.appoinment', compact('appointments'));
    }

    public function listExam(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

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
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $groups = SavsoftGroupModel::all();
        $users = SavsoftUsersModel::all();

        return view('exam.add', compact('groups', 'users'));
    }

    public function saveExam(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login before adding a exam.');
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
            'description'        => strip_tags($validated['description']) ?? '',
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

        return redirect()->route('listExam')->with('success_add', 'Exam created successfully.');
    }

    public function editExam(Request $request, $id)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $quiz = SavsoftQuizModel::findOrFail($id);
        $groups = SavsoftGroupModel::all();
        $users = SavsoftUsersModel::all();

        $selectedGroupIds = $quiz->gids ? explode(',', $quiz->gids) : [];
        $selectedUserIds  = $quiz->uids ? explode(',', $quiz->uids) : [];

        return view('exam.edit', compact('groups', 'users', 'quiz', 'selectedGroupIds', 'selectedUserIds'));
    }

    public function updateExam(Request $request, $id)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $quiz = SavsoftQuizModel::findOrFail($id);

        $validated = $request->validate([
            'quiz_name'         => 'required|string|max:255',
            'description'       => 'nullable|string',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after:start_date',
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
            'description'      => strip_tags($validated['description']) ?? '',
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

        return redirect()->route('listExam', $id)->with('success_update', 'Exam updated successfully.');
    }

    public function deleteExam(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }
    }

    public function listMark(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('valuation.list');
    }

    public function addStudyMaterial(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $groups = SavsoftGroupModel::all();
        $categories = SavsoftCategoryModel::all();

        return view('study_material.add', [
            'groups' => $groups,
            'categories' => $categories
        ]);
    }

    public function saveStudyMaterial(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $request->validate([
            'title'             => 'required|string|max:255',
            'study_description' => 'nullable|string',
            'cid'               => 'required|integer',
            'gid'               => 'nullable|array',
            'gid.*'             => 'integer',
            'userfile'          => 'required|file|max:10240', // 10MB, adjust as needed
        ]);

        $path = $request->file('userfile')->store('study_materials', 'public');

        StudyMaterialModel::create([
            'title'             => $request->input('title'),
            'study_description' => $request->input('study_description'),
            'gids'              => json_encode($request->input('gid', [])),
            'cid'               => $request->input('cid'),
            'created_date'      => now(),
            'created_by'        => session('uid'),
            'attachment'        => $path,
        ]);

        return redirect()->route('listStudyMaterial')->with('success_add', 'Study material added successfully.');
    }

    public function listStudyMaterial(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $search = $request->input('search');

        $query = StudyMaterialModel::leftJoin('savsoft_category', 'study_material.cid', '=', 'savsoft_category.cid')
            ->select('study_material.*', 'savsoft_category.category_name');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('study_material.title', 'like', '%' . $search . '%')
                    ->orWhere('study_material.study_description', 'like', '%' . $search . '%')
                    ->orWhere('savsoft_category.category_name', 'like', '%' . $search . '%');
            });
        }

        $studyMaterials = $query->orderBy('study_material.stid', 'desc')->paginate(10)->withQueryString();

        return view('study_material.list', [
            'studyMaterials' => $studyMaterials,
            'search'         => $search,
        ]);
    }

    public function editStudyMaterial(Request $request, $stid)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $studyMaterial = StudyMaterialModel::findOrFail($stid);
        $groups = SavsoftGroupModel::all();
        $categories = SavsoftCategoryModel::all();

        $rawGids = $studyMaterial->gids;
        $selectedGids = [];

        if (!empty($rawGids)) {
            $decoded = json_decode($rawGids, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $selectedGids = $decoded;
            } else {
                // fallback: stored as comma-separated string, e.g. "3,7,12"
                $selectedGids = array_filter(explode(',', $rawGids));
            }
        }

        // normalize to int so in_array comparisons are consistent
        $selectedGids = array_map('intval', $selectedGids);

        return view('study_material.edit', [
            'studyMaterial' => $studyMaterial,
            'groups' => $groups,
            'categories' => $categories,
            'selectedGids' => $selectedGids,
        ]);
    }

    public function updateStudyMaterial(Request $request, $id)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $request->validate([
            'title'             => 'required|string|max:255',
            'study_description' => 'nullable|string',
            'cid'               => 'required|integer',
            'gid'               => 'nullable|array',
            'gid.*'             => 'integer',
            'userfile'          => 'nullable|file|max:10240', // 10MB, adjust as needed
        ]);

        $studyMaterial = StudyMaterialModel::findOrFail($id);

        $studyMaterial->title             = $request->input('title');
        $studyMaterial->study_description = $request->input('study_description');
        $studyMaterial->cid               = $request->input('cid');
        $studyMaterial->gids              = json_encode($request->input('gid', []));

        // if ($request->hasFile('userfile')) {
        //     // delete old file if present
        //     if ($studyMaterial->attachment && \Storage::disk('public')->exists($studyMaterial->attachment)) {
        //         \Storage::disk('public')->delete($studyMaterial->attachment);
        //     }

        $path = $request->file('userfile')->store('study_materials', 'public');
        $studyMaterial->attachment = $path;
        // }

        $studyMaterial->save();

        return redirect()->route('listStudyMaterial')
            ->with('success_update', 'Study material updated successfully.');
    }

    public function viewStudyMaterial(Request $request, $stid)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $studyMaterial = StudyMaterialModel::findOrFail($stid);

        $category = SavsoftCategoryModel::find($studyMaterial->cid);

        $rawGids = $studyMaterial->gids;
        $selectedGids = [];

        if (!empty($rawGids)) {
            $decoded = json_decode($rawGids, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $selectedGids = $decoded;
            } else {
                $selectedGids = array_filter(explode(',', $rawGids));
            }
        }

        $selectedGids = array_map('intval', $selectedGids);

        $groupNames = SavsoftGroupModel::whereIn('gid', $selectedGids)->pluck('group_name');

        return view('study_material.view', [
            'studyMaterial' => $studyMaterial,
            'category'      => $category,
            'groupNames'    => $groupNames,
        ]);
    }

    public function editSetting(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('setting.edit');
    }

    public function listNotification(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('notification.list');
    }

    public function addNotification(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('notification.add');
    }

    public function listUserGroup(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('user_group.list');
    }

    public function addUserGroup(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('user_group.add');
    }

    public function editUserGroup(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('user_group.edit');
    }

    public function listCategory(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('category.list');
    }

    public function listLevel(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('level.list');
    }

    public function listAccountType(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('account_type.list');
    }

    public function editAccountType(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('account_type.edit');
    }

    public function listCustomFields(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('custom_fields.list');
    }

    public function addCustomFields(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('custom_fields.add');
    }
}
