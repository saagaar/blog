
<template>
        <div class="col-md-9 col-sm-9">
              <div class="white-box add_blog">
                <form method="post">
                  <div>
                        <div class="create-post">
                          <div class="row">
                            <div class="col-md-12 col-sm-12">
                              <div class="form-group post_title">
                                <img src="img/p_image.png" alt="" class="profile-photo-md">
                                <span>Posting as <b>{{ me.name}}</b> &nbsp; &nbsp; &nbsp;</span>
                                <input type="text" @blur="$v.form.title.$touch()" name="title" value=" initialState.blog.title " class="form-control" placeholder="Post Title" v-model="form.title"/> 
                                <div v-if="$v.form.title.$anyDirty">
                                  <div class="error" v-if="!$v.form.title.required">This Field is required</div>
                                  <div class="error" v-if="!$v.form.title.maxLength">Title must be less {{ $v.form.title.$params.maxLength.max }} letters.</div>
                                  <div class="error" v-if="!$v.form.title.minLength">Title must be at least {{ $v.form.title.$params.minLength.min }} letters.</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                          <!-- <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-4">
                              <h4 class="grey"><i class="fa fa-edit">&nbsp;</i>Content</h4>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-8">
                              <div class="tools add_btn">
                                  <button class="btn btn-light" @click.prevent="submitForm(false)">Save</button>
                                 <!--  <button class="btn btn-light">Preview</button>
                                  <button class="btn btn-light">Close</button> 
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div> -->
                          <!--   <div class="col-lg-12 col-md-12 col-sm-12">
                             <div class="form-group">
                              <ckeditor type="classic" :editor="editor"  @blur="$v.form.content.$touch()"  :config="editorConfig" v-model="form.content"></ckeditor>
                               <div v-if="$v.form.content.$anyDirty">
                                      <div class="error" v-if="!$v.form.content.required">This Field is required</div>
                                      <div class="error" v-if="!$v.form.content.minLength">Content must be at least {{ $v.form.content.$params.minLength.min }} letters.</div>
                                </div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="word-count">Words:{{wordCount}} \n 
                                                    Character: {{charCount}}


                                </div> -->
                                <div class="demo-update">
                                 <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-4">
                                      <h4 class="grey"><i class="fa fa-edit">&nbsp;</i>Content</h4>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8">
                                      <div class="tools add_btn">
                                          <button class="btn btn-light" @click.prevent="submitForm(false)">Save</button>
                                         <!--  <button class="btn btn-light">Preview</button>
                                          <button class="btn btn-light">Close</button> -->
                                      </div>
                                    </div>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div id="demo-update__editor">
                                         <ckeditor type="classic" :editor="editor"  @blur="$v.form.content.$touch()"  :config="editorConfig" v-model="form.content"></ckeditor>
                                            <div v-if="$v.form.content.$anyDirty">
                                          <div class="error" v-if="!$v.form.content.required">This Field is required</div>
                                          <div class="error" v-if="!$v.form.content.minLength">Content must be at least {{ $v.form.content.$params.minLength.min }} letters.</div>
                                    </div>
                                  </div>
                                  <div class="demo-update__controls">
                                      <span class="demo-update__words">Words:{{wordCount}}</span><br/>
                                     <span class="demo-update__words">Chraracter:{{charCount}}</span>
                                  </div>
                              </div>
                                 <div class="col-lg-12 col-md-12 col-sm-12">
                                  <button @click.prevent="next()" class="btn btn-primary ml-30">Continue</button>
                                </div>
                              </div> 
                               
                  </form>
                </div>
        </div>
</template>

<script>
window.blogCode='';
import mixin  from './../mixins/LoadData.mixin.js';
import { required, minLength, maxLength } from 'vuelidate/lib/validators';
import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
import EssentialsPlugin from '@ckeditor/ckeditor5-essentials/src/essentials';
import BoldPlugin from '@ckeditor/ckeditor5-basic-styles/src/bold';
import ItalicPlugin from '@ckeditor/ckeditor5-basic-styles/src/italic';
import ParagraphPlugin from '@ckeditor/ckeditor5-paragraph/src/paragraph';
import HeadingPlugin from '@ckeditor/ckeditor5-heading/src/heading';
import StrikeThrough from '@ckeditor/ckeditor5-basic-styles/src/code';
import Underline from '@ckeditor/ckeditor5-basic-styles/src/underline';
import Superscript from '@ckeditor/ckeditor5-basic-styles/src/superscript';
import Subscript from '@ckeditor/ckeditor5-basic-styles/src/subscript';
import Code from '@ckeditor/ckeditor5-basic-styles/src/strikethrough';
import BlockQuote from '@ckeditor/ckeditor5-block-quote/src/blockquote';
import Alignment from '@ckeditor/ckeditor5-alignment/src/alignment';
import ImagePlugin from '@ckeditor/ckeditor5-image/src/image';
import ImageCaptionPlugin from '@ckeditor/ckeditor5-image/src/imagecaption';
import ImageStylePlugin from '@ckeditor/ckeditor5-image/src/imagestyle';
import ImageToolbarPlugin from '@ckeditor/ckeditor5-image/src/imagetoolbar';
import ImageUploadPlugin from '@ckeditor/ckeditor5-image/src/imageupload';
import ListPlugin from '@ckeditor/ckeditor5-list/src/list';
import LinkPlugin from '@ckeditor/ckeditor5-link/src/link';
import WordCount from '@ckeditor/ckeditor5-word-count/src/wordcount';
import Image from '@ckeditor/ckeditor5-image/src/image';
import ImageResize from '@ckeditor/ckeditor5-image/src/imageresize';
import MediaEmbed from '@ckeditor/ckeditor5-media-embed/src/mediaembed';
import UploadAdapter from './../services/UploadAdapter.js';
import HorizontalLine from '@ckeditor/ckeditor5-horizontal-line/src/horizontalline';
import SpecialCharacters from '@ckeditor/ckeditor5-special-characters/src/specialcharacters';
import SpecialCharactersEssentials from '@ckeditor/ckeditor5-special-characters/src/specialcharactersessentials';

import BlockToolbar from '@ckeditor/ckeditor5-ui/src/toolbar/block/blocktoolbar';
// import GFMDataProcessor from '@ckeditor/ckeditor5-markdown-gfm/src/gfmdataprocessor';
import Table from '@ckeditor/ckeditor5-table/src/table';
import TableToolbar from '@ckeditor/ckeditor5-table/src/tabletoolbar';
import TableProperties from '@ckeditor/ckeditor5-table/src/tableproperties';
import TableCellProperties from '@ckeditor/ckeditor5-table/src/tablecellproperties';
import Form from './../services/Form.js';
    export default {
      
        mixins:[mixin],
        
        data() {
          return {
                 customColorPalette : [
                        {
                            color: 'hsl(4, 90%, 58%)',
                            label: 'Red'
                        },
                        {
                            color: 'hsl(340, 82%, 52%)',
                            label: 'Pink'
                        },
                        {
                            color: 'hsl(291, 64%, 42%)',
                            label: 'Purple'
                        },
                        {
                            color: 'hsl(262, 52%, 47%)',
                            label: 'Deep Purple'
                        },
                        {
                            color: 'hsl(231, 48%, 48%)',
                            label: 'Indigo'
                        },
                        {
                            color: 'hsl(207, 90%, 54%)',
                            label: 'Blue'
                        },

                        
                    ],
                editor: ClassicEditor,
                editorConfig: {
                  extraAllowedContent:'iframe[*]',
                  allowedContent:true,
                    height: '500px',

                    plugins: [
                        EssentialsPlugin,
                        BoldPlugin,
                        ItalicPlugin,
                        ParagraphPlugin,
                        HeadingPlugin,
                        BlockQuote,
                        StrikeThrough,
                        Underline,
                        Superscript,
                        Subscript,
                        Code,
                        Alignment,
                        HorizontalLine,
                        ListPlugin,
                        BlockToolbar,
                        LinkPlugin,
                        SpecialCharacters,
                        SpecialCharactersEssentials,
                        WordCount,
                        MediaEmbed,
                        ImagePlugin,
                        ImageCaptionPlugin,
                        ImageStylePlugin,
                        ImageToolbarPlugin,
                        ImageUploadPlugin,
                        ImageResize,
                        Table,
                        TableToolbar,
                        TableProperties,
                        TableCellProperties,
                        // this.Markdown
                     
                        

                    ],
                     extraPlugins: [ this.MyCustomUploadAdapterPlugin ,WordCount],
                    wordCount: {
                    onUpdate: stats => {
                          this.$data.wordCount=stats.words;
                          this.$data.charCount=stats.characters;
                      }
                    },
                    // simpleUpload: {
                    //     uploadUrl: '/blog/add?media=true',
                    //     headers: {
                    //        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    //     },
                    //     code:'asdad'
                    // },


                    toolbar: {
                        items: [
                            'heading',
                            'bold',
                            'italic',
                            'underline',
                            'superscript',
                            'subscript',
                            'undo',
                            'redo',
                            'NumberedList',
                            'bulletedList',
                            'blockquote',
                            'horizontalLine',
                            'table',
                            'strikethrough',
                            'specialCharacters',
                            'code',
                            'alignment',
                            'imageUpload',
                            'mediaEmbed',
                            'insertTable'
                        ]
                    },
                     blockToolbar: [
                            'heading',
                            '|',
                            'bulletedList', 'numberedList',
                            '|',
                            'blockQuote', 'imageUpload',
                            '|',
                            'strikethrough','code','alignment'
                        ],
                    image: {
                          toolbar: [
                              'imageTextAlternative',
                              '|',
                              'imageStyle:alignLeft',
                              'imageStyle:full',
                              'imageStyle:alignRight'

                          ],
                           styles: [
                              'full',
                              'side',
                              'alignLeft',
                              'alignCenter',
                              'alignRight'
                          ] 
                    },
                    table: {
                            contentToolbar: [
                                'tableColumn', 'tableRow', 'mergeTableCells',
                                'tableProperties', 'tableCellProperties'
                            ],

                            // Set the palettes for tables.
                            // tableProperties: {
                            //     borderColors: this.customColorPalette,
                            //     backgroundColors: this.customColorPalette
                            // },

                            // // Set the palettes for table cells.
                            // tableCellProperties: {
                            //     borderColors: this.customColorPalette,
                            //     backgroundColors: this.customColorPalette,
                            // }
                      } 

                },
                initialState:{},
                wordCount:0,
                charCount:0,
                form:new Form({
                    title:'',
                    content:'',
                    code:'',
                    
                }),
         }
        },
        validations: {
          form:{
            title: {
              required,
              minLength: minLength(1),
              maxLength: maxLength(150)
            },
            content: 
            {
              required,
              minLength: minLength(20 ),
            },
          }
        },
        watch: 
        {
          initialState: function (value) {
            if(value.blog)
            {
              this.form.title=value.blog.title;        
              this.form.content=value.blog.content;   
              this.form.code=value.blog.code;
              window.blogCode=value.blog.code;
            }
          },
        },
        computed:
        {
            me:function(){
              return this.$store.getters.me
            },
        },
        mounted: function(){
           
        },
   
        methods:{
           MyCustomUploadAdapterPlugin ( editor ) {
                editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                 let response=new UploadAdapter( loader);
                // this.form.code=response.code
                  return response;
                };
            },
            Markdown( editor ) {
                // editor.data.processor = new GFMDataProcessor( editor.editing.view.document );
            },
           
        //    create: function () {
        //     if (this.instance == null) {
        //         const type = this.type
                
        //         const editors = this.$VueCkeditorEditors || this.editors
        //         if (!Object.keys(editors).length) {
        //             throw new Error(`There are no CKEditor 5 implementations.`)
        //         }

        //         const editor = editors[type]

        //         if (editor == null) {
        //             throw new Error(`Wrong key '${type}'. Allowed keys: ${Object.keys(editors)}`)
        //         }

        //         editor
        //             .create(this.$el, this.config)
        //             .then(editor => {
        //                 this.instance = editor
        //                 editor.plugins.get('FileRepository').createUploadAdapter = function (loader) {
        //                     return new UploadAdapter(loader)
        //                 }
        //                 const instance = this.instance
        //                 instance.isReadOnly = this.readonly
        //                 instance.model.document.on('change', this.update)
        //                 instance.setData(this.value)
        //             })
        //             .catch(error => {
        //                 console.log(error)
        //             })
        //     }
        // },
        // destroy: function () {
        //     const instance = this.instance

        //     if (instance != null) {
        //         instance.destroy()
        //     }
        // },
        // update: function () {
        //     const value = this.instance.getData()

        //     if (this.value !== value) {
        //         this.$emit('input', value)
        //     }
        // },

        //    beforeDestroy() {
        //       this.destroy()
        //   },

          next() {
            this.$v.form.$touch();
            if(!this.$v.form.$invalid)
            {
                var postId = this.submitForm(true);
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

          onReady( editor )  {
                // Insert the toolbar before the editable area.
                editor.ui.getEditableElement().parentElement.insertBefore(
                    editor.ui.view.toolbar.element,
                    editor.ui.getEditableElement()
                );
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
              
              var url='/blog/add';
                this.$v.form.$touch();
                this.form.media=false;
            if(!this.$v.form.$invalid)
            {

               if(window.blogCode)
                 this.form.code=window.blogCode;
                if(this.initialState.blog)
                  url='/blog/edit/'+this.initialState.blog.code;
              
                this.form.post(url).then(response => {
                 if(response.data.status){
                  if(next===true)
                  {
                    let blogId=response.data.blogId;
                    this.$router.push({ path: '/blog/edit/'+blogId+'/step2' })
                  }
                  else
                  {
                    this.$store.commit('SETFLASHMESSAGE',response.data);
                  }
                 }
                 else{
                    
                 }
                }).catch(e => {
                   this.$store.commit('SETFLASHMESSAGE','Some error Occured .Please try again in a while');
                });
            }
          }
        },
    }

</script>

<style type="text/css" >




   .demo-update {
        border: 1px solid var(--ck-color-base-border);
        border-radius: var(--ck-border-radius);
        box-shadow: 2px 2px 0px hsla( 0, 0%, 0%, 0.1 );
        margin: 1.5em 0;
        padding: 1em;
    }

    .demo-update h3 {
        font-size: 18px;
        font-weight: bold;
        margin: 0 0 .5em;
        padding: 0;
    }

    .demo-update .ck.ck-editor__editable_inline {
        border: 1px solid hsla( 0, 0%, 0%, 0.15 );
        transition: background .5s ease-out;
        min-height: 6em;
        margin-bottom: 1em;
    }

    .demo-update__controls {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .demo-update__chart__characters {
        font-size: 13px;
        font-weight: bold;
    }

    .demo-update__words {
        flex-grow: 1;
        opacity: .5;
    }

  .ck-editor .ck-editor__main .ck-content {
    min-height: 300px;
  }

</style>