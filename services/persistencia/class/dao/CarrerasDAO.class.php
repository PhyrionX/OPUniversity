<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
interface CarrerasDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Carreras 
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
 	 * @param carrera primary key
 	 */
	public function delete($id_carrera);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Carreras carrera
 	 */
	public function insert($carrera);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Carreras carrera
 	 */
	public function update($carrera);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNombre($value);


	public function deleteByNombre($value);


}
?>