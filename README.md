# telcos-client-php

Muestra los domicilios asociados a los crédito telcos de la persona (telefonía celular; televisión de paga; y telefonía local y de larga distancia).

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
- En caso de no contar con uno, ejecutar las instrucciones contenidas en **lib/Interceptor/key_pair_gen.sh** o con los siguientes comandos.
**opcional**: Para cifrar el contenedor, colocar una contraseña en una variable de ambiente.
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

### Paso 2. Cargar el certificado dentro del portal de desarrolladores

 1. Iniciar sesión.
 2. Dar clic en la sección "**Mis aplicaciones**".
 3. Seleccionar la aplicación.
 4. Ir a la pestaña de "**Certificados para @tuApp**".
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/applications.png">
    </p>
 5. Al abrirse la ventana, seleccionar el certificado previamente creado y dar clic en el botón "**Cargar**":
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/upload_cert.png">
    </p>

### Paso 3. Descargar el certificado de Círculo de Crédito dentro del portal de desarrolladores

 1. Iniciar sesión.
 2. Dar clic en la sección "**Mis aplicaciones**".
 3. Seleccionar la aplicación.
 4. Ir a la pestaña de "**Certificados para @tuApp**".
    <p align="center">
        <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/applications.png">
    </p>
 5. Al abrirse la ventana, dar clic al botón "**Descargar**":
    <p align="center">
        <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/download_cert.png">
    </p>
 > Es importante que este contenedor sea almacenado en la siguiente ruta:
 > **/path/to/repository/lib/Interceptor/keypair.p12**
 >
 > Así mismo el certificado proporcionado por Círculo de Crédito en la siguiente ruta:
 > **/path/to/repository/lib/Interceptor/cdc_cert.pem**
- En caso de que no se almacene así, se debe especificar la ruta donde se encuentra el contenedor y el certificado. Ver el siguiente ejemplo:
```php
$password = getenv('KEY_PASSWORD');
$this->signer = new \lae\Client\Interceptor\KeyHandler(
    "/example/route/keypair.p12",
    "/example/route/cdc_cert.pem",
    $password
);
```
 > **NOTA:** Solamente en caso de que el contenedor se haya cifrado, debe colocarse la contraseña en una variable de ambiente e indicar el nombre de la misma, como se ve en la imagen anterior.
 
### Paso 4. Modificar URL y credenciales

 Modificar la URL y las credenciales de acceso a la petición en ***test/Api/ApiTest.php***, como se muestra en el siguiente fragmento de código:

```php
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
```
 
### Paso 5. Capturar los datos de la petición

Es importante contar con el setUp() que se encargará de firmar y verificar la petición. El siguiente  el siguiente fragmento de código es el método que se será ejecutado en la prueba ubicado en ***test/Api/ApiTest.php*** 



> **NOTA:** Los datos de la siguiente petición son solo representativos.


```php
    
public function testGetReporte()
{
    $domicilio = new \Telcos\MX\Client\Model\DomicilioPeticion();
    $CatalogoEstados = new \Telcos\MX\Client\Model\CatalogoEstados();
    $CatalogoTipoDomicilio = new \Telcos\MX\Client\Model\CatalogoTipoDomicilio();
    $requestTipoAsent = new \Telcos\MX\Client\Model\CatalogoTipoAsentamiento();

    $domicilio->setEstado($CatalogoEstados::CDMX);
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
    $persona->setResidencia($CatalogoResidencia::_1);
    $persona->setEstadoCivil($requestEdoCivil::S);
    $persona->setSexo($requestSexo::M);
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

```

## Pruebas unitarias

Para ejecutar las pruebas unitarias:
```sh
./vendor/bin/phpunit
```
[1]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos
