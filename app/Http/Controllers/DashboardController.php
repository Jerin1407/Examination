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

    public function saveExam(Request $request) {}

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
}
