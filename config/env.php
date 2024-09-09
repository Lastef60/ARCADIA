<?php
//en php define permet de definir des const

// Pour Arcadia sur MariaDB
define('DB_ARCADIA_HOST', getenv('DB_ARCADIA_HOST'));
define('DB_ARCADIA_PORT', getenv('DB_ARCADIA_PORT'));
define('DB_ARCADIA_NAME', getenv('DB_ARCADIA_NAME'));
define('DB_ARCADIA_USER', getenv('DB_ARCADIA_USER'));
define('DB_ARCADIA_PASSWORD', getenv('DB_ARCADIA_PASSWORD'));

// Pour arcadia_mongodb sur MongoDB
define('DB_MONGO_HOST', getenv('DB_MONGO_HOST'));
define('DB_MONGO_PORT', getenv('DB_MONGO_PORT'));

// Pour Arcadia sur MariaDB
/*define('DB_ARCADIA_HOST', 'localhost');
define('DB_ARCADIA_PORT', '3308');
define('DB_ARCADIA_NAME', 'ARCADIA');
define('DB_ARCADIA_USER', 'root');
define('DB_ARCADIA_PASSWORD', 'Merde60!51S');

// Pour arcadia_mongodb sur MongoDB
define('DB_MONGO_HOST', 'localhost');
define('DB_MONGO_PORT', '27017');*/
