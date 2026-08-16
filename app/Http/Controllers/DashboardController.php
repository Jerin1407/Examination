<?php

namespace App\Http\Controllers;

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
}
