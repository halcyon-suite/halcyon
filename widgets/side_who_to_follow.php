<div class="side_widget what_to_follow">
  <h2>Who to follow</h2>
  <ul class="account_list">
    <li class="account_box what_to_follow_0">
      <div class="icon_box">
	<img id="who-to-follow-avatar-0" src="/assets/images/halcyon_logo.png">
      </div>
      <div class="label_box">
	<a id="who-to-follow-link-0">
	  <h3>
	    <span class="dn emoji_poss" id="who-to-follow-screen-name-0">Loading...</span><br>
	    <span class="un" id="who-to-follow-id-0"></span>
	  </h3>
	</a>
      </div>
    </li>
    <li class="account_box what_to_follow_1">
      <div class="icon_box">
	<img id="who-to-follow-avatar-1" src="/assets/images/halcyon_logo.png">
      </div>
      <div class="label_box">
	<a id="who-to-follow-link-1">
	  <h3>
	    <span class="dn emoji_poss" id="who-to-follow-screen-name-1">Loading...</span><br>
	    <span class="un" id="who-to-follow-id-1"></span>
	  </h3>
	</a>
      </div>
    </li>
    <li class="account_box what_to_follow_2">
      <div class="icon_box">
	<img id="who-to-follow-avatar-2" src="/assets/images/halcyon_logo.png">
      </div>
      <div class="label_box">
	<a id="who-to-follow-link-2">
	  <h3>
	    <span class="dn emoji_poss" id="who-to-follow-screen-name-2">Loading...</span><br>
	    <span class="un" id="who-to-follow-id-2"></span>
	  </h3>
	</a>
      </div>
    </li>
  </ul>
</div>

<?php
  $appSettings = parse_ini_file('config.ini',true);
  $whoToFollowProvider = $appSettings["App"]["who_to_follow_provider"];
?>
<script type="application/javascript">
var whoToFollowProvider = '<?php echo $whoToFollowProvider ?>'
</script>

<script type="application/javascript">
function showWhoToFollow (reply) {
  var users = reply.ids
  var cn
  var index = 0
  var random = Math.floor(Math.random() * 10)
  for (cn = random; cn < users.length; cn = cn + 10) {
    var user
    user = users[cn]
    var img
    if (user.icon) {
      img = user.icon
    } else {
      img = '/assets/images/halcyon_logo.png'
    }
    var name = user.to_id
    var screenName = user.name
    if (index === 0) {
      document.getElementById('who-to-follow-avatar-0').setAttribute('src',img)
      document.getElementById('who-to-follow-id-0').textContent = name
      document.getElementById('who-to-follow-screen-name-0').textContent = screenName
      document.getElementById('who-to-follow-link-0').setAttribute('href','/@' + encodeURI(name))
    } else if (index === 1) {
      document.getElementById('who-to-follow-avatar-1').setAttribute('src',img)
      document.getElementById('who-to-follow-id-1').textContent = name
      document.getElementById('who-to-follow-screen-name-1').textContent = screenName
      document.getElementById('who-to-follow-link-1').setAttribute('href','/@' + encodeURI(name))
    } else if (index === 2) {
      document.getElementById('who-to-follow-avatar-2').setAttribute('src',img)
      document.getElementById('who-to-follow-id-2').textContent = name
      document.getElementById('who-to-follow-screen-name-2').textContent = screenName
      document.getElementById('who-to-follow-link-2').setAttribute('href','/@' + encodeURI(name))
    }
    index = index + 1
    if (index > 2) {
      break
    }
  }
}

function getWhoToFollow () {
  var host = localStorage.getItem("current_instance")
  var user = localStorage.getItem("current_acct")
  if (host && user && whoToFollowProvider) {
    var url
    url = whoToFollowProvider.replace(/{{host}}/g, encodeURIComponent(host))
    url = url.replace(/{{user}}/g, encodeURIComponent(user))
    window.fetch(url, {mode: 'cors'}).then(function (response) {
      if (response.ok) {
        return response.json()
      } else {
        document.getElementById('who-to-follow-link-0').innerHTML = ''
        document.getElementById('who-to-follow-link-0').removeAttribute('href')
        document.getElementById('who-to-follow-link-1').innerHTML = ''
        document.getElementById('who-to-follow-link-1').removeAttribute('href')
        document.getElementById('who-to-follow-link-2').innerHTML = ''
        document.getElementById('who-to-follow-link-2').removeAttribute('href')
      }
    }).then(function (reply) {
      showWhoToFollow(reply)
    })
  }
}

window.addEventListener ('load', function () {
  getWhoToFollow()
}, true)
</script>

