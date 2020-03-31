<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App;
use OwenIt\Auditing\Contracts\Auditable;
class AuditController extends AdminController
{
    function __construct()
    {	
        parent::__construct();
    }
    public function list(Request $request)
    {
    	$breadcrumb=['breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'current_menu'=> 'All Audits',
                  ]];

          $search = $request->get('search');
          // print_r($search);exit;
        if($search){
            $audits = \OwenIt\Auditing\Models\Audit::with('user')
                    ->where('auditable_type', 'like', '%' . $search . '%')
                     ->orWhere('ip_address', 'like', '%' . $search . '%')
                    ->paginate($this->PerPage)
                    ->withPath('?search=' . $search);
        }else{
            $audits = \OwenIt\Auditing\Models\Audit::with('user')
                ->latest()->paginate($this->PerPage);
        }         
        return view('admin.audit.list')->with(array('audits'=>$audits,'breadcrumb'=>$breadcrumb,'primary_menu'=>'adminaudit'));
    }
    public function revert(Request $request,$id){
            $audits = \OwenIt\Auditing\Models\Audit::with('user')->where('id',$id)->first();
            if($audits->event=='created'){
                // print_r($audits->auditable_type);exit;
                $audits->auditable_type::find($audits->auditable_id)->delete();
            }elseif ($audits->event=='updated') {
                $audits->auditable_type::find($audits->auditable_id)->update($audits->old_values);
            }elseif ($audits->event=='deleted') {
                $audits->auditable_type::create($audits->old_values);
            }
            return redirect()->route('audit.list')
                        ->with('success','Action reverted successfully.');
    }
    
}
