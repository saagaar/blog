import config from './../config/config.js';
const state = {
    settings:config,
    me: {},
    user:{
        isLoggedIn:false
    },
    feed: [],
    profilePage: {
        profile: {
            bio: ''
        },
        avatar: '',
        username: '',
        tweets: [],
        is_following: false
    },
    tweetDetail: {
        user: {},
        replies: []
    },
    openTweetDetails: null,
    followSuggestions: [],
    isLoading: false,
    appName: 'TheBloggersClub.com'
}
export default state