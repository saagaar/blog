
<template>

        <div class="col-md-9 col-sm-9">
                <div id="main" class="">
              <div class="white-box add_blog">
                <form method="post" enctype="multipart/form-data" disabled="">
                    <div>
                          <div class="form-group upload_img">
                          <label><i class="fa fa-image"></i> Upload Image</label>

                          <figure> 
                              <img :src="image" id="image-field"/>
                              <span class="file-input btn btn-success btn-file">
                                  <input type="file" ref="file" name="image" id="file1" class="upload" @change="previewImage(); $v.form.image.$touch()">
                              </span>
                          </figure>
                          </div>
                        

                       <div class="form-group pad-box">
                        <h4 class="grey"><i class="fa fa-edit">&nbsp;</i>Short Description </h4>

                        <textarea  class="form-control ckeditor" id="editor" rows="10" blur="$v.form.short_description.$touch()"  v-model="form.short_description"></textarea>
                         <div v-if="$v.form.short_description.$anyDirty">
                              <div class="error" v-if="!$v.form.short_description.required">This Field is required</div>
                              <div class="error" v-if="!$v.form.short_description.maxLength">Description must be less {{ $v.form.short_description.$params.maxLength.max }} letters.</div>
                              <div class="error" v-if="!$v.form.short_description.minLength">Description must be at least {{ $v.form.short_description.$params.minLength.min }} letters.</div>
                            </div>
                     </div>

                      <div class=" pad-box">
                      <div class="form-group">
                          <h4 class="grey"><i class="fa fa-tag">&nbsp;</i>Tags</h4>

                        <div>
                          <multiselect v-if="initialState.options"
                           v-model="form.tags" 
                           placeholder="Search  tag" 
                           label="name" 
                           :loading="isLoading"
                           @search-change="searchTags"
                           track-by="name" 
                           :max="max"
                           :optionsLimit="optionsLimit"
                           :options="options" 
                           :multiple="true" 
                           open-direction="bottom"
                           :internal-search="false"
                           :show-no-results="false"
                         
                           :taggable="false">
                           Tag="checkTag"
                           <template slot="noOptions">Search tags</template>
                           </multiselect>
                        </div>
                      </div>
                      <div class="tgl-group">
                          <span><i class="fa fa-globe">&nbsp;</i> Post As Anonymous</span>
                          <input class="tgl tgl-light"  name="isAnynomous" id="display-address" type="checkbox"  v-model="form.isAnynomous" >
                          <label class="tgl-btn" for="display-address"></label>
                      </div>
                      <hr/>
                      <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                          <button type="button" @click.prevent="submitForm('2')"  class="btn btn-primary ml-30" :disabled="this.$store.state.isLoading"><Loader></Loader>&nbsp;Publish</button>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                          <div class="tools add_btn">
                              <button class="btn btn-light" @click.prevent="submitForm('1')">Save</button>
                              <button class="btn btn-light" @click.prevent="preview()">Preview</button>
                              <button class="btn btn-light" @click.prevent="close()">Close</button>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>
                  </form>
              </div>

          </div>
        </div>
</template>

<script>
import mixin  from './../mixins/LoadData.mixin.js';

import Loader from './../components/Loader';
import Multiselect from 'vue-multiselect'
import { required, between ,email , minLength,maxLength } from 'vuelidate/lib/validators';
import Form from './../services/Form.js';
    export default {
       components:{
          Multiselect,
          Loader
        },
        mixins:[mixin],
      data:function(){
          return {
                isLoading: false,
                max:3,
                image:'/frontend/images/elements/upload.png',
                optionsLimit:5,
                options:[],
                initialState:{},
                form:new Form({
                    short_description:'',
                    image:'',
                    tags:[],
                    isAnynomous:false,
                    file:true,
                    save_method:'1'
                }),
                searchTagform:new Form({
                  name:'',
                })
                 
            }
         },
        validations: {
          form:{
            short_description: {
              required,
              minLength: minLength(4),
              maxLength: maxLength(150)
            },
            image:{

            },
          }
        },
        watch: {
        initialState: function (value) {
            this.form.short_description=value.blog.short_description;     
            this.form.tags=value.blog.tags;
            this.form.isAnynomous=(value.blog.anynomous == '1') ? true :false;
            if(value.blog.image && value.blog.image!='null')
            this.image='/uploads/blog/'+value.blog.code+'/'+value.blog.image;
        },
      },
        computed:{
          // isLoading(){
          //   return this.$store.state.isLoading ;
          // }
        },
        methods:{
            searchTags(searchQuery){
              let curObject=this;
              this.searchTagform.name=searchQuery;
              if(searchQuery.length>2)
              {
               curObject.isLoading=true;
               curObject.searchTagform.post('blog/getTagName').then(response => {
                if(response.data.status){
                   curObject.isLoading = false;
                   curObject.options=response.data.data;
                 }
                 else{
                     curObject.isLoading = false;
                     this.$store.commit('SETFLASHMESSAGE',{status:false,message:response.data.status});
                 }
                }).catch(e => {
                   curObject.isLoading = false;
                    if(e.status===false)
                       this.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
                      else
                     this.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
                });
              }
            },
        
          // next() {
          //   this.$v.form.$touch();
          //   if(!this.$v.form.$invalid)
          //   {
          //     this.step++;
          //   }
          // },
           previewImage:function(){
             var reader = new FileReader();
              var imageField = document.getElementById("image-field")
              reader.onload = function () {
                  if (reader.readyState == 2) {
                      imageField.src = reader.result;
                  }
              }
              this.form.image = this.$refs.file.files[0];
              reader.readAsDataURL(event.target.files[0]);
            },  
            preview:function(){
              this.$router.push('/blog/preview/'+this.$route.params.blogId)
            },
            close:function(){
              this.$router.push('/blog/list')
            },
            submitForm:function(save_method='1'){
              this.form.save_method=save_method;
              let curObject=this;
              curObject.$store.commit('TOGGLE_LOADING');
              this.$v.form.$touch();
              if(!this.$v.form.$invalid)
              {
                 this.form.post('/blog/edit/'+this.$route.params.blogId+'/step2').then(response => {
                 if(response.data.status){
                   curObject.$store.commit('SETFLASHMESSAGE',{status:true,message:response.data.message});
                   curObject.$store.commit('TOGGLE_LOADING');
                   if(this.form.save_method=='2')
                   {
                      this.$router.push({path:'/profile'});
                   }
                   else
                   {
                      this.$router.push({path : '/blog/list'});
                   }
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
            }
        },
    }

</script>

<style type="text/css">
  .
   fieldset[disabled] .multiselect{pointer-events:none}.multiselect__spinner{position:absolute;right:1px;top:1px;width:48px;height:35px;background:#fff;display:block}.multiselect__spinner:after,.multiselect__spinner:before{position:absolute;content:"";top:50%;left:50%;margin:-8px 0 0 -8px;width:16px;height:16px;border-radius:100%;border-color:#41b883 transparent transparent;border-style:solid;border-width:2px;box-shadow:0 0 0 1px transparent}.multiselect__spinner:before{animation:a 2.4s cubic-bezier(.41,.26,.2,.62);animation-iteration-count:infinite}.multiselect__spinner:after{animation:a 2.4s cubic-bezier(.51,.09,.21,.8);animation-iteration-count:infinite}.multiselect__loading-enter-active,.multiselect__loading-leave-active{transition:opacity .4s ease-in-out;opacity:1}.multiselect__loading-enter,.multiselect__loading-leave-active{opacity:0}.multiselect,.multiselect__input,.multiselect__single{font-family:inherit;font-size:16px;-ms-touch-action:manipulation;touch-action:manipulation}.multiselect{box-sizing:content-box;display:block;position:relative;width:100%;min-height:40px;text-align:left;color:#35495e}.multiselect *{box-sizing:border-box}.multiselect:focus{outline:none}.multiselect--disabled{opacity:.6}.multiselect--active{z-index:1}.multiselect--active:not(.multiselect--above) .multiselect__current,.multiselect--active:not(.multiselect--above) .multiselect__input,.multiselect--active:not(.multiselect--above) .multiselect__tags{border-bottom-left-radius:0;border-bottom-right-radius:0}.multiselect--active .multiselect__select{transform:rotate(180deg)}.multiselect--above.multiselect--active .multiselect__current,.multiselect--above.multiselect--active .multiselect__input,.multiselect--above.multiselect--active .multiselect__tags{border-top-left-radius:0;border-top-right-radius:0}.multiselect__input,.multiselect__single{position:relative;display:inline-block;min-height:20px;line-height:20px;border:none;border-radius:5px;background:#fff;padding:0 0 0 5px;width:100%;transition:border .1s ease;box-sizing:border-box;margin-bottom:8px;vertical-align:top}.multiselect__input::-webkit-input-placeholder{color:#35495e}.multiselect__input:-ms-input-placeholder{color:#35495e}.multiselect__input::placeholder{color:#35495e}.multiselect__tag~.multiselect__input,.multiselect__tag~.multiselect__single{width:auto}.multiselect__input:hover,.multiselect__single:hover{border-color:#cfcfcf}.multiselect__input:focus,.multiselect__single:focus{border-color:#a8a8a8;outline:none}.multiselect__single{padding-left:5px;margin-bottom:8px}.multiselect__tags-wrap{display:inline}.multiselect__tags{min-height:40px;display:block;padding:8px 40px 0 8px;border-radius:5px;border:1px solid #e8e8e8;background:#fff;font-size:14px}.multiselect__tag{position:relative;display:inline-block;padding:4px 26px 4px 10px;border-radius:5px;margin-right:10px;color:#fff;line-height:1;background:#41b883;margin-bottom:5px;white-space:nowrap;overflow:hidden;max-width:100%;text-overflow:ellipsis}.multiselect__tag-icon{cursor:pointer;margin-left:7px;position:absolute;right:0;top:0;bottom:0;font-weight:700;font-style:normal;width:22px;text-align:center;line-height:22px;transition:all .2s ease;border-radius:5px}.multiselect__tag-icon:after{content:"\D7";color:#266d4d;font-size:14px}.multiselect__tag-icon:focus,.multiselect__tag-icon:hover{background:#369a6e}.multiselect__tag-icon:focus:after,.multiselect__tag-icon:hover:after{color:#fff}.multiselect__current{min-height:40px;overflow:hidden;padding:8px 12px 0;padding-right:30px;white-space:nowrap;border-radius:5px;border:1px solid #e8e8e8}.multiselect__current,.multiselect__select{line-height:16px;box-sizing:border-box;display:block;margin:0;text-decoration:none;cursor:pointer}.multiselect__select{position:absolute;width:40px;height:38px;right:1px;top:1px;padding:4px 8px;text-align:center;transition:transform .2s ease}.multiselect__select:before{position:relative;right:0;top:65%;color:#999;margin-top:4px;border-style:solid;border-width:5px 5px 0;border-color:#999 transparent transparent;content:""}.multiselect__placeholder{color:#adadad;display:inline-block;margin-bottom:10px;padding-top:2px}.multiselect--active .multiselect__placeholder{display:none}.multiselect__content-wrapper{position:absolute;display:block;background:#fff;width:100%;max-height:240px;overflow:auto;border:1px solid #e8e8e8;border-top:none;border-bottom-left-radius:5px;border-bottom-right-radius:5px;z-index:1;-webkit-overflow-scrolling:touch}.multiselect__content{list-style:none;display:inline-block;padding:0;margin:0;min-width:100%;vertical-align:top}.multiselect--above .multiselect__content-wrapper{bottom:100%;border-bottom-left-radius:0;border-bottom-right-radius:0;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom:none;border-top:1px solid #e8e8e8}.multiselect__content::webkit-scrollbar{display:none}.multiselect__element{display:block}.multiselect__option{display:block;padding:12px;min-height:40px;line-height:16px;text-decoration:none;text-transform:none;vertical-align:middle;position:relative;cursor:pointer;white-space:nowrap}.multiselect__option:after{top:0;right:0;position:absolute;line-height:40px;padding-right:12px;padding-left:20px;font-size:13px}.multiselect__option--highlight{background:#41b883;outline:none;color:#fff}.multiselect__option--highlight:after{content:attr(data-select);background:#41b883;color:#fff}.multiselect__option--selected{background:#f3f3f3;color:#35495e;font-weight:700}.multiselect__option--selected:after{content:attr(data-selected);color:silver}.multiselect__option--selected.multiselect__option--highlight{background:#ff6a6a;color:#fff}.multiselect__option--selected.multiselect__option--highlight:after{background:#ff6a6a;content:attr(data-deselect);color:#fff}.multiselect--disabled{background:#ededed;pointer-events:none}.multiselect--disabled .multiselect__current,.multiselect--disabled .multiselect__select,.multiselect__option--disabled{background:#ededed;color:#a6a6a6}.multiselect__option--disabled{cursor:text;pointer-events:none}.multiselect__option--group{background:#ededed;color:#35495e}.multiselect__option--group.multiselect__option--highlight{background:#35495e;color:#fff}.multiselect__option--group.multiselect__option--highlight:after{background:#35495e}.multiselect__option--disabled.multiselect__option--highlight{background:#dedede}.multiselect__option--group-selected.multiselect__option--highlight{background:#ff6a6a;color:#fff}.multiselect__option--group-selected.multiselect__option--highlight:after{background:#ff6a6a;content:attr(data-deselect);color:#fff}.multiselect-enter-active,.multiselect-leave-active{transition:all .15s ease}.multiselect-enter,.multiselect-leave-active{opacity:0}.multiselect__strong{margin-bottom:8px;line-height:20px;display:inline-block;vertical-align:top}[dir=rtl] .multiselect{text-align:right}[dir=rtl] .multiselect__select{right:auto;left:1px}[dir=rtl] .multiselect__tags{padding:8px 8px 0 40px}[dir=rtl] .multiselect__content{text-align:right}[dir=rtl] .multiselect__option:after{right:auto;left:0}[dir=rtl] .multiselect__clear{right:auto;left:12px}[dir=rtl] .multiselect__spinner{right:auto;left:1px}@keyframes a{0%{transform:rotate(0)}to{transform:rotate(2turn)}}
</style>