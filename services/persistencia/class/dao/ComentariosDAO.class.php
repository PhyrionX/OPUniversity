<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
interface ComentariosDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Comentarios 
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
 	 * @param comentario primary key
 	 */
	public function delete($id_comentarios);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Comentarios comentario
 	 */
	public function insert($comentario);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Comentarios comentario
 	 */
	public function update($comentario);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByComentario($value);

	public function queryByFecha($value);

	public function queryByBBorrado($value);

	public function queryByIdUsuario($value);

	public function queryByIdApuntes($value);


	public function deleteByComentario($value);

	public function deleteByFecha($value);

	public function deleteByBBorrado($value);

	public function deleteByIdUsuario($value);

	public function deleteByIdApuntes($value);


}
?>