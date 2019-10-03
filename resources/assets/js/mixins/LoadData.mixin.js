import Form  from './../services/Form.js';

let getData = function(to,store) {
    
 // 
    return new Promise((resolve, reject) => {
    let initialState = JSON.parse(window.__INITIAL_STATE__) || {};

    if (!initialState.path || to.path !== initialState.path) 
    {
     let form=new Form();

      form.get('/api'+to.path).then(({ data }) => {
     // alert(store.getters.isLoading)
         // this.$store.commit('TOGGLE_LOADING');

        resolve(data);
      })
    } 
    else 
    {
       // alert(store.getters.isLoading)
      // alert(this.$store.getters.isLoading);
     // store.commit('TOGGLE_LOADING');
      // this.$store.commit('TOGGLE_LOADING');
      resolve(initialState);
    }
  });
  
};
export default {
  beforeCreate () 
  {
    // alert(this.$store.getters.isLoading);
    this.$store.commit('TOGGLE_LOADING');
    let store=this.$store;
    // alert(this.$store.getters.isLoading);
    getData(this.$router.currentRoute,store).then((data) => 
    {

      setTimeout(() => 
      {
      this.$store.commit('TOGGLE_LOADING');
        
      // alert(store.getters.isLoading);

         this.$data.initialState=data;
      },2000);
    });
  }
};

