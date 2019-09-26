<template>
  <div>

<div class="modal log-modal fade" id="SignUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-box">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h3>Join BlogSagar</h3>
          <p>Create an account to receive great stories in your inbox and follow authors and topics that you love.</p>
        </div>
        <div class="d-flex flex-column text-center">
          <form method="post">
           <div class="form-group"  :class="{ 'form-group--error': $v.signUpForm.email.$error }" >
              <input type="email" class="form-control form__input"  @blur="$v.signUpForm.email.$touch()" v-model.trim="signUpForm.email"  placeholder="Your email address...">
              <div v-if="$v.signUpForm.email.$anyDirty">
                <div class="error" v-if="!$v.signUpForm.email.required">This Field is required</div>
                <div class="error" v-if="!$v.signUpForm.email.email">This Field must be Valid Email Address</div>
                <div class="error" v-if="!$v.signUpForm.email.isUnique">This Email Address is Already Used</div>
              </div>
            </div>
            <div class="form-group"  :class="{ 'form-group--error': $v.signUpForm.name.$error }" >
              <input type="text" class="form-control form__input"  @blur="$v.signUpForm.name.$touch()" v-model.trim="signUpForm.name"  placeholder="Full Name..">
              <div v-if="$v.signUpForm.name.$anyDirty">
                <div class="error" v-if="!$v.signUpForm.name.required">This Field is required</div>
                <div class="error" v-if="!$v.signUpForm.name.minLength">Name must have at least {{$v.signUpForm.name.$params.minLength.min}} letters.</div>
                
              </div>
            </div>
            <div class="form-group" :class="{ 'form-group--error': $v.signUpForm.password.$error }">
              <input type="password" name="password" class="form-control" @blur="$v.signUpForm.password.$touch()"  placeholder="Your password..." v-model.trim="signUpForm.password">
              <div v-if="$v.signUpForm.password.$anyDirty">
                <div class="error" v-if="!$v.signUpForm.password.required">This Field is required</div>
                <div class="error" v-if="!$v.signUpForm.password.minLength">Password must have at least {{$v.signUpForm.password.$params.minLength.min}} Characters.</div>
              </div>
            </div> 
          <div class="form-group" :class="{ 'form-group--error': $v.signUpForm.repassword.$error }">
              <input type="password" name="password" class="form-control" @blur="$v.signUpForm.repassword.$touch()"   placeholder="Re-type password..." v-model.trim="signUpForm.repassword">
              <div v-if="$v.signUpForm.repassword.$anyDirty">
                <div class="error" v-if="!$v.signUpForm.repassword.required">This Field is required</div>
                <div class="error" v-if="!$v.signUpForm.repassword.sameAsPassword">Password doesnot match</div>
                <div class="error" v-if="!$v.signUpForm.repassword.minLength">Confirm password must have at least {{$v.signUpForm.repassword.$params.minLength.min}} Characters.</div>
                 <!-- <div class="error" v-if="!$v.repassword.sameAsPassword">Passwords must be identical.</div> -->
              </div>
            </div> 
            <button type="submit" id="signupbtn" @click.prevent="submitSignUpForm" class="btn btn-primary btn-round">Sign Up</button>
          </form>
          
          <div class="text-center text-muted delimiter">or use a social network</div>
          <div class="d-flex justify-content-center social-buttons">
            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Google">
              <i class="fab fa-google"></i>
            </button>
            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter">
              <i class="fab fa-twitter"></i>
            </button>
            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
              <i class="fab fa-facebook"></i>
            </button>
            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">
              <i class="fab fa-linkedin"></i>
            </button>
          </div>
        </div>
        <div class="signup-section text-center">Already have an account? <a href="#a" class="text-info"> Sign Up</a>.</div>
      </div>
      <div class="modal-footer text-center">
        <div class="popup_btm">To make BlogSagar work, Click “Sign In” above to accept BlogSagar's <a href="#"> Terms of Service</a> & <a href="#"> Privacy Policy.</a></div>
      </div>
  </div>
</div>
</div>
</div>

 
<div class="modal log-modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-box">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h3>Welcome </h3>
          <p>Sign in to get personalized view your choices,recommendations, follow the topics you love.</p>
        </div>
        <div class="d-flex flex-column text-center">
          <form method="post" autocomplete="none">
            <div class="form-group"  :class="{ 'form-group--error': $v.loginForm.email.$error }" >
              <input type="email" class="form-control form__input"  @blur="$v.loginForm.email.$touch()" v-model.trim="loginForm.email"  placeholder="Your email address..." autocomplete="off">
              <div v-if="$v.loginForm.email.$anyDirty">
                <div class="error" v-if="!$v.loginForm.email.required">This Field is required</div>
                <div class="error" v-if="!$v.loginForm.email.email">This Field must be Valid Email Address</div>
              </div>
            </div>
          
            <div class="form-group" :class="{ 'form-group--error': $v.loginForm.password.$error }">
              <input type="password" name="password" class="form-control" @blur="$v.loginForm.password.$touch()" id="password1"  placeholder="Your password..." v-model.trim="loginForm.password">
              <div v-if="$v.loginForm.password.$anyDirty">
                <div class="error" v-if="!$v.loginForm.password.required">This Field is required</div>
              </div>
            </div> 
            <button type="submit" @click.prevent="submitLoginForm"  class="btn btn-primary btn-round">Login</button>
          </form>
          
          <div class="text-center text-muted delimiter">or use a social network</div>
          <div class="d-flex justify-content-center social-buttons">
            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Google">
              <i class="fab fa-google"></i>
            </button>
            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter">
              <i class="fab fa-twitter"></i>
            </button>
            <a href="/social-login/facebook" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="/social-login/linkedin" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">
              <i class="fab fa-linkedin"></i>
            </a>
          </div>
        </div>
        <div class="signup-section text-center">Not a member yet? <button  class="submit text-info"> Sign Up</button>.</div>
      </div>
      <div class="modal-footer text-center">
        <div class="popup_btm">To make BlogSagar work, Click “Sign In” above to accept BlogSagar's <a href="#"> Terms of Service</a> & <a href="#"> Privacy Policy.</a></div>
      </div>
  </div>
</div>
</div>
</div>
  </div>

</template>
<script>
import { required, minLength , sameAs, between ,email} from 'vuelidate/lib/validators'
import Form from './../../services/Form.js'
    export default {

        data() {
        	 return {
            loginForm:new Form({
                email: '',
                password: '',
              }),
            signUpForm:new Form({
                email: '',
                password: '',
                repassword:'',
                name:'',
              })
          }
        },
        validations: {
        
          loginForm:{
            email: 
            {
              required,
              email
            },
            password: 
            {
              required,
            }
          },
          signUpForm:{
            email: 
            {
              required,
              email,
               async isUnique(value) {
                if (value === '') return true
                    
                        const response = await fetch('/blog/isemailregistered/'+value)
                       return Boolean(await response.json())
                    
              }
            },
            name: 
            {
              required,
              minLength: minLength(2)
            },
            password: 
            {
              required,
               minLength: minLength(6)
            },
            repassword: 
            {
              required,
               minLength: minLength(6),
               sameAsPassword: sameAs("password")
 
            }
          }
          
        },

        methods:{

          submitLoginForm:function(){

          
            this.$v.loginForm.$touch();
            if(!this.$v.loginForm.$invalid)
            {
              this.loginForm.post('blog/login').then(response => {
               if(response.data.status){

                  window.location.href="dashboard"
               }
               else{
                  alert(response.data.message)
               }
              }).catch(e => {
                  console.log(e);
              });
            }
          },
          submitSignUpForm:function(){
            this.$v.signUpForm.$touch();
            if(!this.$v.signUpForm.$invalid)
            {
              this.signUpForm.post('blog/register').then(response => {
               if(response.data.status){

                  // window.location.href="dashboard"
               }
               else{
                  alert(response.data.message)
               }
              }).catch(e => {
                  console.log(e);
              });
            }
          },

        }

    }
</script>
<style type="text/css">
  .error{
    color:red;
    font-size: 12px;
  }
</style>
