<?php

class FunctionsSqlutf8 {

  public function select_normal($cols,$table){

    $sql = new Sqlutf8();
    $query = $sql->select("SELECT ".$cols." FROM ".$table);
    $len = count($query);
    $json = json_encode($query);
    return $query;
  }

  public function search($cols,$col1,$col2,$table,$search){

    $sql = new Sqlutf8();
    $query = $sql->select("SELECT ".$cols." FROM ".$table." WHERE (".$col1." LIKE '%".$search."%' OR ".$col2." LIKE '%".$search."%')");
    $len = count($query);
    $json = json_encode($query);
    return $query;
  }

  public function select_distinct($cols,$table){

    $sql = new Sqlutf8();
    $query = $sql->select("SELECT DISTINCT".$cols." FROM ".$table);
    $len = count($query);
    $json = json_encode($query);
    return $query;
  }

  public function select_conditional1($cols,$table,$Lcond1,$Rcond1){
    $sql = new Sqlutf8();
    $query = $sql->select("SELECT ".$cols." FROM ".$table." WHERE ".$Lcond1."=".$Rcond1);
    $len = count($query);
    $json = json_encode($query);
    return $query;

  }

  public function select_conditional2($cols,$table,$Lcond1,$Rcond1,$Lcond2,$Rcond2){
    $sql = new Sqlutf8();
    $query = $sql->select("SELECT ".$cols." FROM ".$table." WHERE ".$Lcond1."=".$Rcond1." AND ".$Lcond2."=".$Rcond2);
    $len = count($query);
    $json = json_encode($query);
    return $query;

  }

  public function getColumnNames($db,$table){

    $sql = new Sqlutf8();
    $query = $sql->select("SELECT `COLUMN_NAME`FROM `INFORMATION_SCHEMA`.`COLUMNS`WHERE `TABLE_SCHEMA`="."'".$db."'"." AND `TABLE_NAME`="."'".$table."'");
    return $query;
  }

  public function insert($db,$table,$change){

    $sql = new Sqlutf8();
    $heads = self::getColumnNames($db,$table);
    $len = count($heads);
    $string = "(";
    for($i=0;$i<$len;$i+=1){
      $heads_list[] = $heads[$i]['COLUMN_NAME'];
      if($i>=$len-1){
        $string .= $heads_list[$i].")";
      }
      else{
        $string .= $heads_list[$i].",";
      };
    };
    $query = $sql->select("INSERT INTO ".$table.$string." VALUES "."(".$change.")");
  }

  public function delete($table,$Lcond,$Rcond){

      $sql = new Sqlutf8();
      $query = $sql->select("DELETE FROM ".$table." WHERE ".$Lcond."=".$Rcond);

  }

  public function update($table,$Lchange,$Rchange,$Lcond,$Rcond){

      $sql = new Sqlutf8();
      $query = $sql->select("UPDATE ".$table."SET ".$Lchange."=".$Rchange."WHERE ".$Lcond."=".$Rcond);

  }

  public function alter_add($table,$newcol,$datatype){
      //datatype as "varchar(255)"
      $sql = new Sqlutf8();
      $query = $sql->select("ALTER TABLE ".$table." ADD ".$newcol." ".$datatype);

  }

  public function alter_drop($table,$oldcol){
      //datatype as "varchar(255)"
      $sql = new Sqlutf8();
      $query = $sql->select("ALTER TABLE ".$table." DROP COLUMN ".$oldcol);

  }

  public function alter_modify($table,$oldcol,$datatype){
      //datatype as "varchar(255)"
      $sql = new Sqlutf8();
      $query = $sql->select("ALTER TABLE ".$table." MODIFY ".$oldcol." ".$datatype);

  }


};

?>
