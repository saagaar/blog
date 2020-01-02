<template>
		<div>
      <div id="display-message" v-if="message">
      <div class="" v-if="status===true" >


        <div id="message-data" ><i class="fa fa-check-circle text-success"></i> {{ message}}.</div>
      </div>

      <div class="" v-if="status===false">
        <div id="message-data"  > <i class="fa fa-exclamation-triangle text-warning"></i> {{ message}}.</div>
      </div>
      </div> 
            <form action="#">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Enter email" @blur="$v.form.email.$touch()" v-model.trim="form.email">
                    <div v-if="$v.form.email.$anyDirty">
                      <div class="error" v-if="!$v.form.email.required">This Field is required</div>
                      <div class="error" v-if="!$v.form.email.email">This Field must be Valid Email Address</div>
                      <div class="error" v-if="!$v.form.email.minLength">email must be at least {{ $v.form.email.$params.minLength.min }} letters.</div>
                    </div>
                </div>
                <button class="button primary-bg text-white w-100 btn-round" @click.prevent="submitForm()" type="submit">Subscribe</button>
            </form>
      </div>
</template>
<script>
import { required, minLength, email } from 'vuelidate/lib/validators';
import Form from './../../services/Form.js';
export default {
		props:{
			slug:String,
		},
        data() {
          return {
                form:new Form({
                    email:'',
                    slug:this.slug
                }),
                message:'',
                status:''
            }
         },
        validations: {
          form:{
            email: {
              required,
              minLength: minLength(4),
              email,
            },
          }
        },
        methods:{
        	submitForm:function(){
                this.$v.form.$touch();
                let curObject=this;
            if(!this.$v.form.$invalid)
            {
              curObject.form.post('/category/subscribe').then(response => {
                curObject.removeFlashMessageData();
               if(response.data.status){
               	// console.log(response);
               	curObject.status=true;
                curObject.message=response.data.message;
                  // window.location.href="/blog/detail/"+curObject.blogslug
               }
               else{
                  curObject.status=false;
                curObject.message=response.data.message;
               }
              }).catch(e => {
                  curObject.removeFlashMessageData();
                  curObject.status=false;
                  curObject.message=e.message;
              });
            }
          },
          removeFlashMessageData(){
            var self = this;
             setTimeout(function(){
                  self.message=false;
                  self.status=false;
             },5000);
          },
        },
    }
</script>
<style type='text/css' scoped>
#display-message{
    border: 1px solid;
    min-width: 200px;
    max-width: 500px;
    height: auto;
    position: relative;
    z-index: 1000;
    float: right;
    left: 1px;
    background:#3c2a2a;
    opacity: 0.7;
    border-top-left-radius: 18px;
    border-bottom-left-radius: 20px;
    color: white;
    top:-26px;
    font-size: 16px;
    padding: 16px;
    position: fixed;
    top: 80px;
    left: auto;
    right: 0;
    background: #170a0b;
    border: solid 1px #black;
    color: #fff;
    padding: 10px 22px;
}

#message-status{
   float: left;padding-left: 5px;padding-right: 10px
}
#message-data{
   float: left
}
</style>