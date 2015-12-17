<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
interface UniversidadesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Universidades 
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
 	 * @param universidade primary key
 	 */
	public function delete($id_universidad);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Universidades universidade
 	 */
	public function insert($universidade);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Universidades universidade
 	 */
	public function update($universidade);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNombre($value);

	public function queryByCiudad($value);

	public function queryByFechaFundacion($value);

	public function queryBySrcImg($value);


	public function deleteByNombre($value);

	public function deleteByCiudad($value);

	public function deleteByFechaFundacion($value);

	public function deleteBySrcImg($value);


}
?>