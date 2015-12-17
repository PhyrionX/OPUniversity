<?php
/**
 * Class that operate on table 'apuntes'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class ApuntesMySqlExtDAO extends ApuntesMySqlDAO{
	public function getApuntes($value){
		$sql = 'SELECT * FROM apuntes WHERE id_usuario = ? and b_borrado=0';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function buscar($nombre){
		$sql = 'SELECT * FROM apuntes u WHERE titulo like ? and b_borrado=0';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setString('%' . $nombre . '%');
		return $this->getList($sqlQuery);
	}
	
}
?>