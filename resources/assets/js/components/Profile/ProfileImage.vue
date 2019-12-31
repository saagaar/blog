<template>
	     <myUpload 
                    @crop-success="cropSuccess"
                    @crop-upload-success="cropUploadSuccess"
                    @crop-upload-fail="cropUploadFail"
                    v-model="show"
                     lang-type="en"
                :width="200"
                :height="200"
                field="image"
                :header="headers"
                :params="params"
                url="/user/changeprofile"
                ></myUpload>
</template>
<script>
import myUpload from 'vue-image-crop-upload';
import Loader from './../../components/Loader';
    export default {
        props:{
          profileChangeEnable: {type: Boolean, default: false},
        },

         data() {
          return {
                headers: 
                {

                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                show:false,
                params: {
                  name: 'image',
                  _token:document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
      },
      watch:{
        profileChangeEnable:function(newval){
            this.show=newval;
        },
        show:function(newval){
           this.$emit('clicked', newval)
        }
      },
      computed:{
            me(){
              return this.$store.getters.me
            },
            loggedIn(){
              return this.$store.getters.user.loggedInUser;
            }              
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
             // this.$store.commit('TOGGLE_LOADING');
             this.$store.commit('UPDATE_PROFILE',jsonData.data.imageName);
             // this.toggleShow()
          },
          /**
           * upload fail
           *
           * [param] status    server api return error status, like 500
           * [param] field
           */
          cropUploadFail(status, field){
            this.$emit('clicked', false)
            this.$store.commit('SETFLASHMESSAGE',{status:false,message:'We couldn\'t upload the image now.<br/> Please try again later.'});
          },
        },
        components:{
          Loader,
          myUpload
        },
    }
</script>