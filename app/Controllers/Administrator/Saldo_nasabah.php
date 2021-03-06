<?php
namespace App\Controllers\Administrator;
/**
* Auto Generated By TrigerIgniter v1
* Codeigniter Version 4.1.x
* Codeigniter Controller
**/

use App\Models\Saldo_nasabah_model;
use App\Controllers\BaseController;
use App\Models\Jenissimpan_pinjam_model;
use App\Models\Kelola_nasabah_model;

class Saldo_nasabah extends BaseController
{
    protected $model; //Default Models Of this Controler

    /**
     * Class constructor.
     */ 
    public function __construct()
    {
        $this->model = new Saldo_nasabah_model(); //Set Default Models Of this Controller
        $this->Template = $this->defaultTemplate(); //Template Of this Page
        $this->pager = \Config\Services::pager(); // Pagination
        $this->validation =  \Config\Services::validation();
    }

    // This event executed after constructor
    protected function onLoad(){
        $this->getLocale();
        $this->PageData->access = ["Administrator", "Pimpinan"];
        $this->PageData->parent = "Administrator/Saldo_nasabah";
        $this->PageData->header = (!session()->has("hak_akses") ? NULL : ucfirst(str_replace("_", '', session("hak_akses"))) . " :: ") . 'Saldo Nasabah';
        
        // check access level
        if (! $this->access_allowed()) {
            session()->setFlashdata("ci_login_flash_message", 'Login session outdate. Please re-Login !');
            session()->setFlashdata("ci_login_flash_message_type", "text-danger");
            throw new \CodeIgniter\Router\Exceptions\RedirectException();
        };
    
    }

    //TEMPLATE OF THIS PAGE
    private function defaultTemplate()
    {
        return (object) [
            'container' => 'Administrator/_templates/Container',
            'header' => 'Administrator/_templates/header',
            'navbar' => 'Administrator/_templates/navbar',
            'sidebar' => 'Administrator/_templates/sidebar',
            'footer' => 'Administrator/_templates/footer',
        ];
    }
    
    private function access_allowed(){
        $allowed = FALSE;
        if (count($this->PageData->access)==0) return TRUE;
        if (! session()->has("level"))  return FALSE;
        foreach ($this->PageData->access as $key => $value) {
            if(session("level")==$value){
                $allowed=TRUE;
                break;
            }
        };
        return $allowed;
    }

    //INDEX
    public function index()
    {
        $nasabah = new Kelola_nasabah_model();
        $this->PageData->title = "Buku Simpanan";
        $this->PageData->subtitle = [
            $this->PageData->title => 'Administrator/Saldo_nasabah/index'
        ];
        $this->PageData->url = "Administrator/Saldo_nasabah/index";
        //indexstart
        $data = [
            'datanasabah' => $nasabah->findAll(),
            'sortcolumn' => NULL,
            'saldo' => 0,
            'sortorder' => NULL,
            'data' => [],
            'perPage' => 20,
            'currentPage' => 1,
            'start' => 1,
            'end' => 1,
            'totalrecord' => 0,
            'pager' => NULL,
            'keyword' => NULL,
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('Administrator/saldo_nasabah/saldo_nasabah_list', $data);
        //endindex
    }

    //READfunction
    public function read()
    {
        $id = ($this->request->getPost('id_nasabah') == NULL ? session("id_nasabah") : $this->request->getPost('id_nasabah'));
        session()->set("id_nasabah", $id);
        $nasabah = new Kelola_nasabah_model();
        // Table sorting using GET var
        $sortcolumn = $this->request->getGetPost("sortcolumn");
        $sortorder = $this->request->getGetPost("sortorder");
        if ($sortcolumn == NULL || $sortorder == NULL) {
            if (session()->has("sorting_table")) {
                if (session("sorting_table") == $this->model->table) {
                    $sortcolumn = session("sortcolumn");
                    $sortorder = session("sortorder");
                };
            };
        } else {
            $sortcolumn = base64_decode($sortcolumn);
        }
        if ($sortcolumn != NULL && $sortorder != NULL) {
            $sortorder = strtoupper($sortorder);
            if ($sortorder != "DESC" && $sortorder != "ASC") $sortorder = "ASC";
            if (in_array($sortcolumn, $this->model->getFields())) {
                $this->model->order = $sortorder;
                $this->model->columnIndex = $sortcolumn;
                session()->set('sortcolumn', $sortcolumn);
                session()->set('sortorder', $sortorder);
                session()->set('sorting_table', $this->model->table);
            } else {
                $sortcolumn = NULL;
                $sortorder = NULL;
                session()->remove('sortcolumn');
                session()->remove('sortorder');
                session()->remove('sorting_table');
            }
        }

        // How many data shows each page
        $perPage = $this->request->getPostGet("perPage");
        if ($perPage == NULL) {
            if (session()->has("paging_table")) {
                if (session("paging_table") == $this->model->table) {
                    $perPage = session("perPage");
                };
            };
        };
        if ($perPage != NULL) {
            // Minimum data per-page = 2
            if ($perPage <= 0) $perPage = 2;
            session()->set('perPage', $perPage);
            session()->set('paging_table', $this->model->table);
        } else {
            // Default data per-page = 20
            $perPage = 20;
            session()->remove('paging_table');
            session()->remove('perPage');
        }

        $page = $this->request->getGet("page");
        $page = $page <= 0 ? 1 : $page;
        $keyword = $this->request->getGetPost("keyword");
        $this->model->where("id_nasabah", $id);
        $totalrecord = $this->model->getData($keyword)->countAllResults();

        $this->PageData->title = "Buku Simpanan";
        $this->PageData->subtitle = [
            $this->PageData->title => 'Administrator/Saldo_nasabah/read'
        ];
        $this->PageData->url = "Administrator/Saldo_nasabah/read";

        $jenis = new Jenissimpan_pinjam_model();
        $ns = $nasabah->getById($id);
        $bungaSimpanan = 0;
        $check = $jenis->getRowBy("id_jenissimpanpinjam", $ns->id_jenissimpanpinjam);
        if (isset($check->bunga_simpanan)) $bungaSimpanan = $check->bunga_simpanan;
        $saldo = $this->hitung_saldo_nasabah(session("id_nasabah"), $bungaSimpanan);
        $this->model->where("id_nasabah", $id);
        $data = [
            'datanasabah' => $nasabah->findAll(),
            'sortcolumn' => $sortcolumn,
            'saldo' => $saldo,
            'sortorder' => $sortorder,
            'data' => $this->model->getData($keyword)->paginate($perPage),
            'perPage' => $perPage,
            'currentPage' => $page,
            'start' => min(($page * $perPage) - ($perPage - 1), $totalrecord),
            'end' => min(($perPage * $page), $totalrecord),
            'totalrecord' => $totalrecord,
            'pager' => $this->model->pager,
            'keyword' => $keyword,
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('Administrator/saldo_nasabah/saldo_nasabah_list', $data);
    }

    //ACTIONCREATEfunction
    public function createAction()
    {
        if($this->isRequestValid() == FALSE){
            return $this->create();
        };

        $data = [
            // 'id_tambahsimpanan' => $this->request->getPost('id_tambahsimpanan'),
            'id_nasabah' => $this->request->getPost('id_nasabah'),
            'saldo' => $this->request->getPost('saldo'),
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
            'jenis_transaksi' => $this->request->getPost('jenis_transaksi'),
        ];
        
        $this->model->insert($data);
        session()->setFlashdata('ci_flash_message', 'Create item success !');
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }
    
    //ACTIONUPDATEfunction
    public function updateAction()
    {
        $id = $this->request->getPostGet('oldid_tambahsimpanan');
        $dataFind = $this->model->getById($id);

        if($dataFind == FALSE || $id == NULL){
            session()->setFlashdata('ci_flash_message', 'Sorry... This data is missing !');
            session()->setFlashdata('ci_flash_message_type', ' alert-danger ');
            return redirect()->to(base_url($this->PageData->parent . '/index'));
        };

        if($this->isRequestValid() == FALSE){
            return $this->update(urlencode(base64_encode($id)));
        };

        $data = [
            // 'id_tambahsimpanan' => $this->request->getPost('id_tambahsimpanan'),
            'id_nasabah' => $this->request->getPost('id_nasabah'),
            'saldo' => $this->request->getPost('saldo'),
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
            'jenis_transaksi' => $this->request->getPost('jenis_transaksi'),
        ];
        
        $this->model->update($id, $data);
        session()->setFlashdata('ci_flash_message', 'Update item success !');
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }

    // FORMVALIDATION
    private function isRequestValid(){
        $res = FALSE;

        $this->validation->setRules([
                'id_nasabah' => 'trim|required|min_length[1]|max_length[11]',
                'saldo' => 'trim|required|min_length[1]|max_length[11]',
                'tanggal' => 'trim|max_length[11]',
                'nominal' => 'trim|required|min_length[1]|max_length[11]',
                'jenis_transaksi' => 'trim|required|max_length[3]',
        ]);

        if ($this->validation->withRequest($this->request)->run() == TRUE) {
            $res = TRUE;
        }else{
            $errors = $this->validation->getErrors();
            foreach ($errors as $key => $value) {
                session()->setFlashdata('ci_flash_message_'.$key, $value);
                session()->setFlashdata('ci_flash_message_'.$key.'_type', 'is-invalid');
            }
        }
        return $res;
    }

    //EXPORTEXCELfunction
    public function toExcel()
    {
        $sortcolumn = $this->request->getGetPost("sortcolumn");
        $sortorder = $this->request->getGetPost("sortorder");
        if ($sortcolumn == NULL && $sortorder == NULL) {
            if (session()->has("sorting_table")) {
                if (session("sorting_table") == $this->model->table) {
                    $sortcolumn = session("sortcolumn");
                    $sortorder = session("sortorder");
                };
            };
        };
        if ($sortcolumn != NULL && $sortorder != NULL) {
            $this->model->order = $sortorder;
            $this->model->columnIndex = $sortcolumn;
        };
        // Redirect output to a client???s web browser (Xlsx)
        $this->disableCache();
        $this->response->setContentType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $this->response->setHeader('Content-Disposition', 'attachment;filename="Saldo_nasabah ' . date("Y") . '.xlsx"');
        // If you're serving to IE 9, then the following may be needed
        $cacheOptions = [
            'max-age'  => 1,
            's-maxage' => 900,
            'etag'     => 'excel_Saldo_nasabah'
        ];
        $this->response->setCache($cacheOptions);
        // If you're serving to IE over SSL, then the following may be needed
        $this->response->setHeader('Pragma', 'public'); // HTTP/1.0
        $this->model->export();
    }
    
    //ENDFUNCTION
}
