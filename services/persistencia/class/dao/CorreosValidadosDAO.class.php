<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
interface CorreosValidadosDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return CorreosValidados 
	 */
	public function load($idCorreosValidados, $email);

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
 	 * @param correosValidado primary key
 	 */
	public function delete($idCorreosValidados, $email);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CorreosValidados correosValidado
 	 */
	public function insert($correosValidado);
	
	/**
 	 * Update record in table
 	 *
 	 * @param CorreosValidados correosValidado
 	 */
	public function update($correosValidado);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdCorreos($value);


	public function deleteByIdCorreos($value);


}
?>