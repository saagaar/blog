<template>
<div>
	<div class="comments-area white-box">
        <h4> {{ blog.comments_count }} Comments</h4>
        <ListComment :comment="getComments"></ListComment>
    </div>
    <AddComment :blogCode="blog.code" @commented="updateComment"></AddComment>
</div>
</template>
<script>
import ListComment from './ListComment';
import AddComment from './AddComment';
import mixin  from './../../mixins/LoadData.mixin.js';
    export default {
    	props: {
    		blog:Object,
    		allcomment:Array
    	},
        mounted() {

            this.$store.commit('LIST_COMMENTS',this.allcomment);
        },
        data:function(){
          return {
            initialState:{}
            
          }
        },
        mixins:[mixin],
        components:{
        	ListComment,
        	AddComment,
        },
        computed:{
            me:function(){
              return this.$store.getters.me
            },
             getComments(){
                return this.$store.getters.listComments;
            }
          
           
        },
        methods :{
        	updateComment:function(data){
        		var comment ={comment:data.comment,created_at:data.created_at,user:{name:this.me.name,image:this.me.image}};
        		this.allcomment.push(comment);
        		// console.log(this.allcomment);
        	},
           
        },
 
    }
</script>