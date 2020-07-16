<?php

namespace Telcos\MX\Client\Model;

use \ArrayAccess;
use \Telcos\MX\Client\ObjectSerializer;

class Servicio implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;
    
    protected static $telcosModelName = 'Servicio';
    
    protected static $telcosTypes = [
        'fecha_apertura_cuenta' => 'string',
        'fecha_reporte' => 'string',
        'clave_unidad_monetaria' => '\Telcos\MX\Client\Model\CatalogoMoneda',
        'saldo_actual' => 'float',
        'pago_actual' => 'string',
        'id_domicilio' => 'string',
        'fecha_cierre_cuenta' => 'string',
        'cuenta_actual' => 'string'
    ];
    
    protected static $telcosFormats = [
        'fecha_apertura_cuenta' => 'yyyy-MM-dd',
        'fecha_reporte' => 'yyyy-MM-dd',
        'clave_unidad_monetaria' => null,
        'saldo_actual' => 'float',
        'pago_actual' => null,
        'id_domicilio' => null,
        'fecha_cierre_cuenta' => 'yyyy-MM-dd',
        'cuenta_actual' => null
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
        'fecha_apertura_cuenta' => 'fechaAperturaCuenta',
        'fecha_reporte' => 'fechaReporte',
        'clave_unidad_monetaria' => 'claveUnidadMonetaria',
        'saldo_actual' => 'saldoActual',
        'pago_actual' => 'pagoActual',
        'id_domicilio' => 'idDomicilio',
        'fecha_cierre_cuenta' => 'fechaCierreCuenta',
        'cuenta_actual' => 'cuentaActual'
    ];
    
    protected static $setters = [
        'fecha_apertura_cuenta' => 'setFechaAperturaCuenta',
        'fecha_reporte' => 'setFechaReporte',
        'clave_unidad_monetaria' => 'setClaveUnidadMonetaria',
        'saldo_actual' => 'setSaldoActual',
        'pago_actual' => 'setPagoActual',
        'id_domicilio' => 'setIdDomicilio',
        'fecha_cierre_cuenta' => 'setFechaCierreCuenta',
        'cuenta_actual' => 'setCuentaActual'
    ];
    
    protected static $getters = [
        'fecha_apertura_cuenta' => 'getFechaAperturaCuenta',
        'fecha_reporte' => 'getFechaReporte',
        'clave_unidad_monetaria' => 'getClaveUnidadMonetaria',
        'saldo_actual' => 'getSaldoActual',
        'pago_actual' => 'getPagoActual',
        'id_domicilio' => 'getIdDomicilio',
        'fecha_cierre_cuenta' => 'getFechaCierreCuenta',
        'cuenta_actual' => 'getCuentaActual'
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
        $this->container['fecha_apertura_cuenta'] = isset($data['fecha_apertura_cuenta']) ? $data['fecha_apertura_cuenta'] : null;
        $this->container['fecha_reporte'] = isset($data['fecha_reporte']) ? $data['fecha_reporte'] : null;
        $this->container['clave_unidad_monetaria'] = isset($data['clave_unidad_monetaria']) ? $data['clave_unidad_monetaria'] : null;
        $this->container['saldo_actual'] = isset($data['saldo_actual']) ? $data['saldo_actual'] : null;
        $this->container['pago_actual'] = isset($data['pago_actual']) ? $data['pago_actual'] : null;
        $this->container['id_domicilio'] = isset($data['id_domicilio']) ? $data['id_domicilio'] : null;
        $this->container['fecha_cierre_cuenta'] = isset($data['fecha_cierre_cuenta']) ? $data['fecha_cierre_cuenta'] : null;
        $this->container['cuenta_actual'] = isset($data['cuenta_actual']) ? $data['cuenta_actual'] : null;
    }
    
    public function listInvalidProperties()
    {
        $invalidProperties = [];
        if (!is_null($this->container['cuenta_actual']) && (mb_strlen($this->container['cuenta_actual']) > 25)) {
            $invalidProperties[] = "invalid value for 'cuenta_actual', the character length must be smaller than or equal to 25.";
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
    
    public function getCuentaActual()
    {
        return $this->container['cuenta_actual'];
    }
    
    public function setCuentaActual($cuenta_actual)
    {
        if (!is_null($cuenta_actual) && (mb_strlen($cuenta_actual) > 25)) {
            throw new \InvalidArgumentException('invalid length for $cuenta_actual when calling Servicio., must be smaller than or equal to 25.');
        }
        $this->container['cuenta_actual'] = $cuenta_actual;
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
