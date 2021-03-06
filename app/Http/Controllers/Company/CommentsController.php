<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use App\Models\Comment;
use App\Models\Industry;
use App\Models\City;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use View;
use Input;
use Validator;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;


class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response | string
     */
    public function index($company, Request $request)
    {
        if(auth()->user()){
            $company = Company::find($company);
            $id = $company->id;

            $comments = Comment::where('company_id', '=', $id)->latest('created_at')->simplePaginate(5);
            $links = str_replace('/?', '?', $comments->render());

            if ($request->ajax()) {
                return view('newDesign.company.comments', ['comments' => $comments, 'company' =>$company, 'links'=>$links])->render();
            }

            return view('newDesign.company.comments', ['comments' => $comments, 'company' =>$company]);
        }else{
            return "Ви не зареєстровані";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, $company_id)
    {
        $this->validate($request, [
            'comment' => 'required|min:3|max:2000',
        ]);

        $company = Company::find($company_id);
        $comment = $company->comments()->create([
            'comment' => $request->comment,
            'user_id' => Auth::User()->id
        ]);

        $comment->save();
        Session::flash('success', 'Comment was added');
    
        $company = Company::find($company_id);
        $industry = Industry::find($company->industry_id);
        $city = City::find($company->city_id);
        $vacancies = Vacancy::where('company_id', $company->id)->get();
        $comments = Comment::where('company_id', $company->id)->get();
    
        return redirect('/company/' . $company_id)
            ->with('company', $company)
            ->with('industry', $industry)
            ->with('city', $city)
            ->with('vacancies', $vacancies)
            ->with('comments', $comments);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function update(Request $request, $company_id, $comment_id)
    {
        $this->validate($request, [
            'comment' => 'required|min:3|max:2000',
        ]);
        
        $updatedComment = Comment::find($comment_id);
        $updatedComment->update($request->all());
        
        $company = Company::find($company_id);
        $industry = Industry::find($company->industry_id);
        $city = City::find($company->city_id);
        $vacancies = Vacancy::where('company_id', $company->id)->get();
        $comments = Comment::where('company_id', $company->id)->get();
        
        return redirect('/company/' . $company_id)
            ->with('company', $company)
            ->with('industry', $industry)
            ->with('city', $city)
            ->with('vacancies', $vacancies)
            ->with('comments', $comments);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($company_id, $comment_id)
    {
        Comment::destroy($comment_id);
        
        $company = Company::find($company_id);
        $industry = Industry::find($company->industry_id);
        $city = City::find($company->city_id);
        $vacancies = Vacancy::where('company_id', $company->id)->get();
        $comments = Comment::where('company_id', $company->id)->get();
    
        return redirect('/company/' . $company_id)
            ->with('company', $company)
            ->with('industry', $industry)
            ->with('city', $city)
            ->with('vacancies', $vacancies)
            ->with('comments', $comments);
    }
    
    /**
     * @param int $comment_id
     * @return mixed
     */
    public function getEditedComment($comment_id) {
        return Comment::find($comment_id);
    }
}
