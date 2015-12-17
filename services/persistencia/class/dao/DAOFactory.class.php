<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return ApuntesDAO
	 */
	public static function getApuntesDAO(){
		return new ApuntesMySqlExtDAO();
	}

	/**
	 * @return CarrerasDAO
	 */
	public static function getCarrerasDAO(){
		return new CarrerasMySqlExtDAO();
	}

	/**
	 * @return ComentariosDAO
	 */
	public static function getComentariosDAO(){
		return new ComentariosMySqlExtDAO();
	}

	/**
	 * @return CorreosValidadosDAO
	 */
	public static function getCorreosValidadosDAO(){
		return new CorreosValidadosMySqlExtDAO();
	}

	/**
	 * @return InfoUsuarioDAO
	 */
	public static function getInfoUsuarioDAO(){
		return new InfoUsuarioMySqlExtDAO();
	}

	/**
	 * @return RelacionAmigosDAO
	 */
	public static function getRelacionAmigosDAO(){
		return new RelacionAmigosMySqlExtDAO();
	}

	/**
	 * @return UniversidadesDAO
	 */
	public static function getUniversidadesDAO(){
		return new UniversidadesMySqlExtDAO();
	}

	/**
	 * @return UsuariosDAO
	 */
	public static function getUsuariosDAO(){
		return new UsuariosMySqlExtDAO();
	}


}
?>