<?php
/**
 * Class that operate on table 'carreras'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class CarrerasMySqlDAO implements CarrerasDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return CarrerasMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM carreras WHERE id_carrera = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM carreras';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM carreras ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param carrera primary key
 	 */
	public function delete($id_carrera){
		$sql = 'DELETE FROM carreras WHERE id_carrera = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id_carrera);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CarrerasMySql carrera
 	 */
	public function insert($carrera){
		$sql = 'INSERT INTO carreras (nombre) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($carrera->nombre);

		$id = $this->executeInsert($sqlQuery);	
		$carrera->idCarrera = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param CarrerasMySql carrera
 	 */
	public function update($carrera){
		$sql = 'UPDATE carreras SET nombre = ? WHERE id_carrera = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($carrera->nombre);

		$sqlQuery->setNumber($carrera->idCarrera);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM carreras';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNombre($value){
		$sql = 'SELECT * FROM carreras WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNombre($value){
		$sql = 'DELETE FROM carreras WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return CarrerasMySql 
	 */
	protected function readRow($row){
		$carrera = new Carrera();
		
		$carrera->idCarrera = $row['id_carrera'];
		$carrera->nombre = $row['nombre'];

		return $carrera;
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
	 * @return CarrerasMySql 
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