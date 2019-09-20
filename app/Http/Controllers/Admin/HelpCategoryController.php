<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\HelpCatInterface;  
// use App\Models\HelpCategorys;
// use App\Models\LogAdminActivitys;
use Illuminate\Http\Request;

class HelpCategoryController extends AdminController
{
    protected $category;

    function __construct(HelpCatInterface $helpCat)
    {
        parent::__construct();
        $this->category=$helpCat;
        
       
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'Help Category',
                    ]];
        $search = $request->get('search');
        if($search){
            $categories = $this->category->getAll()
            ->where('name', 'like', '%' . $search . '%')
            ->paginate($this->PerPage)
            ->withPath('?search=' . $search);
        }else{
            $categories = $this->category->getAll()->paginate($this->PerPage);
        }
        
        return view('admin.help.list')->with(array('categories'=>$categories,'breadcrumb'=>$breadcrumb));
    }
    public function create(Request $request)
    {
        $breadcrumb= ['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Help Category' => route('helpcat.list'),
                    'current_menu'=>'Create',
                      ]];
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'display' => 'required',
            ]);
      
           $insert =  $this->category->create($request->all());
            return redirect()->route('helpcat.list')
                            ->with('success','Help Category created successfully.');
            
        }
       return view('admin.help.create')->with(array('breadcrumb'=>$breadcrumb));
    }
    public function delete($id)
    {
        $category =$this->category->getcatById($id);
        $category->delete();
        return redirect()->route('helpcat.list')
        ->with('success', 'category has been deleted!!');
    }
    public function edit(Request $request, $id)
    {
        $category =$this->category->getcatById($id);
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'Help Category' => route('helpcat.list'),
                    'current_menu'=>'Edit',
                      ]];
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'display' => 'required',
            ]);
            $category->update($request->all());
            $logCat =$this->category->getcatById($id);
            return redirect()->route('helpcat.list')
                             ->with('success','Help Category updated successfully.');
        }
        return view('admin.help.edit')->with(array('category'=>$category,'breadcrumb'=>$breadcrumb));;
    }

    public function changeDisplay(Request $request)
    {
        $category = $this->category->getcatById($request->id);
        $displayValue= $request->display;
        $category->update(array('display'=>$displayValue));  
        return redirect()->route('helpcat.list')
                        ->with('success','Status change successfully.');
    }

}
