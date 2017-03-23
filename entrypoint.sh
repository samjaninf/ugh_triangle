#!/bin/bash
set -e

# TODO: WRITE the config file from this file.

#echo >&2 "========================================================================"
#echo >&2 "Export the routes file."
#echo >&2 "========================================================================"
#
#ROUTES="./client/app/routes/routes.js"
#
#if [ -f $ROUTES ];
#then
#    echo >&2 "Skipping routes export task. Routes file ${ROUTES} exists already."
#else
#    echo "Exporting routes..."
#    bundle exec rake js:routes
#    echo "Routes exported to ${ROUTES}"
#fi

# possibility 3:


echo >&2 "========================================================================"
echo >&2 "Starting Triangle server"
echo >&2 "========================================================================"
echo >&2 "========================================================================"
echo >&2 "Writing Application .ENV File"
echo >&2 "========================================================================"
if  [ ! -z ${APP_ENV} ]; then
    APP_ENV=production
fi
if  [ ! -z ${APP_DEBUG} ]; then
    APP_DEBUG=false
fi
if  [ ! -z ${APP_KEY} ]; then
    APP_KEY=$(php artisan key:generate --show)
fi
if  [ ! -z ${CACHE_DRIVER} ]; then
    CACHE_DRIVER=file
fi
if  [ ! -z ${SESSION_DRIVER} ]; then
    SESSION_DRIVER=file
fi
if  [ ! -z ${QUEUE_DRIVER} ]; then
    QUEUE_DRIVER=sync
fi
if  [ ! -z ${DB_HOST} ]; then
    DB_HOST=localhost
fi
if  [ ! -z ${DB_USERNAME} ]; then
    DB_USERNAME=root
fi
# APP_KEY=d4J2goqZqvdlwdq0oulZ1ciHf1tCrePS
cat <<EOT >> /var/www/html/.env
APP_ENV=${APP_ENV}
APP_DEBUG=${APP_DEBUG}
APP_KEY=${APP_KEY}
CACHE_DRIVER=${CACHE_DRIVER}
SESSION_DRIVER=${SESSION_DRIVER}
QUEUE_DRIVER=${QUEUE_DRIVER}
DB_HOST=${DB_HOST}
DB_DATABASE=triangle
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}
FACEBOOK_APP_ID=${FACEBOOK_APP_ID}
FACEBOOK_APP_SECRET=${FACEBOOK_APP_SECRET}
LINKEDIN_CLIENT_ID=${LINKEDIN_CLIENT_ID}
LINKEDIN_CLIENT_SECRET=${LINKEDIN_CLIENT_SECRET}
TWITTER_CLIENT_SECRET=${TWITTER_CLIENT_SECRET}
TWITTER_CLIENT_ID=${TWITTER_CLIENT_ID}
BITLY_CLIENT_ID=${BITLY_CLIENT_ID}
BITLY_CLIENT_SECRET=${BITLY_CLIENT_SECRET}
MAILGUN_DOMAIN=${MAILGUN_DOMAIN}
MAILGUN_SECRET=${MAILGUN_SECRET}
EOT
echo >&2 "========================================================================"
echo >&2 "Starting socket server"
echo >&2 "========================================================================"
$(php /var/www/html/artisan sockets:start)
exec "$@"
