<?php
namespace Estacionamento{
    class Estaciona{
        private $veiculo;
        private $vaga;
        private $dataHoraEntrada;
        private $dataHoraSaida;

        function __construct($veiculo, $vaga){
            $this->veiculo = $veiculo;
            $this->vaga = $vaga;
            $this->dataHoraEntrada = date();
        }
    }
}
?>