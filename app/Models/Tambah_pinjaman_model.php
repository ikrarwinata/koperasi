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

class Tambah_pinjaman_model extends Model
{
    protected $table      = 'tambah_pinjaman';
    protected $primaryKey = 'id_pinjaman';

    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id_pinjaman', 'id_nasabah', 'id_jenissimpanpinjam', 'jumlah_pinjaman', 'sisa', 'lama_angsuran', 'total_angsuran', 'awal_pembayaran', 'akhir_pembayaran', 'jaminan', 'tgl_pencairan', 'keterangan', 'valid', 'lengkap'];

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
    public $columnIndex = "id_pinjaman";

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
            ->select("tambah_pinjaman.*, kelola_nasabah.username, kelola_nasabah.nama")
            ->join("kelola_nasabah", "tambah_pinjaman.id_nasabah=kelola_nasabah.id_nasabah");
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
            ->select("tambah_pinjaman.*, kelola_nasabah.username, kelola_nasabah.nama")
            ->join("kelola_nasabah", "tambah_pinjaman.id_nasabah=kelola_nasabah.id_nasabah");
        if ($keyword == null) {
            return $this->sort();
        };
        $this
            ->groupStart()
            ->like($this->table . '.id_nasabah', $keyword)
            ->orLike($this->table . '.id_jenissimpanpinjam', $keyword)
            ->orLike($this->table . '.jumlah_pinjaman', $keyword)
            ->orLike($this->table . '.sisa', $keyword)
            ->orLike($this->table . '.lama_angsuran', $keyword)
            ->orLike($this->table . '.total_angsuran', $keyword)
            ->orLike($this->table . '.awal_pembayaran', $keyword)
            ->orLike($this->table . '.akhir_pembayaran', $keyword)
            ->orLike($this->table . '.jaminan', $keyword)
            ->orLike($this->table . '.tgl_pencairan', $keyword)
            ->orLike($this->table . '.keterangan', $keyword)
            ->orLike($this->table . '.valid', $keyword)
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
        ->setTitle('Data Pinjaman')
        ->setSubject('Data Pinjaman')
        ->setDescription('Data Pinjaman '.date("Y"))
        ->setKeywords('Pinjaman')
        ->setCategory('Pinjaman');

        // subtitle on row 3
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', 'Tambah_pinjaman Data '.date("Y"));
        $spreadsheet->getActiveSheet()->mergeCells('A3:E3');
        // date on row 4
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', date("d M Y H:i"));
        $spreadsheet->getActiveSheet()->mergeCells('A4:E4');

        // columnHeader
        $startRowHeader = 6;
        $highestColumn = "L";
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A'.$startRowHeader, '#')
        ->setCellValue('B'.$startRowHeader, 'Id Nasabah')
        ->setCellValue('C'.$startRowHeader, 'ID Jenis simpan pinjam')
        ->setCellValue('D'.$startRowHeader, 'Jumlah Pinjaman')
        ->setCellValue('E'.$startRowHeader, 'Sisa')
        ->setCellValue('F'.$startRowHeader, 'Lama Angsuran')
        ->setCellValue('G'.$startRowHeader, 'Total Angsuran')
        ->setCellValue('H'.$startRowHeader, 'Awal Pembayaran')
        ->setCellValue('I'.$startRowHeader, 'Akhir Pembayaran')
        ->setCellValue('J'.$startRowHeader, 'Jaminan')
        ->setCellValue('K'.$startRowHeader, 'Tgl Pencairan')
        ->setCellValue('L'.$startRowHeader, 'Keterangan')
        ;
        // set column header style
        $spreadsheet->getActiveSheet()->getStyle("A".$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('B'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('C'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('D'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('E'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('F'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('G'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('H'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('I'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('J'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('K'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('L'.$startRowHeader)->applyFromArray($this->headerStyle);
        // set column header autosize
        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);

        // merge top row as title
        $spreadsheet->getActiveSheet()->mergeCells('A1:'.$highestColumn.'1');
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', "Data Pinjaman");
        $spreadsheet->getActiveSheet()->getStyle('A1:'.$highestColumn.'1')->applyFromArray($this->headerStyle);

        $startRowBody = $startRowHeader+1;
        $index = 0;
        $data_tambah_pinjaman = $this->orderBy($this->columnIndex, $this->order)->findAll();
        foreach ($data_tambah_pinjaman as $key => $tambah_pinjaman) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$startRowBody, ++$index);
            if(isset($tambah_pinjaman->id_nasabah))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$startRowBody, $tambah_pinjaman->id_nasabah);
            if(isset($tambah_pinjaman->id_jenissimpanpinjam))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$startRowBody, $tambah_pinjaman->id_jenissimpanpinjam);
            if(isset($tambah_pinjaman->jumlah_pinjaman))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$startRowBody, $tambah_pinjaman->jumlah_pinjaman);
            if(isset($tambah_pinjaman->sisa))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$startRowBody, $tambah_pinjaman->sisa);
            if(isset($tambah_pinjaman->lama_angsuran))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$startRowBody, $tambah_pinjaman->lama_angsuran);
            if(isset($tambah_pinjaman->total_angsuran))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$startRowBody, $tambah_pinjaman->total_angsuran);
            if(isset($tambah_pinjaman->awal_pembayaran))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$startRowBody, $tambah_pinjaman->awal_pembayaran);
            if(isset($tambah_pinjaman->akhir_pembayaran))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('I'.$startRowBody, $tambah_pinjaman->akhir_pembayaran);
            if(isset($tambah_pinjaman->jaminan))
                $spreadsheet->setActiveSheetIndex(0)->setCellValueExplicit('J'.$startRowBody, $tambah_pinjaman->jaminan, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            if(isset($tambah_pinjaman->tgl_pencairan))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('K'.$startRowBody, $tambah_pinjaman->tgl_pencairan);
            if(isset($tambah_pinjaman->keterangan))
                $spreadsheet->setActiveSheetIndex(0)->setCellValueExplicit('L'.$startRowBody, $tambah_pinjaman->keterangan, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $startRowBody++;
        };

        $spreadsheet->getActiveSheet()->setTitle('Data Pinjaman '.date('Y'));
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
                    $insertData["id_nasabah"] = $cellData[0][$startColumnIndex + 0];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 1])){
                    $insertData["id_jenissimpanpinjam"] = $cellData[0][$startColumnIndex + 1];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 2])){
                    $insertData["jumlah_pinjaman"] = $cellData[0][$startColumnIndex + 2];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 3])){
                    $insertData["sisa"] = $cellData[0][$startColumnIndex + 3];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 4])){
                    $insertData["lama_angsuran"] = $cellData[0][$startColumnIndex + 4];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 5])){
                    $insertData["total_angsuran"] = $cellData[0][$startColumnIndex + 5];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 6])){
                    $insertData["awal_pembayaran"] = $cellData[0][$startColumnIndex + 6];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 7])){
                    $insertData["akhir_pembayaran"] = $cellData[0][$startColumnIndex + 7];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 8])){
                    $insertData["jaminan"] = $cellData[0][$startColumnIndex + 8];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 9])){
                    $insertData["tgl_pencairan"] = $cellData[0][$startColumnIndex + 9];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 10])){
                    $insertData["keterangan"] = $cellData[0][$startColumnIndex + 10];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 11])){
                    $insertData["valid"] = $cellData[0][$startColumnIndex + 11];
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
                    strtolower($cellData[0][0]) == "id_nasabah" &&
                    strtolower($cellData[0][1]) == "id_jenissimpanpinjam" &&
                    strtolower($cellData[0][2]) == "jumlah_pinjaman" &&
                    strtolower($cellData[0][3]) == "sisa" &&
                    strtolower($cellData[0][4]) == "lama_angsuran" &&
                    strtolower($cellData[0][5]) == "total_angsuran" &&
                    strtolower($cellData[0][6]) == "awal_pembayaran" &&
                    strtolower($cellData[0][7]) == "akhir_pembayaran" &&
                    strtolower($cellData[0][8]) == "jaminan" &&
                    strtolower($cellData[0][9]) == "tgl_pencairan" &&
                    strtolower($cellData[0][10]) == "keterangan" &&
                    strtolower($cellData[0][11]) == "valid"
                ) {
                    $startImport = TRUE;
                    $startColumnIndex = 0;
                } elseif
                (
                    // jika kolom pertama adalah nomor
                    (strtolower($cellData[0][0]) == "no" || strtolower($cellData[0][0]) == "#") &&
                    strtolower($cellData[0][1]) == "id_nasabah" &&
                    strtolower($cellData[0][2]) == "id_jenissimpanpinjam" &&
                    strtolower($cellData[0][3]) == "jumlah_pinjaman" &&
                    strtolower($cellData[0][4]) == "sisa" &&
                    strtolower($cellData[0][5]) == "lama_angsuran" &&
                    strtolower($cellData[0][6]) == "total_angsuran" &&
                    strtolower($cellData[0][7]) == "awal_pembayaran" &&
                    strtolower($cellData[0][8]) == "akhir_pembayaran" &&
                    strtolower($cellData[0][9]) == "jaminan" &&
                    strtolower($cellData[0][10]) == "tgl_pencairan" &&
                    strtolower($cellData[0][11]) == "keterangan" &&
                    strtolower($cellData[0][12]) == "valid"
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
