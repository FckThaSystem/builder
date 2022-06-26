<?php

namespace core\Components\Builder;

use Aigletter\Contracts\Builder\BuilderInterface;
use Aigletter\Contracts\Builder\SqlBuilderInterface;

class QueryBuilder implements SqlBuilderInterface
{
    private string $select;

    private string $table;

    private string $where = '';

    private string $order = '';

    private string $limit = '';

    private string $offset = '';


    public function select($columns): \Aigletter\Contracts\Builder\BuilderInterface
    {
        $str = '"SELECT ';
        foreach ($columns as $key => $value){
            if($key < count($columns) - 1){
                $str .= $value . ', ';
            }
            $str .= $value;
        }
        $this->select = $str;
        return $this;
    }

    public function where($conditions): \Aigletter\Contracts\Builder\BuilderInterface
    {
        $str = '';

        if(count($conditions)){
            $count = 0;
            foreach ($conditions as $key => $value){
                $str .= $key . '=' . $value;
                if($count < count($conditions) - 1){
                    $str .= ' AND ';
                }
                $count++;
            }
        }
        $this->where = $str;
        return $this;
    }

    public function table($table): \Aigletter\Contracts\Builder\BuilderInterface
    {
        $str = ' FROM ' . $table;
        $this->table = $str;
        return $this;
    }

    public function limit($limit): \Aigletter\Contracts\Builder\BuilderInterface
    {
        $str = '';
        if($limit){
            $str = ' LIMIT ' . $limit;
        }
        $this->limit = $str;
        return $this;
    }

    public function offset($offset): \Aigletter\Contracts\Builder\BuilderInterface
    {
        $str = '';
        if($offset){
            $str = ' OFFSET ' . $offset;
        }
        $this->offset = $str;
        return $this;
    }

    public function order($order): \Aigletter\Contracts\Builder\BuilderInterface
    {
        $str = '';
        if($order){
            $str = ' ORDER BY ' . $order;
        }

        $this->order = $str;
        return $this;
    }

    public function build(): string
    {
        return $this->select . $this->table . $this->where . $this->order . $this->limit . $this->offset . '"';
    }
}