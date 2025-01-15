FOLDER=/var/www/html/storage/app
if [ ! -d "$FOLDER" ]; then
    echo "$FOLDER is not a directory, copying storage_ content to storage"
    cp -r /var/www/html/storage_/. /var/www/html/storage
    echo "deleting storage_..."
    rm -rf /var/www/html/storage_
fi

DB_FOLDER=/var/www/html/storage/database
if [ ! -d "$DB_FOLDER" ]; then
    echo "$DB_FOLDER is not a directory, initializing database"
    mkdir -p /var/www/html/storage/database
    touch /var/www/html/storage/database/database.sqlite
fi

# php /var/www/html/artisan migrate --force
# php /var/www/html/artisan db:seed --force
