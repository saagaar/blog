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
    protected $team;
    function __construct(TeamInterface $team)
    {
         parent::__construct();
         $this->team=$team;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Teams',
                      ]];
        $search = $request->get('search');
        if($search){
            $team = $this->team->getAll()->where('name', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $team = $this->team->getAll()->paginate($this->PerPage);
        }
        return view('admin.team.list')->with(array('team'=>$team,'breadcrumb'=>$breadcrumb,'menu'=>'Team List'));
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
             $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);  
           $requestObj=app(TeamRequest::class);
            $validatedData = $requestObj->validated();
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/team-images'), $imageName);
            $validatedData['image'] = $imageName;
            $this->Team->create($validatedData);
            return redirect()->route('team.list')    
                             ->with(array('success'=>'Team created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('admin.team.create')->with(array('breadcrumb'=>$breadcrumb));
    }
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All Teams' => route('team.list'),
                        'current_menu'=>'Edit Team',
                          ]];
            $team =$this->team->getById($id);    
            if ($request->method()=='POST')
            {
            $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              ]);
               $requestObj=app(TeamRequest::class);
                $validatedData = $requestObj->validated();
                if ($request->hasFile('image')) {
                    $dir = 'frontend/images/team-images/';
                    if ($team->image != '' && File::exists($dir . $team->image))
                    File::delete($dir . $team->image);
                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('frontend/images/team-images'), $imageName);
                    $validatedData['image'] = $imageName;
                }else {
                    $validatedData['image'] = $team->image;
                }
                $this->team->update($id,$validatedData);
                return redirect()->route('team.list')
                            ->with('success','Team Updated Successfully.');
            }
            return view('admin.team.edit',compact('team','breadcrumb'));
    }
    public function delete($id)
    {
       $team =$this->team->getById($id);
        if($team){
            $dir = 'frontend/images/team-images/';
            if ($team->image != '' && File::exists($dir . $team->image)){
                File::delete($dir . $team->image);
            }
            $team->delete();
        }
        return redirect()->route('team.list')
        ->with('success', 'Team has been deleted!');
    }
     public function changeStatus(Request $request)
    {
        $team = $this->team->getById($request->id);
        $status =$request->status;
        $team->update(array('status'=>$status)); 
        return redirect()->route('team.list')
                        ->with('success','Status change successfully.');
    } 
}
