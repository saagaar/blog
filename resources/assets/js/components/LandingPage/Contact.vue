<template>
	<div>
		<form class="contact-form-footer">
          <input class="form-control" type="text" @blur="$v.form.name.$touch()" name="name"  v-model="form.name" placeholder="Name">
          <div v-if="$v.form.name.$anyDirty">
                              <div class="error" v-if="!$v.form.name.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.name.maxLength">name must be less {{ $v.form.name.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.name.minLength">name must be at least {{ $v.form.name.$params.minLength.min }} letters.</div>
                            </div>
          <input class="form-control" type="text" @blur="$v.form.email.$touch()" name="email"  v-model="form.email"  placeholder="email">
          <div v-if="$v.form.email.$anyDirty">
                              <div class="error" v-if="!$v.form.email.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.email.maxLength">email must be less {{ $v.form.email.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.email.minLength">email must be at least {{ $v.form.email.$params.minLength.min }} letters.</div>
                            </div>
            <input class="form-control" type="text" @blur="$v.form.phone.$touch()" name="phone"  v-model="form.phone"  placeholder="phone">
          <div v-if="$v.form.phone.$anyDirty">
                              <div class="error" v-if="!$v.form.phone.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.phone.maxLength">phone must be less {{ $v.form.phone.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.phone.minLength">phone must be at least {{ $v.form.phone.$params.minLength.min }} letters.</div>
                              <div class="error" v-if="!$v.form.phone.numeric">phone must be Numbers.</div>
                            </div>
          <textarea class="form-control" @blur="$v.form.message.$touch()" name="message"  v-model="form.message"  placeholder="message" ></textarea> 
          <div v-if="$v.form.message.$anyDirty">
                              <div class="error" v-if="!$v.form.message.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.message.maxLength">message must be less {{ $v.form.message.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.message.minLength">message must be at least {{ $v.form.message.$params.minLength.min }} letters.</div>
                            </div>
          <button type="submit" @click.prevent="submitForm()" class="btn btn-primary  primary-shadow btn-sm">Send</button>
        </form>
	</div>
</template>
<script>
import { required, minLength, maxLength,numeric } from 'vuelidate/lib/validators';
import Form from './../../services/Form.js';
export default {
        data() {
          return {
                form:new Form({
                    name:'',
                    email:'',
                    phone:'',
                    message:''
                }),
            }
         },
        validations: {
          form:{
            name: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150)
            },
            email: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150)
            },
            phone: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150),
              numeric
            },
            message: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150)
            },
          }
        },
        methods:{
        	submitForm:function(){
                this.$v.form.$touch();
            if(!this.$v.form.$invalid)
            {
              this.form.post('/contact/form').then(response => {
               if(response.data.status){
               	// console.log(response);
               	
                  // window.location.href="/blog/detail/"+this.blogCode
               }
               else{
                  
               }
              }).catch(e => {
              	
                  console.log(e);
              });
            }
          }
        },
    }
</script>