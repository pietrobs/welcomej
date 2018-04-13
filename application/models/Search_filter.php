<?php
class searchFilter{
    private $dbTable;
    private $attribute;
    private $orderBy;
    private $offset;
    private $limit;
    private $likeColumn;
    private $like;
    const ASCENDANT  = "ASC";
    const DESCENDANT = "DESC";

    public function __construct(string $dbTable,
                                string $attribute,
                                string $orderBy,
                                int    $offset,
                                int    $limit,
                                string $likeColumn = NULL,
                                string $like = NULL){
        $this->dbTable = $dbTable;
        $this->attribute = $attribute;
        $this->orderBy = $orderBy;
        $this->offset = $offset;
        $this->limit = $limit;
        $this->likeColumn = $likeColumn;
        $this->like = $like;
    }

    public function setLimit($newLimit){
        $this->limit = $newLimit;
    }

    public function setOffset($newOffset){
        $this->offset = $newOffset;
    }

    public function setPage($page){
        self::setOffset(($page - 1) * $this->limit);
    }

    public function setAttribute($newAttribute){
        $this->attribute = $newAttribute;
    }

    public function setOrderBy($newOrderBy){
        $this->orderBy = $newOrderBy;
    }

    public function setLikeColumn($newLikeColumn){
        $this->likeColumn = $newLikeColumn;
    }

    public function setLike($newLike){
        $this->like = $newLike;
    }

    public function getAttribute() { return $this->attribute; }
    public function getOrderBy() { return $this->orderBy; }
    public function getLimit() { return $this->limit; }
    public function getLike() { return $this->like; }
    public function getDB() { return $this->dbTable;}

    public function applyFilter($db, $currentDB = TRUE){
        if($currentDB)
            $db->order_by("$this->dbTable.$this->attribute", $this->orderBy);
        else
            $db->order_by("$this->attribute", $this->orderBy);
        $db->limit($this->limit, $this->offset);
        if($this->likeColumn != NULL && $this->like != NULL){
            if($currentDB)
                $db->like("$this->dbTable.$this->likeColumn", $this->like);
            else
                $db->like("$this->likeColumn", $this->like);
        }
        //print_r($db->get_compiled_select());
        return $db;
    }

    public function numRows($db){
        if($this->like != NULL && $this->like != "")
            $db->like("$this->dbTable.$this->likeColumn", $this->like);

        return $db;
    }
}

?>