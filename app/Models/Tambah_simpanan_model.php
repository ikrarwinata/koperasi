<?php
namespace App\Models;
/**
* Auto Generated By TrigerIgniter v1
* Codeigniter Version 4.1.x
* Codeigniter Model
**/
require_once(APPPATH.'ThirdParty'.DIRECTORY_SEPARATOR.'phpspreadsheet'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use CodeIgniter\Model;

class Tambah_simpanan_model extends Model
{
    protected $table      = 'tambah_simpanan';
    protected $primaryKey = 'id_tambahsimpanan';

    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id_tambahsimpanan', 'id_nasabah', 'saldo', 'id_jenissimpanpinjam', 'tanggal', 'nominal'];

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
    public $columnIndex = "id_tambahsimpanan";

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
        if ($keyword == null) {
            return $this->sort();
        };
        $this
            ->groupStart()
            ->like($this->table . '.id_tambahsimpanan', $keyword)
            ->orLike($this->table . '.id_nasabah', $keyword)
            ->orLike($this->table . '.saldo', $keyword)
            ->orLike($this->table . '.id_jenissimpanpinjam', $keyword)
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
    
    //COLUMNHEADER_STYLE_PHPSPREADSHEET
    /**
     * Property for PHPSpreadsheet
     * 
     * @access	public
     */
    public $headerStyle = array(
                'font' => array('bold' => true), // Set font nya jadi bold
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                )
            );

    //EXPORT_PHPSPREADSHEET_FUNCTION
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        // Set document properties
        $spreadsheet->getProperties()->setCreator('shouts')
        ->setLastModifiedBy('shouts')
        ->setTitle('Tambah_simpanan Data')
        ->setSubject('Tambah_simpanan Data')
        ->setDescription('Tambah_simpanan Data '.date("Y"))
        ->setKeywords('Tambah_simpanan')
        ->setCategory('Tambah_simpanan');

        // subtitle on row 3
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', 'Tambah_simpanan Data '.date("Y"));
        $spreadsheet->getActiveSheet()->mergeCells('A3:E3');
        // date on row 4
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', date("d M Y H:i"));
        $spreadsheet->getActiveSheet()->mergeCells('A4:E4');

        // columnHeader
        $startRowHeader = 6;
        $highestColumn = "G";
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A'.$startRowHeader, '#')
        ->setCellValue('B'.$startRowHeader, 'Id_tambahsimpanan')
        ->setCellValue('C'.$startRowHeader, 'Id_nasabah')
        ->setCellValue('D'.$startRowHeader, 'Saldo')
        ->setCellValue('E'.$startRowHeader, 'Id_jenissimpanpinjam')
        ->setCellValue('F'.$startRowHeader, 'Tanggal')
        ->setCellValue('G'.$startRowHeader, 'Nominal')
        ;
        // set column header style
        $spreadsheet->getActiveSheet()->getStyle("A".$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('B'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('C'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('D'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('E'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('F'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('G'.$startRowHeader)->applyFromArray($this->headerStyle);
        // set column header autosize
        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

        // merge top row as title
        $spreadsheet->getActiveSheet()->mergeCells('A1:'.$highestColumn.'1');
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', "Tambah_simpanan Data");
        $spreadsheet->getActiveSheet()->getStyle('A1:'.$highestColumn.'1')->applyFromArray($this->headerStyle);

        $startRowBody = $startRowHeader+1;
        $index = 0;
        $data_tambah_simpanan = $this->orderBy($this->columnIndex, $this->order)->findAll();
        foreach ($data_tambah_simpanan as $key => $tambah_simpanan) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$startRowBody, ++$index);
            if(isset($tambah_simpanan->id_tambahsimpanan))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$startRowBody, $tambah_simpanan->id_tambahsimpanan);
            if(isset($tambah_simpanan->id_nasabah))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$startRowBody, $tambah_simpanan->id_nasabah);
            if(isset($tambah_simpanan->saldo))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$startRowBody, $tambah_simpanan->saldo);
            if(isset($tambah_simpanan->id_jenissimpanpinjam))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$startRowBody, $tambah_simpanan->id_jenissimpanpinjam);
            if(isset($tambah_simpanan->tanggal))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$startRowBody, $tambah_simpanan->tanggal);
            if(isset($tambah_simpanan->nominal))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$startRowBody, $tambah_simpanan->nominal);
            $startRowBody++;
        };

        $spreadsheet->getActiveSheet()->setTitle('Tambah_simpanan Data '.date('Y'));
        $spreadsheet->setActiveSheetIndex(0);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    //IMPORT_PHPSPREADSHEET_FUNCTION
    public function import($filepath){        
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);

        $spreadsheet = $reader->load($filepath);
        $sheet = $spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $startImport = FALSE;
        $doInsert = FALSE;
        $startColumnIndex = 0;
        $counter = 0;

        for ($row = 1; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
            $cellData = $sheet->rangeToArray(
                'A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE
            );

            // Sesuaikan key array dengan nama kolom di database
            if ($cellData == NULL) continue;
            // Pastikan kolom pertama atau kedua tidak kosong
            if ((!isset($cellData[0][0])) && (!isset($cellData[0][1])) && ($cellData[0][0] == NULL) && ($cellData[0][1] == NULL)) continue;
            
            $doInsert = FALSE;
            if ($startImport == TRUE) {
                $insertData = [];
                if (isset($cellData[0][$startColumnIndex + 0])){
                    $insertData["id_tambahsimpanan"] = $cellData[0][$startColumnIndex + 0];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 1])){
                    $insertData["id_nasabah"] = $cellData[0][$startColumnIndex + 1];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 2])){
                    $insertData["saldo"] = $cellData[0][$startColumnIndex + 2];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 3])){
                    $insertData["id_jenissimpanpinjam"] = $cellData[0][$startColumnIndex + 3];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 4])){
                    $insertData["tanggal"] = $cellData[0][$startColumnIndex + 4];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 5])){
                    $insertData["nominal"] = $cellData[0][$startColumnIndex + 5];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }

                if($doInsert){
                    $this->insert($insertData);
                    $counter++;
                }
            } else {
                if (
                    // jika kolom pertama tanpa nomor
                    strtolower($cellData[0][0]) == "id_tambahsimpanan" &&
                    strtolower($cellData[0][1]) == "id_nasabah" &&
                    strtolower($cellData[0][2]) == "saldo" &&
                    strtolower($cellData[0][3]) == "id_jenissimpanpinjam" &&
                    strtolower($cellData[0][4]) == "tanggal" &&
                    strtolower($cellData[0][5]) == "nominal"
                ) {
                    $startImport = TRUE;
                    $startColumnIndex = 0;
                } elseif
                (
                    // jika kolom pertama adalah nomor
                    (strtolower($cellData[0][0]) == "no" || strtolower($cellData[0][0]) == "#") &&
                    strtolower($cellData[0][1]) == "id_tambahsimpanan" &&
                    strtolower($cellData[0][2]) == "id_nasabah" &&
                    strtolower($cellData[0][3]) == "saldo" &&
                    strtolower($cellData[0][4]) == "id_jenissimpanpinjam" &&
                    strtolower($cellData[0][5]) == "tanggal" &&
                    strtolower($cellData[0][6]) == "nominal"
                ) {
                    $startImport = TRUE;
                    $startColumnIndex = 1;
                }
            };
        };

        return $counter;
    }
    //END_PHPSPREADSHEET_FUNCTION
}
