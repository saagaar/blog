<template>
<div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" @click="closeNav">&times;</a>
  <div class="container">
   <div class="row">
            <div class="col-lg-7 col-md-6">
                <div class="single-footer-widget">
                    <ul>
                        <li><a href="/page/about"><i class="fa fa-angle-right">&nbsp;</i> About Us</a></li>
                        <li><a href="#"><i class="fa fa-angle-right">&nbsp;</i> Privacy &amp; Policy</a></li>
                        <li><a href="#"><i class="fa fa-angle-right">&nbsp;</i> Terms &amp; Conditions</a></li>
                        <li><a href="#"><i class="fa fa-angle-right">&nbsp;</i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <p class="footer-text m-0">
                Copyright &copy;All rights reserved | Powered By: <a href="https://idata.com.np" target="_blank">iData Solutions</a>
            </p>
            </div>
            <div class="clearfix"></div>    
        </div>
    </div>
</div>

<span class="open_btn" @click="openNav">
    <a href="javascript:void(0)">
        <i class="fa fa-angle-left faa-passing-reverse animated"></i>
        <i class="fa fa-angle-left"></i>
        <em>Slide here</em>
    </a>
</span>
</div>
</template>

<script>
    export default {
        data() {
        	return {


           message:'Sagar'
           }
       },

        methods:{
             openNav:function(){ 
              document.getElementById("mySidenav").style.width = "100%";
              },

              closeNav:function(){ 
              document.getElementById("mySidenav").style.width = "0";
              }
        }
    }
</script>
