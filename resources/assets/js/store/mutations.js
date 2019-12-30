export const UserLoggedIn = (state, user) => {
    state.user.isLoggedIn = user
}
export const LoggedInUser = (state, user) => {
    state.user.loggedInUser = user
}

export const ADD_ME = (state, user) => {
    state.me = user
}
export const AUTH_FOLLOWING = (state, data) => {
    state.authFollowing = data
}
export const UPDATE_UNREAD_NOTIFICATION_COUNT = (state, count) => {
    state.me.unReadNotificationsCount = count
    
}
export const UPDATE_PROFILE = (state, imageName) => {
    state.me.image = imageName
    state.user.loggedInUser.image=imageName
}
export const UPDATE_ADDRESS = (state, addressName) => {
    state.me.address = addressName
    state.user.loggedInUser.address = addressName
}
export const UPDATE_COUNTRY = (state, countryName) => {
    state.me.country = countryName
    state.user.loggedInUser.country = countryName
}
export const UPDATE_BIO = (state, bioName) => {
    state.me.bio = bioName
    state.user.loggedInUser.bio = bioName
}
export const INCREMENT_FOLLOWERS_COUNT = (state, count) => {
   	state.me.followerCount += count;
}
export const INCREMENT_FOLLOWING_COUNT = (state, count) => {
    state.me.followingCount += count;
}
export const DECREMENT_FOLLOWERS_COUNT = (state, count) => {
   	state.me.followerCount -= count;
}
export const DECREMENT_FOLLOWING_COUNT = (state, count) => {
    state.me.followingCount -= count;
}
export const LIKES_COUNT = (state, likes) => {
    state.likes = likes;
}
export const TOGGLE_LOADING = state => 
{
    state.isLoading = !state.isLoading;
}
export const TOGGLE_LIKED_CURRENT_BLOG = (state, isLikedCurrentBlog) => {
    state.isLikedCurrentBlog = isLikedCurrentBlog;
}

export const SETFLASHMESSAGE = (state, flashdata)=> 
{
    state.flashMessage = flashdata;
}

export const LIST_COMMENTS = (state, comments) => {
	if(state.listComments.length<1)
		state.listComments=comments;
	else
    state.listComments.push(comments);
}