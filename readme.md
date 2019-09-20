composer require api
composer require nesbot/carbon (to have nice datetime like "5 minutes ago" )

php bin/console make:user
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console make:fixtures
php bin/console doctrine:query:sql 'SELECT * FROM User'
php bin/console make:controller --no-template


To enable the GraphQL support, run composer require webonyx/graphql-php,
when browse /api/graphql.