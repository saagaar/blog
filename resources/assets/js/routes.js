import VueRouter from 'vue-router';

let routes=[
				{
						path:'/home',
						components:require('./pages/HomePage')
				},
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
						components:require('./pages/Timeline'),
						meta:{layout:"timeline"}
						
				},
				{
						path:'/followers',
						components:require('./pages/FollowersList'),
						meta:{layout:"timeline"}
						
				},
				{
						path:'/followings',
						components:require('./pages/FollowingsList'),
						meta:{layout:"timeline"}
						
				},
				{
						path:'/categories',
						components:require('./pages/InterestCategory')
				},
				{
						path:'/change-password',
						components:require('./pages/ChangePassword')
				},
				{
						path:'/settings',
						components:require('./pages/EditProfile')
				},
				{
						path:'/users/notifications',
						components:require('./pages/AllNotifications')
				},

		   ];

export default new VueRouter({
	routes,

	linkActiveClass: 'active',
	mode: 'history',
	hash: false,
})