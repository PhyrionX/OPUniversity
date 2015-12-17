<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
interface RelacionAmigosDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return RelacionAmigos 
	 */
	public function load($idUsuario1, $idUsuario2);

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
 	 * @param relacionAmigo primary key
 	 */
	public function delete($idUsuario1, $idUsuario2);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param RelacionAmigos relacionAmigo
 	 */
	public function insert($relacionAmigo);
	
	/**
 	 * Update record in table
 	 *
 	 * @param RelacionAmigos relacionAmigo
 	 */
	public function update($relacionAmigo);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByFechaAmistad($value);


	public function deleteByFechaAmistad($value);


}
?>