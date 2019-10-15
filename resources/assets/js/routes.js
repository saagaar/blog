import VueRouter from 'vue-router';

let routes=[
				
				{
						path:'/blog/add',
						components:require('./pages/AddBlogStep1')
				},
				{
						path:'/blog/edit/:blogId/',
						components:require('./pages/AddBlogStep1')
				},
				{
						path:'/blog/edit/:blogId/step2',
						components:require('./pages/AddBlogStep2')
				},
				{
						path:'/dashboard',
						components:require('./pages/Dashboard')
				},
				{
						path:'/blog/list',
						components:require('./pages/BlogList')
				},
				{
						path:'/profile',
						components:require('./pages/EditProfile')
				},
				{
						path:'/categories',
						components:require('./pages/InterestCategory')
				},
				{
						path:'/change-password',
						components:require('./pages/ChangePassword')
				},

		   ];

export default new VueRouter({
	routes,

	linkActiveClass: 'isActive',
	mode: 'history',
	hash: false,
})