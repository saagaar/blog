import BlogPolicy from './../policies/BlogPolicy';
import PermissionCheck from './../mixins/PermissionCheck.mixin';

/**
* This class is used to implement permission check same as laravel gate /policies
* construct expects @object User
**/
export default class Gate
{
    constructor(user)
    {
     
        this.user=user;
        this.policies = {
            blog: BlogPolicy,
        };
    }

    before()
    {
        return this.user.roles === 'admin';
    }

    allow(action, type, model = null)
    {
        if (this.before()) {
            return true;
        }
       if(type=='' || type===undefined || model=='' || model===undefined)
       {
          return this.user.permissions.indexOf(action) !== -1;
       }
        return this.policies[type][action](this.user, model);
    }

    deny(action, type, model = null)
    {
        return ! this.allow(action, type, model);
    }
    
}