 <template>
  <ContentLoader 
    height=700
    width=900
    speed=2
    primaryColor="#c0c0c0"
    secondaryColor="#ffffff"
  >
    <circle cx="48" cy="48" r="20" /> 
    <rect x="84" y="34" rx="0" ry="0" width="120" height="9" /> 
    <rect x="85" y="49" rx="0" ry="0" width="64" height="11" /> 
    <circle cx="48" cy="115" r="20" /> 
    <rect x="84" y="100" rx="0" ry="0" width="120" height="9" /> 
    <rect x="85" y="115" rx="0" ry="0" width="64" height="11" /> 
    <circle cx="50" cy="185" r="20" /> 
    <rect x="84" y="175" rx="0" ry="0" width="120" height="9" /> 
    <rect x="85" y="190" rx="0" ry="0" width="64" height="12" /> 
    <circle cx="50" cy="251" r="20" /> 
    <rect x="84" y="240" rx="0" ry="0" width="120" height="9" /> 
    <rect x="85" y="255" rx="0" ry="0" width="64" height="11" /> 
    <circle cx="53" cy="317" r="20" /> 
    <rect x="84" y="305" rx="0" ry="0" width="120" height="9" /> 
    <rect x="85" y="320" rx="0" ry="0" width="64" height="11" /> 
    <circle cx="55" cy="380" r="20" /> 
    <rect x="84" y="367" rx="0" ry="0" width="120" height="9" /> 
    <rect x="85" y="382" rx="0" ry="0" width="57" height="11" /> 
    <circle cx="53" cy="450" r="20" /> 
    <rect x="84" y="437" rx="0" ry="0" width="120" height="9" /> 
    <rect x="85" y="453" rx="0" ry="0" width="64" height="11" />
  </ContentLoader>
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