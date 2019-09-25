<?php

namespace App\Providers;
use App\Repository\UserInterface;
use App\Repository\AdminUser\AdminUser;
use App\Repository\HelpCatInterface;
use App\Repository\HelpCat\HelpCat;
use App\Repository\AdminRoleInterface;
use App\Repository\AdminRole\AdminRole;
use App\Repository\AdminRolePermissionInterface;
use App\Repository\AdminRolePermission\AdminRolePermission;
use App\Repository\AdminPermissionInterface;
use App\Repository\AdminPermission\AdminPermission;
use App\Repository\CategoryInterface;
use App\Repository\Category\Category;
use App\Repository\SiteoptionInterface;
use App\Repository\SiteOption\SiteOption;
use App\Repository\BlogInterface;
use App\Repository\blog\Blog;
use App\Repository\LocaleInterface;
use App\Repository\locale\Locale;
use Illuminate\Support\ServiceProvider;
use App\Repository\AccountInterface;
use App\Repository\Account\Account;
use App\Repository\RoleInterface;
use App\Repository\Role\Roles;
use App\Repository\PermissionInterface;
use App\Repository\UserPermission\Permissions;
use App\Repository\CmsInterface;
use App\Repository\Cms\Cmss;
use App\Repository\TestimonialInterface;
use App\Repository\Testimonial\Testimonial;
use App\Repository\ServiceInterface;
use App\Repository\Service\Service;
use App\Repository\TeamInterface;
use App\Repository\Team\Team;
use App\Repository\ClientInterface;
use App\Repository\Client\Client;
use App\Repository\BannerInterface;
use App\Repository\Banner\Banner;
use App\Repository\PaymentGatewayInterface;
use App\Repository\PaymentGateway\PaymentGateway;
use App\Repository\SubscriptionManagerInterface;
use App\Repository\SubscriptionManager\SubscriptionManager;
use App\Repository\ContactInterface;
use App\Repository\Contact\Contacts;
use App\Repository\GallerycatInterface;
use App\Repository\GalleryCategory\GalleryCategory;
use App\Repository\GalleryInterface;
use App\Repository\Gallery\Gallery;
use App\Repository\VisitorLogInterface;
use App\Repository\VisitorLog\VisitorLog;
use App\Repository\BlocklistInterface;
use App\Repository\Blocklist\Blocklist;
use App\Repository\SeoInterface;
use App\Repository\Seo\Seo;
use App\Repository\LanguageInterface;
use App\Repository\Language\Language;
use App\Repository\TagInterface;
use App\Repository\Tag\Tag;
use App\Repository\FollowerInterface;
use App\Repository\Follower\Follower;
use App\Repository\LogActivityInterface;
use App\Repository\LogActivity\LogActivity;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserInterface::class, AdminUser::class,User::class);
        $this->app->singleton(HelpcatInterface::class, HelpCat::class);
        $this->app->singleton(AdminPermissionInterface::class, AdminPermission::class);
        $this->app->singleton(AdminRoleInterface::class, AdminRole::class);
        $this->app->singleton(AdminRolePermissionInterface::class, AdminRolePermission::class);
        $this->app->singleton(CategoryInterface::class, Category::class);
        $this->app->singleton(SiteoptionInterface::class, SiteOption::class);
        $this->app->singleton(BlogInterface::class, Blog::class);
        $this->app->singleton(LocaleInterface::class, Locale::class);
        $this->app->singleton(AccountInterface::class, Account::class);
        $this->app->singleton(RoleInterface::class, Roles::class);
        $this->app->singleton(PermissionInterface::class, Permissions::class);
        $this->app->singleton(CmsInterface::class, Cmss::class);
        $this->app->singleton(TestimonialInterface::class, Testimonial::class);
        $this->app->singleton(ServiceInterface::class, Service::class);
        $this->app->singleton(TeamInterface::class, Team::class);
        $this->app->singleton(ClientInterface::class, Client::class);
        $this->app->singleton(BannerInterface::class, Banner::class);
        $this->app->singleton(PaymentGatewayInterface::class, PaymentGateway::class);
        $this->app->singleton(SubscriptionManagerInterface::class, SubscriptionManager::class);
        $this->app->singleton(ContactInterface::class, Contacts::class);
        $this->app->singleton(GallerycatInterface::class, GalleryCategory::class);
        $this->app->singleton(GalleryInterface::class, Gallery::class);
        $this->app->singleton(VisitorLogInterface::class, VisitorLog::class);
        $this->app->singleton(BlocklistInterface::class, Blocklist::class);
        $this->app->singleton(SeoInterface::class, Seo::class);
        $this->app->singleton(LanguageInterface::class, Language::class);
        $this->app->singleton(TagInterface::class, Tag::class);
        $this->app->singleton(FollowerInterface::class, Follower::class);
        $this->app->singleton(LogActivityInterface::class, LogActivity::class);
    }
}
