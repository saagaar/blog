
<template>
<div class="col-md-9 col-sm-9" v-if="blogList.length>0" >
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
                <form action="#" class="position text-right">
                  <div class="input-append">
                    <input type="text" class="sr-input" placeholder="Search Post">
                    <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>
                  </div>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
      <div class="inbox-body">
        <div class="mail-option">
          <div class="chk-all">
            <input type="checkbox" class="mail-checkbox mail-group-checkbox">
            <div class="btn-group">
              <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                         All
                                         <i class="fa fa-angle-down "></i>
                                     </a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-ban">&nbsp;</i> None</a></li>
                <li><a href="#"><i class="fa fa-book">&nbsp;</i> Read</a></li>
                <li><a href="#"> <i class="fa fa-file-word">&nbsp;</i> Unread</a></li>
              </ul>
            </div>
          </div>

          <div class="btn-group">
            <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
              <i class=" fa fa-sync"></i>
            </a>
          </div>
          <div class="btn-group hidden-phone">
            <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                                     More
                                     <i class="fa fa-angle-down "></i>
                                 </a>
            <ul class="dropdown-menu">
              <li><a href="#"><i class="fa fa-pencil-alt">&nbsp;</i> Mark as Read</a></li>
              <li><a href="#"><i class="fa fa-ban">&nbsp;</i> Spam</a></li>
              <li class="divider"></li>
              <li><a href="#"><i class="fa fa-trash-alt">&nbsp;</i> Delete</a></li>
            </ul>
          </div>
          <div class="btn-group">
            <a data-toggle="dropdown" href="#" class="btn mini blue">
                                     Sort by
             <i class="fa fa-angle-down "></i>
             </a>
            <ul class="dropdown-menu">
              <li><a href="#"><i class="fa fa-pencil-alt">&nbsp;</i> Draft</a></li>
              <li><a href="#"><i class="fa fa-ban">&nbsp;</i> Publish</a></li>
              <li class="divider"></li>
              <li><a href="#"><i class="fa fa-trash-alt">&nbsp;</i> Delete</a></li>
            </ul>
          </div>

          <ul class="unstyled inbox-pagination">
            <li><span>1-50 of 234</span></li>
            <li>
              <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
            </li>
            <li>
              <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
            </li>
          </ul>
        </div>
        <table class="table table-inbox table-hover">
          <tbody >
            <tr class="unread"  v-for="eachblog in blogList">
              <td class="inbox-small-cells">
                <input type="checkbox" class="mail-checkbox">
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
import mixin  from './../mixins/LoadData.mixin.js';

    export default {
        mounted() {
           
        },
        data:function(){
          return {
            blogList:'',
          }
        },
        mixins:[mixin],
        components:{
        },
        methods:{
          myBlog:function(){
            
          }
        }
    }
</script>

<style type="text/css">
 
</style>