<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavsoftCategoryModel;
use App\Models\SavsoftLevelModel;
use App\Models\SavsoftOptionsModel;
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

        $categories = SavsoftCategoryModel::all();
        $levels = SavsoftLevelModel::all();

        switch ($questionType) {
            case 'Multiple Choice Single Answer':
                return view('question_bank.new_question_1', [
                    'nop'           => $nop,
                    'withParagraph' => $withParagraph,
                    'categories'    => $categories,
                    'levels'        => $levels
                ]);

            case 'Multiple Choice Multiple Answer':
                return view('question_bank.new_question_2', [
                    'nop'           => $nop,
                    'withParagraph' => $withParagraph,
                    'categories'    => $categories,
                    'levels'        => $levels
                ]);

            case 'Match the Column':
                return view('question_bank.new_question_3', [
                    'nop'           => $nop,
                    'withParagraph' => $withParagraph,
                    'categories'    => $categories,
                    'levels'        => $levels
                ]);

            case 'Short Answer':
                return view('question_bank.new_question_4', [
                    'withParagraph' => $withParagraph,
                    'categories'    => $categories,
                    'levels'        => $levels
                ]);

            case 'Long Answer':
                return view('question_bank.new_question_5', [
                    'withParagraph' => $withParagraph,
                    'categories'    => $categories,
                    'levels'        => $levels
                ]);

            default:
                return back()->withErrors(['question_type' => 'Please select a valid question type.']);
        }
    }

    public function saveNewQuestion1(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $request->validate([
            'cid'      => 'required|integer|min:1',
            'lid'      => 'required|integer|min:1',
            'question' => 'required|string',
            'score'    => 'required|integer|min:1',
            'nop'      => 'required|integer|min:2',
        ]);

        // Create the question
        $qbank = SavsoftQbankModel::create([
            'question_type'   => 'Multiple Choice Single Answer',
            'question'        => $request->input('question'),
            'description'     => $request->input('description'),
            'cid'             => $request->input('cid'),
            'lid'             => $request->input('lid'),
            'paragraph'       => $request->input('paragraph'),
            'inserted_by'     => session('uid'),
            'inserted_by_name' => session('first_name') . ' ' . session('last_name'),
            'is_upload'       => 0,
            'parent_id'        => 0,
        ]);

        // Create each option row
        $nop         = (int) $request->input('nop');
        $correctOpt  = (int) $request->input('score');

        for ($i = 1; $i <= $nop; $i++) {
            SavsoftOptionsModel::create([
                'qid'      => $qbank->qid,
                'q_option' => $request->input('option' . $i),
                'q_option1' => '',
                'q_option_match1' => '',
                'score'    => ($i === $correctOpt) ? 1 : 0,
            ]);
        }

        // "Submit & Add new with same paragraph" — redisplay the form, same cid/lid/paragraph
        if ($request->input('parag') === '1') {
            return view('question_bank.new_question_1', [
                'nop'           => $nop,
                'withParagraph' => true,
                'categories'    => SavsoftCategoryModel::all(),
                'levels'        => SavsoftLevelModel::all(),
                'selectedCid'   => $request->input('cid'),
                'selectedLid'   => $request->input('lid'),
                'paragraphVal'  => $request->input('paragraph'),
            ])->with('success', 'Question added. Add another with the same paragraph.');
        }

        return redirect()->route('listQuestion')->with('success_add', 'Question added successfully.');
    }

    public function saveNewQuestion2(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.new_question_2');
    }

    public function saveNewQuestion3(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.new_question_3');
    }

    public function saveNewQuestion4(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.new_question_4');
    }

    public function saveNewQuestion5(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return view('question_bank.new_question_5');
    }
}
