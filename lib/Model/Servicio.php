<?php

namespace Telcos\Client\Model;

use \ArrayAccess;
use \Telcos\Client\ObjectSerializer;

class Servicio implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;
    
    protected static $TelcosSimulacionModelName = 'Servicio';
    
    protected static $TelcosSimulacionTypes = [
        'fecha_apertura_cuenta' => 'string',
        'fecha_reporte' => 'string',
        'clave_unidad_monetaria' => '\Telcos\Client\Model\CatalogoMoneda',
        'saldo_actual' => 'string',
        'pago_actual' => 'string',
        'id_domicilio' => 'string',
        'fecha_cierre_cuenta' => 'string'
    ];
    
    protected static $TelcosSimulacionFormats = [
        'fecha_apertura_cuenta' => 'dd/MM/yyyy',
        'fecha_reporte' => 'dd/MM/yyyy',
        'clave_unidad_monetaria' => null,
        'saldo_actual' => null,
        'pago_actual' => null,
        'id_domicilio' => null,
        'fecha_cierre_cuenta' => 'dd/MM/yyyy'
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
        'fecha_apertura_cuenta' => 'fechaAperturaCuenta',
        'fecha_reporte' => 'fechaReporte',
        'clave_unidad_monetaria' => 'claveUnidadMonetaria',
        'saldo_actual' => 'saldoActual',
        'pago_actual' => 'pagoActual',
        'id_domicilio' => 'idDomicilio',
        'fecha_cierre_cuenta' => 'fechaCierreCuenta'
    ];
    
    protected static $setters = [
        'fecha_apertura_cuenta' => 'setFechaAperturaCuenta',
        'fecha_reporte' => 'setFechaReporte',
        'clave_unidad_monetaria' => 'setClaveUnidadMonetaria',
        'saldo_actual' => 'setSaldoActual',
        'pago_actual' => 'setPagoActual',
        'id_domicilio' => 'setIdDomicilio',
        'fecha_cierre_cuenta' => 'setFechaCierreCuenta'
    ];
    
    protected static $getters = [
        'fecha_apertura_cuenta' => 'getFechaAperturaCuenta',
        'fecha_reporte' => 'getFechaReporte',
        'clave_unidad_monetaria' => 'getClaveUnidadMonetaria',
        'saldo_actual' => 'getSaldoActual',
        'pago_actual' => 'getPagoActual',
        'id_domicilio' => 'getIdDomicilio',
        'fecha_cierre_cuenta' => 'getFechaCierreCuenta'
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
        $this->container['fecha_apertura_cuenta'] = isset($data['fecha_apertura_cuenta']) ? $data['fecha_apertura_cuenta'] : null;
        $this->container['fecha_reporte'] = isset($data['fecha_reporte']) ? $data['fecha_reporte'] : null;
        $this->container['clave_unidad_monetaria'] = isset($data['clave_unidad_monetaria']) ? $data['clave_unidad_monetaria'] : null;
        $this->container['saldo_actual'] = isset($data['saldo_actual']) ? $data['saldo_actual'] : null;
        $this->container['pago_actual'] = isset($data['pago_actual']) ? $data['pago_actual'] : null;
        $this->container['id_domicilio'] = isset($data['id_domicilio']) ? $data['id_domicilio'] : null;
        $this->container['fecha_cierre_cuenta'] = isset($data['fecha_cierre_cuenta']) ? $data['fecha_cierre_cuenta'] : null;
    }
    
    public function listInvalidProperties()
    {
        $invalidProperties = [];
        if (!is_null($this->container['id_domicilio']) && (mb_strlen($this->container['id_domicilio']) > 20)) {
            $invalidProperties[] = "invalid value for 'id_domicilio', the character length must be smaller than or equal to 20.";
        }
        if (!is_null($this->container['id_domicilio']) && (mb_strlen($this->container['id_domicilio']) < 0)) {
            $invalidProperties[] = "invalid value for 'id_domicilio', the character length must be bigger than or equal to 0.";
        }
        return $invalidProperties;
    }
    
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }
    
    public function getFechaAperturaCuenta()
    {
        return $this->container['fecha_apertura_cuenta'];
    }
    
    public function setFechaAperturaCuenta($fecha_apertura_cuenta)
    {
        $this->container['fecha_apertura_cuenta'] = $fecha_apertura_cuenta;
        return $this;
    }
    
    public function getFechaReporte()
    {
        return $this->container['fecha_reporte'];
    }
    
    public function setFechaReporte($fecha_reporte)
    {
        $this->container['fecha_reporte'] = $fecha_reporte;
        return $this;
    }
    
    public function getClaveUnidadMonetaria()
    {
        return $this->container['clave_unidad_monetaria'];
    }
    
    public function setClaveUnidadMonetaria($clave_unidad_monetaria)
    {
        $this->container['clave_unidad_monetaria'] = $clave_unidad_monetaria;
        return $this;
    }
    
    public function getSaldoActual()
    {
        return $this->container['saldo_actual'];
    }
    
    public function setSaldoActual($saldo_actual)
    {
        $this->container['saldo_actual'] = $saldo_actual;
        return $this;
    }
    
    public function getPagoActual()
    {
        return $this->container['pago_actual'];
    }
    
    public function setPagoActual($pago_actual)
    {
        $this->container['pago_actual'] = $pago_actual;
        return $this;
    }
    
    public function getIdDomicilio()
    {
        return $this->container['id_domicilio'];
    }
    
    public function setIdDomicilio($id_domicilio)
    {
        if (!is_null($id_domicilio) && (mb_strlen($id_domicilio) > 20)) {
            throw new \InvalidArgumentException('invalid length for $id_domicilio when calling Servicio., must be smaller than or equal to 20.');
        }
        if (!is_null($id_domicilio) && (mb_strlen($id_domicilio) < 0)) {
            throw new \InvalidArgumentException('invalid length for $id_domicilio when calling Servicio., must be bigger than or equal to 0.');
        }
        $this->container['id_domicilio'] = $id_domicilio;
        return $this;
    }
    
    public function getFechaCierreCuenta()
    {
        return $this->container['fecha_cierre_cuenta'];
    }
    
    public function setFechaCierreCuenta($fecha_cierre_cuenta)
    {
        $this->container['fecha_cierre_cuenta'] = $fecha_cierre_cuenta;
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
