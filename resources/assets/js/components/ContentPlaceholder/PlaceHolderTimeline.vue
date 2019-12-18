 <template>
 <content-loader
    :height="800"
    :width="800"
    :speed="2"
    primaryColor="#c0c0c0"
    secondaryColor="#ffffff"
  >
  
    <rect x="40" y="38" rx="0" ry="0" width="127" height="135" /> 
    <rect x="202" y="41" rx="8" ry="8" width="368" height="14" /> 
    <rect x="203" y="87" rx="8" ry="8" width="583" height="7" /> 
    <rect x="206" y="108" rx="8" ry="8" width="580" height="7" /> 
    <rect x="205" y="129" rx="8" ry="8" width="431" height="7" /> 
    <rect x="210" y="158" rx="8" ry="8" width="205" height="12" /> 

    <rect x="37" y="223" rx="0" ry="0" width="127" height="135" /> 
    <rect x="202" y="227" rx="8" ry="8" width="368" height="14" /> 
    <rect x="203" y="268" rx="8" ry="8" width="583" height="7" /> 
    <rect x="203" y="291" rx="8" ry="8" width="580" height="7" /> 
    <rect x="204" y="314" rx="8" ry="8" width="431" height="7" /> 
    <rect x="204" y="343" rx="8" ry="8" width="205" height="12" /> 

    <rect x="39" y="414" rx="0" ry="0" width="127" height="135" /> 
    <rect x="206" y="421" rx="8" ry="8" width="368" height="14" /> 
    <rect x="207" y="464" rx="8" ry="8" width="583" height="7" /> 
    <rect x="210" y="487" rx="8" ry="8" width="580" height="7" /> 
    <rect x="210" y="512" rx="8" ry="8" width="306" height="7" /> 
    <rect x="209" y="534" rx="8" ry="8" width="205" height="12" /> 

    <rect x="38" y="607" rx="0" ry="0" width="127" height="135" /> 
    <rect x="209" y="611" rx="8" ry="8" width="368" height="14" /> 
    <rect x="210" y="650" rx="8" ry="8" width="583" height="7" /> 
    <rect x="210" y="674" rx="8" ry="8" width="580" height="7" /> 
    <rect x="213" y="699" rx="8" ry="8" width="364" height="7" /> 
    <rect x="214" y="730" rx="8" ry="8" width="205" height="12" />
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