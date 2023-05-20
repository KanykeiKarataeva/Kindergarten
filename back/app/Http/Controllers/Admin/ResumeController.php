<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResumeController extends Controller
{
    public function index(){
        $resumes = Resume::all();
        $answers = Answer::all();
        return view('admin.resume.index', compact('resumes', 'answers'));
    }

    public function show(Resume $resume){
//        $questions = Question::all();
//        $answers = Answer::where('resume_id', $resume->id)->get();
        $answers = DB::table('answers')
            ->leftJoin('resumes', 'resumes.id', '=', 'answers.resume_id')
            ->leftJoin('questions', 'questions.id', '=', 'answers.question_id')
            ->select('answers.answers', 'questions.question as question', 'answers.resume_id')->get();
        return view('admin.resume.show', compact('resume', 'answers'));
    }

    public function delete(Resume $resume){
        $resume->delete();
        return redirect()->route('admin.resume.index')->with('status', 'The resume was deleted');
    }
}
