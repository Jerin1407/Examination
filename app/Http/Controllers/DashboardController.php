<?php

namespace App\Http\Controllers;

use App\Models\SavsoftQuizModel;
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
        return view('exam.add');
    }

    public function listExam(Request $request)
    {
        $query = SavsoftQuizModel::query();

        if ($request->filled('search')) {
            $query->where('quiz_name', 'like', '%' . $request->search . '%');
        }

        $exams = $query->orderBy('quid', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Counts for the summary cards
        $activeCount = SavsoftQuizModel::whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->count();

        $upcomingCount = SavsoftQuizModel::whereDate('start_date', '>', now())
            ->count();

        $archivedCount = SavsoftQuizModel::whereDate('end_date', '<', now())
            ->count();

        return view('exam.list', compact('exams', 'activeCount', 'upcomingCount', 'archivedCount'));
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
