{!! tr('Hello') !!},<br><br>

{!! tr(":username_invites_you_to_join_the_:site", ['username' => $user->name, 'site' => site_option("site_title")]) !!}.
<br>
{!! tr('if_you_accept_you_will_have_access_to_all_of_his_posts') !!}<br>
<a href="{!! url('sign_up?ref='.\Crypt::encrypt($user->id).'&email='.$email) !!}">{!! tr('join') !!}</a>
@include('email.parts.footer')