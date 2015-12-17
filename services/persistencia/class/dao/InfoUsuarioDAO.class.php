<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
interface InfoUsuarioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return InfoUsuario 
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
 	 * @param infoUsuario primary key
 	 */
	public function delete($id_usuario);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param InfoUsuario infoUsuario
 	 */
	public function insert($infoUsuario);
	
	/**
 	 * Update record in table
 	 *
 	 * @param InfoUsuario infoUsuario
 	 */
	public function update($infoUsuario);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByApellidos($value);

	public function queryByPoblacion($value);

	public function queryBySrcImg($value);

	public function queryByFechaNacimiento($value);

	public function queryByFechaCreacion($value);

	public function queryByIdCarrera($value);

	public function queryByIdUniversidad($value);


	public function deleteByApellidos($value);

	public function deleteByPoblacion($value);

	public function deleteBySrcImg($value);

	public function deleteByFechaNacimiento($value);

	public function deleteByFechaCreacion($value);

	public function deleteByIdCarrera($value);

	public function deleteByIdUniversidad($value);


}
?>