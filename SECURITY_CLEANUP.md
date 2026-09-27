# Security cleanup applied

This package was cleaned without changing the application's controllers, models, routes, or key-verification logic.

Changes:
- Replaced the obfuscated `public/index.php` with a normal CodeIgniter 4 front controller.
- Removed the unused public `conn.php` endpoint containing separate hard-coded database credentials.
- Removed the unused public `lib.php` endpoint that accepted direct `.so` uploads without the application's authentication flow.
- Removed the exposed `public/error_log` file.
- Removed default/public welcome and static index files that could expose framework information.
- Removed runtime session/log/cache files from the distributable package.
- Added Apache rules to deny common secret/log/backup files and common legacy endpoints.
- Existing `app/Controllers`, `app/Models`, `app/Config/Routes.php`, authentication, key verification, API connection flow, and database configuration were not intentionally removed.

Important: database credentials are still present in the application's existing configuration files because changing them without the correct hosting credentials would break the application. Rotate those credentials on the server if this ZIP was previously exposed.
