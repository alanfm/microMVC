<?php

/**
 * @package System\Core
 */
namespace System\Core;

/**
 * Classe ConnectionPDO
 *
 * Cria uma instancia da api PDO
 *
 * @author Alan Freire <alan_freire@msn.com>
 */
final class ConnectionPDO
{
	private $conn;

	public function __construct($host, $database = 'mysql', $dbname, $user, $pass)
	{
		try {
			switch ($database) {
				case 'mysql':
					$this->conn = new \PDO(sprintf('mysql:host=%s;port=3306;dbname=%s;charset=utf8', $host, $dbname),
								           $user,
								           $pass);
					break;

				case 'pgsql':
				case 'postgres':
				case 'postgresql':
					$this->conn = new \PDO(sprintf('pgsql:host=%s;port=5432;dbname=%s;charset=utf8', $host, $dbname),
								           $user,
								           $pass);
					break;				
			}

			$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (\PDOExcetion $e) {
			die (sprintf('Erro ao conectar-se com o banco de dados: %s', $e->getMessage()));
		}
	}

	public function get()
	{
		return $this->conn;
	}
}