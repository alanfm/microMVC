<?php
/**
 * @package System
 * @subpackage Core
 */
namespace System\Core;

/**
 * Classe SQL
 * 
 * Cria uma interface para criação de códigos SQL de forma abstrata
 * para ser usada pela api PDO com os bancos de dados MySql e Postgreslq
 * 
 * @author Alan Freire - alan_freire@msn.com
 * @version 0.2.0
 * @copyright MIT © 2016 - Alan Freire
 */
class SQL
{
    /**
     * Armazena o código SQL
     * @access private
     * 
     * @var string
     */
    private $string;

    /**
     * Armazena se já foi adicionado um where
     * @access private
     * 
     * @var boolean
     */
    private $where;

    /**
     * Method __construct
     * @access public
     * 
     * Constroi o objeto SQL e seta as
     * configurações padrões do objeto.
     */
    public function __construct()
    {
        $this->where = false;
    }

    /**
     * Method insert
     * @access public
     * 
     * Cria uma instrução de inserção em SQL.
     * Onde é passado por parametro o nome da tabela e
     * um vetor associativo com o nome dos campos e seus valores.
     * 
     * @param string
     * @param array
     * @return object
     */
    public function insert($table, $fields)
    {
        if (!is_array($fields)) {
            throw new \Exception("Parametro campos inválido.");

            return;            
        }

        if (!is_string($table)) {
            throw new \Exception("Parametro tabela inválido.");

            return;
        }

        $this->string = sprintf('INSERT INTO %s (%s) VALUES (%s)',
                                $table,
                                implode(', ', array_keys($fields)),
                                implode(', ', array_fill(0, count($fields), '?')));

        return $this;
    }

    /**
     * Method delete
     * @access public
     * 
     * Cria uma instrução SQL de exclusão de tupla
     * 
     * @param string
     * @return object
     */
    public function delete($table)
    {
        if (!is_string($table)) {
            throw new \Exception('Parametro tabela inválido.');

            return;
        }

        $this->string = sprintf('DELETE FROM %s', $table);

        return $this;
    }

    /**
     * Method update
     * @access public
     * 
     * Cria uma instrução SQL de atualização
     * Onde recebe por parametro o nome da tabela, depois um
     * vetor associativo com o nome dos campos e seus valores.
     * 
     * @param string
     * @param array
     * @return object
     */
    public function update($table, $fields)
    {
        if (!is_string($table)) {
            throw new \Exception('Parametro tabela inválido.');

            return;
        }

        if (!is_array($fields)) {
            throw new \Exception('Parametro campos inválido.');
            
            return;
        }

        $this->string = sprintf('UPDATE %s SET %s',
                                $table,
                                implode(' = ?, ', array_keys($fields)) . ' = ?');

        return $this;
    }

    /**
     * Method select
     * @access public
     * 
     * Cria uma instrução SQL de seleção de dados de uma tabela
     * Onde é passado por parametro o nome da tabela e um
     * array associativo com o nome dos campos e seus valores
     * 
     * @param string
     * @param array
     * @return object
     */
    public function select($table, $fields = ['*'])
    {
        if (!is_string($table)) {
            throw new \Exception('Parametro tabela inválido.');

            return;            
        }

        if (!is_array($fields)) {
            throw new \Exception('Parametro campos inválido.');

            return;
        }

        $this->string = sprintf('SELECT %s FROM %s',
                                implode(', ', $fields),
                                $table);
        return $this;
    }

    /**
     * Method where
     * @access public
     * 
     * Cria uma clausula where para o código SQL
     * Onde é passado por parametro um vetor associativo com o nome dos
     * campo e o valor que pode ser uma string ou um vetor com o valor do
     * campo e o operador de comparação.
     * No segundo parametro é o operador booleano AND ou OR
     * 
     * @param array
     * @param string
     * @return object
     */
    public function where($fields, $cond = 'AND')
    {
        if (!is_array($fields)) {
            throw new \Exception('Parametro campos inválido.');

            return;            
        }

        $str = array();

        foreach($fields as $field => $value) {
            if (is_array($value)) {
                $str[] = sprintf('%s %s %s', $field, $value[1], '?');
            } else {
                $str[] = sprintf('%s = %s', $field, '?');
            }
        }

        if ($this->where) {
            $this->string .= sprintf(' AND (%s)', implode(' '.$cond.' ', $str));
        } else {
            $this->string .= sprintf('%s(%s)',
                                     (!$this->where? ' WHERE ': ''),
                                     implode(' '.$cond.' ', $str));
            $this->where = true;
        }

        return $this;
    }

    /**
     * Method orderBy
     * @access public
     * 
     * Cria uma clausula para o código SQL de ordenação por campo
     * Onde é passado por parametro o campo que será ordenado a consulta
     * e o tipo de ordenação crescente ou decrescente.
     * 
     * @param string
     * @param string ASC|DESC
     * @return object
     */
    public function orderBy($field, $order = 'ASC')
    {
        if (!is_string($field)) {
            throw new \Exception('Parametro campo inválido.');
            
            return;
        }

        if (!is_string($order) || !in_array(strtoupper($order), ['ASC', 'DESC'])) {
            throw new \Exception('Parametro ordem inválido. (Valores válido: ASC ou DESC)');
            
            return;
        }

        $this->string .= sprintf(' ORDER BY %s%s', $field, ($order? ' ' . strtoupper($order): ''));
        
        return $this;
    }

    /**
     * Method limit
     * @access public
     * 
     * Cria uma clausula de limit para instrução de seleção do SQL
     * onde é passado um número inteiro por parametro com a quantidade
     * de registros que serão retornado pela consulta
     * 
     * @param integer
     * @return object
     */
    public function limit($number)
    {
        if (!is_integer($number)) {
            throw new \Exception('Parametro número inválido.');
            
            return;
        }

        $this->string .= sprintf(' LIMIT %d', $number);

        return $this;
    }

    /**
     * Method offSet
     * @access public
     * 
     * Cria uma clausula de onde começar a listar os registro de uma consulta sql
     * 
     * @param integer
     * @return object
     */
    public function offSet($number)
    {
        if (!is_integer($number)) {
            throw new \Exception('Parametro número inválido.');
            
            return;
        }

        $this->string .= sprintf(' OFFSET %d', $number);

        return $this;
    }

    /**
     * Method get
     * @access public
     * 
     * Retorna uma string com o código da instrução SQL
     * 
     * @return string
     */
    public function get()
    {
        $this->where = false;
        return $this->string;
    }
}