<?php
/**
 * Class that operate on table 'comentarios'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class ComentariosMySqlDAO implements ComentariosDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ComentariosMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM comentarios WHERE id_comentarios = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM comentarios';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM comentarios ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param comentario primary key
 	 */
	public function delete($id_comentarios){
		$sql = 'DELETE FROM comentarios WHERE id_comentarios = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id_comentarios);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ComentariosMySql comentario
 	 */
	public function insert($comentario){
		$sql = 'INSERT INTO comentarios (comentario, fecha, b_borrado, id_usuario, id_apuntes) VALUES (?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($comentario->comentario);
		$sqlQuery->set($comentario->fecha);
		$sqlQuery->setNumber($comentario->bBorrado);
		$sqlQuery->setNumber($comentario->idUsuario);
		$sqlQuery->setNumber($comentario->idApuntes);

		$id = $this->executeInsert($sqlQuery);	
		$comentario->idComentarios = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ComentariosMySql comentario
 	 */
	public function update($comentario){
		$sql = 'UPDATE comentarios SET comentario = ?, fecha = ?, b_borrado = ?, id_usuario = ?, id_apuntes = ? WHERE id_comentarios = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($comentario->comentario);
		$sqlQuery->set($comentario->fecha);
		$sqlQuery->setNumber($comentario->bBorrado);
		$sqlQuery->setNumber($comentario->idUsuario);
		$sqlQuery->setNumber($comentario->idApuntes);

		$sqlQuery->setNumber($comentario->idComentarios);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM comentarios';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByComentario($value){
		$sql = 'SELECT * FROM comentarios WHERE comentario = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFecha($value){
		$sql = 'SELECT * FROM comentarios WHERE fecha = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByBBorrado($value){
		$sql = 'SELECT * FROM comentarios WHERE b_borrado = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdUsuario($value){
		$sql = 'SELECT * FROM comentarios WHERE id_usuario = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdApuntes($value){
		$sql = 'SELECT * FROM comentarios WHERE id_apuntes = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByComentario($value){
		$sql = 'DELETE FROM comentarios WHERE comentario = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFecha($value){
		$sql = 'DELETE FROM comentarios WHERE fecha = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByBBorrado($value){
		$sql = 'DELETE FROM comentarios WHERE b_borrado = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdUsuario($value){
		$sql = 'DELETE FROM comentarios WHERE id_usuario = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdApuntes($value){
		$sql = 'DELETE FROM comentarios WHERE id_apuntes = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ComentariosMySql 
	 */
	protected function readRow($row){
		$comentario = new Comentario();
		
		$comentario->idComentarios = $row['id_comentarios'];
		$comentario->comentario = $row['comentario'];
		$comentario->fecha = $row['fecha'];
		$comentario->bBorrado = $row['b_borrado'];
		$comentario->idUsuario = $row['id_usuario'];
		$comentario->idApuntes = $row['id_apuntes'];

		return $comentario;
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
	 * @return ComentariosMySql 
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