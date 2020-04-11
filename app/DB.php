<?php


namespace App;

use Config\Database;

/**
 * Sql Sorgu Hazırlayıcı...
 */
class DB
{

    /**
     * Update (Güncelle) komutunu oluşturur. Önemli: Bu komuta ->where() komutunu ilave edin!
     * $table: işlem yapılmak istenilen tablonun adı girilir, sadece bir tablo adı girin.
     * $keyvalues: veri eklenmek istenilen sütunlar ile verilerin içerdiği bir dizi (array) verin.
     *   örn. array("sutun1"=>"deger1","sutun2"=>"deger2","sutun3"=>"deger3")
     */
    public function update($table, $keyvalues)
    {
        $fieldvalues = "";
        if (is_array($keyvalues)) {
            foreach ($keyvalues as $field => $value) {
                //$field = preg_replace("/[^0-9a-zA-Z_]/", "", $field);
                $fieldvalues .= $field . "=";
                $fieldvalues .= (is_string($value)) ? ("'" . $value . "',") : ($value . ",");
            }
            $fieldvalues = substr($fieldvalues, 0, (strlen($fieldvalues) - 1));
        }

        $this->sql = "UPDATE " . $table . " SET " . $fieldvalues;
        return $this;
    }

    /**
     * Delete (Kayıt Sil) komutunu oluşturur. Önemli: Bu komuta ->where() komutunu ilave edin!
     * $table: işlem yapılmak istenilen tablonun adı girilir, sadece bir tablo adı girin.
     */
    public function delete($table)
    {
        $this->sql = "DELETE FROM " . $table;
        return $this;
    }

    /**
     * Where komutunu ilave eder.
     * $condition: koşul ifadesini verin. Örn. id=1 veya isim like 'cem'
     */
    public function where($condition)
    {
        $this->sql .= " WHERE " . $condition;
        return $this;
    }

    /**
     * Order By komutunu ilave eder.
     * $field: sonucu sıralarken baz alınmasını istediğiniz sütunun adının yanı sıra ASC veya DESC koşulu verin.
     */
    public function order($field)
    {
        $this->sql .= " ORDER BY " . $field;
        return $this;
    }

    /**
     * Group By komutunu ilave eder.
     * $field: sonucu gruplandırırken baz alınmasını istediğiniz sütunun adını verin.
     */
    public function group($field)
    {
        $this->sql .= " GROUP BY " . $field;
        return $this;
    }

    /**
     * Limit komutunu ilave eder.
     * $condition: sınır ifadesini verin. Örn. 10 veya 1,10
     */
    public function limit($condition)
    {
        $this->sql .= " LIMIT " . $condition;
        return $this;
    }

    /**
     * Doğrudan SQL sorgusu çalıştırma imkanı verir.
     * $sql: çalıştırmak istediğiniz sorguyu verin.
     */
    public function query($sql = "")
    {
        $this->sql = $this->sql . ";";

        if ($sql != "") {
            $this->sql = $sql;
        }

        $this->query = mysqli_query($this->vt, $this->sql);

        $this->last_id = mysqli_insert_id($this->vt);

        return $this;
    }

    /**
     * Oluşan sorgu sonucunun tamamını dizi (array) olarak verir.
     * Önemli : Kayıt çoğunluğunda performanı düşürür!
     * $type: alınacak verinin sütun şekli (default MYSQLI_BOTH yani ikisi).
     *   MYSQLI_ASSOC : dizi anahtarının sütun adları olarak belirler
     *   MYSQLI_NUM : dizi anahtarının sütun numaraları olarak belirler
     *   MYSQLI_BOTH : dizi anahtarının her iki durumda dahil olarak belirler
     */
    public function all($type = MYSQLI_BOTH)
    {
        $this->query();
        return mysqli_fetch_all($this->query, $type);
    }

    /**
     * Oluşan sorgunun sonucunu sütun ismi ile döndürür.
     * Tek seferlik çağırıldığında oluşan ilk kaydı döner.
     * Birden fazla kayıt alabilmek için;
     *
     * $db = new DB();
     * $v = $db->select("*","table_name")->where("id=1;");
     *
     * while ($r = $v->assoc()) {
     * $value = $r["field"];
     * }
     */
    public function assoc()
    {
        if ($this->query == null) {
            $this->query();
        }
        return mysqli_fetch_assoc($this->query);
    }

    /**
     * Oluşan sorgunun sonucunu sütun numarası ile döndürür.
     * $type: alınacak verinin sütun şekli (default MYSQLI_NUM yani sütun numaraları).
     *   MYSQLI_ASSOC : dizi anahtarının sütun adları olarak belirler
     *   MYSQLI_NUM : dizi anahtarının sütun numaraları olarak belirler
     *   MYSQLI_BOTH : dizi anahtarının her iki durumda dahil olarak belirler
     * Tek seferlik çağırıldığında oluşan ilk kaydı döner.
     * Birden fazla kayıt alabilmek için;
     *
     * $db = new DB();
     * $v = $db->select("*","table_name")->where("id=1;");
     *
     * while ($r = $v->arrays()) {
     * $value = $r[0];
     * }
     */
    public function arrays($type = MYSQLI_NUM)
    {
        if ($this->query == null) {
            $this->query();
        }
        return mysqli_fetch_array($this->query, $type);
    }

    /**
     * Bağımsız SQL sorgusu çalıştırma imkanı verir.
     * $sql: çalıştırmak istediğiniz sorguyu verin.
     */
    public function queryDirect($sql, $type = MYSQLI_BOTH)
    {
        $q = mysqli_query($this->vt, $sql);

        return mysqli_fetch_all($q, $type);
    }


    public function __destruct()
    {
        mysqli_close($this->vt);
    }

    /**
     * Sql Bağlantısını Oluşturur.
     * Sorgu yazarken kolaylık sağlar.
     */

    public $vt;
    public $query = null;
    public $sql = "";
    public $last_id = "";

    private $dbname = "mysql";

    /**
     * Nesne örneklenirken MySQL bağlantısı kurulur.
     */
    public function __construct(
        $database = ""
    )
    {
        $this->dbname = ($database != "") ? $database : Database::$dbname;


        $this->vt = @mysqli_connect(
            Database::$dbhost,
            Database::$dbuser,
            Database::$dbpass,
            $this->dbname,
            Database::$dbport
        );

        mysqli_query($this->vt, "SET NAMES utf8");
        mysqli_query($this->vt, "SET CHARACTER SET utf8");
    }

    public function info()
    {
        return $this->vt;
    }

    /**
     * Select (Seç) komutunu oluşturur.
     * $field: okunmak istenilen sütunlar aralarına virgül (,) koyularak yazılabilir.
     * $table: okunmak istenilen tablonun adı girilir, sadece bir tablo adı girin.
     */
    public function select($field, $table)
    {
        $this->sql = "SELECT " . $field . " FROM " . $table;
        return $this;
    }

    /**
     * Insert (Ekle) komutunu oluşturur.
     * $table: işlem yapılmak istenilen tablonun adı girilir, sadece bir tablo adı girin.
     * $keyvalues: veri eklenmek istenilen sütunlar ile verilerin içerdiği bir dizi (array) verin.
     *   örn. array("sutun1"=>"deger1","sutun2"=>"deger2","sutun3"=>"deger3")
     */
    public function insertOne($table, $keyvalues)
    {
        $fields = "";
        $values = "";
        if (is_array($keyvalues)) {
            foreach ($keyvalues as $field => $value) {
                //$field = preg_replace("/[^0-9a-zA-Z_]/", "", $field);
                if ($value != "") {
                    $fields .= $field . ",";
                    $values .= (!is_numeric($value)) ? ("'" . $value . "',") : ($value . ",");
                }
                if (is_numeric($value) && intval($value) == 0) {
                    $fields .= $field . ",";
                    $values .= $value . ",";
                }
            }
            $fields = substr($fields, 0, (strlen($fields) - 1));
            $values = substr($values, 0, (strlen($values) - 1));
        }


        $this->sql = "INSERT INTO " . $table . " (" . $fields . ") VALUES (" . $values . "); ";

        return $this;
    }

    /**
     * Insert (Ekle) komutunu oluşturur.
     * $table: işlem yapılmak istenilen tablonun adı girilir, sadece bir tablo adı girin.
     * $keys: verilerin ekleneceği sütunların isimlerini verin. Örn. array( "isim", "soyisim" )
     * $keyvalues: veri eklenmek istenilen sütunların isimleri ile verilerin içerdiği bir dizi (array) verin.
     *   Örn.
     * $db = new DB();
     *
     * $db->insert("table",
     * array( "isim", "soyisim" ),  // Sütun isimleri
     * array(
     * array( "isim"=>"ahmet", "soyisim" => "mehmet" ),  // Verilen sütun isimlerine ait
     * array( "soyisim"=>"osman", "isim" => "deneme" )   // eklenmek istenilen veriler.
     * ))->query();
     */
    public function insert($table, $keys, $keyvalues)
    {
        $fields = "";
        $values = "";
        $invalue = [];

        if (is_array($keys) && is_array($keyvalues)) {
            foreach ($keys as $key => $field) {
                //$field = preg_replace("/[^0-9a-zA-Z_]/", "", $field);
                $fields .= $field . ",";
                $invalue[] = $field;
            }

            foreach ($keyvalues as $value) {
                $incount = count($invalue);

                $values .= "(";

                for ($i = 0; $i < $incount; $i++) {
                    $temp = $value[$invalue[$i]];
                    $values .= (!is_numeric($temp) && $temp != "") ? ("'" . $temp . "',") : ($temp . ",");
                }

                $values = substr($values, 0, (strlen($values) - 1));
                $values .= "),";
            }

            unset($invalue);

            $fields = substr($fields, 0, (strlen($fields) - 1));
            $values = substr($values, 0, (strlen($values) - 1));
        }


        $this->sql = "INSERT INTO " . $table . " (" . $fields . ") VALUES " . $values . "; ";
        return $this;
    }

}