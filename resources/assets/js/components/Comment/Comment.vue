<template>
<div>
	<div class="comments-area white-box">
        <h4> {{ commentsCount }} Comments</h4>
        <ListComment ></ListComment>
    </div>
    <AddComment :blogCode="blog.code"></AddComment>
</div>
</template>
<script>
import ListComment from './ListComment';
import AddComment from './AddComment';
    export default {
    	props: {
    		blog:Object,
    		allcomment:Array
    	},
        created() {
            if(this.allcomment.length>0)
            {
                this.$store.commit('LIST_COMMENTS',this.allcomment);
            }
        },
        data:function(){
          return {
            initialState:{}
            
          }
        },
        components:{
        	ListComment,
        	AddComment,
        },
        computed:{
            me:function(){
              return this.$store.getters.me
            },
            commentsCount:function(){
                return this.$store.getters.listComments.length;
            }
        },
        methods :{
        },
 
    }
</script>