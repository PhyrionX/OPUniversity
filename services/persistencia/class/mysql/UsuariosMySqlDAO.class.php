<?php
/**
 * Class that operate on table 'usuarios'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class UsuariosMySqlDAO implements UsuariosDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return UsuariosMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM usuarios WHERE id_usuario = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM usuarios';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM usuarios ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param usuario primary key
 	 */
	public function delete($id_usuario){
		$sql = 'DELETE FROM usuarios WHERE id_usuario = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id_usuario);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param UsuariosMySql usuario
 	 */
	public function insert($usuario){
		$sql = 'INSERT INTO usuarios (email, pass, nombre, b_validado, b_borrado) VALUES (?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($usuario->email);
		$sqlQuery->set($usuario->pass);
		$sqlQuery->set($usuario->nombre);
		$sqlQuery->setNumber($usuario->bValidado);
		$sqlQuery->setNumber($usuario->bBorrado);

		$id = $this->executeInsert($sqlQuery);	
		$usuario->idUsuario = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param UsuariosMySql usuario
 	 */
	public function update($usuario){
		$sql = 'UPDATE usuarios SET email = ?, pass = ?, nombre = ?, b_validado = ?, b_borrado = ? WHERE id_usuario = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($usuario->email);
		$sqlQuery->set($usuario->pass);
		$sqlQuery->set($usuario->nombre);
		$sqlQuery->setNumber($usuario->bValidado);
		$sqlQuery->setNumber($usuario->bBorrado);

		$sqlQuery->setNumber($usuario->idUsuario);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM usuarios';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByEmail($value){
		$sql = 'SELECT * FROM usuarios WHERE email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPass($value){
		$sql = 'SELECT * FROM usuarios WHERE pass = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNombre($value){
		$sql = 'SELECT * FROM usuarios WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByBValidado($value){
		$sql = 'SELECT * FROM usuarios WHERE b_validado = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByBBorrado($value){
		$sql = 'SELECT * FROM usuarios WHERE b_borrado = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByEmail($value){
		$sql = 'DELETE FROM usuarios WHERE email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPass($value){
		$sql = 'DELETE FROM usuarios WHERE pass = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNombre($value){
		$sql = 'DELETE FROM usuarios WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByBValidado($value){
		$sql = 'DELETE FROM usuarios WHERE b_validado = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByBBorrado($value){
		$sql = 'DELETE FROM usuarios WHERE b_borrado = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return UsuariosMySql 
	 */
	protected function readRow($row){
		$usuario = new Usuario();
		
		$usuario->idUsuario = $row['id_usuario'];
		$usuario->email = $row['email'];
		$usuario->pass = $row['pass'];
		$usuario->nombre = $row['nombre'];
		$usuario->bValidado = $row['b_validado'];
		$usuario->bBorrado = $row['b_borrado'];

		return $usuario;
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
	 * @return UsuariosMySql 
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