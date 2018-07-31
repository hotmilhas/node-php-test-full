<?php
namespace Estacionamento{
    class Pagamento{
        private $estaciona;
        private $dataHora;
        private $valor;

        function __construct($estaciona){
            $this->estaciona = $estaciona;
            $this->dataHora = date();
        }
    }
}
?>