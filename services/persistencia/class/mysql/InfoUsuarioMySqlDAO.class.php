<?php
/**
 * Class that operate on table 'info_usuario'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class InfoUsuarioMySqlDAO implements InfoUsuarioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return InfoUsuarioMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM info_usuario WHERE id_usuario = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM info_usuario';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM info_usuario ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param infoUsuario primary key
 	 */
	public function delete($id_usuario){
		$sql = 'DELETE FROM info_usuario WHERE id_usuario = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id_usuario);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param InfoUsuarioMySql infoUsuario
 	 */
	public function insert($infoUsuario){
		$sql = 'INSERT INTO info_usuario (id_usuario, apellidos, poblacion, src_img, fecha_nacimiento, fecha_creacion, id_carrera, id_universidad) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($infoUsuario->idUsuario);
		$sqlQuery->set($infoUsuario->apellidos);
		$sqlQuery->set($infoUsuario->poblacion);
		$sqlQuery->set($infoUsuario->srcImg);
		$sqlQuery->set($infoUsuario->fechaNacimiento);
		$sqlQuery->set($infoUsuario->fechaCreacion);
		$sqlQuery->setNumber($infoUsuario->idCarrera);
		$sqlQuery->setNumber($infoUsuario->idUniversidad);

		$id = $this->executeInsert($sqlQuery);	
		$infoUsuario->idUsuario = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param InfoUsuarioMySql infoUsuario
 	 */
	public function update($infoUsuario){
		$sql = 'UPDATE info_usuario SET apellidos = ?, poblacion = ?, src_img = ?, fecha_nacimiento = ?, fecha_creacion = ?, id_carrera = ?, id_universidad = ? WHERE id_usuario = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($infoUsuario->apellidos);
		$sqlQuery->set($infoUsuario->poblacion);
		$sqlQuery->set($infoUsuario->srcImg);
		$sqlQuery->set($infoUsuario->fechaNacimiento);
		$sqlQuery->set($infoUsuario->fechaCreacion);
		$sqlQuery->setNumber($infoUsuario->idCarrera);
		$sqlQuery->setNumber($infoUsuario->idUniversidad);

		$sqlQuery->setNumber($infoUsuario->idUsuario);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM info_usuario';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByApellidos($value){
		$sql = 'SELECT * FROM info_usuario WHERE apellidos = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPoblacion($value){
		$sql = 'SELECT * FROM info_usuario WHERE poblacion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySrcImg($value){
		$sql = 'SELECT * FROM info_usuario WHERE src_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFechaNacimiento($value){
		$sql = 'SELECT * FROM info_usuario WHERE fecha_nacimiento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFechaCreacion($value){
		$sql = 'SELECT * FROM info_usuario WHERE fecha_creacion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdCarrera($value){
		$sql = 'SELECT * FROM info_usuario WHERE id_carrera = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdUniversidad($value){
		$sql = 'SELECT * FROM info_usuario WHERE id_universidad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByApellidos($value){
		$sql = 'DELETE FROM info_usuario WHERE apellidos = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPoblacion($value){
		$sql = 'DELETE FROM info_usuario WHERE poblacion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySrcImg($value){
		$sql = 'DELETE FROM info_usuario WHERE src_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFechaNacimiento($value){
		$sql = 'DELETE FROM info_usuario WHERE fecha_nacimiento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFechaCreacion($value){
		$sql = 'DELETE FROM info_usuario WHERE fecha_creacion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdCarrera($value){
		$sql = 'DELETE FROM info_usuario WHERE id_carrera = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdUniversidad($value){
		$sql = 'DELETE FROM info_usuario WHERE id_universidad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return InfoUsuarioMySql 
	 */
	protected function readRow($row){
		$infoUsuario = new InfoUsuario();
		
		$infoUsuario->idUsuario = $row['id_usuario'];
		$infoUsuario->apellidos = $row['apellidos'];
		$infoUsuario->poblacion = $row['poblacion'];
		$infoUsuario->srcImg = $row['src_img'];
		$infoUsuario->fechaNacimiento = $row['fecha_nacimiento'];
		$infoUsuario->fechaCreacion = $row['fecha_creacion'];
		$infoUsuario->idCarrera = $row['id_carrera'];
		$infoUsuario->idUniversidad = $row['id_universidad'];

		return $infoUsuario;
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
	 * @return InfoUsuarioMySql 
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