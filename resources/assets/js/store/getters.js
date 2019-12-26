// Get authenticated user
export const me = state => state.me
export const authFollowing = state => state.authFollowing
//Get Loggedin info
export const user = state => state.user
//Get initial data from html

// Get user feed
export const feed = state => state.feed

// Get user profile page
export const categoryPage = state => state.categoryPage

// Get tweet detail
export const tweetDetail = state => state.tweetDetail

// Get suggest follower
export const followerSuggestions = state => state.followSuggestions

// Get open tweet details
export const openTweetDetails = state => state.openTweetDetails

// Get toggle status of loading
export const isLoading = state => state.isLoading

// Get the app name
export const appName = state => state.appName

export const config = state => state.settings

export const listComments = state => state.listComments