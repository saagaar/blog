<template>
	<div>
		<div class="comment-form white-box">
	        <h4>Leave a Reply</h4> 
	        <form class="form-contact comment_form" method="POST" id="commentForm">
	            <div class="row">
	                <div class="col-12">
	                    <div class="form-group">
	                        <textarea class="form-control w-100" @blur="$v.form.comment.$touch()" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment" v-model="form.comment"></textarea>
	                        <div v-if="$v.form.comment.$anyDirty">
                              <div class="error" v-if="!$v.form.comment.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.comment.maxLength">comment must be less {{ $v.form.comment.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.comment.minLength">comment must be at least {{ $v.form.comment.$params.minLength.min }} letters.</div>
                            </div>
	                    </div>
	                </div>
	            </div>
	            <div class="form-group">
	                <button type="submit" @click.prevent="submitForm()" class="button button-contactForm btn-round">Comment </button>
	            </div>
	        </form>
	    </div>
	</div>
</template>
<script>
import { required, minLength, maxLength } from 'vuelidate/lib/validators';
import Form from './../../services/Form.js';
export default {
      	props: {
    		blogCode:String
    	},
        data() {
          return {
                form:new Form({
                    comment:'',
                }),
            }
         },
        validations: {
          form:{
            comment: {
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

              (this.$store.dispatch('createComments',{'code':this.blogCode,'form':this.form}));

              // this.form.post('/create/comment/'+this.blogCode).then(response => {
              //  if(response.data.status){
              //  	// console.log(response);
               	// this.$emit('commented', {comment:this.form.comment,created_at:moment()});
               	
              //     // window.location.href="/blog/detail/"+this.blogCode
              //  }
              //  else{
                  
              //  }
              // }).catch(e => {
              	
              //     console.log(e);
              // });
            }
          }
        },
    }
</script>