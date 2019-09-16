<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController; 
use App\Http\Requests\TagRequest;
use App\Repository\TagInterface;
class TagsController extends AdminController
{
    protected $tag;
     public function __construct(TagInterface $tag)
    {
         parent::__construct();
         $this->tag=$tag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Tags',
                      ]];
        $search = $request->get('search');
        if($search){
            $tags = $this->tag->getAll()->where('name', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $tags = $this->tag->getAll()->paginate($this->PerPage);
        }
        return view('admin.tags.list')->with(array('tags'=>$tags,'breadcrumb'=>$breadcrumb,'menu'=>'Tags List'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'=> 
                    [
                      'Dashboard'  => route('admin.dashboard'),
                      'All tagss' => route('tags.list'),
                      'current_menu'  =>'Create Tags',
                    ]];
        if ($request->method()=='POST') 
        {
            $requestobj=app(TagRequest::class);
            $validatedData = $requestobj->validated();
            $this->tag->create($validatedData);
            return redirect()->route('tags.list')    
                             ->with(array('success'=>'Tags created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('admin.tags.create')->with(array('breadcrumb'=>$breadcrumb));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All Tags' => route('tags.list'),
                        'current_menu'=>'Edit tags',
                          ]];
            $tag =$this->tag->getTagById($id);    
            if ($request->method()=='POST')
            {
                $requestobj=app(TagRequest::class);
                $validatedData = $requestobj->validated();
                $this->tag->update($id,$validatedData);
                return redirect()->route('tags.list')
                            ->with('success','Tags Updated Successfully.');
            }
            return view('admin.tags.edit',compact('tag','breadcrumb'));
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       $tag =$this->tag->getById($id);
        if($tag){
            $tag->delete();
        }
        return redirect()->route('tags.list')
        ->with('success', 'Tag deleted successfully!!');
    }

     public function changeStatus(Request $request)
    {
        $tag = $this->tag->getTagById($request->id);
        $status =$request->status;
        $tag->update(array('status'=>$status)); 
        return redirect()->route('tags.list')
                        ->with('success','Status change successfully.');
    } 
}
