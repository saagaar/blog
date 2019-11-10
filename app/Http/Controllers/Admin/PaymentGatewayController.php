<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\PaymentGatewayInterface;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentgatewayRequest;
use Illuminate\Support\Facades\File;
use App;
class PaymentGatewayController extends AdminController
{
    protected $paymentGateway;
    function __construct(PaymentGatewayInterface $paymentGateway)
    {
         parent::__construct();
         $this->paymentGateway=$paymentGateway;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Payment Gateways',
                      ]];
        $search = $request->get('search');
        if($search){
            $paymentGateway = $this->paymentGateway->getAll()->where('email', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $paymentGateway = $this->paymentGateway->getAll()->paginate($this->PerPage);
        }
        return view('admin.paymentgateway.list')->with(array('paymentGateway'=>$paymentGateway,'breadcrumb'=>$breadcrumb,'menu'=>'Payment   Gateway List','primary_menu'=>'paymentgateway.list'));
    }
    public function create(Request $request)
    {
        $breadcrumb=['breadcrumbs'=> 
                    [
                      'Dashboard'  => route('admin.dashboard'),
                      'All PaymentGateways' => route('paymentgateway.list'),
                      'current_menu'  =>'Create Payment Gateway',
                    ]];
        if ($request->method()=='POST')
        {
            
            $requestObj=app(PaymentGatewayRequest::class);
            $validatedData = $requestObj->validated();
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('uploads/paymentgateway-images'), $imageName);
            $validatedData['image'] = $imageName;
            $this->paymentGateway->create($validatedData);
            return redirect()->route('paymentgateway.list')    
                             ->with(array('success'=>'PaymentGateway created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('admin.paymentgateway.create')->with(array('breadcrumb'=>$breadcrumb,'primary_menu'=>'paymentgateway.list'));
    }
   public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All payment gateway' => route('paymentgateway.list'),
                        'current_menu'=>'Edit Payment Gateway',
                          ]];
            $paymentGateway =$this->paymentGateway->getById($id);    
            if ($request->method()=='POST')
            {
                
                $requestObj=app(PaymentGatewayRequest::class);
                $validatedData = $requestObj->validated();
                if ($request->hasFile('image')) {
                    $dir = 'uploads/paymentgateway-images/';
                    if ($paymentGateway->image != '' && File::exists($dir . $paymentGateway->image))
                    File::delete($dir . $paymentGateway->image);
                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('uploads/paymentgateway-images'), $imageName);
                    $validatedData['image'] = $imageName;
                }else 
                {
                    $validatedData['image'] = $paymentGateway->image;
                }
                $this->paymentGateway->update($id,$validatedData);
                return redirect()->route('paymentgateway.list')
                            ->with('success','Payment gateway Updated Successfully.');
            }
            return view('admin.paymentgateway.edit',compact('paymentGateway','breadcrumb'))->with(array('primary_menu'=>'paymentgateway.list'));
    }
    public function delete($id)
    {
       $paymentGateway =$this->paymentGateway->getById($id);       
        if($paymentGateway){
            $dir = 'uploads/paymentgateway-images/';
            if ($paymentGateway->image != '' && File::exists($dir . $paymentGateway->image)){
                File::delete($dir . $paymentGateway->image);
            }
            $paymentGateway->delete();
        }
        return redirect()->route('paymentgateway.list')
        ->with('success', 'Payment Gateway has been deleted');
    }

     public function changeStatus(Request $request)
    {
        $paymentGateway = $this->paymentGateway->getById($request->id);
        $status = $request->status;
        $paymentGateway->update(array('status'=>$status));  
        return redirect()->route('paymentgateway.list')
                        ->with('success','Status change successfully.');
    } 

    public function changeMode(Request $request)
    {
        $paymentGateway = $this->paymentGateway->getById($request->id);
        $mode = $request->mode;
        $paymentGateway->update(array('mode'=>$mode));  
        return redirect()->route('paymentgateway.list')
                        ->with('success','Status change successfully.');
    }       
}
