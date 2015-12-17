<?php
/**
 * Class that operate on table 'correos_validados'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class CorreosValidadosMySqlDAO implements CorreosValidadosDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return CorreosValidadosMySql 
	 */
	public function load($idCorreosValidados, $email){
		$sql = 'SELECT * FROM correos_validados WHERE id_correos_validados = ?  AND email = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idCorreosValidados);
		$sqlQuery->setNumber($email);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM correos_validados';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM correos_validados ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param correosValidado primary key
 	 */
	public function delete($idCorreosValidados, $email){
		$sql = 'DELETE FROM correos_validados WHERE id_correos_validados = ?  AND email = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idCorreosValidados);
		$sqlQuery->setNumber($email);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CorreosValidadosMySql correosValidado
 	 */
	public function insert($correosValidado){
		$sql = 'INSERT INTO correos_validados (id_correos, id_correos_validados, email) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($correosValidado->idCorreos);

		
		$sqlQuery->setNumber($correosValidado->idCorreosValidados);

		$sqlQuery->setNumber($correosValidado->email);

		$this->executeInsert($sqlQuery);	
		//$correosValidado->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param CorreosValidadosMySql correosValidado
 	 */
	public function update($correosValidado){
		$sql = 'UPDATE correos_validados SET id_correos = ? WHERE id_correos_validados = ?  AND email = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($correosValidado->idCorreos);

		
		$sqlQuery->setNumber($correosValidado->idCorreosValidados);

		$sqlQuery->setNumber($correosValidado->email);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM correos_validados';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdCorreos($value){
		$sql = 'SELECT * FROM correos_validados WHERE id_correos = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdCorreos($value){
		$sql = 'DELETE FROM correos_validados WHERE id_correos = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return CorreosValidadosMySql 
	 */
	protected function readRow($row){
		$correosValidado = new CorreosValidado();
		
		$correosValidado->idCorreosValidados = $row['id_correos_validados'];
		$correosValidado->email = $row['email'];
		$correosValidado->idCorreos = $row['id_correos'];

		return $correosValidado;
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
	 * @return CorreosValidadosMySql 
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