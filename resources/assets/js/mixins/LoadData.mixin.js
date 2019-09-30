import Form from './../services/Form.js'

let getData = function(to,form) {
 // let form=new Form();
    return new Promise((resolve, reject) => {
    let initialState = JSON.parse(window.__INITIAL_STATE__) || {};

    if (!initialState.path || to.path !== initialState.path) 
    {
      form.get('/api'+to.path).then(({ data }) => {
        resolve(data);
      })
    } 
    else 
    {
      form.isLoading=true;
      resolve(initialState);
    }
  });
  
};
export default {
  created () 
  {
  let  form=this.form;
    // this.isLoading=true;
    getData(this.$router.currentRoute,form).then((data) => 
    {
      setTimeout(() => 
      {
        form.isLoading=false;
        this.$data.blogList=(data.blogList)
      },2000);
    });
  }
};

