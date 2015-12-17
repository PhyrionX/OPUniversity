<?php
/**
 * Class that operate on table 'relacion_amigos'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class RelacionAmigosMySqlDAO implements RelacionAmigosDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return RelacionAmigosMySql 
	 */
	public function load($idUsuario1, $idUsuario2){
		$sql = 'SELECT * FROM relacion_amigos WHERE id_usuario1 = ?  AND id_usuario2 = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idUsuario1);
		$sqlQuery->setNumber($idUsuario2);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM relacion_amigos';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM relacion_amigos ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param relacionAmigo primary key
 	 */
	public function delete($idUsuario1, $idUsuario2){
		$sql = 'DELETE FROM relacion_amigos WHERE id_usuario1 = ?  AND id_usuario2 = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idUsuario1);
		$sqlQuery->setNumber($idUsuario2);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param RelacionAmigosMySql relacionAmigo
 	 */
	public function insert($relacionAmigo){
		$sql = 'INSERT INTO relacion_amigos (fecha_amistad, id_usuario1, id_usuario2) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($relacionAmigo->fechaAmistad);

		
		$sqlQuery->setNumber($relacionAmigo->idUsuario1);

		$sqlQuery->setNumber($relacionAmigo->idUsuario2);

		$this->executeInsert($sqlQuery);	
		//$relacionAmigo->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param RelacionAmigosMySql relacionAmigo
 	 */
	public function update($relacionAmigo){
		$sql = 'UPDATE relacion_amigos SET fecha_amistad = ? WHERE id_usuario1 = ?  AND id_usuario2 = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($relacionAmigo->fechaAmistad);

		
		$sqlQuery->setNumber($relacionAmigo->idUsuario1);

		$sqlQuery->setNumber($relacionAmigo->idUsuario2);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM relacion_amigos';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByFechaAmistad($value){
		$sql = 'SELECT * FROM relacion_amigos WHERE fecha_amistad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByFechaAmistad($value){
		$sql = 'DELETE FROM relacion_amigos WHERE fecha_amistad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return RelacionAmigosMySql 
	 */
	protected function readRow($row){
		$relacionAmigo = new RelacionAmigo();
		
		$relacionAmigo->idUsuario1 = $row['id_usuario1'];
		$relacionAmigo->idUsuario2 = $row['id_usuario2'];
		$relacionAmigo->fechaAmistad = $row['fecha_amistad'];

		return $relacionAmigo;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return RelacionAmigosMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>