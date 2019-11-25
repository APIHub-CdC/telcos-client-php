<?php

namespace Telcos\Client\Model;

use \ArrayAccess;
use \Telcos\Client\ObjectSerializer;

class Servicios implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;
    
    protected static $TelcosSimulacionModelName = 'Servicios';
    
    protected static $TelcosSimulacionTypes = [
        'telefonia_celular' => '\Telcos\Client\Model\TelefoniaCelular',
        'television_paga' => '\Telcos\Client\Model\TelevisionPaga',
        'telefonia_local_distancia' => '\Telcos\Client\Model\TelefoniaLocalDistancia'
    ];
    
    protected static $TelcosSimulacionFormats = [
        'telefonia_celular' => null,
        'television_paga' => null,
        'telefonia_local_distancia' => null
    ];
    
    public static function TelcosSimulacionTypes()
    {
        return self::$TelcosSimulacionTypes;
    }
    
    public static function TelcosSimulacionFormats()
    {
        return self::$TelcosSimulacionFormats;
    }
    
    protected static $attributeMap = [
        'telefonia_celular' => 'telefoniaCelular',
        'television_paga' => 'televisionPaga',
        'telefonia_local_distancia' => 'telefoniaLocalDistancia'
    ];
    
    protected static $setters = [
        'telefonia_celular' => 'setTelefoniaCelular',
        'television_paga' => 'setTelevisionPaga',
        'telefonia_local_distancia' => 'setTelefoniaLocalDistancia'
    ];
    
    protected static $getters = [
        'telefonia_celular' => 'getTelefoniaCelular',
        'television_paga' => 'getTelevisionPaga',
        'telefonia_local_distancia' => 'getTelefoniaLocalDistancia'
    ];
    
    public static function attributeMap()
    {
        return self::$attributeMap;
    }
    
    public static function setters()
    {
        return self::$setters;
    }
    
    public static function getters()
    {
        return self::$getters;
    }
    
    public function getModelName()
    {
        return self::$TelcosSimulacionModelName;
    }
    
    
    
    protected $container = [];
    
    public function __construct(array $data = null)
    {
        $this->container['telefonia_celular'] = isset($data['telefonia_celular']) ? $data['telefonia_celular'] : null;
        $this->container['television_paga'] = isset($data['television_paga']) ? $data['television_paga'] : null;
        $this->container['telefonia_local_distancia'] = isset($data['telefonia_local_distancia']) ? $data['telefonia_local_distancia'] : null;
    }
    
    public function listInvalidProperties()
    {
        $invalidProperties = [];
        return $invalidProperties;
    }
    
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }
    
    public function getTelefoniaCelular()
    {
        return $this->container['telefonia_celular'];
    }
    
    public function setTelefoniaCelular($telefonia_celular)
    {
        $this->container['telefonia_celular'] = $telefonia_celular;
        return $this;
    }
    
    public function getTelevisionPaga()
    {
        return $this->container['television_paga'];
    }
    
    public function setTelevisionPaga($television_paga)
    {
        $this->container['television_paga'] = $television_paga;
        return $this;
    }
    
    public function getTelefoniaLocalDistancia()
    {
        return $this->container['telefonia_local_distancia'];
    }
    
    public function setTelefoniaLocalDistancia($telefonia_local_distancia)
    {
        $this->container['telefonia_local_distancia'] = $telefonia_local_distancia;
        return $this;
    }
    
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }
    
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
    
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
    
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
