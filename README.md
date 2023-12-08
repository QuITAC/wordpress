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
