
<template>

        <div class="col-md-9 col-sm-9">
                <div id="main" class="">
              <div class="white-box add_blog">
                <form method="post">
                  <div>
                    <div class="create-post">
                      <div class="row">
                        <div class="col-md-12 col-sm-12">
                          <div class="form-group post_title">
                            <img src="img/p_image.png" alt="" class="profile-photo-md">
                            <span>Posting as <b>Shanvi</b> &nbsp; &nbsp; &nbsp;</span>
                            <input type="text" @blur="$v.form.title.$touch()" name="title" class="form-control" placeholder="Post Title" v-model="form.title"/> 
                            <div v-if="$v.form.title.$anyDirty">
                              <div class="error" v-if="!$v.form.title.required">This Field is required</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-4">
                          <h4 class="grey"><i class="fa fa-edit">&nbsp;</i>Main Content </h4>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-8">
                          <div class="tools add_btn">
                              <button class="btn btn-light">Save</button>
                             <!--  <button class="btn btn-light">Preview</button>
                              <button class="btn btn-light">Close</button> -->
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                  
                      <div class="form-group">
                        <ckeditor :editor="editor"  @blur="$v.form.content.$touch()"  v-model="form.content"></ckeditor>
                           <div v-if="$v.form.content.$anyDirty">
                                <div class="error" v-if="!$v.form.content.required">This Field is required</div>
                              </div>
                       </div>

                      <button @click.prevent="next()" class="btn btn-primary ml-30">Continue</button>
                    </div>
                    
                  </form>
              </div>

          </div>
        </div>
</template>

<script>
import mixin  from './../mixins/LoadData.mixin.js';

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import Multiselect from 'vue-multiselect'
import { required, between ,email} from 'vuelidate/lib/validators';
import Form from './../services/Form.js';
    export default {
       components:{
          Multiselect
        },
        mixins:[mixin],
        data() {

          return {
                editor: ClassicEditor,
                step:1,
                form:new Form({
                    title:'',
                    content:'',
                }),
            }
         },
        validations: {
          form:{
            title: {
              required,
            },
            content: 
            {
              required,
            },
          }
        },

        mounted() {
             setTimeout(() => {
              this.myData = 'Example Data';
            }, 5000);
        },

        methods:{
          next() {
            this.$v.form.$touch();
            if(!this.$v.form.$invalid)
            {

                var postId = this.submitForm(true);
                // console.log(postId);
                // this.$router.push({ path: '/blog/edit/'+postId+'/step2' })
            }
          },
          previewImage:function(){
            
             var reader = new FileReader();
              var imageField = document.getElementById("image-field")
              reader.onload = function () {
                  if (reader.readyState == 2) {
                      imageField.src = reader.result;
                  }
              }
              reader.readAsDataURL(event.target.files[0]);
            },
    //          addTag (newTag) {
    //   const tag = {
    //     name: newTag,
    //     code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
    //   }
    //   this.options.push(tag)
    //   this.form.tags.push(tag)
    // },
          submitForm:function(next=false){
                this.$v.form.$touch();
            if(!this.$v.form.$invalid)
            {
              this.form.post('/blog/add').then(response => {
               if(response.data.status){

                if(next===true)
                {
                  let blogId=response.data.blogId;
                  // console.log(blogId);
                  this.$router.push({ path: '/blog/edit/'+blogId+'/step2' })
                }
                else{
                  //success message
                }
                  // return response.data.blogId;

                  // window.location.href="dashboard"
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

<style type="text/css">
  .ck-editor__editable {
    min-height: 300px;
   }

  
</style>