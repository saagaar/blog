<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\BlocklistInterface;  
use Illuminate\Http\Request;
use App\Http\Requests\BlocklistRequest;
use App;
class BlockListController extends AdminController
{
    protected $blockList;

    function __construct(BlocklistInterface $blockList)
    {
        parent::__construct();
        $this->blockList=$blockList;
       
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'Block List',
                      ]];
        $search = $request->get('search');
        if($search){
            $ipData = $this->blockList->getAll()->where('ip_address', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $ipData = $this->blockList->getAll()->paginate($this->PerPage);
        }
        
        return view('admin.ipblocklist.list')->with(array('ipData'=>$ipData,'breadcrumb'=>$breadcrumb,'menu'=>'Block List','primary_menu'=>'blocklist.list'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Block List' => route('blocklist.list'),
                    'current_menu'=>'Create Block List',
                      ]];
         $adminId = auth()->user()->id;
        if ($request->method()=='POST') {

            $requestObj=app(BlocklistRequest::class);
            $validatedData = $requestObj->validated();
           $this->blockList->create($validatedData);
           return redirect()->route('blocklist.list')
                            ->with(array('success'=>'Block List created successfully.','breadcrumb'=>$breadcrumb));
        }
       return view('admin.ipblocklist.create')->with(array('adminId'=>$adminId,'breadcrumb'=>$breadcrumb,'primary_menu'=>'blocklist.list'));;
    }
    public function delete($id)
    {
        $ipData = $this->blockList->GetIpById($id);
        $ipData->delete();
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
        $adminId = auth()->user()->id;
        $ipData =$this->blockList->GetIpById($id);
        if ($request->method()=='POST') 
        {
            $requestObj=app(BlocklistRequest::class);
            $validatedData = $requestObj->validated();
            $this->blockList->update($id,$validatedData);
            return redirect()->route('blocklist.list')
                        ->with('success','Block List updated successfully.');
        }
        
        return view('admin.ipblocklist.edit',compact('ipData'))->with(array('admin_id'=>$adminId,'ipdata'=>$ipData,'breadcrumb'=>$breadcrumb,'primary_menu'=>'blocklist.list'));
    }
     
}
