<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
interface UsuariosDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Usuarios 
	 */
	public function load($id);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param usuario primary key
 	 */
	public function delete($id_usuario);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Usuarios usuario
 	 */
	public function insert($usuario);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Usuarios usuario
 	 */
	public function update($usuario);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByEmail($value);

	public function queryByPass($value);

	public function queryByNombre($value);

	public function queryByBValidado($value);

	public function queryByBBorrado($value);


	public function deleteByEmail($value);

	public function deleteByPass($value);

	public function deleteByNombre($value);

	public function deleteByBValidado($value);

	public function deleteByBBorrado($value);


}
?>