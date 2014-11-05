<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'mail' => array(
        'name' => 'smtp.googlemail.com',
        'host' => 'smtp.googlemail.com',
        'connection_class' => 'login',
        'connection_config' => array(
            'username' => 'dnaloco@gmail.com',
            'password' => '123',
            'ssl' => 'tls',
            'port' => 587,
            'from' => 'dnaloco@gmail.com'
        )
    )
);
