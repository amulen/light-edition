<?php

namespace Rii\ReportBundle\Repository;

use Rii\PropertyBundle\Repository\EntityRepository;
/**
 * ContableAsientoMovRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContableAsientoMovRepository extends EntityRepository
{

    function __construct($app) {
        parent::__construct($app);
        $this->tableName = "contable_asientos_mov";
        $this->tableId = "movimiento";
    }

    public function getAllWithDebeHaber($fromDate, $toDate, $inmobiliaria, $sucursal) {
        $queryStr = "SELECT  cue.*,  sum(mov.debe)+0 as debe, sum(mov.haber)+0 as haber
       FROM contable_asientos_mov mov
       INNER JOIN contable_asientos asi 
       ON mov.asiento = asi.asiento 
       INNER JOIN contable_cuentas_contables cue
       ON mov.cuenta_contable = cue.cuenta
       WHERE mov.borrado = 'N' AND asi.borrado = 'N' AND cue.borrado = 'N'
       AND asi.inmobiliaria = :inmobiliaria AND asi.sucursal = :sucursal
       AND asi.fecha_hora >= :date_from AND asi.fecha_hora < :date_to
       GROUP BY cue.nro_cuenta
       ORDER BY cue.nro_cuenta ASC";

        $stmt = $this->app['db']->prepare($queryStr);
        $stmt->bindValue("date_from", $fromDate->format('Y-m-d H:i:s'));
        $stmt->bindValue("date_to", $toDate->format('Y-m-d H:i:s'));
        $stmt->bindValue("inmobiliaria", $inmobiliaria);
        $stmt->bindValue("sucursal", $sucursal);
        $stmt->execute();
        $var = $stmt->fetchAll();
        return $var;
    }

    public function lastMovement() {
        $sql = "SELECT *"
                . " FROM ".$this->tableName." mov "
                . " WHERE mov.borrado = 'N' "
                . " ORDER BY mov.fec_ult_act ASC"
                . " LIMIT 1"
                . ";";
        $stmt = $this->app['db'];
        return $stmt->fetchAssoc($sql);
    }
}
