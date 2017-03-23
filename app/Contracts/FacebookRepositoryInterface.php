<?php
/**
 * Created by PhpStorm.
 * User: imcod
 * Date: 4/26/2016
 * Time: 6:18 PM
 */

namespace App\Contracts;


use App\Profile;

interface FacebookRepositoryInterface
{

    public function getPageInsights(Profile $profile);

    public function delete($post);

    public function comment($post, $comment);

    public function analyze(Profile $profile);

    public function login($request);

}