
<template>
<div id="display-message" v-if="message">
<div class="" v-if="status=='success'" >


  <div id="message-data"> <div class="msg-icon"><i class="fa fa-check-circle text-success" ></i></div><div class="msg-icon"> <span v-html="message"></span></div></div>
</div>

<div class="" v-if="status=='error'">
  <div id="message-data"  > <i class="fa fa-exclamation-triangle text-warning"></i> {{ message}}.</div>
</div>
</div>
</template>

<script>
    export default 
    {
        data:function(){
           return {
                message:false,
                status:false
           }
        },  
        computed:{
              flashMessage() { 
                return this.$store.state.flashMessage 
              },
            },
        watch: {
          flashMessage(newValue) {
           this.message=newValue.message;
           if(newValue.status) this.status='success';
           else this.status='error';
            this.removeFlashMessageData();
          }
        },
        methods:{
          removeFlashMessageData(){
            var self = this;
             setTimeout(function(){
                  self.message=false;
                  self.status=false;
             },5000);
          }
        }

    }
</script>

<style type="text/css" scoped>
#display-message{
    border: 1px solid;
    min-width: 200px;
    max-width: 500px;
    height: auto;
    position: relative;
    z-index: 1000;
    float: right;
    left: 1px;
    background:#3c2a2a;
    opacity: 0.7;
    border-top-left-radius: 18px;
    border-bottom-left-radius: 20px;
    color: white;
    top:-26px;
    font-size: 16px;
    padding: 16px;
    position: fixed;
    top: 80px;
    left: auto;
    right: 0;
    background: #170a0b;
    border: solid 1px #black;
    color: #fff;
    padding: 10px 22px;
}

#message-status{
   float: left;padding-left: 5px;padding-right: 10px
}
.msg-icon{
  float: left;

}
.msg-icon svg{
  margin-right: 8px;
}
#message-data{
   float: left;
   text-align: left;
   line-height: 20px
}
   </style>