#!/usr/bin/env sh

# Install WordPress.
wp core install \
  --title="My wordpress site" \
  --admin_user="wordpress" \
  --admin_password="wordpress" \
  --admin_email="admin@mankis.hr" \
  --url="https://game-score.loc" \
  --skip-email

# Update permalink structure.
wp option update permalink_structure "/%year%/%monthnum%/%postname%/" --skip-themes --skip-plugins

wp config create --dbname=gamescore --dbuser=root --dbhost=mysql --dbpass=root123
