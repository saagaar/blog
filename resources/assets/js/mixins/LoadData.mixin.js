import Form from './../services/Form.js'

let getData = function(to) {
 let form=new Form();
    return new Promise((resolve, reject) => {
    let initialState = JSON.parse(window.__INITIAL_STATE__) || {};

    if (!initialState.path || to.path !== initialState.path) {
      form.get('/api'+to.path).then(({ data }) => {
        resolve(data);
      })
    } else {
      resolve(initialState);
    }
  });
  
};
export default {
  created () 
  {
    // this.isLoading=true;
    getData(this.$router.currentRoute).then((data) => 
    {
      setTimeout(() => {
        this.isLoading=false;
      this.$data.options=(data.options)
      },2000);
    });
  }
};

