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
						path:'/saved/blog',
						components:require('./pages/SavedBlog')
				},
				{
						path:'/blog/list',
						components:require('./pages/BlogList')
				},
			
				{
						name:'profile',
						path:'/profile/:username?',
						components:require('./pages/Timeline'),
						meta:{layout:"timeline"}
						
				},
			
				{
						name:'followers',
						path:'/followers/:username?',
						components:require('./pages/FollowersList'),
						meta:{layout:"timeline"}
						
				},
				{
						name:'followings',
						path:'/followings/:username?',
						components:require('./pages/FollowingsList'),
						meta:{layout:"timeline"}
						
				},
				{
						name:'following-suggestion',
						path:'/following/suggestion',
						components:require('./pages/FollowingSuggestion'),
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
				{
						path:'/blog/preview/:blogId/',
						components:require('./pages/BlogPreview')
				},
				
				

		   ];

export default new VueRouter({
	routes,

	linkActiveClass: 'active',
	mode: 'history',
	hash: false,
})