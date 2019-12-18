<div id="display-message">
@if($type=='success')
<div id="message-data" ><i class="fa fa-check-circle text-success"></i>
    {{ $slot }} 
</div>
@endif
@if($type=='error')
<div id="message-data"  > <i class="fa fa-exclamation-triangle text-warning"></i> 
    {{ $slot }} 
</div>
@endif
</div>
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
#message-data{
   float: left
}
   </style>
