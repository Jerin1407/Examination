<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavsoftCategoryModel;
use App\Models\SavsoftLevelModel;
use App\Models\SavsoftQbankModel;

class QuestionBankController extends Controller
{
    public function listQuestion(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

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

    public function addQuestion(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.add');
    }

    public function saveQuestion(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return redirect()->route('listQuestion')->with('success_add', 'Question added successfully.');
    }

    public function editQuestion1(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.edit_question_1');
    }

    public function editQuestion2(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.edit_question_2');
    }

    public function editQuestion3(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.edit_question_3');
    }

    public function editQuestion4(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.edit_question_4');
    }

    public function editQuestion5(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.edit_question_5');
    }

    public function updateQuestion(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return redirect()->route('listQuestion')->with('success_update', 'Question updated successfully.');
    }

    public function deleteQuestion(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }
    }

    public function nextQuestionType(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $questionType  = $request->input('question_type');
        $nop           = (int) $request->input('nop', 4);
        $withParagraph = $request->has('with_paragraph');

        switch ($questionType) {
            case '1': // Multiple Choice Single Answer
                return view('question_bank.new_question_1', [
                    'nop'           => $nop,
                    'withParagraph' => $withParagraph,
                ]);

            case '2': // Multiple Choice Multiple Answer
                return view('question_bank.new_question_2', [
                    'nop'           => $nop,
                    'withParagraph' => $withParagraph,
                ]);

            case '3': // Match the Column
                return view('question_bank.new_question_3', [
                    'nop'           => $nop,
                    'withParagraph' => $withParagraph,
                ]);

            case '4': // Short Answer
                return view('question_bank.new_question_4', [
                    'withParagraph' => $withParagraph,
                ]);

            case '5': // Long Answer
                return view('question_bank.new_question_5', [
                    'withParagraph' => $withParagraph,
                ]);

            default:
                return back()->withErrors(['question_type' => 'Please select a valid question type.']);
        }
    }

    public function newQuestion1(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.new_question_1');
    }

    public function newQuestion2(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.new_question_2');
    }

    public function newQuestion3(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.new_question_3');
    }

    public function newQuestion4(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.new_question_4');
    }

    public function newQuestion5(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.new_question_5');
    }
}
