<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\TeamInterface;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;
use Illuminate\Support\Facades\File;
use App;
class TeamController extends AdminController
{
    protected $Team;
    function __construct(TeamInterface $team)
    {
         parent::__construct();
         $this->Team=$team;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Teams',
                      ]];
        $search = $request->get('search');
        if($search){
            $Team = $this->Team->getAll()->where('name', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $Team = $this->Team->getAll()->paginate($this->PerPage);
        }
        return view('team.list')->with(array('Team'=>$Team,'breadcrumb'=>$breadcrumb,'menu'=>'Team List'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'=> 
                    [
                      'Dashboard'  => route('admin.dashboard'),
                      'All Teams' => route('team.list'),
                      'current_menu'  =>'Create Team',
                    ]];
        if ($request->method()=='POST') 
        {
            $requestobj=app(TeamRequest::class);
            $validatedData = $requestobj->validated();
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/team-images'), $imageName);
            $validatedData['image'] = $imageName;
            $this->Team->create($validatedData);
            return redirect()->route('team.list')    
                             ->with(array('success'=>'Team created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('team.create')->with(array('breadcrumb'=>$breadcrumb));
    }
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All Teams' => route('team.list'),
                        'current_menu'=>'Edit Team',
                          ]];
            $team =$this->Team->getById($id);    
            if ($request->method()=='POST')
            {
                $requestobj=app(TeamRequest::class);
                $validatedData = $requestobj->validated();
                if ($request->hasFile('image')) {
                    $dir = 'images/team-images/';
                    if ($team->image != '' && File::exists($dir . $team->image))
                    File::delete($dir . $team->image);
                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('images/team-images'), $imageName);
                    $validatedData['image'] = $imageName;
                }else {
                    $validatedData['image'] = $team->image;
                }
                $this->Team->update($id,$validatedData);
                return redirect()->route('team.list')
                            ->with('success','Team Updated Successfully.');
            }
            return view('team.edit',compact('team','breadcrumb'));
    }
    public function delete($id)
    {
       $team =$this->Team->getById($id);
        $result = $team->delete();
        if($result=='true'){
            $dir = 'images/team-images/';
            if ($team->image != '' && File::exists($dir . $team->image)){
                File::delete($dir . $team->image);
            }
        }
        return redirect()->route('team.list')
        ->with('success', '');
    }
}
