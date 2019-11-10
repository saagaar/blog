


export default class BlogPolicy
{
    // static create(user)
    // {
    //     return user.role === 'editor';
    // }

    // static view(user, post)
    // {
    //     return true;
    // }

    // static delete(user, post)
    // {
    //     return user.id === post.user_id;
    // }

    static update(user, blog)
    {
        if(user.permissions.indexOf('edit all posts')!==-1)
        {
            return user.username === blog.user.username;
        }
         if(user.permissions.indexOf('edit own posts')!==-1)
        {
           return true;
        }
        if (user.permissions=='edit posts more then his point') {
            return false;
        }
    }
}