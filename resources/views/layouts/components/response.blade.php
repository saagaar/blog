@if($type=='success')
<div class="response-message alert alert-success">
    {{ $slot }} 
</div>
@endif
@if($type=='error')
<div class="response-message alert alert-danger">
    {{ $slot }} 
</div>
@endif
