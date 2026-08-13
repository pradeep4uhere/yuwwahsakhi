<?php

return [
    'ips' => env('APP_ENV') === 'local' ? ['*'] : ['*'],
];