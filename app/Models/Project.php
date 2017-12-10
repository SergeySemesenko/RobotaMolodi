<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use ModelValidator;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',       'company_desc',
        'location',   'project_about',
        'brand',      'company_about',
        'bonuses',    'project_term',
        'full_desc',  'breaf_desc',
        'company_id', 'industry_id'
    ];
    /**
    * The attributes that should be casted to native types.
    *
    * @var array
    */
   protected $casts = [
       'slides' => 'array',
   ];

    /**
    * The value is containes validation's rules.
    *
    * @var array
    */
    private $rules = [
       'name'          => 'required|min:3|max:32',
       'brand'         => 'required|min:3|max:32',
       'location'      => 'required|min:3|max:32',
       'bonuses'       => 'required|min:3|max:32',
       'company_desc'  => 'required|min:3|max:255',
       'company_about' => 'required|min:3|max:255',
       'project_about' => 'required|min:3|max:255',
       'project_term'  => 'required|min:3|max:32',
       'breaf_desc'    => 'required|min:3|max:32',
       'full_desc'     => 'required|min:3|max:255',
       'company_id'    => 'required|integer',
       'industry_id'   => 'required|integer'
    ];

    static public function validationRules()
    {
        return [
            'name'          => 'required|min:3',
            'brand'         => 'required|min:3',
            'logo'          => 'required|image',
            'location'      => 'required|min:3',
            'bonuses'       => 'required|min:3',
            'company_desc'  => 'required|min:3',
            'company_about' => 'required|min:3',
            'project_about' => 'required|min:3',
            'project_term'  => 'required|min:3',
            'breaf_desc'    => 'required|min:3',
            'full_desc'     => 'required|min:3',
            'company_id'    => 'required|integer',
            'industry_id'   => 'required|integer',
            'vacancies'     => 'required|array',
            'slides_url'     => 'array',
            'slides_disk'     => 'array',
        ];
    }
    public function isOwner($userId){
        if($userId ===  $this->company->user->id)
            return true;
        else
            return false;
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id');
    }

    public function members()
    {
        return $this->hasMany('App\Models\ProjectMember','project_id');
    }

    public function vacancies()
    {
        return $this->hasMany('App\Models\ProjectVacancy','project_id');
    }

}
