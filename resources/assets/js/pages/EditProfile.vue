
<template>
<div class="col-md-9 col-sm-9">
    <div >
        <div class="white-box edit_profile">
          <div class="area-heading">
              <h3>Settings</h3>
          </div>

          <div class="row">
          <div class="col-md-6">
          <div class="edit-box">
            <h4> <i class="fa fa-edit"></i> Edit basic information:</h4>

          <div class="row">

          <div class="col-sm-12 form-group">
          <TextEdit :formName="'Name'" :inputName="'name'" :value="me.name"></TextEdit>
          </div>
          <div class="col-sm-12 form-group">
          <EmailEdit :formName="'My Email'" :inputName="'email'" :value="me.email"></EmailEdit>
          </div>
          <div class="col-sm-6">
            <DobEdit :formName="'Date of birth'" :inputName="'dob'" :value="me.dob"></DobEdit>

          </div>

          <div class="col-sm-6 form-group">
          <TextEdit :formName="'Address'" :inputName="'address'" :value="me.address"></TextEdit>
          </div>
          <div class="col-sm-6 form-group">
          <TextEdit :formName="'Country'" :inputName="'country'" :value="me.country"></TextEdit>
          </div>
          <div class="col-sm-6 form-group">
            <TextEdit :formName="'Bio'" :inputName="'bio'" :value="me.bio"></TextEdit>
          </div>
          <div class="col-sm-12 form-group">
            <ChangePassword></ChangePassword>
          </div>
          <div class="clearfix"></div>
          </div>

          </div>
          </div>

          <div class="col-md-6">
             <div class="col-sm-12 form-group upload_img">
              <label><i class="fa fa-image"></i> Profile Photo </label>
           <!--    <cropper
                        classname="cropper"
                        :src="me.image? '/uploads/user-images/'+me.image:'/images/system-images/default-profile.png'"
                        :stencilProps="{
                          aspectRatio: 10/12
                        }"
                        :minWidth="48"
                        :minHeight="72"
                        :maxWidth="640"
                        :maxHeight="760"
                        @change="change"
                        :previewClassname="image"
                      >
                      
                </cropper> -->
                <myUpload 
                    @crop-success="cropSuccess"
                    @crop-upload-success="cropUploadSuccess"
                    @crop-upload-fail="cropUploadFail"
                    v-model="show"
                     lang-type="en"
                :width="300"
                :height="300"
                field="image"
                :header="headers"
                :params="params"
                url="/user/changeprofile"
                ></myUpload>
              <img :src="me.image? '/uploads/user-images/'+me.image:'/images/system-images/default-profile.png'" @click="toggleShow()">
              <figure>
                       <!-- <img :src="me.image? '/uploads/user-images/'+me.image:'/images/system-images/default-profile.png'" id="image-field"/>  -->
                <span class="file-input btn btn-success btn-file">
                      <button class="btn btn-success">Change Profile Picture</button> 
                      <!-- <cropper
                        classname="cropper"
                        :src="me.image? '/uploads/user-images/'+me.image:'/images/system-images/default-profile.png'"
                        :stencilProps="{
                          aspectRatio: 10/12
                        }"
                        @change="change"
                      ></cropper> -->
                      <!-- <input type="file" ref="file" name="image" id="file1" class="upload" @change="toggleShow();"> -->
                      <!-- <a ="#" @change="toggleShow()">Change Profile</a -->
                  </span>
              </figure>   
          </div>

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
// import { Cropper } from 'vue-advanced-cropper'
import myUpload from 'vue-image-crop-upload';
    export default {
         data() {
          return {
            isLoading:false,
            form:new Form({
              image:'',
              file:true
            }),
            headers: {

                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            show:false,
            params: {
            name: 'image',
          },
          
           
        }
      },
       
        computed:{
            me:function(){
              return this.$store.getters.me
            },
        },
        methods:{
        
          toggleShow() 
          {
            this.show = !this.show;
          },
          cropSuccess(image, field){
            this.form.image = image;
          },
          /**
           * upload success
           *
           * [param] jsonData  server api return data, already json encode
           * [param] field
           */
          cropUploadSuccess(jsonData, field){

             this.$store.commit('SETFLASHMESSAGE',{status:true,message:jsonData.message});
             this.$store.commit('TOGGLE_LOADING');
             this.$store.commit('UPDATE_PROFILE',jsonData.data.imageName);
          },
          /**
           * upload fail
           *
           * [param] status    server api return error status, like 500
           * [param] field
           */
          cropUploadFail(status, field){
            console.log('-------- upload fail --------');
            this.$store.commit('SETFLASHMESSAGE',{status:false,message:'We couldn\'t upload the image now.<br/> Please try again later.'});
          },
          changeImage:function() 
          {
            let curObject=this;
              const file = this.$refs.file.files[0];
              if (file.size > 5 * 1024 * 1024) {
                curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:'File size is more then 5 MB'});
                return;
              }
              this.form.image = file;
            this.form.post('/user/changeprofile').then(response => {
               if(response.data.status){
                 curObject.$store.commit('SETFLASHMESSAGE',{status:true,message:response.data.message});
                 // curObject.$store.commit('TOGGLE_LOADING');
                 curObject.$store.commit('UPDATE_PROFILE',response.data.data.imageName);
               }
               else{
                 curObject.$store.commit('SETFLASHMESSAGE',{status:false,message:response.data.message});
                  // curObject.$store.commit('TOGGLE_LOADING');
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
            DobEdit,
            myUpload
        },
    }
</script>