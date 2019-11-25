<?php

namespace Telcos\Client;

use \GuzzleHttp\Client;
use \GuzzleHttp\HandlerStack;

use \Telcos\Client\Configuration;
use \Telcos\Client\ApiException;
use \Telcos\Client\ObjectSerializer;

class TelcosApiTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $password = getenv('KEY_PASSWORD');
        $this->signer = new \Telcos\Client\Interceptor\KeyHandler(null, null, $password);     

        $events = new \Telcos\Client\Interceptor\MiddlewareEvents($this->signer);
        $handler = \GuzzleHttp\HandlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));
        $handler->push($events->verify_signature_header('x-signature'));

        $client = new \GuzzleHttp\Client(['handler' => $handler, 'verify' => false]);
        $config = new \Telcos\Client\Configuration();
        $config->setHost('the_url');
        
        $this->apiInstance = new \Telcos\Client\Api\TelcosApi($client,$config);
    }    
    
    public function testGetReporte()
    {
        $x_api_key = "your_api_key";
        $username = "your_username";
        $password = "your_password";

        $requestDomicilio = new \Telcos\Client\Model\DomicilioPeticion();
        $requestEstado = new \Telcos\Client\Model\CatalogoEstados();
        $requestTipoDom = new \Telcos\Client\Model\CatalogoTipoDomicilio();
        $requestTipoAsent = new \Telcos\Client\Model\CatalogoTipoAsentamiento();

        $requestDomicilio->setDireccion(null);
        $requestDomicilio->setColonia(null);
        $requestDomicilio->setMunicipio(null);
        $requestDomicilio->setCiudad(null);
        $requestDomicilio->setEstado($requestEstado::CDMX);
        $requestDomicilio->setCodigoPostal(null);
        $requestDomicilio->setFechaResidencia(null);
        $requestDomicilio->setNumeroTelefono(null);
        $requestDomicilio->setTipoDomicilio($requestTipoDom::O);
        $requestDomicilio->setTipoAsentamiento($requestTipoAsent::_0);

        $requestPersona = new \Telcos\Client\Model\PersonaPeticion();
        $requestResidencia = new \Telcos\Client\Model\CatalogoResidencia();
        $requestEdoCivil = new \Telcos\Client\Model\CatalogoEstadoCivil();
        $requestSexo = new \Telcos\Client\Model\CatalogoSexo();
        
        $requestPersona->setPrimerNombre("NOMBRE");
        $requestPersona->setSegundoNombre(null);
        $requestPersona->setApellidoPaterno("PATERNO");
        $requestPersona->setApellidoMaterno("MATERNO");
        $requestPersona->setApellidoAdicional(null);
        $requestPersona->setFechaNacimiento("27-06-1986");
        $requestPersona->setRfc(null);
        $requestPersona->setCurp(null);
        $requestPersona->setNumeroSeguridadSocial(null);
        $requestPersona->setNacionalidad(null);
        $requestPersona->setResidencia($requestResidencia::_1);
        $requestPersona->setEstadoCivil($requestEdoCivil::S);
        $requestPersona->setSexo($requestSexo::M);
        $requestPersona->setClaveElector(null);
        $requestPersona->setNumeroDependientes(null);
        $requestPersona->setFechaDefuncion(null);
        $requestPersona->setDomicilio($requestDomicilio);        

        try {
            $result = $this->apiInstance->getReporte($x_api_key, $username, $password, $requestPersona);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling TelcosApi->getReporte: ', $e->getMessage(), PHP_EOL;
        }
    }

}
