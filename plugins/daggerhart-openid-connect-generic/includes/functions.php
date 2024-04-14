<?php
/**
 * Global OIDCG functions.
 *
 * @package   OpenID_Connect_Generic
 * @author    Jonathan Daggerhart <jonathan@daggerhart.com>
 * @copyright 2015-2020 daggerhart
 * @license   http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 */

/**
 * Return a single use authentication URL.
 *
 * @return string
 */
function oidcg_get_authentication_url() {
	return \OpenID_Connect_Generic::instance()->client_wrapper->get_authentication_url();
}

/**
 * Refresh a user claim and update the user metadata.
 *
 * @param WP_User $user             The user object.
 * @param array   $token_response   The token response.
 *
 * @return WP_Error|array
 */
function oidcg_refresh_user_claim( $user, $token_response ) {
	return \OpenID_Connect_Generic::instance()->client_wrapper->refresh_user_claim( $user, $token_response );
}

add_action('openid-connect-generic-update-user-using-current-claim', function( $user, $user_claim) {
    // Based on some data in the user_claim, modify the user.
    if ( array_key_exists( 'groups', $user_claim ) ) {
	if ( in_array('admin',$user_claim['groups'] )) {
            $user->set_role( 'administrator' );
	}
        elseif ( in_array('pr',$user_claim['groups'])) {
		$user->set_role('administrator');
	}	
	elseif (in_array('vorstand',$user_claim['groups'])) {
		$user->set_role('editor');
	}
	else {
		$user->set_role('subscriber');
	}
    }
}, 10, 2);

