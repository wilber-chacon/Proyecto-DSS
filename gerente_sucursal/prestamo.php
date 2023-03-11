<?php

class Prestamo
{

        private $numPrestamo;
        private $estado_prestamo;
        private $fechaApertura;
        private $monto_prestamo;
        private $porcentajeInteres;
        private $cuotaMensual;
        private $cantYearAPagar;
        private $codigo_cliente;
        private $nombreCliente;
       


        public function __construct()
        {
                $this->numPrestamo= "";
                $this->estado_prestamo= "";
                $this->fechaApertura= "";
                $this->monto_prestamo= "";
                $this->porcentajeInteres= "";
                $this->cuotaMensual= "";
                $this->cantYearAPagar= "";
                $this->codigo_cliente= "";
                $this->nombreCliente= "";
        }





        public function getnumPrestamo()
        {
                return $this->numPrestamo;
        }
        public function setnumPrestamo($numPrestamo_)
        {
                $this->numPrestamo = $numPrestamo_;
        }
        public function getestadoprestamo()
        {
                return $this->estado_prestamo;
        }
        public function setestadoprestamo($estado_prestamo_)
        {
                $this->estado_prestamo = $estado_prestamo_;
        }
        public function getfechaApertura()
        {
                return $this->fechaApertura;
        }
        public function setfechaApertura($fechaApertura_)
        {
                $this->fechaApertura = $fechaApertura_;
        }
        public function getmontoprestamo()
        {
                return $this->monto_prestamo;
        }
        public function setmontoprestamo($monto_prestamo_)
        {
                $this->monto_prestamo = $monto_prestamo_;
        }
        public function getporcentajeInteres()
        {
                return $this->porcentajeInteres;
        }
        public function setporcentajeInteres($porcentajeInteres_)
        {
                $this->porcentajeInteres = $porcentajeInteres_;
        }
        public function getcuotaMensual()
        {
                return $this->cuotaMensual;
        }
        public function setcuotaMensual($cuotaMensual_)
        {
                $this->cuotaMensual = $cuotaMensual_;
        }
        public function getcantYearAPagar()
        {
                return $this->cantYearAPagar;
        }
        public function setcantYearAPagar($cantYearAPagar_)
        {
                $this->cantYearAPagar = $cantYearAPagar_;
        }
        public function getcodigocliente()
        {
                return $this->codigo_cliente;
        }
        public function setcodigocliente($codigo_cliente_)
        {
                $this->codigo_cliente = $codigo_cliente_;
        }
        public function getnombreCliente()
        {
                return $this->nombreCliente;
        }
        public function setnombreCliente($nombreCliente_)
        {
                $this->nombreCliente = $nombreCliente_;
        }

}

?>