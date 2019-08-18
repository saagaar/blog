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
    protected $PaymentGateway;
    function __construct(PaymentGatewayInterface $paymentgateway)
    {
         parent::__construct();
         $this->PaymentGateway=$paymentgateway;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All PaymentGateways',
                      ]];
        $search = $request->get('search');
        if($search){
            $PaymentGateway = $this->PaymentGateway->getAll()->where('email', 'like', '%' . $search . '%')->paginate($this->PerPage)->withPath('?search=' . $search);
        }else{
            $PaymentGateway = $this->PaymentGateway->getAll()->paginate($this->PerPage);
        }
        return view('paymentgateway.list')->with(array('PaymentGateway'=>$PaymentGateway,'breadcrumb'=>$breadcrumb,'menu'=>'PaymentGateway List'));
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
            $requestobj=app(PaymentGatewayRequest::class);
            $validatedData = $requestobj->validated();
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/paymentgateway-images'), $imageName);
            $validatedData['image'] = $imageName;
            $this->PaymentGateway->create($validatedData);
            return redirect()->route('paymentgateway.list')    
                             ->with(array('success'=>'PaymentGateway created successfully.','breadcrumb'=>$breadcrumb));
        }
        return view('paymentgateway.create')->with(array('breadcrumb'=>$breadcrumb));
    }
   public function edit(Request $request, $id)
    {
            $breadcrumb=['breadcrumbs' => [
                        'Dashboard' => route('admin.dashboard'),
                        'All payment gateway' => route('paymentgateway.list'),
                        'current_menu'=>'Edit Payment Gateway',
                          ]];
            $paymentgateway =$this->PaymentGateway->getById($id);    
            if ($request->method()=='POST')
            {
                $requestobj=app(PaymentGatewayRequest::class);
                $validatedData = $requestobj->validated();
                if ($request->hasFile('image')) {
                    $dir = 'images/payment-images/';
                    if ($paymentgateway->image != '' && File::exists($dir . $paymentgateway->image))
                    File::delete($dir . $paymentgateway->image);
                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('images/payment-images'), $imageName);
                    $validatedData['image'] = $imageName;
                }else {
                    $validatedData['image'] = $paymentgateway->image;
                }
                $this->PaymentGateway->update($id,$validatedData);
                return redirect()->route('paymentgateway.list')
                            ->with('success','Payment gateway Updated Successfully.');
            }
            return view('paymentgateway.edit',compact('paymentgateway','breadcrumb'));
    }
    public function delete($id)
    {
       $paymentgateway =$this->PaymentGateway->getById($id);       
        if($paymentgateway){
            $dir = 'images/paymentgateway-images/';
            if ($paymentgateway->image != '' && File::exists($dir . $paymentgateway->image)){
                File::delete($dir . $paymentgateway->image);
            }
            $paymentgateway->delete();
        }
        return redirect()->route('paymentgateway.list')
        ->with('success', '');
    }
}
