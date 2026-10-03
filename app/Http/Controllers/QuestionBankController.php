<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavsoftCategoryModel;
use App\Models\SavsoftLevelModel;
use App\Models\SavsoftOptionsModel;
use App\Models\SavsoftQbankModel;
use Illuminate\Support\Facades\DB;

class QuestionBankController extends Controller
{
    public function listQuestion(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $categories = SavsoftCategoryModel::where('is_active', 1)->get();
        $levels = SavsoftLevelModel::where('is_active', 1)->get();

        $search = $request->input('search');
        $cid = $request->input('cid');
        $lid = $request->input('lid');

        $questions = SavsoftQbankModel::query()
            ->where('savsoft_qbank.is_active', 1)
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

    public function editQuestion1(Request $request, $qid)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $question = SavsoftQbankModel::where('qid', $qid)
            ->where('is_active', 1)
            ->firstOrFail();

        if ($question->question_type !== 'Multiple Choice Single Answer') {
            return redirect()->route('listQuestion');
        }

        $options    = SavsoftOptionsModel::where('qid', $qid)->orderBy('oid')->get();
        $categories = SavsoftCategoryModel::where('is_active', 1)->get();
        $levels     = SavsoftLevelModel::where('is_active', 1)->get();

        return view('question_bank.edit_question_1', compact('question', 'options', 'categories', 'levels'));
    }

    public function editQuestion2(Request $request, $qid)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $question = SavsoftQbankModel::where('qid', $qid)
            ->where('is_active', 1)
            ->firstOrFail();

        if ($question->question_type !== 'Multiple Choice Multiple Answer') {
            return redirect()->route('listQuestion');
        }

        $options    = SavsoftOptionsModel::where('qid', $qid)->orderBy('oid')->get();
        $categories = SavsoftCategoryModel::where('is_active', 1)->get();
        $levels     = SavsoftLevelModel::where('is_active', 1)->get();

        return view('question_bank.edit_question_2', compact('question', 'options', 'categories', 'levels'));
    }

    public function editQuestion3(Request $request, $qid)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $question = SavsoftQbankModel::where('qid', $qid)
            ->where('is_active', 1)
            ->firstOrFail();

        if ($question->question_type !== 'Match the Column') {
            return redirect()->route('listQuestion');
        }

        $options    = SavsoftOptionsModel::where('qid', $qid)->orderBy('oid')->get();
        $categories = SavsoftCategoryModel::where('is_active', 1)->get();
        $levels     = SavsoftLevelModel::where('is_active', 1)->get();

        return view('question_bank.edit_question_3', compact('question', 'options', 'categories', 'levels'));
    }

    public function editQuestion4(Request $request, $qid)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $question = SavsoftQbankModel::where('qid', $qid)
            ->where('is_active', 1)
            ->firstOrFail();

        if ($question->question_type !== 'Short Answer') {
            return redirect()->route('listQuestion');
        }

        $option     = SavsoftOptionsModel::where('qid', $qid)->orderBy('oid')->first();
        $categories = SavsoftCategoryModel::where('is_active', 1)->get();
        $levels     = SavsoftLevelModel::where('is_active', 1)->get();

        return view('question_bank.edit_question_4', compact('question', 'option', 'categories', 'levels'));
    }

    public function editQuestion5(Request $request, $qid)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $question = SavsoftQbankModel::where('qid', $qid)
            ->where('is_active', 1)
            ->firstOrFail();

        if ($question->question_type !== 'Long Answer') {
            return redirect()->route('listQuestion');
        }

        $categories = SavsoftCategoryModel::where('is_active', 1)->get();
        $levels     = SavsoftLevelModel::where('is_active', 1)->get();

        return view('question_bank.edit_question_5', compact('question', 'categories', 'levels'));
    }

    public function updateQuestion1(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return redirect()->route('listQuestion')->with('success_update', 'Question updated successfully.');
    }

    public function updateQuestion2(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return redirect()->route('listQuestion')->with('success_update', 'Question updated successfully.');
    }

    public function updateQuestion3(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return redirect()->route('listQuestion')->with('success_update', 'Question updated successfully.');
    }

    public function updateQuestion4(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return redirect()->route('listQuestion')->with('success_update', 'Question updated successfully.');
    }

    public function updateQuestion5(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        return redirect()->route('listQuestion')->with('success_update', 'Question updated successfully.');
    }

    public function deleteQuestion(Request $request, $id)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $question = SavsoftQbankModel::find($id);

        // Updating is_active to 0
        $question->is_active = 0;
        $question->save();

        return redirect()->back()->with('success_delete', 'Question deleted successfully.');
    }

    public function nextQuestionType(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $questionType  = $request->input('question_type');
        $nop           = (int) $request->input('nop', 4);
        $withParagraph = $request->has('with_paragraph');

        $categories = SavsoftCategoryModel::where('is_active', 1)->get();
        $levels = SavsoftLevelModel::where('is_active', 1)->get();

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
        if ($request->input('parag') == '1') {
            return view('question_bank.new_question_1', [
                'nop'           => $nop,
                'withParagraph' => true,
                'categories'    => SavsoftCategoryModel::all(),
                'levels'        => SavsoftLevelModel::all(),
                'selectedCid'   => $request->input('cid'),
                'selectedLid'   => $request->input('lid'),
                'paragraphVal'  => $request->input('paragraph'),
                'success'       => 'Question added. Add another with the same paragraph.',
            ]);
        }

        return redirect()->route('listQuestion')->with('success_add', 'Question added successfully.');
    }

    public function saveNewQuestion2(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $request->validate([
            'cid'      => 'required|integer|min:1',
            'lid'      => 'required|integer|min:1',
            'question' => 'required|string',
            'score'    => 'required|array|min:1',
            'score.*'  => 'integer|min:1',
            'nop'      => 'required|integer|min:2',
        ]);

        $nop        = (int) $request->input('nop');
        $correctOpt = array_map('intval', $request->input('score', []));

        DB::transaction(function () use ($request, $nop, $correctOpt) {

            $qbank = SavsoftQbankModel::create([
                'question_type'    => 'Multiple Choice Multiple Answer',
                'question'         => $request->input('question'),
                'description'      => $request->input('description'),
                'cid'              => $request->input('cid'),
                'lid'              => $request->input('lid'),
                'paragraph'        => $request->input('paragraph'),
                'inserted_by'      => session('uid'),
                'inserted_by_name' => session('first_name') . ' ' . session('last_name'),
                'is_upload'        => 0,
                'parent_id'        => 0,
            ]);

            // Each correct option gets an equal share of 1 point (Savsoft behaviour)
            $perOption = 1 / count($correctOpt);

            for ($i = 1; $i <= $nop; $i++) {
                SavsoftOptionsModel::create([
                    'qid'             => $qbank->qid,
                    'q_option'        => $request->input('option' . $i) ?? '',
                    'q_option1'       => '',
                    'q_option_match'  => '',
                    'q_option_match1' => '',
                    'score'           => in_array($i, $correctOpt, true) ? $perOption : 0,
                ]);
            }
        });

        return redirect()->route('listQuestion')->with('success_add', 'Question added successfully.');
    }

    public function saveNewQuestion3(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $request->validate([
            'cid'        => 'required|integer|min:1',
            'lid'        => 'required|integer|min:1',
            'question'   => 'required|string',
            'option'     => 'required|array|min:2',
            'option.*'   => 'required|string',
            'option2'    => 'required|array|min:2',
            'option2.*'  => 'required|string',
        ], [
            'option.*.required'  => 'Please fill in every left column option.',
            'option2.*.required' => 'Please fill in every right column option.',
        ]);

        $left  = array_values($request->input('option', []));
        $right = array_values($request->input('option2', []));
        $count = count($left);

        DB::transaction(function () use ($request, $left, $right, $count) {

            $qbank = SavsoftQbankModel::create([
                'question_type'    => 'Match the Column',
                'question'         => $request->input('question'),
                'description'      => $request->input('description'),
                'cid'              => $request->input('cid'),
                'lid'              => $request->input('lid'),
                'paragraph'        => $request->input('paragraph'),
                'inserted_by'      => session('uid'),
                'inserted_by_name' => session('first_name') . ' ' . session('last_name'),
                'is_upload'        => 0,
                'parent_id'        => 0,
            ]);

            // Each pair carries an equal share of 1 point (Savsoft behaviour)
            $perPair = 1 / $count;

            foreach ($left as $i => $leftValue) {
                SavsoftOptionsModel::create([
                    'qid'             => $qbank->qid,
                    'q_option'        => $leftValue,
                    'q_option_match'  => $right[$i] ?? '',
                    'q_option1'       => '',
                    'q_option_match1' => '',
                    'score'           => $perPair,
                ]);
            }
        });

        return redirect()->route('listQuestion')->with('success_add', 'Question added successfully.');
    }

    public function saveNewQuestion4(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $request->validate([
            'cid'      => 'required|integer|min:1',
            'lid'      => 'required|integer|min:1',
            'question' => 'required|string',
            'option'   => 'required|array|min:1',
            'option.0' => 'required|string',
        ], [
            'option.0.required' => 'Please enter the answer.',
        ]);

        DB::transaction(function () use ($request) {

            $qbank = SavsoftQbankModel::create([
                'question_type'    => 'Short Answer',
                'question'         => $request->input('question'),
                'description'      => $request->input('description'),
                'cid'              => $request->input('cid'),
                'lid'              => $request->input('lid'),
                'paragraph'        => $request->input('paragraph'),
                'inserted_by'      => session('uid'),
                'inserted_by_name' => session('first_name') . ' ' . session('last_name'),
                'is_upload'        => 0,
                'parent_id'        => 0,
            ]);

            SavsoftOptionsModel::create([
                'qid'             => $qbank->qid,
                'q_option'        => trim($request->input('option.0')),
                'q_option1'       => '',
                'q_option_match'  => '',
                'q_option_match1' => '',
                'score'           => 1,
            ]);
        });

        return redirect()->route('listQuestion')->with('success_add', 'Question added successfully.');
    }

    public function saveNewQuestion5(Request $request)
    {
        if (!session()->has('uid')) {
            return redirect()->route('showLogin')->with('login_first', 'Please login to access the page.');
        }

        $request->validate([
            'cid'      => 'required|integer|min:1',
            'lid'      => 'required|integer|min:1',
            'question' => 'required|string',
        ]);

        SavsoftQbankModel::create([
            'question_type'    => 'Long Answer',
            'question'         => $request->input('question'),
            'description'      => $request->input('description'),
            'cid'              => $request->input('cid'),
            'lid'              => $request->input('lid'),
            'paragraph'        => $request->input('paragraph'),
            'inserted_by'      => session('uid'),
            'inserted_by_name' => session('first_name') . ' ' . session('last_name'),
            'is_upload'        => 0,
            'parent_id'        => 0,
        ]);

        return redirect()->route('listQuestion')->with('success_add', 'Question added successfully.');
    }
}
