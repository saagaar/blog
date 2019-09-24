
<template>
<div class="col-md-9 col-sm-9">
    <div id="main">
        <div class="white-box edit_profile">
            <div class="area-heading">
                <h3>Edit User Profile</h3>
            </div>
            
            <h4> <i class="fa fa-edit"></i> Edit basic information:</h4>

            <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
<div class="row">

<div class="col-sm-6 form-group">
<label>First Name</label>
<input class="form-control" name="name" id="name" type="text" Value="Bikash">
</div>
<div class="col-sm-6 form-group">
<label>Last Name</label>
<input class="form-control" name="lastName" id="laseName" type="text" value="Bhandari">
</div>
<div class="col-sm-6 form-group">
<label>My Email</label>
<input class="form-control" name="email" id="email" type="email" value="bikash.433@gmail.com">
</div>
<div class="col-sm-6">
<label>Date Of Birth</label>
<div class="row">  
  <div class="form-group col-sm-3 col-xs-6">
    <label for="month" class="sr-only"></label>
    <select class="form-control" id="day">
      <option value="Day">Day</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
   
    </select>
  </div>
  <div class="form-group col-sm-4 col-xs-6">
    <label for="month" class="sr-only"></label>
    <select class="form-control" id="month">
      <option value="month">Month</option>
      <option>Jan</option>
     
      <option selected="">Dec</option>
    </select>
  </div>
  <div class="form-group col-sm-5 col-xs-12">
    <label for="year" class="sr-only"></label>
    <select class="form-control" id="year">
      <option value="year">Year</option>
      <option selected="">2000</option>
      <option>2001</option>
    
    </select>
  </div>
  <div class="clearfix"></div>
</div>
</div>

<div class="col-sm-12">
    <div class="form-group gender">
      <span class="custom-label"><strong>I am a: </strong></span>
      <label class="radio-inline">
        <input type="radio" name="optradio" checked="">Male
      </label>
      <label class="radio-inline">
        <input type="radio" name="optradio">Female
      </label>
    </div>
</div>

<div class="col-sm-6 form-group">
<label>My city</label>
<input class="form-control" name="city" id="city" type="text" Value="Kathmandu">
</div>
<div class="col-sm-6 form-group">
<label>My Country</label>
<select class="form-control" id="country">
  <option value="country">Country</option>
  <option value="AFG">Afghanistan</option>
  <option value="ALA">Ƭand Islands</option>
  <option value="ALB">Albania</option>
 
  <option value="ZWE">Zimbabwe</option>
</select>
</div>

<div class="col-sm-12 form-group upload_img">
    <label><i class="fa fa-image"></i> Profile Photo</label>
    <figure> <img src="img/placeholder-image-500X300.jpg" id="image-field"/> </figure>
     
          <span class="file-input btn btn-success btn-file">
            Browse 
            <input type="file"  name="file" id="file1" class="upload" onchange="previewimage(event)" multiple>
        </span>
      
      </div>


     

<div class="col-sm-12 form-group">
  <label>About Me</label>
<textarea class="form-control w-100" name="aboutme" id="aboutme" cols="30" rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
</textarea>
</div>

<div class="clearfix"></div>
</div>

<hr/>
<br/>
<h4> <i class="fa fa-book"></i> My Education:</h4>

<div class="row">
<div class="col-sm-12 form-group">
<label>University</label>
<input class="form-control" name="university" id="university" type="text" Value="Harvard Unversity">
</div>

  <div class="col-sm-6 form-group">
    <label>From</label>
    <input type="text" name="date" value="2014" class="form-control" />
  </div>
  <div class="col-sm-6 form-group">
    <label>To</label>
    <input type="text" name="date" value="2019" class="form-control" />
  </div>

<div class="col-sm-12 form-group">
<label>Description</label>
<textarea class="form-control w-100" name="aboutme" id="aboutme" cols="20" rows="3">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate.
</textarea>
</div>
<div class="col-sm-12">
    <div class="form-group gender">
      <span class="custom-label"><strong>Graduated?: </strong></span>
      <label class="radio-inline">
        <input type="radio" name="graduated" checked="">Yes
      </label>
      <label class="radio-inline">
        <input type="radio" name="graduated">No
      </label>
    </div>
</div>

<div class="clearfix"></div>
</div>

<hr/>
<br/>
<h4> <i class="fa fa-briefcase"></i> Work Experience:</h4>

<div class="row">
<div class="col-sm-6 form-group">
<label>Company</label>
<input class="form-control" name="company" id="company" type="text" Value="Tejobindu Solutions Pvt.Ltd.">
</div>
<div class="col-sm-6 form-group">
<label>Designation</label>
<input class="form-control" name="designation" id="designation" type="text" Value="Exclusive Author">
</div>

  <div class="col-sm-6 form-group">
    <label>From</label>
    <input type="text" name="date" value="2014" class="form-control" />
  </div>
  <div class="col-sm-6 form-group">
    <label>To</label>
    <input type="text" name="date" value="2019" class="form-control" />
  </div>

<div class="col-sm-12 form-group">
<label>Description</label>
<textarea class="form-control w-100" name="aboutme" id="aboutme" cols="20" rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
</textarea>
</div>
<div class="clearfix"></div>
</div>

<hr/>
<br/>
<h4> <i class="fa fa-heart"></i> My Interests:</h4>

<br/>

<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>

<hr/>
<div class="interest_list">
<a href="#" class="btn btn-sm btn-success">
  Bycicle 
  <i class="fa fa-times"></i>
</a>
<a href="#" class="btn btn-sm btn-success">
  Photography 
  <i class="fa fa-times"></i>
</a>
<a href="#" class="btn btn-sm btn-success">
  Shopping 
  <i class="fa fa-times"></i>
</a>
<a href="#" class="btn btn-sm btn-success">
  Traveling 
  <i class="fa fa-times"></i>
</a>
<a href="#" class="btn btn-sm btn-success">
  Eating 
  <i class="fa fa-times"></i>
</a>
</div>

<div class="input-group">
  <input type="text" class="form-control" value="Photgraphy">
  <div class="input-group-append">
    <button type="button" class="btn btn-secondary">Add</button>
  </div>
</div>

<div class="form-group mt-3">
<button type="submit" class="btn btn-primary btn-round text-uppercase">Save Change</button>
</div>
</form>

        </div>
    </div>
</div>

</template>

<script>
        function previewimage(event) {
            
            var reader = new FileReader();
            var imageField = document.getElementById("image-field")
            reader.onload = function () {
                if (reader.readyState == 2) {
                    imageField.src = reader.result;
                }
            }
            reader.readAsDataURL(event.target.files[0]);
        }
  import { VclFacebook,VclInstagram } from 'vue-content-loading';

    export default {
         data() {
    return {
          myData: null
        }
      },
        mounted() {
             setTimeout(() => {
              this.myData = 'Example Data';
            }, 5000);
        },

        components:{
            
            VclFacebook,
            VclInstagram
          
        },
    }
</script>