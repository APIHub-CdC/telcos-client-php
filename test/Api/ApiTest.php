<?php

namespace Telcos\MX\Client;


use \GuzzleHttp\Client;
use \GuzzleHttp\Event\Emitter;
use \GuzzleHttp\Middleware;
use \GuzzleHttp\HandlerStack as handlerStack;

use \Telcos\MX\Client\ApiException;
use \Telcos\MX\Client\Configuration;
use \Telcos\MX\Client\Model\Error;
use \Telcos\MX\Client\ObjectSerializer;
use \Telcos\MX\Client\Interceptor\KeyHandler;
use \Telcos\MX\Client\Interceptor\MiddlewareEvents;
use \Telcos\MX\Client\Api\TelcosApi as Instance;


class ApiTest extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $password = getenv('KEY_PASSWORD');
        $this->signer = new KeyHandler(null, null, $password);

        $events = new MiddlewareEvents($this->signer);
        $handler = handlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));   
        $handler->push($events->verify_signature_header('x-signature'));
        $client = new Client(['handler' => $handler]);

        $config = new Configuration();
        $config->setHost('the_url');
        
        $this->apiInstance = new Instance($client, $config);
        $this->x_api_key = "your_api_key";
        $this->username = "your_username";
        $this->password = "your_password";

    }
    
 public function testGetReporte()
    {
        $domicilio = new \Telcos\MX\Client\Model\DomicilioPeticion();
        $CatalogoEstados = new \Telcos\MX\Client\Model\CatalogoEstados();
        $CatalogoTipoDomicilio = new \Telcos\MX\Client\Model\CatalogoTipoDomicilio();
        $requestTipoAsent = new \Telcos\MX\Client\Model\CatalogoTipoAsentamiento();

        $domicilio->setDireccion(null);
        $domicilio->setColoniaPoblacion(null);
        $domicilio->setDelegacionMunicipio(null);
        $domicilio->setCiudad(null);
        $domicilio->setEstado($CatalogoEstados::CDMX);
        $domicilio->setCP(null);
        $domicilio->setFechaResidencia(null);
        $domicilio->setNumeroTelefono(null);
        $domicilio->setTipoDomicilio($CatalogoTipoDomicilio::C);
        $domicilio->setTipoAsentamiento($requestTipoAsent::_1);

        $persona = new \Telcos\MX\Client\Model\PersonaPeticion();
        $CatalogoResidencia = new \Telcos\MX\Client\Model\CatalogoResidencia();
        $requestEdoCivil = new \Telcos\MX\Client\Model\CatalogoEstadoCivil();
        $requestSexo = new \Telcos\MX\Client\Model\CatalogoSexo();
        
        $persona->setPrimerNombre("NOMBRE");
        $persona->setSegundoNombre(null);
        $persona->setApellidoPaterno("PATERNO");
        $persona->setApellidoMaterno("MATERNO");
        $persona->setApellidoAdicional(null);
        $persona->setFechaNacimiento("1980-01-04");
        $persona->setRfc(null);
        $persona->setCurp(null);
        $persona->setNacionalidad(null);
        $persona->setResidencia($CatalogoResidencia::_1);
        $persona->setEstadoCivil($requestEdoCivil::S);
        $persona->setSexo($requestSexo::M);
        $persona->setClaveElectorIFE(null);
        $persona->setNumeroDependientes(null);
        $persona->setFechaDefuncion(null);
        $persona->setDomicilio($domicilio);       

        $peticion = new \Telcos\MX\Client\Model\Peticion(); 

        $peticion->setFolioOtorgante("1234");
        $peticion->setPersona($persona);

        try {
            $result = $this->apiInstance->getReporte($this->x_api_key, $this->username, $this->password, $peticion);
            if($this->apiInstance->getStatusCode() == 200){
                print_r($result);
            }
        } catch (ApiException $e) {
            echo ' code. Exception when calling ApiTest->testGetReporte: ', $e->getResponseBody(), PHP_EOL;
        }
        $this->assertTrue($this->apiInstance->getStatusCode() == 200);        
    }

}
