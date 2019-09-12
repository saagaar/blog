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
          <form action="/user/signup" method="post">
            <div class="form-group">
              <input type="text" class="form-control" id="fullname"placeholder="Your Full Name...">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" id="email1"placeholder="Your email address...">
            </div>
            <div class="form-group">
              <input type="password" class="form-control"  placeholder="Your password...">
            </div>
            <div class="form-group">
              <input type="password" class="form-control"  placeholder="Re-type password...">
            </div>
            <button type="submit" class="btn btn-primary btn-round">Sign Up</button>
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
          <form method="post">
            <div class="form-group"  :class="{ 'form-group--error': $v.email.$error }" >
              <input type="email" class="form-control form__input" :class="{ 'is-invalid': submitted && $v.user.firstName.$error }" v-model.trim="$v.email.$model" placeholder="Your email address...">
                <div class="error" v-if="!$v.email.required">Field is required</div>
                <div class="error" v-if="!$v.email.minLength">Name must have at least {{$v.email.$params.minLength.min}} letters.</div>
                <tree-view :data="$v.email" :options="{rootObjectKey: '$v.email', maxDepth: 2}"></tree-view>
            </div>
           
            <div class="form-group" :class="{ 'form-group--error': $v.password.$error }">
              <input type="password" name="password" class="form-control" id="password1" placeholder="Your password...">
             <div  class="error" v-if="!$v.password.required">This Field is required</div>
            </div>
            <button type="submit" @click.prevent="submitForm" class="btn btn-primary btn-round">Login</button>
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
import { required, minLength, between } from 'vuelidate/lib/validators'
import { validationMixin } from 'vuelidate'
    export default {
      mixins: [validationMixin],
        data() {
        	 return {
              // form:{
              email: '',
              password: '',
              submitStatus: null
              }
          // }
        },
        validations: {
          email: {
            required,
            minLength: minLength(4)
          },
          password: {
            between: between(5, 30)

          }
        },
        methods:{
          submitForm:function(){
            // this.$v.form.$touch();

          }
        }

    }
</script>
<style type="text/css">
  .error{
    color:red;
    font-size: 12px;
  }
</style>
