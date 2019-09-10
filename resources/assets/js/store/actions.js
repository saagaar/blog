

export const checkLoginUser = ({ commit }) => {
    // show loading

 window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

    window.axios.get('//localhost:8000/logincheck')
  .then(function (response) {
    // handle success
	  commit('UserLoggedIn', response.data.status );
  });
  




    const instance = axios.create({
    // change this url to your api
    baseURL: '//localhost:8000/login-check',

    // any other headers you want to include
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        // 'X-CSRF-TOKEN': token ? token.content : null
    }
	});
	console.log(instance);
}
