<?php
namespace App\Models;
/**
* Auto Generated By TrigerIgniter v1
* Codeigniter Version 4.1.x
* Codeigniter Model
**/

use CodeIgniter\Model;

class Ambil_simpanan_model extends Model
{
    protected $table      = 'ambil_simpanan';
    protected $primaryKey = 'id_ambilsimpanan';

    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id_ambilsimpanan', 'id_nasabah', 'saldo', 'tanggal','nominal','timestamps','valid', 'lengkap'];

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public $order = "DESC";
    public $columnIndex = "id_ambilsimpanan";

    /**
     * Get all writable fields.
     * Used on table sorting in controllers.
     *
     * @access	public
     * @return	array 	return array
     */
    public function getFields() : array
    {
        return $this->allowedFields;
    }

    /**
     * Get first row of the result, select by id, built in sorting.
     *
     * @access	public
     * @param	mixed	$id 	the id
     * @return	mixed 	return as array or object of the first result.
     */
    public function getById(mixed $id) : mixed
    {
        return $this->where($this->primaryKey, $id)->sort()->first();
    }

    /**
     * Get first row of the result, select a row by given parameter where a column of row equal to $val, built in sorting.
     * 
     * @access	public
     * @param	string	$key 	the column name
     * @param	string	$val 	the column value
     * @return	mixed	return as array or object of the first result.
     */
    public function getRowBy(string $key, string $val): mixed
    {
        return $this->where($key, $val)->sort()->first();
    }

    /**
     * Get all result, select all where a column of row equal to $val, built in sorting.
     * 
     * @access	public
     * @param	string	$key 	the column name
     * @param	string	$val 	the column value
     * @return	object|array 	return as array or object of the result.
     */
    public function getBy($key, $val): mixed
    {
        return $this->where($key, $val)->sort()->findAll();
    }

    /**
     * Count total rows using WHERE condition, accept null.
     * 
     * @access	public
     * @param	mixed	$arr 	the condition, accept array, object, string
     * @return	int 	return as int of total row.
     */
    public function totalRows(mixed $arr = NULL): int
    {
        $this
            ->select("ambil_simpanan.*, kelola_nasabah.username, kelola_nasabah.nama")
            ->join("kelola_nasabah", "ambil_simpanan.id_nasabah=kelola_nasabah.id_nasabah");
        if ($arr == NULL) {
            return $this->countAllResults();
        }else{
            if(is_array($arr)) {
                foreach ($arr as $key => $value) {
                    $this->where($key, $value);
                };
            }else{
                $this->getData($arr);
            }
            return $this->countAllResults();
        }
    }

    /**
     * Get all result wherever its contains $keyword,
     * used to search a value in table
     * 
     * @access	public
     * @param	string	$keyword 	the value to search
     * @return	object 	return This Model, build in sorted.
     */
    public function getData(string|null $keyword = null) : object
    {
        $this
            ->select("ambil_simpanan.*, kelola_nasabah.username, kelola_nasabah.nama")
            ->join("kelola_nasabah", "ambil_simpanan.id_nasabah=kelola_nasabah.id_nasabah");
        if ($keyword == null) {
            return $this->sort();
        };
        $this
            ->groupStart()
            ->like($this->table . '.id_nasabah', $keyword)
            ->orLike($this->table . '.saldo', $keyword)
            ->orLike($this->table . '.tanggal', $keyword)
            ->orLike($this->table . '.nominal', $keyword)
            ->groupEnd();
        return $this->sort();
    }

    /**
     * Void sorting column, accept null.
     * 
     * @access	public
     * @param	string|null	$columnIndex 	the column to sort
     * @param	string|null	$sortDirection 	the direction, accept DESC or ASC
     */
    public function sort(string|null $columnIndex = NULL, string|null $sortDirection = NULL)
    {
        if($columnIndex == NULL){
            if (strpos($this->columnIndex, ".") !== FALSE) {
                $columnIndex = $this->columnIndex;
            }else{
                $columnIndex = $this->table . '.' . $this->columnIndex;
            }
        };
        if($sortDirection == NULL){
            $sortDirection = $this->order;
        };
        return $this->orderBy($columnIndex, $sortDirection);
    }

    /**
     * Void clear table, also reset auto increament.
     * 
     * @access	public
     */
    public function truncate(){
        $this->query('TRUNCATE '.$this->table);
    }
    
    //END_PHPSPREADSHEET_FUNCTION
}
