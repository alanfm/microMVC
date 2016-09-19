<?php

namespace System\Core;

class SQL
{
    private $string;
    private $where;

    public function __construct()
    {
        $this->string = '';
        $this->where = false;
    }

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

    public function delete($table)
    {
        if (!is_string($table)) {
            throw new \Exception('Parametro tabela inválido.');

            return;
        }

        if (!is_array($field)) {
            throw new \Exception('Parametro campo inválido.');
            
            return;
        }

        $this->string = sprintf('DELETE FROM %s', $table);

        return $this;
    }

    public function update($table, $fields, $field)
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

    public function select($table, $fields = ['*'])
    {
        $this->string = sprintf('SELECT %s FROM %s',
                                implode(', ', $fields),
                                $table);
        $this->where = false;
        return $this;
    }

    public function where($fields, $cond = 'AND')
    {
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

    public function orderBy($field, $order = null)
    {
        $this->string .= sprintf(' ORDER BY %s%s', $field, ($order? ' ' . strtoupper($order): ''));
        
        return $this;
    }

    public function limit($number)
    {
        $this->string .= sprintf(' LIMIT %d', $number);

        return $this;
    }

    public function get()
    {
        return $this->string;
    }
}