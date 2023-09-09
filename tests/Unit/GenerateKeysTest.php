<?php

namespace Unit;

use ErrorException;
use OpensCrypt\App\Core\Cypher;
use OpensCrypt\App\Core\GenerateKeys;
use PHPUnit\Framework\TestCase;


class GenerateKeysTest extends TestCase
{
    public GenerateKeys $generateKeys;

    /**
//     * @throws ErrorException
     */
    public function it_generate_keys(): void
    {
        $instance = new GenerateKeys(__DIR__ . '\\');

        $instance->privateKeyFileName   = 'keyPri.pem';
        $instance->publicKeyFileName    = 'keyPub.pem';

        $instance->generate();

        if ($instance->isPem()){
            print_r($instance->getKeysPath());
        }
        else{
            print_r($instance->getKeys());
        }
    }

    /** @test
     * @throws ErrorException
     * @throws \Exception
     */
    public function it_cypher_data_text()
    {
        $cypher = new Cypher('Hello');

        print_r(file_get_contents('./keyPri.pem'));

        print_r(
            $cypher->setCypherKey(file_get_contents('./keyPri.pem'))
            ->getHash()
        );
    }
    
}