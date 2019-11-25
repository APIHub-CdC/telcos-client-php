<?php

namespace Telcos\Client\Model;

use \ArrayAccess;
use \Telcos\Client\ObjectSerializer;

class Respuesta implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;
    
    protected static $TelcosSimulacionModelName = 'Respuesta';
    
    protected static $TelcosSimulacionTypes = [
        'folio_consulta' => 'string',
        'observacion' => 'string',
        'persona' => '\Telcos\Client\Model\PersonaRespuesta',
        'domicilios' => '\Telcos\Client\Model\DomicilioRespuesta[]',
        'servicios' => '\Telcos\Client\Model\Servicios'
    ];
    
    protected static $TelcosSimulacionFormats = [
        'folio_consulta' => null,
        'observacion' => null,
        'persona' => null,
        'domicilios' => null,
        'servicios' => null
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
        'folio_consulta' => 'folioConsulta',
        'observacion' => 'observacion',
        'persona' => 'persona',
        'domicilios' => 'domicilios',
        'servicios' => 'servicios'
    ];
    
    protected static $setters = [
        'folio_consulta' => 'setFolioConsulta',
        'observacion' => 'setObservacion',
        'persona' => 'setPersona',
        'domicilios' => 'setDomicilios',
        'servicios' => 'setServicios'
    ];
    
    protected static $getters = [
        'folio_consulta' => 'getFolioConsulta',
        'observacion' => 'getObservacion',
        'persona' => 'getPersona',
        'domicilios' => 'getDomicilios',
        'servicios' => 'getServicios'
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
        $this->container['folio_consulta'] = isset($data['folio_consulta']) ? $data['folio_consulta'] : null;
        $this->container['observacion'] = isset($data['observacion']) ? $data['observacion'] : null;
        $this->container['persona'] = isset($data['persona']) ? $data['persona'] : null;
        $this->container['domicilios'] = isset($data['domicilios']) ? $data['domicilios'] : null;
        $this->container['servicios'] = isset($data['servicios']) ? $data['servicios'] : null;
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
    
    public function getFolioConsulta()
    {
        return $this->container['folio_consulta'];
    }
    
    public function setFolioConsulta($folio_consulta)
    {
        $this->container['folio_consulta'] = $folio_consulta;
        return $this;
    }
    
    public function getObservacion()
    {
        return $this->container['observacion'];
    }
    
    public function setObservacion($observacion)
    {
        $this->container['observacion'] = $observacion;
        return $this;
    }
    
    public function getPersona()
    {
        return $this->container['persona'];
    }
    
    public function setPersona($persona)
    {
        $this->container['persona'] = $persona;
        return $this;
    }
    
    public function getDomicilios()
    {
        return $this->container['domicilios'];
    }
    
    public function setDomicilios($domicilios)
    {
        $this->container['domicilios'] = $domicilios;
        return $this;
    }
    
    public function getServicios()
    {
        return $this->container['servicios'];
    }
    
    public function setServicios($servicios)
    {
        $this->container['servicios'] = $servicios;
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
