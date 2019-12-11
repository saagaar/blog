<template>
<div class="row">
    <div  v-if="lists.length>0" v-for="items in lists"  class="col-lg-6 col-md-6">
        <div class="single-blog video-style small row m_b_30 ">
            <div class="thumb col-md-4 col-sm-5 col-12">
                <figure>
                    <a href="#">
                         <img v-if="items.image" class="img-fluid" :src="'/uploads/blog/'+items.code+'/'+items.image" :alt="items.title">
                       <img v-else class="img-fluid" :src="'/images/system-images/default-post.jpg'" :alt="items.title">
                    </a>
                </figure>
            </div>
            <div class="short_details col-md-8 col-sm-7 col-12">
                <a class="d-block" :href="'/blog/detail/'+items.code">
                    <h4>{{items.title}}</h4>
                </a>
                <p>{{items.short_description}}</p>
                <div class="meta-bottom d-flex">
                    <a href="#"><i class="ti-time"></i>{{ items.created_at | moment("from", "now")}}</a>
                    <a href="#" class="appreciate"><i>
                        <img src="frontend/images/elements/inactive-appreciate.png" class="img-fluid">
                    </i> {{items.likes_count}} like</a>
                    <a href="#"><i class="ti-eye"></i> {{items.views}} view</a>
                    <a href="#" class="book_mark"><i class="fa fa-bookmark"></i> Bookmark</a>
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
    category: String,
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
       
        this.form.get('/getblogbycategory/'+this.category+'?page='+this.offset).then(response => 
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

       

      // axios.get(api, {
      //   params: {
      //     page: this.page,
      //   },
      // }).then(({ data }) => {
      //   if (data.hits.length) {
      //     this.page += 1;
      //     this.list.push(...data.hits);
      //     $state.loaded();
      //   } else {
      //     $state.complete();
      //   }
      // });
    },
 
};
</script>