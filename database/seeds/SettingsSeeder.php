<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::add("site_title", "Triangle");
        \App\Setting::add("site_description", "Triangle is a social network tool that helps you managing / scheduling your posts and profiles in Facebook, LinkedIn and Twitter.");
        \App\Setting::add("site_keywords", "social,scheduling posts,posts");
        \App\Setting::add("tos", "");
        \App\Setting::add("fb_api_key", "");
        \App\Setting::add("fb_api_secret", "");
        \App\Setting::add("twitter_api_key", "");
        \App\Setting::add("twitter_api_secret", "");
        \App\Setting::add("linkedin_api_key", "");
        \App\Setting::add("linkedin_api_secret", "");
        \App\Setting::add("bitly_api_key", "");
        \App\Setting::add("bitly_api_secret", "");
        \App\Setting::add("privacy", "");
        \App\Setting::add("site_author", "Yoan Marinov");
    }
}
