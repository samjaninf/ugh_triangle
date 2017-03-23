<?php
namespace App\Publishers;


use App\Contracts\PublisherInterface;
use Happyr\LinkedIn\LinkedIn;

class LinkedInPage implements PublisherInterface
{

    public function __construct()
    {
        $this->linkedin = new LinkedIn(\Config::get('oauth-5-laravel.Linkedin.client_id'), \Config::get('oauth-5-laravel.Linkedin.client_secret'));
    }

    public function post($post)
    {
        $this->linkedin->setAccessToken($post->profile->access_token);
        if ($post->images != "") {
            foreach (json_decode($post->images, true) as $image) {
                $options = array('json' =>
                    array(
                        'comment' => $post->content . ' ' . $image,
                        'visibility' => array(
                            'code' => 'anyone'
                        )
                    )
                );
                $this->linkedin->post('v1/companies/' . $post->profile->e_id . '/shares?format=json', $options);
            }
        } else {
            $options = array('json' =>
                array(
                    'comment' => $post->content,
                    'visibility' => array(
                        'code' => 'anyone'
                    )
                )
            );
            $this->linkedin->post('v1/companies/' . $post->profile->e_id . '/shares?format=json', $options);
        }

    }
}