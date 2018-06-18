<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 18/6/18
 * Time: 1:11 PM
 */

namespace App\Tests\Utils;


use App\Utils\GenerateToken;
use PHPUnit\Framework\TestCase;

class TokenGeneratorTest extends TestCase
{
    public function testTokenGenerator()
    {
        $tokengenerator = new GenerateToken();
        $token = $tokengenerator->generate();


        $this->assertEquals(80,strlen($token));


    }
}