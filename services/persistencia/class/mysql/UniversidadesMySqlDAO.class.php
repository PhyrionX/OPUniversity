<?php
/**
 * Class that operate on table 'universidades'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class UniversidadesMySqlDAO implements UniversidadesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return UniversidadesMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM universidades WHERE id_universidad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM universidades';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM universidades ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param universidade primary key
 	 */
	public function delete($id_universidad){
		$sql = 'DELETE FROM universidades WHERE id_universidad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id_universidad);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param UniversidadesMySql universidade
 	 */
	public function insert($universidade){
		$sql = 'INSERT INTO universidades (nombre, ciudad, fecha_fundacion, src_img) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($universidade->nombre);
		$sqlQuery->set($universidade->ciudad);
		$sqlQuery->set($universidade->fechaFundacion);
		$sqlQuery->set($universidade->srcImg);

		$id = $this->executeInsert($sqlQuery);	
		$universidade->idUniversidad = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param UniversidadesMySql universidade
 	 */
	public function update($universidade){
		$sql = 'UPDATE universidades SET nombre = ?, ciudad = ?, fecha_fundacion = ?, src_img = ? WHERE id_universidad = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($universidade->nombre);
		$sqlQuery->set($universidade->ciudad);
		$sqlQuery->set($universidade->fechaFundacion);
		$sqlQuery->set($universidade->srcImg);

		$sqlQuery->setNumber($universidade->idUniversidad);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM universidades';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNombre($value){
		$sql = 'SELECT * FROM universidades WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCiudad($value){
		$sql = 'SELECT * FROM universidades WHERE ciudad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFechaFundacion($value){
		$sql = 'SELECT * FROM universidades WHERE fecha_fundacion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySrcImg($value){
		$sql = 'SELECT * FROM universidades WHERE src_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNombre($value){
		$sql = 'DELETE FROM universidades WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCiudad($value){
		$sql = 'DELETE FROM universidades WHERE ciudad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFechaFundacion($value){
		$sql = 'DELETE FROM universidades WHERE fecha_fundacion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySrcImg($value){
		$sql = 'DELETE FROM universidades WHERE src_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return UniversidadesMySql 
	 */
	protected function readRow($row){
		$universidade = new Universidade();
		
		$universidade->idUniversidad = $row['id_universidad'];
		$universidade->nombre = $row['nombre'];
		$universidade->ciudad = $row['ciudad'];
		$universidade->fechaFundacion = $row['fecha_fundacion'];
		$universidade->srcImg = $row['src_img'];

		return $universidade;
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
	 * @return UniversidadesMySql 
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