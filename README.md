## Installation Guide
1. git clone https://github.com/venussa/testeci_yudha_romadhon
2. go to project workspace and run `composer install`
3. setup database credential on env file
   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_DATABASE=eci`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=root`
5. run `php artisan key:generate` && `php artisan migrate` && `php artisan db:seed`
6. run `php artisan serve --port=80`

## Detail Code
- Task number 1
   - https://github.com/venussa/testeci_yudha_romadhon/commit/714bcb50182ebba4e018313825d66e3ff346dc27
- Task Number 2
   - https://github.com/venussa/testeci_yudha_romadhon/commit/9be28584debb0f020f13a4eca879289ec7fe0080
   - https://github.com/venussa/testeci_yudha_romadhon/commit/5d7d3dc88cc09606ec23f40790f0e9abd1aaf5a3
- Task Number 3
   - https://github.com/venussa/testeci_yudha_romadhon/commit/4112d65dcefd3d83925e93495898aa9978cb0f8c
- Task number 4
   - https://github.com/venussa/testeci_yudha_romadhon/commit/3cb6ea986d9792996563b376bfdaaa2ba7d0ce51
 
## API Documentation
Postman Collection : https://github.com/venussa/testeci_yudha_romadhon/blob/develop/ECII_Postman_Collection.postman_collection.json
