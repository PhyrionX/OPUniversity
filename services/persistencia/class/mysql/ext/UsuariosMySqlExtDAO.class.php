<?php
/**
 * Class that operate on table 'usuarios'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-25 15:23
 */
class UsuariosMySqlExtDAO extends UsuariosMySqlDAO{

	public function login($nombre, $pass){
		$sql = 'SELECT * FROM usuarios u WHERE email = ? AND pass = ? and b_borrado = 0';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setString($nombre);
		$sqlQuery->setString($pass);
		return $this->getRow($sqlQuery);
	}

	public function buscar($nombre){
		$sql = 'SELECT * FROM usuarios u WHERE nombre like ? and b_borrado=0';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setString('%' . $nombre . '%');
		return $this->getList($sqlQuery);
	}

	public function baja($id) {
		$sql = 'UPDATE usuarios SET b_borrado = ? WHERE id_usuario = ?';
		$sqlQuery = new SqlQuery($sql);
		

		$sqlQuery->setNumber("1");

		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
}
?>