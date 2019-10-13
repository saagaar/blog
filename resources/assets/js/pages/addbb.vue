<div class="col-md-9 col-sm-9">
            <div id="main" class="">
              <div class="white-box add_blog">
                <form method="post" action="?">
                  <div class="create-post">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                          <div class="form-group post_title">
                            <img src="img/p_image.png" alt="" class="profile-photo-md">
                          <!--   <span>Posting as <b>Shanvi</b> &nbsp; &nbsp; &nbsp;</span>  -->
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
                        <h4 class="grey"><i class="fa fa-edit">&nbsp;</i>Compose </h4>
                      </div>
                      <div class="col-lg-9 col-md-8 col-sm-8">
                        <div class="tools add_btn">
                            <button class="btn btn-light">Save</button>
                            <button class="btn btn-light">Preview</button>
                            <button class="btn btn-light">Close</button>
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

                      <div class="form-group">

                      <multiselect 
                       v-model="form.tags" 
                       :options="options" 
                       :multiple="true" 
                       :close-on-select="false" 
                       :clear-on-select="false" 
                       :max="5" 
                       :taggable="true" 
                       :preserve-search="true" 
                       placeholder="Pick Tags or Add New" 
                       label="name" 
                       track-by="name" 
                       :hide-selected="false"
                       >
                       <template slot="selection" slot-scope="{ tags, search, isOpen }"><span class="multiselect__single" v-if="form.tags.length &amp;&amp; !isOpen">{{ form.tags.length }} options selected</span></template>
                       </multiselect>
                         <div v-if="$v.form.tags.$anyDirty">
                            <div class="error" v-if="!$v.form.tags.required">This Field is required</div>
                          </div>
                     </div>
                <div class="form-group upload_img">
                <label><i class="fa fa-image"></i> Upload Image</label>
                <figure> <img src="images/placeholder-image-500X300.jpg" id="image-field"/> </figure>
                 
                      <span class="file-input btn btn-success btn-file">
                        Browse 

                        <input type="file"  name="bannerImage" id="file1" class="upload" @change="previewImage();$v.form.bannerImage.$touch()"  >

                    </span>
                    
                  </div>
                    <button @click.prevent="submitForm" class="btn btn-primary ml-30">Publish</button>

                  </form>
              </div>

            </div>
        </div>