
<template>
<div>
<div class="progress">
              

      <div class="progress-bar per bg-success" role="progressbar"  :style="'width:'+percentcompleted+'%'"  aria-valuenow="percentcompleted" aria-valuemin="0" aria-valuemax="100"><slot></slot>%</div>
</div>
            

</div>
</template>

<script>
    export default 
    {
      props:{
        percentcompleted:Number,
        totalwords:Number
      },
        data:function(){
           return {
            percent:this.percentcompleted
           }
        },  
       
       
       

    }
</script>

