<?php

namespace Telcos\MX\Client\Model;

use \ArrayAccess;
use \Telcos\MX\Client\ObjectSerializer;

class TelefoniaLocalDistancia implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;
    
    protected static $telcosModelName = 'TelefoniaLocalDistancia';
    
    protected static $telcosTypes = [
        
    ];
    
    protected static $telcosFormats = [
        
    ];
    
    public static function telcosTypes()
    {
        return self::$telcosTypes;
    }
    
    public static function telcosFormats()
    {
        return self::$telcosFormats;
    }
    
    protected static $attributeMap = [
        
    ];
    
    protected static $setters = [
        
    ];
    
    protected static $getters = [
        
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
        return self::$telcosModelName;
    }
    
    
    
    protected $container = [];
    
    public function __construct(array $data = null)
    {
    }
    
    public function listInvalidProperties()
    {
        $invalidProperties = parent::listInvalidProperties();
        return $invalidProperties;
    }
    
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
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
