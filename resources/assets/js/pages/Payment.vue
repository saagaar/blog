<template>
  <div class="col-md-9 col-sm-9">
                            <div class="white-box payment_process">
                                <div class="area-heading">
                                    <h3>Payment Page</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pay-bill-summary-wrap">
                                            <h4>Transaction Summary</h4>
                                            <div class="table-responsive mt-3">
                                                <table class="table pay-bill-summary-table table-bordered">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th scope="col"><strong>Reference No.</strong></th>
                                                            <th scope="col"><strong>Debit/Credit</strong></th>
                                                            <th scope="col"><strong>Date</strong></th>
                                                            <th scope="col"><strong>Amount(Nrs.)</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody v-if="initialState.transaction.data.length>0">
                                                        <tr  v-for="trans in initialState.transaction.data ">
                                                            <!-- <td>
                                                                <h5 class="bill-topic"><strong>Technology Posts</strong>
                                                                </h5>
                                                                <p class="topic-description mb-0">Lorem ipsum dolorum delectus commodi.</p>
                                                            </td> -->
                                                            <td><span class="article-num">{{trans.reference}}</span></td>
                                                            <td><span class="article-rate">{{trans.debit_credit}}</span></td>
                                                            <td>{{trans.created_at| moment("from", "now")}}</td>
                                                            <td>
                                                                <h5 class="bill-amount">
                                                                    {{trans.amount}}
                                                                </h5>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                    <tbody v-else>
                                                      <tr >
                                                            <td colspan="4">
                                                                <h5 class="bill-topic"><strong>No Records Found</strong>
                                                                </h5>
                                                              
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                   <!--  <tfoot>
                                                        <tr>
                                                            <td colspan="3">
                                                                <h5 class="text-right">Payment Sub Total:</h5>
                                                            </td>
                                                            <td>
                                                                <h5 class="text-left"><span
                                                                        class="payment-total">$1580.00</span></h5>
                                                            </td>
                                                        </tr>

                                                    </tfoot> -->
                                                </table>
                                                  <ul class="unstyled inbox-pagination" v-if="initialState.transaction.data.length>0" >
                                                    <li><span>Total {{initialState.transaction.total}} {{ initialState.transaction.from}} of {{initialState.transaction.to}}</span></li>
                                                    
                                                   
                                                 <pagination :data="initialState.transaction"  :limit="-1" :show-disabled="true"  @pagination-change-page="getResults">
                                                   <span slot="prev-nav"><li>
                                                      <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                                    </li></span>
                                                   <span slot="next-nav"> <li>
                                                      <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                                    </li></span>
                                                 </pagination>
                                                  </ul>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-4 order-md-2">
                                        <div class="earn-chart-wrap mt-3 mt-md-4">
                                            <!-- <h4>Amount Earned</h4>
                                            <div class="card mt-3">
                                                <div class="card-body">
                                                    <img src="images/chart-sample.jpg" alt="">
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="mt-4">
                                            <h4>Total Earnings</h4>
                                            <h2>{{  ((parseFloat(initialState.all.paid_amount))+(parseFloat(initialState.all.amount))).toFixed(2)}}</h2>
                                        </div>

                                    </div>
                                    <div class="col-md-7 col-lg-8 order-md-1">
                                        <div class="pr-md-4 points-earnings-wrap">
                                        <div class="point-description mt-3 mt-md-4">
                                            <p class="mb-0">Current Point : <span class="curr-point">{{parseFloat(initialState.all.point)-parseFloat(initialState.all.point_previous)}}</span></p>
                                          
                                            <p><strong>Total Point : <span class="total-point">{{initialState.all.point}}</span></strong></p>
                                        </div>
                                        <hr>
                                        <div class="earning-description">
                                            <!-- <p class="mb-0">Current Earnings : <span class="curr-earning">800</span></p> -->
                                            <p><strong>Wallet Amount : <span class="total-earning">{{initialState.all.amount}}</span></strong>
                                            </p>
                                        </div>
                                        <div class="payment-btn mt-3 mt-md-4">
                                           <p><input type="number" blur="$v.form.withdraw_amount.$touch()" v-model="form.withdraw_amount" name="withdraw_amount" placeholder="Enter amount to Withdraw"> 
                                              <div v-if="$v.form.withdraw_amount.$anyDirty">
                                              <div class="error" v-if="!$v.form.withdraw_amount.required">This Field is required</div>
                                              <div class="error" v-if="!$v.form.withdraw_amount.minValue">Withdraw Amount must be at least {{ $v.form.withdraw_amount.$params.minValue.min }} .</div>
                                               <div class="error" v-if="!$v.form.withdraw_amount.denomination">Please enter amount in Mulitple of 500.</div>
                                          </div>
                                           </p>
                                            <button type="submit" class="btn btn-primary primary-shadow btn-sm" @click.prevent="processPayment()">Withdrawl Amount</button>
                                        </div>
                                    </div>
                                    </div>
                                   
                                </div>

                            </div>
                        </div>
</template>
<script>

import mixin  from './../mixins/LoadData.mixin.js';
import Form  from './../services/Form.js';
import { required,minValue, maxValue } from 'vuelidate/lib/validators';
import PlaceHolderBlogList  from './../components/ContentPlaceholder/PlaceHolderBlogList';
    export default {
        
        data:function(){
          return {
            initialState:{},
            form:new Form({
              withdraw_amount:0,
              reset:true
            }),
           
            isLoading:false
          }
        },
         validations: {
          form:{
            withdraw_amount: 
            {
              required,
              minValue: minValue(500),
              async  denomination(value) {
                if (value % 500 == 0) return true
                else return false;
              }
              // maxValue:maxValue(this.initialState.all.amount)
            },
          }
        },
        mixins:[mixin],
        components:{
          PlaceHolderBlogList
        },
       
     methods: {
        getResults(page = 1) 
        {
          this.initialState.blogList={};
          this.$store.commit('TOGGLE_LOADING');
          this.form.get('/api/payment?page=' + page).then(response => {
               this.$store.commit('TOGGLE_LOADING');
               if(response.data)
               {
                 this.initialState.transaction=response.data.transaction
               }
               else
               {
                  
               }
              }).catch(e => 
              {
                 this.$store.commit('TOGGLE_LOADING');
              });
        },
        processPayment() 
        {
          this.$v.form.$touch();
          let curObject=this;
            if(!this.$v.form.$invalid)
            {
              this.form.post('/request/payment').then(response => {
               if(response.data.status){
                 curObject.form.withdraw_amount=0;
                 curObject.$store.commit('SETFLASHMESSAGE',{status:true,message:response.data.message});
                 curObject.$store.commit('TOGGLE_LOADING');
               }
               else{
                 curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:response.data.message});
                  curObject.$store.commit('TOGGLE_LOADING');
               }
              }).catch(e => {
                   curObject.$store.commit('TOGGLE_LOADING');
                  if(e.status===false)
                     curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
                    else
                   curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
              });
            }

        },
        


      }
    }
</script>

<style type="text/css">
 
</style>