<template>
<div class="row">
    <div  v-if="lists.length>0" v-for="items in lists"  class="col-lg-6 col-md-6">
        <div class="single-blog video-style small row m_b_30 ">
            <div class="thumb col-md-4 col-sm-5 col-12">
                <figure>
                    <a href="#">
                         <img v-if="items.image" class="img-fluid" :src="getImageurl(items.code,items.image)" :alt="items.title">
                       <img v-else class="img-fluid" :src="'/frontend/images/elements/default-post.jpg'" :alt="items.title">
                    </a>
                </figure>
            </div>
            <div class="short_details col-md-8 col-sm-7 col-12">
              <div class="meta-top d-flex">
            <a v-if="items.anynomous==1" href="#">By Anynomyous</a>
            <a v-else-if="items.user==null" href="#">By Admin</a>
             <a v-else :href="'/profile/'+items.user.username">By {{ items.user.name }}</a>
            </div>
                <a class="d-block" :href="url(items)">
                    <h4>{{items.title}}</h4>
                </a>
                <p>{{items.short_description}}</p>
                <div class="meta-bottom d-flex">
                    <a href="#"><i class="ti-time"></i>{{ items.created_at | moment("from", "now")}}</a>
                    <a href="" class="appreciate"><i>
                        <img src="/frontend/images/elements/inactive-appreciate.png" class="img-fluid">
                    </i> {{items.likes_count}} like</a>
                    <a href="#"><i class="ti-eye"></i> {{items.views}} view</a>
                    <!-- <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a> -->
                </div>
            </div>
        </div>
        </div>
        <InfiniteLoading @infinite="infiniteHandler" spinner="spiral">
          <div slot="no-more"></div>
          <div slot="no-results"><hr></div>
        </InfiniteLoading>
</div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';
import Form from './../../services/Form.js';

export default {
  props:{
    slug: String,
  },
  components: {
    InfiniteLoading,
  },
  data(){
    return {
      offset: 1,
      lists: [],
      form:new Form()
    };
  },
  methods: {
    infiniteHandler($state) {
       
        this.form.get('/api/getbloglistbyslug/'+this.slug+'?page='+this.offset).then(response => 
        {
               if(response.data.data.length)
               {
                 this.offset+=1;
                 this.lists.push(...response.data.data);
                 $state.loaded();
               }
               else
               {
                 $state.complete();
               }
              }).catch(e => 
              {
                 this.$store.commit('SETFLASHMESSAGE',{status:false,message:e.message});
              });
        },
        getImageurl:function(code,image){
          var img = image.split('.');
          var url = '/uploads/blog/'+code+'/'+img[0]+'-thumbnail.'+img[1];
          return url;
        },
        url(items){
          var blogslug= this.blogslug(items.title);
          var url = '/blog/detail/'+items.code+'/'+blogslug;
          return url;
        },
        blogslug: function(title) {
          var blogslug = this.sanitizeTitle(title);
          return blogslug;
        },
        sanitizeTitle: function(title) {
              var slug = "";
              // alert(sl);
              // Change to lower case
              var titleLower = title.toLowerCase();
              // Letter "e"
              slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
              // Letter "a"
              slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
              // Letter "o"
              slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
              // Letter "u"
              slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
              // Letter "d"
              slug = slug.replace(/đ/gi, 'd');
              // Trim the last whitespace
              slug = slug.replace(/\s*$/g, '');
              // Change whitespace to "-"
              slug = slug.replace(/\s+/g, '-');
              
              return slug;
            }
        }, 
};
</script>