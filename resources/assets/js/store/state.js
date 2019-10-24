import config from './../config/config.js';
const state = {
    settings:config,
    me: {},
    user:{
        isLoggedIn:false,
        followersCount:0,
        followingsCount:0
    },
    feed: [],
    listComments:{},
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
    isLoading: false,
    flashMessage:{},
    appName: 'TheBloggersClub.com'
}
export default state