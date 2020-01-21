import Form  from './../services/Form.js'
export const checkLoginUser = ({ commit }) => {
    // show loading
    let form=new Form();
    form.get('logincheck').then(response => {
          commit('UserLoggedIn', response.data.status );
          commit('LoggedInUser', response.data.data );
      }).catch(e => 
      {
          console.log(e);
      });
}
export const createComments = ({ commit,getters},data) => {
    // show loading
    // let form=new Form();
    data.form.post('/create/comment/'+data.code).then(response => {
      if(response.data.status==true)
      {
          var res=response.data.data;
          res.user={'name':getters.me.name,'image':getters.me.image};
          res.type='newComment';

          commit('LIST_COMMENTS',res);
      }
    
      }).catch(e => 
      {
          console.log(e);
      });
}