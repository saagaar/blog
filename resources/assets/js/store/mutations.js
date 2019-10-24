export const UserLoggedIn = (state, user) => {
    state.user.isLoggedIn = user
}

export const ADD_ME = (state, user) => {
    state.me = user
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
export const TOGGLE_LOADING = state => 
{
    state.isLoading = !state.isLoading
}

export const LIST_COMMENTS = (state, comments) => {
    state.listComments = comments
}
export const SETFLASHMESSAGE = (state, flashdata)=> 
{
    state.flashMessage = flashdata
}