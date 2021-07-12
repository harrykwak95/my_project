<?php
class DatabaseTable
{
    private $pdo;
    private $table;
    private $primarykey;

    public function __construct(PDO $pdo, string $table, string $primarykey) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primarykey = $primarykey;
    }

    /**
     * 쿼리 실행
     */

     private function query($sql, $parameters=[])
     {
        $query = $this -> pdo -> prepare($sql);
        $query->execute($parameters);
        return $query;
    }
    
    /**
     * 테이블 전체 로우 실행
     */
    public function total()
    {
        $query = $this->query('SELECT COUNT(*)
        FROM `' . $this->table . '`');
        $row = $query->fetch();
        return $row[0];
    }
    /**
     * ID로 테이블 데이터 가져오기
     */
     public function findById($value)
     {
        $query = 'SELECT * FROM `' . $this->table . '`
        WHERE `'. $this->primarykey . '` =:value';
    
        $parameters = [
            'value' => $value
        ];
    
        $query = $this->query($query, $parameters);
    
        return $query->fetch();
    }
    /**
     * 테이블 데이터 삽입
     */
    function insert($fields)
    {
        $query = 'INSERT INTO `' . $this -> table . '` (';
        
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '`,';
        }

        $query = rtrim($query, ',');
    
        $query .= ') VALUES (';

        foreach ($fields as $key => $value) {
            $query .= ':' . $key . ',';
        }
    
        $query = rtrim($query, ',');
    
        $query .= ')';
    
        $fields = $this -> processDates($fields);
    
        $this->query($query, $fields);
    }

    /**
     * 테이블 데이터 수정
     */

    private function update($fields)
    {
        $query = ' UPDATE `' . $this->table . '` SET ';
    
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '` = :' . $key . ',';
        }
    
        $query = rtrim($query, ',');
        
        $query .= ' WHERE `' . $this->primarykey . '` = :primarykey';
        
        // :primaryKey 변수 설정
        $fields['primarykey'] = $fields['id'];
    
        $fields = processDates($fields);
    
        query($query, $fields);
    }

    /**
     * 테이블 데이터 삭제
     */

    public function delete($id)
    {
        $parameters = [':id' => $id];
        $this->query('DELETE FROM `' . $this-> table . '`
        WHERE `' . $this-> primarykey . '` = :id', $parameters);
    }

    /**
    * 테이블 모든 데이터 가져오기
    */


    public function findAll()
    {
        $result = $this -> query('SELECT * FROM ' . $this->table);
    
        return $result->fetchAll();
    }

    /**
    * 날짜 형식 처리
    */

    private function processDates($fields)
    {
        foreach ($fields as $key => $value) {
            if($value instanceof DateTime) {
                $fields[$key] = $value->format('Y-m-d H:i:s');
            }
        }

        return $fields;
    }

    /**
    * 데이터 삽입 또는 수정 선택 처리
    */

    public function save($record)
    {
        try {
            if ($record[$this -> primarykey] == '') {
                $record[$this -> primarykey] = null;
            }
            $this->insert($record);
        } catch (PDOException $e) {
            $this->update($record);
        }
    }
}

?>