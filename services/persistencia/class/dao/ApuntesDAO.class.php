<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
interface ApuntesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Apuntes 
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
 	 * @param apunte primary key
 	 */
	public function delete($id_apunte);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Apuntes apunte
 	 */
	public function insert($apunte);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Apuntes apunte
 	 */
	public function update($apunte);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTipo($value);

	public function queryByFechaSubida($value);

	public function queryByArchivo($value);

	public function queryByBBorrado($value);

	public function queryByIdUsuario($value);

	public function queryByIdUniversidad($value);

	public function queryByIdCarrera($value);


	public function deleteByTipo($value);

	public function deleteByFechaSubida($value);

	public function deleteByArchivo($value);

	public function deleteByBBorrado($value);

	public function deleteByIdUsuario($value);

	public function deleteByIdUniversidad($value);

	public function deleteByIdCarrera($value);


}
?>