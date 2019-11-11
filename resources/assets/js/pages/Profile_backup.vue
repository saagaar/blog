
<template>
  <div class="timeline">
        <div class="timeline-cover"> 
          
          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info profile_pic_upload">
                  <figure><img src="/images/system-images/default-profile.png" alt="Profile Image" class="img-responsive profile-photo" id="profileImage" />
                    <div class="profile_img_change"> <span class="file-input btn btn-success btn-file"> <i class="fa fa-camera"></i>
                      <input type="file"  name="file" id="file1" class="upload" onchange="viewimage(event)" multiple>
                      </span> </div>
                  </figure>
                  <h3>Bikash Bhandari</h3>
                </div>
               
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="timeline.html" class="active">Timeline</a></li>
                  <li><a href="about.html">About</a></li>
                  <li><a href="photos.html">Photos</a></li>
                  <li><a href="archive.html">Archive</a></li>
                </ul>
                <ul class="follow-me list-inline">
                  <li>
                    <button class="btn-primary">Edit Profile</button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!--Timeline Menu for Large Screens End--> 
          
        </div>
        <div id="page-contents">
          <div class="row">
            <div class="col-md-3 col-sm-3">
              <div id="sidebar">
                <ul class="nav-news-feed">
                  <li><i class="fa fa-users"></i>
                    <div>Followers <span>1024</span></div>
                  </li>
                  <li><i class="fa fa-user-plus"></i>
                    <div>Following <span>433</span></div>
                  </li>
                  <li><i class="fa fa-list-ul"></i>
                    <div><a href="#">No of Post <span>420</span></a></div>
                  </li>
                  <li><i class="fa fa-user"></i>
                    <div><a href="#">Profile Viewed <span>14</span></a></div>
                  </li>
                  <li><i class="fa fa-edit"></i>
                    <div><a href="#">Edit Profile</a></div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-9 col-sm-9">
              <div id="main" class="">
                <div class="white-box create-post">
                  <div class="row">
                    <div class="col-md-8 col-sm-8">
                      <div class="form-group"> <img src="img/p_image.png" alt="Profile Image" class="profile-photo-md">
                        <textarea name="texts" id="exampleTextarea" cols="60" rows="1" class="form-control" placeholder="Write Bikash Bhandari Wall"></textarea>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4 pad-left-0">
                      <div class="tools">
                        <ul class="publishing-tools list-inline">
                          <li><a href="#"><i class="fa fa-edit"></i></a></li>
                          <li><a href="#"><i class="fa fa-image"></i></a></li>
                          <li><a href="#"><i class="fa fa-video"></i></a></li>
                        </ul>
                        <button class="btn btn-primary pull-right">Publish</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="img/magazine/12.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part that is observable to us. If you look just at the portion of the Universe we can see, you can measure its spatial curvature, and find that it’s incredibly close to flat...</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30 ">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="img/magazine/13.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>Inflation did not occur at arbitrarily high energies. There’s an energy scale at which the laws of physics no longer make sense: the Planck scale, or about 1019 GeV. This is about 100 trillion times larger than the maximum energies the LHC achieves…</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="img/magazine/14.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>The idea that the Big Bang happened everywhere at once may apply to our Universe, but certainly ought not to apply to the vast majority of Universes existing in the Multiverse. Assuming that inflation is a quantum field, like all fields we know of, it must spread…</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="img/magazine/12.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part that is observable to us. If you look just at the portion of the Universe we can see, you can measure its spatial curvature, and find that it’s incredibly close to flat. No regions...</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30 ">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="img/magazine/13.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>Inflation did not occur at arbitrarily high energies. There’s an energy scale at which the laws of physics no longer make sense: the Planck scale, or about 1019 GeV. This is about 100 trillion times larger than the maximum energies the LHC achieves, and a factor of about Dummy text…</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="img/magazine/14.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>The idea that the Big Bang happened everywhere at once may apply to our Universe, but certainly ought not to apply to the vast majority of Universes existing in the Multiverse. Assuming that inflation is a quantum field, like all fields we know of, it must spread out over time, meaning that in any region of space…</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="img/magazine/12.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part that is observable to us. If you look just at the portion of the Universe we can see, you can measure its spatial curvature, and find that it’s incredibly close to flat. No regions...</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30 ">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="img/magazine/13.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>Inflation did not occur at arbitrarily high energies. There’s an energy scale at which the laws of physics no longer make sense: the Planck scale, or about 1019 GeV. This is about 100 trillion times larger than the maximum energies the LHC achieves, and a factor of about 100…</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="img/magazine/14.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>The idea that the Big Bang happened everywhere at once may apply to our Universe, but certainly ought not to apply to the vast majority of Universes existing in the Multiverse. Assuming that inflation is a quantum field, like all fields we know of, it must spread out over…</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="single-blog video-style small row m_b_30">
                      <div class="thumb col-lg-3 col-md-4 col-sm-5"> <img class="img-fluid" src="img/magazine/12.jpg" alt="Blog Image Name Goes Here"> </div>
                      <div class="short_details col-lg-9 col-md-8 col-sm-7"> <a class="d-block" href="single-blog.html">
                        <h4>Blessed night morning on
                          them you great</h4>
                        </a>
                        <p>Why must the Multiverse exist? Quite simply: there must be more Universe than the part that is observable to us. If you look just at the portion of the Universe we can see, you can measure its spatial curvature, and find that it’s incredibly close to flat. No regions repeat; no locations...</p>
                        <div class="meta-bottom d-flex"> <a href="#"><i class="ti-time"></i>mar 12</a> <a href="#"><i class="ti-heart"></i> 0 like</a> <a href="#"><i class="ti-eye"></i> 1k view</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 text-center">
                    <div class="lds-ring">
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
      </div>
</template>

<script>
  
import Favorite from './../components/Favorites/Favorite';
// Vue.component('favorite', require('./Favorites/Favorite.vue'));
import mixin  from './../mixins/LoadData.mixin.js';
    export default {
        computed:{
            me:function(){
              return this.$store.getters.me
            },
        },
        data:function(){
          return {
           allCategories:[],
            userInterest:[],
            
          }
        },
        // mixins:[mixin],
        // components:{
        //     Favorite
        // },
        // methods:{
          
        // }
    }

                      // function viewimage(event) {
                          
                      //     var reader = new FileReader();
                      //     var imageField = document.getElementById("profileImage")
                      //     reader.onload = function () {
                      //         if (reader.readyState == 2) {
                      //             imageField.src = reader.result;
                      //         }
                      //     }
                      //     reader.readAsDataURL(event.target.files[0]);
                      // }
</script>