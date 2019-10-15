 <template>
 <content-loader
    :height="750"
    :width="900"
    :speed="2"
    primaryColor="#c0c0c0"
    secondaryColor="#ffffff"
  >
    <circle cx="90" cy="80" r="80" /> 
    <rect x="200" y="34" rx="0" ry="0" width="600" height="27" /> 
    <rect x="200" y="75" rx="0" ry="0" width="300" height="27" /> 
    
  
    <circle cx="90" cy="276" r="80" /> 
    <rect x="200" y="240" rx="0" ry="0" width="600" height="27" /> 
    <rect x="200" y="278" rx="0" ry="0" width="300" height="27" /> 


    <circle cx="90" cy="460" r="80" /> 
    <rect x="200" y="430" rx="0" ry="0" width="600" height="27" /> 
    <rect x="200" y="469" rx="0" ry="0" width="300" height="27" /> 

    <circle cx="90" cy="650" r="80" /> 
    <rect x="200" y="620" rx="0" ry="0" width="600" height="27" /> 
    <rect x="200" y="659" rx="0" ry="0" width="300" height="27" /> 
   
    </content-loader>
</template>



   <script>
   import { ContentLoader } from 'vue-content-loader';
    export default {
        data() {
          return {
           
           }
        },
      
        components:
        {
           ContentLoader
        },
    }
</script>
</script>