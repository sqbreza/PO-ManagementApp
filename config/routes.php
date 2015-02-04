<?php
/**
 * Created by PhpStorm.
 * User: saquiB
 * Date: 2/4/2015
 * Time: 4:14 PM
 */
return [
    //'<controller:\w+>/<id:\w+>' => '<controller>',
    '<controller:[\w\-]+>/<action:[\w\-]+>/<id:\w+>' => '<controller>/<action>',
    '<controller:[\w\-]+>/<action:[\w\-]+>' => '<controller>/<action>',
];