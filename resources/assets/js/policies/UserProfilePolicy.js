


export default class UserProfilePolicy
{
    static updateProfile(currentUser,loginUser)
    {

        if(loginUser!=null && loginUser.hasOwnProperty('username'))
        {
             if(loginUser.username==currentUser.username)
            {
                return true;
            }
        }
        
    }
    static viewUserDashboard(currentUser,loginUser)
    {

        if(loginUser!=null && loginUser.hasOwnProperty('username'))
        {
             if(loginUser.username==currentUser.username)
            {
                return true;
            }
        }
        
    }

     static viewFollowButton(currentUser,loginUser)
    {
        if(loginUser!=null && loginUser.hasOwnProperty('username'))
        {
                return true;
        }

    }
   
}