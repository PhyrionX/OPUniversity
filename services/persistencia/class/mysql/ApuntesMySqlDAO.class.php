<?php
/**
 * Class that operate on table 'apuntes'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class ApuntesMySqlDAO implements ApuntesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ApuntesMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM apuntes WHERE id_apunte = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM apuntes';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM apuntes ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param apunte primary key
 	 */
	public function delete($id_apunte){
		$sql = 'DELETE FROM apuntes WHERE id_apunte = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id_apunte);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ApuntesMySql apunte
 	 */
	public function insert($apunte){
		$sql = 'INSERT INTO apuntes (tipo, fecha_subida, archivo, b_borrado, id_usuario, id_universidad, id_carrera, titulo, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($apunte->tipo);
		$sqlQuery->set($apunte->fechaSubida);
		$sqlQuery->set($apunte->archivo);
		$sqlQuery->setNumber($apunte->bBorrado);
		$sqlQuery->setNumber($apunte->idUsuario);
		$sqlQuery->setNumber($apunte->idUniversidad);
		$sqlQuery->setNumber($apunte->idCarrera);
		$sqlQuery->set($apunte->titulo);
		$sqlQuery->set($apunte->descripcion);
		//echo $sql;
		$id = $this->executeInsert($sqlQuery);	
		$apunte->idApunte = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ApuntesMySql apunte
 	 */
	public function update($apunte){
		$sql = 'UPDATE apuntes SET tipo = ?, fecha_subida = ?, archivo = ?, b_borrado = ?, id_usuario = ?, id_universidad = ?, id_carrera = ?, titulo = ?, descripcion = ? WHERE id_apunte = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($apunte->tipo);
		$sqlQuery->set($apunte->fechaSubida);
		$sqlQuery->set($apunte->archivo);
		$sqlQuery->setNumber($apunte->bBorrado);
		$sqlQuery->setNumber($apunte->idUsuario);
		$sqlQuery->setNumber($apunte->idUniversidad);
		$sqlQuery->setNumber($apunte->idCarrera);
		$sqlQuery->set($apunte->titulo);
		$sqlQuery->set($apunte->descripcion);

		$sqlQuery->setNumber($apunte->idApunte);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM apuntes';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByTipo($value){
		$sql = 'SELECT * FROM apuntes WHERE tipo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFechaSubida($value){
		$sql = 'SELECT * FROM apuntes WHERE fecha_subida = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByArchivo($value){
		$sql = 'SELECT * FROM apuntes WHERE archivo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByBBorrado($value){
		$sql = 'SELECT * FROM apuntes WHERE b_borrado = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdUsuario($value){
		$sql = 'SELECT * FROM apuntes WHERE id_usuario = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdUniversidad($value){
		$sql = 'SELECT * FROM apuntes WHERE id_universidad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdCarrera($value){
		$sql = 'SELECT * FROM apuntes WHERE id_carrera = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTipo($value){
		$sql = 'DELETE FROM apuntes WHERE tipo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFechaSubida($value){
		$sql = 'DELETE FROM apuntes WHERE fecha_subida = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByArchivo($value){
		$sql = 'DELETE FROM apuntes WHERE archivo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByBBorrado($value){
		$sql = 'DELETE FROM apuntes WHERE b_borrado = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdUsuario($value){
		$sql = 'DELETE FROM apuntes WHERE id_usuario = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdUniversidad($value){
		$sql = 'DELETE FROM apuntes WHERE id_universidad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdCarrera($value){
		$sql = 'DELETE FROM apuntes WHERE id_carrera = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ApuntesMySql 
	 */
	protected function readRow($row){
		$apunte = new Apunte();
		
		$apunte->idApunte = $row['id_apunte'];
		$apunte->tipo = $row['tipo'];
		$apunte->fechaSubida = $row['fecha_subida'];
		$apunte->archivo = $row['archivo'];
		$apunte->bBorrado = $row['b_borrado'];
		$apunte->idUsuario = $row['id_usuario'];
		$apunte->idUniversidad = $row['id_universidad'];
		$apunte->idCarrera = $row['id_carrera'];
		$apunte->titulo = $row['titulo'];
		$apunte->descripcion = $row['descripcion'];

		return $apunte;
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
	 * @return ApuntesMySql 
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