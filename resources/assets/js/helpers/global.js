  export default{
  getProfileUrl(url) {
              if(url=='' || url==null){
                return '/frontend/images/elements/default-profile.png';
              }
              else if(url.match('(http(s)?://)')!=null){
                return url;
              }
              else if(url.match('www.')!=null){
                return url;
              }
              else{
                return '/uploads/user-images/'+url;
              }
  }
}


