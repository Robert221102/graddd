<?php

namespace App\Core;

use App\Core\DB;
use \PDO;

abstract class Model
{
    protected static $table;

    protected static $primaryKey = 'id';

    protected static $wheres = [];

    public static function all()
    {
        $query = "SELECT * FROM " . static::$table;
        return DB::query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) 
    {
        $query = "SELECT * FROM " . static::$table ." WHERE " . static::$primaryKey . "= :id";
        return DB::query($query, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    }

    public static function paginate($perPage = 10 ,$page = 1)
    {
        $offset = ($page - 1) * $perPage; 

        $query = "SELECT * FROM " . static::$table . " LIMIT {$perPage} OFFSET {$offset}";

        $result = DB::query($query)->fetchAll(PDO::FETCH_ASSOC);

        $countQuery = " SELECT COUNT(*) as total FROM " . static::$table;
        $total = DB::query($countQuery)->fetch(PDO::FETCH_ASSOC)['total'];

        $lastPage = ceil($total / $perPage);

        return [
            'data' => $result,
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => $lastPage 
        ];
    }
    
    public function where($column , $operator , $value)
    {
        static::$wheres[]=[
            'column'=> $column,
            'operator'=>$operator,
            'value'=>$value
        ];

        return $this;
    }

    public function get()
    {
        $query= "SELECT * FROM " . static::$table;

        if(!empty(static::$wheres)){
            $query .=" WHERE ";
            foreach(static::$wheres as $index =>$where){
                if($index !=0){
                    $query .=" AND ";
                }
                $query.=$where['column'] . " " . $where['operator'] . ' : ' . $where['column'];
            }
        }
    
        $stmt = DB::query($query, $this->getWhereParameters());

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getWhereParameters()
    {
        $parameters = [];
        foreach(static::$wheres as $where){
            $parameters[$where['column']] = $where['value'];
        }
        return $parameters;
    }
}
