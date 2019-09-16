import Form  from './../services/Form.js'
export const checkLoginUser = ({ commit }) => {
    // show loading
    let form=new Form();
    form.get('logincheck').then(response => {
          commit('UserLoggedIn', response.data.status );
      }).catch(e => 
      {
          console.log(e);
      });
}
