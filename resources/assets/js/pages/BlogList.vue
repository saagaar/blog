<template>

<div class="col-md-9 col-sm-9"  >
  <section class="dashboard_sec">
    <div class="container">
        <div class="row">
        <div class="col-md-12 col-sm-12">
          <div id="main" class="">
            <div class="user_blog_list">
    <aside class="lg-side">
      <div class="inbox-head">
        <div class="row">
            <div class="col-sm-6">
                <h3> <i class="fa fa-mail-bulk">&nbsp;</i> All Posts</h3>
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
            <a data-original-title="Refresh" @click="resetFilters " data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
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

          <ul class="unstyled inbox-pagination" >
            <li><span>{{blogList.from}}-{{ blogList.to}} of {{blogList.total}}</span></li>
            
           
         <pagination :data="blogList"  :limit="-1" :show-disabled="true"  @pagination-change-page="getResults">
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
        <tbody v-if="form.isLoading===true">
           <ContentLoader
             
            height=700
            width=1000
            speed=2
            primaryColor="#c0c0c0"
            secondaryColor="#ffffff"
            >
              
 <rect x="26" y="31" rx="0" ry="0" width="27" height="26" /> 
    <rect x="70" y="31" rx="0" ry="0" width="287" height="25" /> 
    <rect x="375" y="31" rx="0" ry="0" width="32" height="23" /> 
    <rect x="430" y="31" rx="0" ry="0" width="42" height="23" /> 
    <rect x="493" y="31" rx="0" ry="0" width="41" height="22" /> 
    <rect x="546" y="32" rx="0" ry="0" width="46" height="22" /> 
    <rect x="26" y="79" rx="0" ry="0" width="26" height="25" /> 
    <rect x="70" y="78" rx="0" ry="0" width="287" height="26" /> 
    <rect x="378" y="78" rx="0" ry="0" width="31" height="25" /> 
    <rect x="433" y="80" rx="0" ry="0" width="40" height="23" /> 
    <rect x="499" y="79" rx="0" ry="0" width="38" height="23" /> 
    <rect x="549" y="79" rx="0" ry="0" width="46" height="24" /> 
    <rect x="26" y="123" rx="0" ry="0" width="27" height="23" /> 
    <rect x="70" y="123" rx="0" ry="0" width="286" height="25" /> 
    <rect x="380" y="123" rx="0" ry="0" width="34" height="23" /> 
    <rect x="435" y="123" rx="0" ry="0" width="40" height="23" /> 
    <rect x="500" y="123" rx="0" ry="0" width="35" height="23" /> 
    <rect x="549" y="123" rx="0" ry="0" width="46" height="23" /> 
    <rect x="27" y="162" rx="0" ry="0" width="26" height="25" /> 
    <rect x="70" y="163" rx="0" ry="0" width="287" height="27" /> 
    <rect x="380" y="166" rx="0" ry="0" width="33" height="24" /> 
    <rect x="435" y="166" rx="0" ry="0" width="38" height="24" /> 
    <rect x="500" y="166" rx="0" ry="0" width="36" height="24" /> 
    <rect x="549" y="166" rx="0" ry="0" width="43" height="24" /> 
    <rect x="26" y="205" rx="0" ry="0" width="27" height="26" /> 
    <rect x="70" y="205" rx="0" ry="0" width="287" height="25" /> 
    <rect x="377" y="205" rx="0" ry="0" width="32" height="23" /> 
    <rect x="433" y="205" rx="0" ry="0" width="40" height="23" /> 
    <rect x="497" y="205" rx="0" ry="0" width="35" height="22" /> 
    <rect x="546" y="205" rx="0" ry="0" width="46" height="22" /> 
    <rect x="26" y="256" rx="0" ry="0" width="25" height="26" /> 
    <rect x="70" y="257" rx="0" ry="0" width="285" height="25" /> 
    <rect x="375" y="256" rx="0" ry="0" width="32" height="23" /> 
    <rect x="430" y="256" rx="0" ry="0" width="42" height="23" /> 
    <rect x="493" y="256" rx="0" ry="0" width="41" height="22" /> 
    <rect x="546" y="256" rx="0" ry="0" width="46" height="22" /> 
    <rect x="26" y="310" rx="0" ry="0" width="25.11" height="28" /> 
    <rect x="70" y="310" rx="0" ry="0" width="287" height="25" /> 
    <rect x="375" y="310" rx="0" ry="0" width="32" height="23" /> 
    <rect x="430" y="310" rx="0" ry="0" width="42" height="23" /> 
    <rect x="493" y="310" rx="0" ry="0" width="41" height="22" /> 
    <rect x="546" y="310" rx="0" ry="0" width="46" height="22" />

            </ContentLoader>
          </tbody>
          <tbody v-else-if="blogList.data" >
            <tr class="unread"  v-for="eachblog in blogList.data" :key="blogList.data.id">
              <td class="inbox-small-cells">
                <input type="checkbox" class="mail-checkbox" @click="select" v-model="postIds" :value="eachblog.code">
              </td>
              <td class="view-message">
                <div><a href="#" class="sort_info_link">{{ eachblog.title}}</a></div>
                <div class="hidden_sec">
                  <div class="hidden_td_link">
                  <a href="#">Edit</a>
                  &nbsp;|&nbsp;
                  <a href="#">Preview</a>
                  &nbsp;|&nbsp;
                  <a href="#">Delete</a>
                  </div>
                </div>
              </td>
              <td class="view-message inbox-small-cells"><a href="#" class="draft_link">{{(eachblog.save_method==1) ?'Draft' : 'Published'}}</a> </td>
              <td class="view-message inbox-small-cells">5 <i class="fa fa-comments"></i></td>
              <td class="inbox-small-cells" width="62px"> 14 <i class="fa fa-eye"></i></td>
              <td class="view-message text-right">{{ eachblog.created_at | moment("from", "now")}}</td>
            </tr>
           
          </tbody>
          
          <tbody v-else-if="isLoading===false && !blogList.data">
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
 import { BulletListLoader,ContentLoader } from 'vue-content-loader';
import mixin  from './../mixins/LoadData.mixin.js';
import Form  from './../services/Form.js';
    export default {
        
        data:function(){
          return {
            blogList:{},
            form:new Form(),
            sort_by:'',
            filter_by:'',
            search:'',
            postIds:[],
            allSelected:false,
          }
        },
        mixins:[mixin],
        components:{
          BulletListLoader,
          ContentLoader
        },
        watch: {
          filter_by: function () {
            this.getResults();          
          },
          sort_by: function () {
            this.getResults();          
          },
          search(newValue, oldValue) {
           var newspacecount=newValue.split(' ').length;
           var oldspacecount=oldValue.split(' ').length;
            
            if(newspacecount!=oldspacecount)
            {
               this.getResults();
            }
            else if(newValue.trim()=='')
            {
              this.getResults();
            }        
          }


      },
      created(){
        // this.getResults();
      },
      methods: {
        getResults(page = 1) {
          this.blogList={};
          this.form.get('api/blog/list?page=' + page+'&search='+this.search+'&sort_by='+this.sort_by+'&filter_by='+this.filter_by).then(response => {
               if(response.data)
               {
                this.blogList=response.data.blogList
               }
               else
               {
                  alert(response.data.message)
               }
              }).catch(e => 
              {
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
              this.blogList.data.forEach(function(item,value)
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
        isLoading:function()
        {
          return form.isLoading;
        },
        select: function() {
            // this.allSelected = false;
        }


      }
    }
</script>

<style type="text/css">
 
</style>