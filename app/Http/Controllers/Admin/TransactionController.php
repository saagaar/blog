<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController; 
use App\Repository\AccountInterface;
use App\Notifications\Notifications;
use App\Repository\PaymentRequestInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App;
use DB;
use Str;
class TransactionController extends AdminController
{
    protected $user;
    function __construct(AccountInterface $UserInterface)
    {
         parent::__construct();
         $this->user=$UserInterface;
    }
    public function list(Request $request)
    {
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Transactions',
                      ]];
        $transaction = $this->user->getUserTransaction()->where('status','completed')->paginate($this->PerPage);
        
        return view('admin.transaction.list')->with(array('transaction'=>$transaction,'breadcrumb'=>$breadcrumb,'menu'=>'Transaction List','primary_menu'=>'transaction.list'));
    }
    public function listPaymentRequest(Request $request,PaymentRequestInterface $paymentRequest){
        $breadcrumb=['breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu'=>'All Payment Request',
                    ]];
        $payment = $paymentRequest->getAllWithUser($this->PerPage);
        return view('admin.transaction.paymentrequest-list')->with(array('paymentRequest'=>$payment,'breadcrumb'=>$breadcrumb,'menu'=>'Transaction List','primary_menu'=>'transaction.list'));
    }
    public function changeStatus(Request $request)
    {
        $paymentGateway = $this->paymentGateway->getById($request->id);
        $status = $request->status;
        $paymentGateway->update(array('status'=>$status));  
        return redirect()->route('paymentgateway.list')
                        ->with('success','Status change successfully.');
    } 

    public function completePaymentRequest(Request $request,PaymentRequestInterface $paymentRequest)
    {
        $userid= $request->post('id');
        $amount= $request->post('amount');
        $payment_request_id= $request->post('payment_request_id');
        $remarks=$request->post('remarks');
        DB::beginTransaction();
        $user= $this->user->getById($userid);
        $reference=Str::uuid();
     try {
        $transactionData=['debit_credit'=>'debit','amount'=>$amount,'status'=>'completed','remarks'=>$remarks, 'reference'=>$reference];
         $this->user->decreaseWalletBalance($user->id,$amount);
         $user->transaction()->create($transactionData);
         $paymentRequest->update($payment_request_id,array('status'=>'2'));
         $notify_code='payment_request_complete';
         $user->notify(new Notifications($notify_code,['USER'=>$user->name,'REFERENCE'=>$reference,'AMOUNT'=>$amount,'WEBSITE_NAME'=>config('settings.site_name')],array(),array('email'=>$user->email)));

         DB::commit();
         return ['success_message'=>'Payment Completed successfully'];
        } catch (\Exception $e) {
               DB::rollback();
                return ['error_message'=>'Transaction Could not be successfull'];
        }
    }
    public function rejectPaymentRequest(Request $request,PaymentRequestInterface $paymentRequest)
    {
        $userid= $request->post('id');
        $amount= $request->post('amount');
        $payment_request_id= $request->post('payment_request_id');
        $remarks=$request->post('remarks');
        $user= $this->user->getById($userid);
         $paymentRequest->update($payment_request_id,array('status'=>'3','remarks'=>$remarks));
         $notify_code='payment_request_rejected';
         $user->notify(new Notifications($notify_code,['USER'=>$user->name,'AMOUNT'=>$amount,'REMARKS'=>$remarks,'WEBSITE_NAME'=>config('settings.site_name')],array(),array('email'=>$user->email)));
        return ['success_message'=>'Status Updated successfully'];
    }           
}
