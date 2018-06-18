<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 18/6/18
 * Time: 1:03 PM
 */

namespace App\Utils;


class GenerateToken
{

    private const CHARACTER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    public const DEFAULT_LENGTH = 80;

    public function generate(int $length = self::DEFAULT_LENGTH)
    {
        $token = '';
        $max = strlen(self::CHARACTER);

        for ($i = 0; $i < $length; $i++) {

            $token .= self::CHARACTER[random_int(0, $max - 1)];

        }

        return $token;
    }
}