


export default class UserProfilePolicy
{
   

    static updateProfile(currentUser,loginUser)
    {
        if(loginUser.hasOwnProperty('username'))
        {
             if(loginUser.username==currentUser.username)
            {
                return true;
            }
        }
        
    }
   
}