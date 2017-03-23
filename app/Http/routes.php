<?php
Route::group(['middleware' => "guest"], function () {
    //Home Page
    get('/', 'HomeController@index');

    //Sign Up
    get('sign_up', ['uses' => 'RegistrationController@register', 'as' => 'sign_up']);
    post('sign_up', ['uses' => 'RegistrationController@doRegister', 'as' => 'sign_up']);

    //Forgot Password Option
    get('forgot_password', ['uses' => 'ForgotPasswordController@forgotPassword', 'as' => 'forgot_password']);
    post('forgot_password', ['uses' => 'ForgotPasswordController@doForgotPassword', 'as' => 'forgot_password']);

});

//Privacy
get('privacy', ['uses' => 'PrivacyController@index', 'as' => 'privacy']);

//Terms
get('tos', ['uses' => 'TOSController@index', 'as' => 'tos']);

//Normal Login
post('login', ['uses' => 'Auth\\LoginController@login', 'as' => 'login']);

//Login Through Facebook
get('login/fb', 'Auth\\SocialLoginController@loginFb');
get('facebook/callback', 'Auth\\SocialLoginController@doLoginFb');
//Login Through Google Plus
get('google/callback', 'Auth\\SocialLoginController@doAuth');
get('login/gp', 'Auth\\SocialLoginController@loginGp');

//Login Through Twitter
get('login/twitter', 'Auth\\SocialLoginController@loginTwitter');

//LinkedIn Login
get('login/linkedin', 'Auth\\SocialLoginController@loginLinkedIn');

\Route::group(['middleware' => 'auth', 'prefix' => 'app', 'namespace' => "App\\"], function () {
    // Application Dasbhaord
    get('dashboard', 'DashboardController@index');
    //Publishing Page
    get('publishing', ['uses' => 'PublishingController@index', 'as' => 'publishing']);
    //Get Posts
    get('posts/get', ['uses' => 'PublishingController@getPart', 'as' => 'posts.get']);
    //Statistics Page
    get('statistics', ['uses' => 'StatisticsController@index', 'as' => 'statistics']);
    get('statistics/show', ['uses' => 'StatisticsController@show', 'as' => 'statistics.show']);
    // profile Page
    get('profile/{id}', ['uses' => 'ProfileController@show', 'as' => 'profile']);
    // analyzing a profile
    get('profile/{id}/analyze', ['uses' => 'ProfileController@analyze', 'as' => 'profile.analyze']);
    // Profile updating
    get('profile/{id}/update', ['uses' => 'ProfileController@update', 'as' => 'profile.update']);
    // Messages module
    get('messages', ['uses' => 'MessagesController@index', 'as' => 'messages.index']);
    get('messages/create', ['uses' => 'MessagesController@create', 'as' => 'messages.create']);
    get('messages/send', ['uses' => 'MessagesController@create', 'as' => 'messages.send']);
    // Loads Saved Texts
    get('drafts/save', ['uses' => 'PostController@saveDraft', 'as' => 'drafts.save', 'middleware' => 'ajaxOnly']);
    get('drafts/load', ['uses' => 'PostController@loadDrafts', 'as' => 'drafts.load', 'middleware' => 'ajaxOnly']);
    // Notifications Module
    resource('notification', 'NotificationController');
    \Route::group(['middleware' => 'ajaxOnly'], function () {
        // Load last 3 notifications
        get('notificaton/load/last', ['uses' => 'NotificationController@loadLast', 'as' => 'app.notifications.load_last']);
        // Gets the number of notifications
        get('notificaton/load/count', ['uses' => 'NotificationController@count', 'as' => 'app.notifications.load_count']);
        // Seens the notification
        get('notificaton/seen', ['uses' => 'NotificationController@seen', 'as' => 'app.notification.seen']);
    });
    //Connect a profile page
    get('connect', ['uses' => 'ProfileController@connect', 'as' => 'connect']);
    //Team
    get('team', ['uses' => 'TeamController@index', 'as' => 'team.index']);
    //Add a new member to the team
    get('team/add', ['uses' => 'TeamController@add', 'as' => 'team.add']);
    // searches for a member in the team
    get('team/search', ['uses' => 'TeamController@search', 'as' => 'team.search']);
    // removes a member from the team
    get('team/{id}/remove', ['uses' => 'TeamController@remove', 'as' => 'team.remove']);
    // leave the team
    get('team/leave', ['uses' => 'TeamController@leave', 'as' => 'team.leave']);
    // Accept Invitation
    get('invitation/{id}/accept', ['uses' => "InvitationController@accept", "as" => "app.invitation.accept"]);
    // Declines an invitation
    get('invitation/{id}/decline', ['uses' => "InvitationController@decline", "as" => "app.invitation.decline"]);
    // Feeds
    get('feeds', ['uses' => 'FeedsController@index', 'as' => 'feeds']);
    get('feeds/twitter', ['uses' => 'FeedsController@twitter', 'as' => 'feeds.twitter']);
    get('feeds/twitter/change', ['uses' => 'FeedsController@twitterChange', 'as' => 'feeds.twitter']);
    // Feedly Authentication
    get('feeds/feedly/connect', ['uses' => 'FeedlyController@authenticate', 'as' => 'feedly.connect']);
    // Change Password
    post('change_password', ['uses' => 'SettingsController@changePassword', 'as' => 'password.change']);
    // Enabling Profile Ajaxly
    get('turn/profile', 'ProfileController@turn');
    // Deletes a profile
    get('profile/{id}/delete', ['uses' => 'ProfileController@delete', 'as' => 'profile.delete']);
    // Predefined times
    // Jquery file upload
    post('upload', 'UploadController@upload', ['middleware' => 'ajaxOnly']);
    get('upload/delete', 'UploadController@delete', ['middleware' => 'ajaxOnly']);
    // Predefined times index page
    get('ptimes', ['uses' => 'ScheduleController@select', 'as' => 'predefined_times']);
    // Delete a predefined time
    get('ptime/{id}/delete', 'ScheduleController@destroy');
    // Creates a new predefined time
    post('ptime/{pid}', 'ScheduleController@store');
    //Activate Profile
    get('activate/{id}/{type}', 'ProfileController@activate');
    // Posting
    post('post', 'PostController@post');
    // Post deleting
    get('post/{id}/delete', ['uses' => 'PostController@destroy', 'as' => 'post.delete']);
    //Connecting To Profile

    // Facebook profile connection
    get('connect/fb_profile', ['uses' => 'ConnectionController@fb_profile', 'as' => 'connect.facebook_profile']);
    get('connect/fb_page', ['uses' => 'ConnectionController@fb_page', 'as' => 'connect.facebook_page']);
    post('connect/fb_page', ['uses' => 'ConnectionController@connectFbPage', 'as' => 'connect.facebook_page']);
    get('connect/fb_group', ['uses' => 'ConnectionController@fb_group', 'as' => 'connect.facebook_group']);
    post('connect/fb_group', ['uses' => 'ConnectionController@connectFbGroup', 'as' => 'connect.facebook_group']);
    get('connect/fb_event', ['uses' => 'ConnectionController@fb_event', 'as' => 'connect.facebook_event']);
    post('connect/fb_event', ['uses' => 'ConnectionController@connectFbEvent', 'as' => 'connect.facebook_event']);
    //Connect Twitter
    get('connect/twitter', ['uses' => 'ConnectionController@twitter', 'as' => 'connect.twitter']);
    get('twitter/callback', ['as' => 'twitter.callback', 'uses' => 'ConnectionController@connectTwitter']);
    //Connect LinkedIn
    get('connect/linkedin', ['uses' => 'ConnectionController@linkedin', 'as' => 'connect.linkedin']);
    get('connect/linkedin_page', ['uses' => 'ConnectionController@linkedin_page', 'as' => 'connect.linkedin_page']);
    post('connect/linkedin_page', ['uses' => 'ConnectionController@connectLinkedinPage', 'as' => 'connect.linkedin_page']);
    //Connect Pinterest
    get('connect/pinterest', ['uses' => 'ConnectionController@pinterest', 'as' => 'connect.pinterest']);
    get('connect/pinterest_c', ['uses' => 'ConnectionController@connectPinterest', 'as' => 'connect.pinterest']);

    // Index page of bitlys
    get('bitly', ['uses' => 'BitlyController@index', 'as' => 'bitly']);
    // Pre-connect request
    get('preconnect/bitly/{pid}', 'BitlyController@preConnect');
    // Connects a single profile
    get('connect/bitly', 'BitlyController@connect');
    // Connects all profiles
    get('connect/bitly/all', 'BitlyController@connectAll');
    // Disconnect a profile
    get('disconnect/bitly/{pid}', 'BitlyController@disconnect');

    Route::group(['middleware' => 'ajaxOnly'], function () {
        // Creating a comment
        get('comment/create', 'CommentsController@create');
        // Loading all comments ajaxly
        get('comments/load', 'CommentsController@load');
    });
//    post('connect/pinterest_board', 'ConnectionController@connectPinterestBoard');
//    get('pinterest/boards', 'ConnectionController@pinterestBoards');
    //Settings
    get('settings', ['uses' => 'SettingsController@index', 'as' => 'app.settings']);
    // Updating settings
    post('settings', ['uses' => 'SettingsController@update', 'as' => 'app.settings.update']);
    // Watermark
    get('watermark/{id}', ['uses' => 'WatermarkController@index', 'as' => 'watermark']);
    // Uploading a watermark
    post('watermark/{id}', 'WatermarkController@upload');
    // Updating the watermark
    post('watermark/{id}/update', 'WatermarkController@update');
    //Manage Profiles
    get('profiles/manage', ['uses' => 'ProfileController@manage', 'as' => 'manage_profiles']);
    //Log Out
    get('logout', ['uses' => 'LogoutController@logout', 'as' => 'logout']);
});

/*
 * ADMIN PANEL
 */

/*
 * Admin panel login
 */
Route::get('admin/login', 'Admin\\DashboardController@login');
Route::post('admin/login', 'Admin\\DashboardController@doLogin');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
    // Dashboard
    Route::get('dashboard', 'DashboardController@index');
    // Translations TO-DO
    Route::get('translations', 'DashboardController@translations');
    // Settings page
    Route::get('settings', ['uses' => 'SettingsController@index', 'as' => 'settings']);
    // Update settings page
    Route::post('settings', ['uses' => 'SettingsController@update', 'as' => 'settings.update']);
    // Users CRUD
    Route::resource('users', 'UsersController');
    // Log-out
    Route::get('logout', 'DashboardController@logout');
});
