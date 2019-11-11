    <template>
    <ul class="nav-news-feed">
              <li>
                  <i class="fa fa-newspaper"></i>
                  <div><router-link to="/dashboard">Reports</router-link></div>
              </li>
              <li>
                  <i class="fa fa-list-ol"></i>
                  <div>
                   <router-link to="/blog/list">No of Post <span>{{me.blogCount}}</span></router-link>
                 
                 </div>
              </li>
               <!-- <li>
                  <i class="fa fa-list-ul"></i>
                  <div>
                     
                  </div>
              </li> -->
              <li>
                  <i class="fa fa-list-ul"></i>
                  <div>
                     <router-link to="/profile">Profile</router-link>
                  </div>
              </li>
              <li>
                  <i class="fa fa-list-ul"></i>
                  <div>
                     <router-link to="/categories">Customize Interests</router-link>
                  </div>
              </li>
             
              <li>
                  <i class="fa fa-user-plus"></i>
                  <div><a href="#">Who's viewed your profile <span>14</span></a></div>
              </li>
              <li>
                  <i class="fa fa-cog" aria-hidden="true"></i>
                  <div>
                     <router-link to="/settings">Settings</router-link>
                  </div>
              </li>
            </ul>
      </template>
      <script>
        export default {
            data() {
              return {
               
               }
            },
            computed:{
            me:function(){
              return this.$store.getters.me
            },
            
           
        },
       
        }
      </script>