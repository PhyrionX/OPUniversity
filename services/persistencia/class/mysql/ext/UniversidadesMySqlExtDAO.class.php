<?php
/**
 * Class that operate on table 'universidades'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class UniversidadesMySqlExtDAO extends UniversidadesMySqlDAO{
	public function buscar($nombre){
		$sql = 'SELECT * FROM universidades u WHERE nombre like ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setString('%' . $nombre . '%');
		return $this->getList($sqlQuery);
	}
	
}
?>