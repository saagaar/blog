 <template>
 <content-loader
    :height="750"
    :width="900"
    :speed="2"
    primaryColor="#c0c0c0"
    secondaryColor="#ffffff"
  >
    <rect x="19" y="29" rx="8" ry="8" width="288" height="21" /> 
    <rect x="26" y="88" rx="0" ry="0" width="242" height="226" /> 
    <rect x="326" y="86" rx="0" ry="0" width="233" height="223" /> 
    <rect x="633" y="83" rx="0" ry="0" width="210" height="217" /> 
    <rect x="29" y="348" rx="0" ry="0" width="242" height="240" /> 
    <rect x="330" y="347" rx="0" ry="0" width="242" height="240" /> 
    <rect x="625" y="348" rx="0" ry="0" width="222" height="237" />
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