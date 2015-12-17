<?php
/**
 * Class that operate on table 'carreras'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class CarrerasMySqlExtDAO extends CarrerasMySqlDAO{
	public function buscar($nombre){
		$sql = 'SELECT * FROM carreras u WHERE nombre like ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setString('%' . $nombre . '%');
		return $this->getList($sqlQuery);
	}

	
}
?>