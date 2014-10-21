<?php

namespace classes;


class OrdenTrabajo {
   private $id;
   private $empleado_id;
   private $cliente_id;
   private $tipo_orden_id;
   private $fecha_entrada;
   private $descripcion_falla;
   private $trabajo_realizado;
   private $fecha_finalizado;
   private $fecha_salida;
   private $importe_trabajo;
   private $nro_factura;
   private $remito_entrega;
   private $presupuesto;
   
   public function __construct($empleado_id, $cliente_id, $tipo_orden_id, $fecha_entrada, $descripcion_falla) {
       $this->empleado_id = $empleado_id;
       $this->cliente_id = $cliente_id;
       $this->tipo_orden_id = $tipo_orden_id;
       $this->fecha_entrada = $fecha_entrada;
       $this->descripcion_falla = $descripcion_falla;
   }

   
   
   public function getEmpleado_id() {
       return $this->empleado_id;
   }

   public function getCliente_id() {
       return $this->cliente_id;
   }

   public function getTipo_orden_id() {
       return $this->tipo_orden_id;
   }

   public function getFecha_entrada() {
       return $this->fecha_entrada;
   }

   public function getDescripcion_falla() {
       return $this->descripcion_falla;
   }

   public function getTrabajo_realizado() {
       return $this->trabajo_realizado;
   }

   public function getFecha_finalizado() {
       return $this->fecha_finalizado;
   }

   public function getFecha_salida() {
       return $this->fecha_salida;
   }

   public function getImporte_trabajo() {
       return $this->importe_trabajo;
   }

   public function getNro_factura() {
       return $this->nro_factura;
   }

   public function getRemito_entrega() {
       return $this->remito_entrega;
   }

   public function getPresupuesto() {
       return $this->presupuesto;
   }

   public function setEmpleado_id($empleado_id) {
       $this->empleado_id = $empleado_id;
   }

   public function setCliente_id($cliente_id) {
       $this->cliente_id = $cliente_id;
   }

   public function setTipo_orden_id($tipo_orden_id) {
       $this->tipo_orden_id = $tipo_orden_id;
   }

   public function setFecha_entrada($fecha_entrada) {
       $this->fecha_entrada = $fecha_entrada;
   }

   public function setDescripcion_falla($descripcion_falla) {
       $this->descripcion_falla = $descripcion_falla;
   }

   public function setTrabajo_realizado($trabajo_realizado) {
       $this->trabajo_realizado = $trabajo_realizado;
   }

   public function setFecha_finalizado($fecha_finalizado) {
       $this->fecha_finalizado = $fecha_finalizado;
   }

   public function setFecha_salida($fecha_salida) {
       $this->fecha_salida = $fecha_salida;
   }

   public function setImporte_trabajo($importe_trabajo) {
       $this->importe_trabajo = $importe_trabajo;
   }

   public function setNro_factura($nro_factura) {
       $this->nro_factura = $nro_factura;
   }

   public function setRemito_entrega($remito_entrega) {
       $this->remito_entrega = $remito_entrega;
   }

   public function setPresupuesto($presupuesto) {
       $this->presupuesto = $presupuesto;
   }


   
}
