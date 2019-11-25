# telcos-client-php

Presenta los creditos de la persona con servicios con domicilio asociado de: telefonía celular; televisión de paga; y, telefonía local y de larga distancia.

## Requisitos

PHP 7.1 ó superior

### Dependencias adicionales
- Se debe contar con las siguientes dependencias de PHP:
    - ext-curl
    - ext-mbstring
- En caso de no ser así, para linux use los siguientes comandos

```sh
#ejemplo con php en versión 7.3 para otra versión colocar php{version}-curl
apt-get install php7.3-curl
apt-get install php7.3-mbstring
```
- Composer [vea como instalar][1]

## Instalación

Ejecutar: `composer install`

## Guía de inicio

### Paso 1. Generar llave y certificado

- Se tiene que tener un contenedor en formato PKCS12.
- En caso de no contar con uno, ejecutar las instrucciones contenidas en **lib/Interceptor/key_pair_gen.sh** ó con los siguientes comandos.
- **opcional**: Para cifrar el contenedor, colocar una contraseña en una variable de ambiente.
```sh
export KEY_PASSWORD=your_password
```
- Definir los nombres de archivos y alias.
```sh
export PRIVATE_KEY_FILE=pri_key.pem
export CERTIFICATE_FILE=certificate.pem
export SUBJECT=/C=MX/ST=MX/L=MX/O=CDC/CN=CDC
export PKCS12_FILE=keypair.p12
export ALIAS=circulo_de_credito
```
- Generar llave y certificado.
```sh
#Genera la llave privada.
openssl ecparam -name secp384r1 -genkey -out ${PRIVATE_KEY_FILE}

#Genera el certificado público.
openssl req -new -x509 -days 365 \
    -key ${PRIVATE_KEY_FILE} \
    -out ${CERTIFICATE_FILE} \
    -subj "${SUBJECT}"
```
- Generar contenedor en formato PKCS12.
```sh
# Genera el archivo pkcs12 a partir de la llave privada y el certificado.
# Deberá empaquetar la llave privada y el certificado.
openssl pkcs12 -name ${ALIAS} \
    -export -out ${PKCS12_FILE} \
    -inkey ${PRIVATE_KEY_FILE} \
    -in ${CERTIFICATE_FILE} -password pass:${KEY_PASSWORD}
```

### Paso 2. Carga del certificado dentro del portal de desarrolladores
 1. Iniciar sesión.
 2. Dar clic en la sección "**Mis aplicaciones**".
 3. Seleccionar la aplicación.
 4. Ir a la pestaña de "**Certificados para @tuApp**".
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/applications.png">
    </p>
 5. Al abrirse la ventana emergente, seleccionar el certificado previamente creado y dar clic en el botón "**Cargar**":
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/upload_cert.png" width="268">
    </p>

### Paso 3. Descarga del certificado de Círculo de Crédito dentro del portal de desarrolladores
 1. Iniciar sesión.
 2. Dar clic en la sección "**Mis aplicaciones**".
 3. Seleccionar la aplicación.
 4. Ir a la pestaña de "**Certificados para @tuApp**".
    <p align="center">
        <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/applications.png">
    </p>
 5. Al abrirse la ventana emergente, dar clic al botón "**Descargar**":
    <p align="center">
        <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/download_cert.png" width="268">
    </p>

 > Es importante que este contenedor sea almacenado en la siguiente ruta:
 > **/path/to/repository/lib/Interceptor/keypair.p12**
 >
 > Así mismo el certificado proporcionado por círculo de crédito en la siguiente ruta:
 > **/path/to/repository/lib/Interceptor/cdc_cert.pem**

- En caso de que no se almacene así, se debe especificar la ruta donde se encuentra el contenedor y el certificado. Ver el siguiente ejemplo:

```php
/**
* Esto es parte del setUp() de las pruebas unitarias.
*/
$password = getenv('KEY_PASSWORD');
$this->signer = new \Telcos\Client\Interceptor\KeyHandler(
    "/example/route/keypair.p12",
    "/example/route/cdc_cert.pem",
    $password
);
```
 > **NOTA:** Sólamente en caso de que el contenedor haya cifrado, se debe colocar la contraseña en una variable de ambiente e indicar el nombre de la misma, como se ve en la imagen anterior.

### Paso 4. Capturar los datos de la petición

Los siguientes datos a modificar se encuentran en ***test/Api/TelcosApiTest.php***

Es importante contar con el setUp() que se encargará de inicializar la url, firmar y verificar la petición. Modificar la URL de la petición del objeto ***$config***, como se muestra en el siguiente fragmento de código:

```php
<?php
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
```
```php

<?php
/**
* Este es el método que se será ejecutado en la prueba ubicado en path/to/repository/test/Api/TelcosApiTest.php 

*/
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
?>
```
## Pruebas unitarias

Para ejecutar las pruebas unitarias:

```sh
./vendor/bin/phpunit
```

[1]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos
