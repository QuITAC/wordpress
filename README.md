# wordpress_docker

The wordpress instance for the new instance

This service should run under `www.queerreferat.ac`

## Development notes

* installing plugins beforehand via script in the container is quite cumbersome. We probably have to do this manually by clicking through the interface and documenting every step we take
* even though no physical location has been given for the volumes they still exist. even when doing `dc down`. this means for a full reset you would have to delete the volumes for the db and probably wordpress itself.

## STate

Authentik throws after setup after manual (see wordpress.md in docs folder):

```text
Redirect URI Error
The request fails due to a missing, invalid, or mismatching redirection URI (redirect_uri).
```

Investigate. Hopefully, just a typo.
