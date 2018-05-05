<!DOCTYPE HTML>
<html lang='en'>
<head>
<script>
if(
localStorage.getItem('current_id') |
localStorage.getItem('current_instance') |
localStorage.getItem('current_authtoken')
){
location.href = '/logout';
};
</script>
<?php
require_once('../authorize/mastodon.php');
use HalcyonSuite\HalcyonForMastodon\Mastodon;
use Exception;
$api = new Mastodon();
if ($_GET['code']) {
$domain = htmlspecialchars((string)filter_input(INPUT_GET, 'host'), ENT_QUOTES);
$URL= 'https://'.$domain;
$api->selectInstance($URL);
$response = $api->get_access_token($api->clientWebsite.'/auth?&host='.$domain, htmlspecialchars((string)filter_input(INPUT_GET, 'code'), ENT_QUOTES));
if ($response['html']["access_token"]) {
$access_token = $response['html']["access_token"];
$account_id = $api->accounts_verify_credentials()['html']['id'];
echo "
<script>
localStorage.setItem('current_id','$account_id');
localStorage.setItem('current_instance','$domain');
localStorage.setItem('current_authtoken', '$access_token');
localStorage.setItem('setting_post_stream', 'auto');
localStorage.setItem('setting_post_privacy', 'public');
localStorage.setItem('setting_local_instance', 'default');
localStorage.setItem('setting_search_filter', 'all');
localStorage.setItem('setting_link_previews', 'true');
localStorage.setItem('setting_desktop_notifications', 'true');
location.href = '/';
</script>
";
}
}
?>
<script src="//yastatic.net/jquery/3.2.1/jquery.min.js"></script>
<script src="/assets/js/mastodon.js/mastodon.js"></script>
</head>
<body>
</body>
</html>
