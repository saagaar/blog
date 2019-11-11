
<template>
<div class="col-md-9 col-sm-9">
    <div id="main">
        <div class="white-box edit_profile">
          <div class="area-heading">
              <h3>Settings</h3>
          </div>
          
          <h4> <i class="fa fa-edit"></i> Edit basic information:</h4>

          <div class="row">

          <div class="col-sm-12 form-group">
          <TextEdit :formName="'Name'" :inputName="'name'" :value="me.name"></TextEdit>
          </div>
          <div class="col-sm-6 form-group">
          <EmailEdit :formName="'My Email'" :inputName="'email'" :value="me.email"></EmailEdit>
          </div>
          <div class="col-sm-6">
            <DobEdit :formName="'Date of birth'" :inputName="'dob'" :value="me.dob"></DobEdit>
          <!-- <label>Date Of Birth</label>
           -->
          <!-- <div class="row">  
            <div class="form-group col-sm-3 col-xs-6">
              <label for="month" class="sr-only"></label>
              <select class="form-control" id="day">
                <option value="Day">Day</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
             
              </select>
            </div>
            <div class="form-group col-sm-4 col-xs-6">
              <label for="month" class="sr-only"></label>
              <select class="form-control" id="month">
                <option value="month">Month</option>
                <option>Jan</option>
               
                <option selected="">Dec</option>
              </select>
            </div>
            <div class="form-group col-sm-5 col-xs-12">
              <label for="year" class="sr-only"></label>
              <select class="form-control" id="year">
                <option value="year">Year</option>
                <option selected="">2000</option>
                <option>2001</option>
              
              </select>
            </div>
            <div class="clearfix"></div>
          </div> -->
          </div>

          <!-- <div class="col-sm-12">
              <div class="form-group gender">
                <span class="custom-label"><strong>I am a: </strong></span>
                <label class="radio-inline">
                  <input type="radio" name="optradio" checked="">Male
                </label>
                <label class="radio-inline">
                  <input type="radio" name="optradio">Female
                </label>
              </div>
          </div> -->

          <div class="col-sm-6 form-group">
          <TextEdit :formName="'Address'" :inputName="'address'" :value="me.address"></TextEdit>
          </div>
          <div class="col-sm-6 form-group">
          <TextEdit :formName="'Country'" :inputName="'country'" :value="me.country"></TextEdit>
          </div>

          <div class="col-sm-12 form-group upload_img">
              <label><i class="fa fa-image"></i> Profile Photo <span class="file-input btn btn-success btn-file">
                      <button class="btn btn-success">Chnage Profile Picture</button> 
                      <input type="file" ref="file" name="image" id="file1" class="upload" @change="changeImage();">
                  </span></label>
              <figure> <img :src="me.image? '/images/user-images/'+me.image:'/images/system-images/default-profile.png'" id="image-field"/> </figure>
               
                    
                
                </div>


               

          <div class="col-sm-12 form-group">
            <TextEdit :formName="'Bio'" :inputName="'bio'" :value="me.bio"></TextEdit>
          </div>
          <div class="col-sm-12 form-group">
            <ChangePassword></ChangePassword>
          </div>
          <div class="clearfix"></div>
          </div>

          </div>


        </div>
    </div>
</div>

</template>

<script>
import TextEdit from './../components/Settings/TextEdit';
import ChangePassword from './../components/Settings/ChangePassword';
import EmailEdit from './../components/Settings/EmailEdit';
import DobEdit from './../components/Settings/DobEdit';
import Form from './../services/Form.js';

    export default {
         data() {
          return {
            isLoading:false,
            form:new Form({
              image:'',
              file:true
            })
           }
        },
        mounted() {
        },
        computed:{
            me:function(){
              return this.$store.getters.me
            },
        },
        methods:{
          changeImage:function() 
          {
            this.form.image = this.$refs.file.files[0];
            // console.log(this.form.image);
            let curObject=this;
            this.form.post('/user/changeprofile').then(response => {
               if(response.data.status){
                 curObject.$store.commit('SETFLASHMESSAGE',{status:true,message:response.data.message});
                 // curObject.$store.commit('TOGGLE_LOADING');
                 curObject.$store.commit('UPDATE_PROFILE',response.data.data.imageName);
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
        components:{
            
            TextEdit,
            EmailEdit,
            ChangePassword,
            DobEdit
        },
    }
</script>