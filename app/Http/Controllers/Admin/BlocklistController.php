<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\BlocklistInterface;  
use Illuminate\Http\Request;
use App\Http\Requests\BlocklistRequest;
use App;
class BlocklistController extends AdminController
{
    protected $blocklist;

    function __construct(BlocklistInterface $blocklist)
    {
        parent::__construct();
        $this->blocklist=$blocklist;
       
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'Block List',
                      ]];
        $search = $request->get('search');
        if($search){
            $ipdata = $this->blocklist->getAll()->where('ip_address', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $ipdata = $this->blocklist->getAll()->paginate($this->PerPage);
        }
        
        return view('ipblocklist.list')->with(array('ipdata'=>$ipdata,'breadcrumb'=>$breadcrumb,'menu'=>'Block List'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Block List' => route('blocklist.list'),
                    'current_menu'=>'Create Block List',
                      ]];
         $admin_id = auth()->user()->id;
        if ($request->method()=='POST') {

            // $request=::class;
            $requestobj=app(BlocklistRequest::class);
            $validatedData = $requestobj->validated();
        $this->blocklist->create($validatedData);
       return redirect()->route('blocklist.list')
                            ->with(array('success'=>'Block List created successfully.','breadcrumb'=>$breadcrumb));
        }
       return view('ipblocklist.create')->with(array('admin_id'=>$admin_id,'breadcrumb'=>$breadcrumb));;
    }
    public function delete($id)
    {
        $ipdata = $this->blocklist->GetIpById($id);
        // dd($ipdata);
        $ipdata->delete();
        return redirect()->route('blocklist.list')
        ->with('success', 'Block List has been deleted!!');
    }
    public function edit(Request $request, $id)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Block List' => route('blocklist.list'),
                    'current_menu'=>'Edit Block List',
                      ]];
                       $admin_id = auth()->user()->id;
        $ipdata =$this->blocklist->GetIpById($id);
        if ($request->method()=='POST') 
        {
            $requestobj=app(BlocklistRequest::class);
            $validatedData = $requestobj->validated();
            $this->blocklist->update($id,$validatedData);
            return redirect()->route('blocklist.list')
                        ->with('success','Block List updated successfully.');
        }
        
        return view('ipblocklist.edit',compact('ipdata'))->with(array('admin_id'=>$admin_id,'ipdata'=>$ipdata,'breadcrumb'=>$breadcrumb));
    }
     
}
