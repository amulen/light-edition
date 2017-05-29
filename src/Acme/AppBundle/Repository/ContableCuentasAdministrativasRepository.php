<?php

namespace Rii\ReportBundle\Repository;

use Rii\PropertyBundle\Repository\EntityRepository;
 use Rii\ReportBundle\Entity\ContableCuentasAdministrativas;
/**
 * ContableCuentasAdministrativasRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContableCuentasAdministrativasRepository extends EntityRepository
{
    static function mapToContableCuentasAdministrativas($dbData) {
    	$cuenta = new ContableCuentasAdministrativas();
 		$cuenta->setId($dbData["cuenta"]);
 		$cuenta->setInmobiliaria($dbData["inmobiliaria"]);
 		$cuenta->setSucursal($dbData["sucursal"]);
 		$cuenta->setNroCuenta($dbData["nro_cuenta"]);
 		$cuenta->setNombre($dbData["nombre"]);
 		$cuenta->setVisible($dbData["visible"]);
 		$cuenta->setTipoCuenta($dbData["tipo_cuenta"]);
 		$cuenta->setTipoCombo($dbData["tipo_combo"]);
 		$cuenta->setTipoComboPersonas($dbData["tipo_combo_personas"]);
 		$cuenta->setNewRecord($dbData["new_record"]);
 		$cuenta->setFecUltAct($dbData["fec_ult_act"]);
 		$cuenta->setBorrado($dbData["borrado"]);
 		$cuenta->setDirty($dbData["dirty"]);
 		return $cuenta;
	}
}