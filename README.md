# Docker for wordpress with wp-cli container
This is simplified version of this Docker-based environment setup https://github.com/chriszarate/docker-wordpress-vip-go
It is created for the workshop so you can quickly install wordpress and test your plugins.

## Set up

1. Clone or fork this repo.

2. Add `game-score.loc` to your `/etc/hosts` file:

   ```
   127.0.0.1 localhost game-score.loc
   ```

3. Run `docker-compose up -d`.


## Install WordPress

```sh
docker-compose run --rm wp-cli install-wp
```

Log in to `http://game-score.loc/wp-admin/` with `wordpress` / `wordpress`.

Alternatively, you can navigate to `http://game-score.loc/` and manually perform WordPress install.


## Configuration

Put project-specific WordPress config in `conf/wp-local-config.php` and PHP ini
changes in `conf/php-local.ini`, which are synced to the container. PHP ini
changes are only reflected when the container restarts. You may also adjust the
Nginx config of the reverse proxy container via `conf/nginx-proxy.conf`.


## HTTPS support

This repo provide HTTPS support out of the box. The setup script generates
self-signed certificates for the domain specified in `.env`. To enforce the use
of HTTPS, comment out (or remove) `HTTPS_METHOD: "nohttps"` from the
`services/proxy/environment` section of `docker-compose.yml`.

You may wish to add the generated root certificate to your system’s trusted root
certificates. This will allow you to browse your dev environment over HTTPS
without accepting a browser security warning. On OS X:

```sh
sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain certs/ca-root/ca.crt
```


## Multiple environments

Multiple instances of this dev environment are possible. Make an additional copy
of this repo with a different folder name. Then, either juggle them by stopping
one and starting another, or modify `/etc/hosts` and `.env` to use another
domain, e.g., `project2.test`.


## Troubleshooting

If your stack is not responding, the most likely cause is that a container has
stopped or failed to start. Check to see if all of the containers are "Up":

```
docker-compose ps
```

If not, inspect the logs for that container, e.g.:

```
docker-compose logs wordpress
```

If your self-signed certs have expired (`ERR_CERT_DATE_INVALID`), simply delete
the `certs/self-signed` directory, run `./certs/create-certs.sh`, and restart
the stack.
