<template>

<div class="col-md-9 col-sm-9"  >
  <section class="dashboard_sec">
    <div class="container">
        <div class="row">
        <div class="col-md-12 col-sm-12">
          <div  class="">
            <div class="user_blog_list">
    <aside class="lg-side">
      <div class="inbox-head">
        <div class="row">
            <div class="col-sm-6">
                <h3> <i class="fa fa-mail-bulk">&nbsp;</i> All Post &nbsp;&nbsp;&nbsp; <router-link :to="config.ROOT_URL+'/blog/add'" v-if="$gate.allow('create')"><i class="fa fa-plus-circle"></i></router-link></h3>
            </div>
            <div class="col-sm-6">
                <form class="position text-right">
                  <div class="input-append">
                    <input type="text" class="sr-input" v-model.trim="search"  placeholder="Search Post">
                    <button class="btn sr-btn" @click.prevent="searchPost" type="submit"><i class="fa fa-search"></i></button>
                  </div>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
      <div class="inbox-body">
        <div class="mail-option">
          <div class="chk-all">
            <input type="checkbox" @click="selectAllCheckbox" v-model="allSelected" class="mail-checkbox mail-group-checkbox" v>
            <div class="btn-group">
              <a data-toggle="dropdown" href="#"    class="btn mini all" aria-expanded="false">
                   All
                   <i class="fa fa-angle-down "></i>
               </a>
              <!-- <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-ban">&nbsp;</i> None</a></li>
                <li><a href="#"><i class="fa fa-book">&nbsp;</i> Read</a></li>
                <li><a href="#"> <i class="fa fa-file-word">&nbsp;</i> Unread</a></li>
              </ul> -->
            </div>
          </div>

          <div class="btn-group">
            <a data-original-title="Refresh" @click="resetFilters" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
              <i class=" fa fa-sync"></i>
            </a>
          </div>
          <div class="btn-group hidden-phone">
            <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                     Sort by
                     <i class="fa fa-angle-down "></i>
                 </a>
            <ul class="dropdown-menu">
              <li><a href="#" @click="updateSortBy('asc')"><i class="fa fa-sort-up">&nbsp;</i>Ascending</a></li>
              <li><a href="#"  @click="updateSortBy('desc')"><i class="fa fa-sort-down" aria-hidden="true">&nbsp;</i> Descending</a></li>
             
            </ul>
          </div>
          <div class="btn-group">
            <a data-toggle="dropdown" href="#" class="btn mini blue">
                                     Filter by
             <i class="fa fa-angle-down "></i>
             </a>
            <ul class="dropdown-menu">
             <li><a href="#" @click="updateFilterBy()">&nbsp;</i> --All--</a></li>
              <li><a href="#" @click="updateFilterBy(1)"><i class="fa fa-save">&nbsp;</i> Draft</a></li>
              <li><a href="#" @click="updateFilterBy(2)"><i class="fa fa-eye">&nbsp;</i> Published</a></li>
              
            </ul>
          </div>

          <ul class="unstyled inbox-pagination" v-if="initialState.blogList" >
            <li><span>{{initialState.blogList.from}}-{{ initialState.blogList.to}} of {{initialState.blogList.total}}</span></li>
            
           
         <pagination :data="initialState.blogList"  :limit="-1" :show-disabled="true"  @pagination-change-page="getResults">
           <span slot="prev-nav"><li>
              <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
            </li></span>
           <span slot="next-nav"> <li>
              <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
            </li></span>
         </pagination>
          </ul>

        </div>
        <table class="table table-inbox table-hover">
        <tbody v-if="this.$store.getters.isLoading===true">
           <PlaceHolderBlogList></PlaceHolderBlogList>
        </tbody>
          <tbody v-else-if="initialState.blogList" >
            <tr class="unread"  v-for="eachblog in initialState.blogList.data">
              <td class="inbox-small-cells">
                <input type="checkbox" class="mail-checkbox" @click="select" v-model="postIds" :value="eachblog.code">
              </td>
              <td class="view-message">
                <div>
                  <router-link :to="'/blog/edit/'+eachblog.code" v-if="$gate.allow('update', 'blog', eachblog)">{{ eachblog.title}}</router-link>
                  <a href="#" v-else>{{ eachblog.title}}</a>

                </div>
                <div class="hidden_sec">
                  <div class="hidden_td_link">
                    <router-link :to="'/blog/edit/'+eachblog.code" v-if="$gate.allow('update', 'blog', eachblog)">Edit</router-link>
                  &nbsp;|&nbsp;
                  <router-link :to="'/blog/preview/'+eachblog.code">Preview</router-link>
                  &nbsp;|&nbsp;
                  <a href="" v-if="$gate.allow('delete', 'blog', eachblog)" @click.prevent="deleteBlog(eachblog.code)">Delete</a>
                  </div>
                </div>
              </td>
              <td class="view-message inbox-small-cells"><a href="#" class="draft_link">{{(eachblog.save_method==1) ?'Draft' : 'Published'}}</a> </td>
               <td class="inbox-small-cells" width="62px"> {{eachblog.views}} <i class="fa fa-eye"></i></td>
              <td class="inbox-small-cells" width="62px"> {{eachblog.likes_count}} <i class="fa fa-thumbs-up"></i></td>
              <td class=" inbox-small-cells">{{eachblog.comments_count}} <i class="fa fa-comments"></i></td>

              <td class="view-message text-right">{{ eachblog.created_at | moment("from", "now")}}</td>
            </tr>
           
          </tbody>
          
          <tbody v-else-if="this.$store.getters.isLoading===false">
             <tr >
              <td colspan="6">No post are available</td>
            </tr>
          </tbody>
        </table>
         
      </div>
    </aside>

      </div>
      </div>
        </div>

            <div class="clearfix"></div>
        </div>
    </div>
  </section>
</div>
</template>
<script>
import config from '../config/config.js';
import mixin  from './../mixins/LoadData.mixin.js';
import Form  from './../services/Form.js';
import PlaceHolderBlogList  from './../components/ContentPlaceholder/PlaceHolderBlogList';
    export default {
        
        data:function(){
          return {
            initialState:{},
            form:new Form(),
            sort_by:'',
            filter_by:'',
            search:'',
            postIds:[],
            allSelected:false,
            isLoading:false
          }
        },
        mixins:[mixin],
        components:{
          PlaceHolderBlogList
        },
        watch: {
          filter_by: function () {
            this.getResults();          
          },
          sort_by: function () {
            this.getResults();          
          },
          search(newValue, oldValue) 
          {
           var newspacecount=newValue.split(' ').length;
           var oldspacecount=oldValue.split(' ').length;
            if(newspacecount=oldspacecount)
            {
               this.getResults();
            }
            else if(newValue.trim()=='')
            {
              this.getResults();
            }        
          }
      },
     computed:{
        config:function(){
         return this.$store.getters.config;
        },
      },
     methods: {
        getResults(page = 1) 
        {
          this.initialState.blogList={};
          this.$store.commit('TOGGLE_LOADING');
          this.form.get('api/blog/list?page=' + page+'&search='+this.search+'&sort_by='+this.sort_by+'&filter_by='+this.filter_by).then(response => {
               this.$store.commit('TOGGLE_LOADING');
               if(response.data)
               {
                 this.initialState.blogList=response.data.blogList
               }
               else
               {
                  alert(response.data.message)
               }
              }).catch(e => 
              {
                 this.$store.commit('TOGGLE_LOADING');
                  console.log(e);
              });
        },

        updateFilterBy(value=''){
          this.filter_by=value;
        },
        updateSortBy(value){
          this.sort_by=value;
        },
        searchPost(){
         this.getResults();
        },
        resetFilters  ()
        {
          this.filter_by='';
          this.sort_by='';
          this.search='';
        },
        selectAllCheckbox()
        {
            var postids=this.postIds;
            var selected=this.selected;
            if (!this.allSelected) {
              this.initialState.blogList.data.forEach(function(item,value)
              {
                 postids.push(item.code);
                 selected=true;
              });
              
            }
            else{
               postids=[];
               selected=false;
            }
            this.allSelected=selected;
            this.postIds=postids;
        },
           deleteBlog:function(code){
              var reconfirm = confirm("Are you sure you want to Delete this ");
              if (reconfirm) {
                  let curObject=this;
                this.form.get('api/blog/deleteBlog/'+code).then(response => {
               this.$store.commit('TOGGLE_LOADING');
               if(response.data)
               {
                curObject.$store.commit('SETFLASHMESSAGE',{status:true,message:response.data.message});
                 curObject.$store.commit('TOGGLE_LOADING');
                this.getResults();
               }
               else
               {
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
              } else {
                  return false;
              }
        },
        select: function() {
            // this.allSelected = false;
        }


      }
    }
</script>

<style type="text/css">
 
</style>