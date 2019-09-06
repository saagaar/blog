import VueRouter from 'vue-router';

let routes=[
				{
						path:'/',
						components:require('./pages/Home')
				},
				{
						path:'/contact',
						components:require('./pages/Contact')
				}
		   ];

export default new VueRouter({
	routes,
	linkActiveClass: 'isActive'
})