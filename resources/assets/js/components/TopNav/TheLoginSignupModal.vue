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
          <h3>Join TheBloggersClub.com</h3>
          <p>Create an account to receive great stories in your inbox and follow authors and topics that you love.</p>
        </div>
        <div class="d-flex flex-column text-center">
          <form method="post">
          @csrf
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
            <button type="submit" id="signupbtn" @click.prevent="submitSignUpForm" class="btn btn-primary btn-round"><Loader></Loader> Sign Up</button>
          </form>
          
          <div class="text-center text-muted delimiter">or use a social network</div>
          
          <div class="d-flex justify-content-center social-buttons">
            <a href="/social-login/google" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Google">
              <i class="fab fa-google"></i>
            </a>
           <!--  <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter">
              <i class="fab fa-twitter"></i>
            </button> -->
            <a href="/social-login/facebook" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
              <i class="fab fa-facebook"></i>
            </a>

          <!--   <a href="/social-login/linkedin" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">
              <i class="fab fa-linkedin"></i>
            </a> -->
          </div>
        </div>
        <div class="signup-section text-center">Already have an account? <LoginButton></LoginButton>.</div>
      </div>
      <div class="modal-footer text-center">
        <div class="popup_btm"> Read our <a href="/page/terms-service"> Terms of Service</a> & <a href="/page/privacy-policy"> Privacy Policy</a> to understand how TheBloggersClub works.</a></div>
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
            <div class="form-group">
              <input type="checkbox" name="remember" id="re-password" v-model.trim="loginForm.remember">  Remember Me
            </div>
            <button type="submit" @click.prevent="submitLoginForm"  class="btn btn-primary btn-round"><Loader></Loader> Login</button>
          </form>
          
          <div class="text-center text-muted delimiter">or use a social network</div>
          <div class="d-flex justify-content-center social-buttons">

            <a href="/social-login/google" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Google">
              <i class="fab fa-google"></i>
            </a>
           <!--  <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter">
              <i class="fab fa-twitter"></i>
            </button> -->
            <a href="/social-login/facebook" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
              <i class="fab fa-facebook"></i>
            </a>
           <!--  <a href="/social-login/linkedin" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">

          <!--   <a href="/social-login/linkedin" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">

              <i class="fab fa-linkedin"></i>
            </a> -->
          </div>
        </div>
        <div class="signup-section text-center">Not a member yet?<SignUpButton :text="'Sign Up'"></SignUpButton>.</div>
        <div class="signup-section text-center">Forgot Password? <a href="/password/reset" class="submit text-info"> Forgot Password</a>.</div>
      </div>
      <div class="modal-footer text-center">
        <div class="popup_btm"> Read our <a href="/page/terms-service"> Terms of Service</a> & <a href="/page/privacy-policy"> Privacy Policy</a> to understand how TheBloggersClub works.</a></div>
      </div>
  </div>
</div>
</div>
</div>
  </div>

</template>
<script>
  import LoginButton from './LoginButton.vue';
import SignUpButton from './SignUpButton.vue';
import { required, minLength , sameAs, between ,email} from 'vuelidate/lib/validators'
import LoginMixin from './../../mixins/Login.mixins';
import Form from './../../services/Form.js';
import Loader from './../../components/Loader';
    export default {
          mixins:[LoginMixin],
        data() {
        	 return {
            loginForm:new Form({
                email: '',
                password: '',
                remember:'',
                formReset:false
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
                    
                        const response = await fetch('blog/isemailregistered/'+value)
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
        components:{
                SignUpButton,
                LoginButton,
                Loader,
        },
        computed:{
           config:function(){
             return this.$store.getters.config;
           }
        },
        methods:{

          submitLoginForm:function(){
            this.$v.loginForm.$touch();
            let curObject=this;
            if(!this.$v.loginForm.$invalid)
            {
              curObject.$store.commit('TOGGLE_LOADING');
              this.loginForm.post('blog/login').then(response => {
               if(response.data.status){
                  curObject.$store.commit('TOGGLE_LOADING');
                  window.location.href=this.config.ROOT_URL+"/home"
               }
               else{
                  curObject.$store.commit('TOGGLE_LOADING');
                  this.$store.commit('SETFLASHMESSAGE',{status:false,message:response.data.message})
               }
              }).catch(e => {
                   curObject.$store.commit('TOGGLE_LOADING');
                   this.$store.commit('SETFLASHMESSAGE',{status:false,message:response.data.message})
              });
            }
          },
          submitSignUpForm:function(){
            this.$v.signUpForm.$touch();
            let curObject=this;
            if(!this.$v.signUpForm.$invalid)
            {
              curObject.$store.commit('TOGGLE_LOADING');
              this.signUpForm.post('blog/register').then(response => {
               if(response.data.data.status){
                curObject.$store.commit('TOGGLE_LOADING');
                 this.closeAllPopups();
                 this.$store.commit('SETFLASHMESSAGE',{status:true,message:response.data.message});
               }
               else{
                curObject.$store.commit('TOGGLE_LOADING');
                this.closeAllPopups();
                  this.$store.commit('SETFLASHMESSAGE',{status:false,message:response.data.message});
               }
              }).catch(e => {
                curObject.$store.commit('TOGGLE_LOADING');
                    this.$store.commit('SETFLASHMESSAGE',{status:false,message:response.data.message});
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
