# wordpress_docker

The wordpress instance for the new instance

This service should run under `www.queerreferat.ac`

## Development notes

* This repo is a near complete copy of the wordpress application itself. We can add plugins to the `wordpress/wp-content/plugins` folder directly.
* Most data is dynamically saved in the database. which means the database needs proper backup once in production. While developing refer to the first startup section.

### First Startup

* Complete the 5-minute install.
* Activate the OIDC Plugin.
* Navigate to __Settings >> OpenID Connect Plugin__ and fill in the data from authentik in accordance to <https://goauthentik.io/integrations/services/wordpress/>.
  * Contrary to the guide in the link select `Auto Login - SSO`, `Link Existing Users` and if necessary `Disable SSL Verify` and `Logging`.

### File/Folder Ownershop
* Make sure all files and folders are owned by www-data
```bash
chown -R www-data:www-data [FOLDER]
```

### Notes
We edited the functions.php File and added the following code
```php
add_action('openid-connect-generic-update-user-using-current-claim', function( $user, $user_claim) {
    // Based on some data in the user_claim, modify the user.
    if ( array_key_exists( 'groups', $user_claim ) ) {
	if ( in_array('admin',$user_claim['groups'] )) {
            $user->set_role( 'administrator' );
	}
        elseif ( in_array('pr',$user_claim['groups'])) {
		$user->set_role('editor');
	}	
	elseif (in_array('vorstand',$user_claim['groups'])) {
		$user->set_role('editor');
	}
	else {
		$user->set_role('subscriber');
	}
    }
}, 10, 2);
```
Should this break during an Update pls add it again.
