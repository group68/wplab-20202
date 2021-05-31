# Usage

## Start services
```
docker-compose up -d
```
You should be able to access websites at **localhost:6969**

### Notes
While browsing ecommerce website, you might encounter this file permission denied error:
> **Warning**: fopen(/var/www/html/ecommerce/tmp/cache/describecategories): Failed to open stream: Permission denied

To fix this, grant read/write/executable permission on `ecommerce/tmp/` folder to php service:
```
chmod 747 ecommerce/tmp/
```

## Stop services
```
docker-compose down
