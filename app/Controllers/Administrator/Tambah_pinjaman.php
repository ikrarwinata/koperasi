<?php
namespace App\Controllers\Administrator;
/**
* Auto Generated By TrigerIgniter v1
* Codeigniter Version 4.1.x
* Codeigniter Controller
**/

use App\Models\Tambah_pinjaman_model;
use App\Controllers\BaseController;
use App\Models\Jenissimpan_pinjam_model;
use App\Models\Kelola_nasabah_model;

class Tambah_pinjaman extends BaseController
{
    protected $model; //Default Models Of this Controler

    /**
     * Class constructor.
     */ 
    public function __construct()
    {
        $this->model = new Tambah_pinjaman_model(); //Set Default Models Of this Controller
        $this->Template = $this->defaultTemplate(); //Template Of this Page
        $this->pager = \Config\Services::pager(); // Pagination
        $this->validation =  \Config\Services::validation();
    }

    // This event executed after constructor
    protected function onLoad(){
        $this->getLocale();
        $this->PageData->access = ["Administrator", "Pimpinan"];
        $this->PageData->parent = "Administrator/Tambah_pinjaman";
        $this->PageData->header = (!session()->has("hak_akses") ? NULL : ucfirst(str_replace("_", '', session("hak_akses"))) . " :: ") . 'Pinjaman';
        
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
        //indexstart
        
        // Table sorting using GET var
        $sortcolumn = $this->request->getGetPost("sortcolumn");
        $sortorder = $this->request->getGetPost("sortorder");
        if ($sortcolumn == NULL || $sortorder == NULL){
            if (session()->has("sorting_table")) {
                if (session("sorting_table")==$this->model->table) {
                    $sortcolumn = session("sortcolumn");
                    $sortorder = session("sortorder");
                };
            };
        }else{
            $sortcolumn = base64_decode($sortcolumn);
        }
        if ($sortcolumn != NULL && $sortorder != NULL) {
            $sortorder = strtoupper($sortorder);
            if ($sortorder != "DESC" && $sortorder != "ASC") $sortorder = "ASC";
            if (in_array($sortcolumn, $this->model->getFields())){
                $this->model->order = $sortorder;
                $this->model->columnIndex = $sortcolumn;
                session()->set('sortcolumn', $sortcolumn);
                session()->set('sortorder', $sortorder);
                session()->set('sorting_table', $this->model->table);
            }else{
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
                if (session("paging_table")==$this->model->table) {
                    $perPage = session("perPage");
                };
            };
        };
        if ($perPage != NULL) {
            // Minimum data per-page = 2
            if ($perPage <= 0) $perPage = 2;
            session()->set('perPage', $perPage);
            session()->set('paging_table', $this->model->table);
        }else{
            // Default data per-page = 20
            $perPage = 20;
            session()->remove('paging_table');
            session()->remove('perPage');
        }

        $page = $this->request->getGet("page");
        $page = $page<=0?1:$page;
        $keyword = $this->request->getGetPost("keyword");

        if (session("hak_akses") == "Administrator") {
            $this->model->where("lengkap", 0);
            $totalrecord = $this->model->getData($keyword)->countAllResults();
            $this->model->where("lengkap", 0);
            $this->PageData->title = "Periksa Kelengkapan Pengajuan Pinjaman";
        } else if (session("hak_akses") == "Pimpinan") {
            $this->model->where(["valid" => 0, "lengkap" => 1]);
            $totalrecord = $this->model->getData($keyword)->countAllResults();
            $this->model->where("valid", 0)->where("lengkap", 1);
            $this->PageData->title = "Verifikasi Pengajuan Pinjaman";
        }
        $this->PageData->subtitle = [
            $this->PageData->title => 'Administrator/Tambah_pinjaman/index'
        ];
        $this->PageData->url = "Administrator/Tambah_pinjaman/index";

        $data = [
            'sortcolumn' => $sortcolumn,
            'sortorder' => $sortorder,
            'data' => $this->model->getData($keyword)->paginate($perPage),
            'perPage' => $perPage,
            'currentPage' => $page,
            'start' => min(($page*$perPage)-($perPage-1), $totalrecord),
            'end' => min(($perPage*$page), $totalrecord),
            'totalrecord' => $totalrecord,
            'pager' => $this->model->pager,
            'keyword' => $keyword,
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('Administrator/tambah_pinjaman/tambah_pinjaman_list', $data);
        //endindex
    }

    //READfunction
    public function cicilan()
    {
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
        $this->model->where("valid", 1);
        $totalrecord = $this->model->getData($keyword)->countAllResults();

        $this->PageData->title = "Data Pinjaman";
        $this->PageData->header = "Data Pinjaman";
        $this->PageData->subtitle = [
            $this->PageData->title => 'Administrator/Tambah_pinjaman/index'
        ];
        $this->PageData->url = "Administrator/Tambah_pinjaman/index";

        $this->model->where("valid", 1);
        $data = [
            'sortcolumn' => $sortcolumn,
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
        return view('Administrator/cicilan/cicilan_list', $data);
    }

    //UPDATEfunction
    public function read($id = NULL)
    {
        $id = $id == NULL ? $this->request->getPostGet("id_pinjaman") : base64_decode(urldecode($id));
        $data = [
            'data' => $this->model->getById($id),
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('Administrator/tambah_pinjaman/tambah_pinjaman_read', $data);
    }

    //CREATEfunction
    public function create()
    {
        $this->PageData->header .= ' :: ' . 'Pinjaman Baru';
        $this->PageData->title = "Pinjaman Baru";
        $this->PageData->subtitle = [
            'Pinjaman' => 'Administrator/Tambah_pinjaman/index',
            'Pinjaman Baru' => 'Administrator/Tambah_pinjaman/create',
        ];
        $this->PageData->url = "Administrator/Tambah_pinjaman/create";
        $nasabah = new Kelola_nasabah_model();

        $data = [
            'data' => (object) [
                'bunga' => set_value('bunga'),
                'id_pinjaman' => set_value('id_pinjaman'),
                'id_nasabah' => set_value('id_nasabah'),
                'jumlah_pinjaman' => set_value('jumlah_pinjaman'),
                'lama_angsuran' => set_value('lama_angsuran', 12),
                'total_angsuran' => set_value('total_angsuran'),
                'awal_pembayaran' => set_value('awal_pembayaran'),
                'akhir_pembayaran' => set_value('akhir_pembayaran'),
                'jaminan' => set_value('jaminan'),
                'tgl_pencairan' => set_value('tgl_pencairan'),
                'keterangan' => set_value('keterangan'),
            ],
            'datanasabah' => $nasabah->findAll(),
            'action' => site_url($this->PageData->parent.'/createAction'),
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('Administrator/tambah_pinjaman/tambah_pinjaman_form', $data);
    }
    
    //ACTIONCREATEfunction
    public function createAction()
    {
        if($this->isRequestValid() == FALSE){
            return $this->create();
        };
        $nasabah = new Kelola_nasabah_model();
        $n = $nasabah->getById($this->request->getPost("id_nasabah"));
        $data = [
            'id_nasabah' => $this->request->getPost("id_nasabah"),
            'id_jenissimpanpinjam' => $n->id_jenissimpanpinjam,
            'jumlah_pinjaman' => $this->request->getPost('jumlah_pinjaman'),
            'sisa' => $this->request->getPost('sisa'),
            'lama_angsuran' => $this->request->getPost('lama_angsuran'),
            'total_angsuran' => $this->request->getPost('total_angsuran'),
            'awal_pembayaran' => $this->request->getPost('awal_pembayaran'),
            'akhir_pembayaran' => $this->request->getPost('akhir_pembayaran'),
            'jaminan' => $this->request->getPost('jaminan'),
            'tgl_pencairan' => $this->request->getPost('tgl_pencairan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'valid' => 1,
            'lengkap' => 1,
        ];
        
        $this->model->insert($data);
        session()->setFlashdata('ci_flash_message', 'Create item success !');
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url('Administrator/Tambah_pinjaman/cicilan'));
    }
    
    //UPDATEfunction
    public function update($id=NULL)
    {
        $id = $id == NULL ? $this->request->getPostGet("id_pinjaman") : base64_decode(urldecode($id));

        $dataFind = $this->model->getById($id);
        $jenis = new Jenissimpan_pinjam_model();
        $bungaSimpanan = 0;
        $check = $jenis->getRowBy("id_jenissimpanpinjam", $dataFind->id_jenissimpanpinjam);
        if (isset($check->bunga_simpanan)) $bungaSimpanan = $check->bunga_simpanan;
        if (session("hak_akses") == "Administrator") {
            $this->model->update($id, ['lengkap' => 1]);
        } else if (session("hak_akses") == "Pimpinan") {
            $this->model->update($id, ['valid' => 1]);
        }

        return redirect()->back();
    }

    //DELETE
    public function delete($id=NULL)
    {
        $id = $id == NULL ? $this->request->getPostGet("id_pinjaman") : base64_decode(urldecode($id));
        $row = $this->model->getById($id);

        if ($row && $id != NULL) {
            
            
            $this->model->delete($id);
            session()->setFlashdata('ci_flash_message', 'Delete item success !');
            session()->setFlashdata('ci_flash_message_type', ' alert-success ');
            return redirect()->to(base_url($this->PageData->parent . '/index'));
        } else {
            session()->setFlashdata('ci_flash_message', 'Sorry... This data is missing !');
            session()->setFlashdata('ci_flash_message_type', ' alert-danger ');
            return redirect()->to(base_url($this->PageData->parent . '/index'));
        }
    }

    //DELETEBATCH
    public function deleteBatch()
    {
        $arr = $this->request->getPost("removeme");
        $res = 0;
        if ($arr!=NULL) {
            if (count($arr)>=1) {
                foreach ($arr as $key => $id) {
                    $row = $this->model->getById($id);
                    if (! $row || $id == NULL) continue;
                    
                    $this->model->delete($id);
                    $res++;
                }
            }
        }

        session()->setFlashdata('ci_flash_message', "$res data deleted !");
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }

    //TRUNCATE
    public function truncate()
    {
        $this->model->truncate();
        session()->setFlashdata('ci_flash_message', 'Data truncated !');
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }

    // FORMVALIDATION
    private function isRequestValid(){
        $res = FALSE;

        $this->validation->setRules([
                'id_nasabah' => 'trim|required|max_length[11]',
                'jumlah_pinjaman' => 'trim|required|min_length[1]|max_length[15]',
                'lama_angsuran' => 'trim|required|min_length[1]|max_length[11]',
                'total_angsuran' => 'trim|required|min_length[1]|max_length[15]',
                'awal_pembayaran' => 'trim|required|max_length[11]',
                'akhir_pembayaran' => 'trim|required|max_length[11]',
                'jaminan' => 'trim|required|max_length[40]',
                'tgl_pencairan' => 'trim|required|max_length[11]',
                'keterangan' => 'trim|required|max_length[50]',
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
    public function toExcel(){
        $sortcolumn = $this->request->getGetPost("sortcolumn");
        $sortorder = $this->request->getGetPost("sortorder");
        if ($sortcolumn == NULL && $sortorder == NULL){
            if (session()->has("sorting_table")) {
                if (session("sorting_table")==$this->model->table) {
                    $sortcolumn = session("sortcolumn");
                    $sortorder = session("sortorder");
                };
            };
        };
        if ($sortcolumn != NULL && $sortorder != NULL) {
            $this->model->order = $sortorder;
            $this->model->columnIndex = $sortcolumn;
        };
        // Redirect output to a client’s web browser (Xlsx)
        $this->disableCache();
        $this->response->setContentType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $this->response->setHeader('Content-Disposition', 'attachment;filename="Tambah_pinjaman ' . date("Y") . '.xlsx"');
        // If you're serving to IE 9, then the following may be needed
        $cacheOptions = [
            'max-age'  => 1,
            's-maxage' => 900,
            'etag'     => 'excel_Tambah_pinjaman'
        ];
        $this->response->setCache($cacheOptions);
        // If you're serving to IE over SSL, then the following may be needed
        $this->response->setHeader('Pragma', 'public'); // HTTP/1.0
        $this->model->export();
    }

    //PRINTfunction
    public function printAll(){
        // Table sorting using GET var
        $sortcolumn = $this->request->getGetPost("sortcolumn");
        $sortorder = $this->request->getGetPost("sortorder");
        if ($sortcolumn == NULL || $sortorder == NULL){
            if (session()->has("sorting_table")) {
                if (session("sorting_table")==$this->model->table) {
                    $sortcolumn = session("sortcolumn");
                    $sortorder = session("sortorder");
                };
            };
        }else{
            $sortcolumn = base64_decode($sortcolumn);
        }
        if ($sortcolumn != NULL && $sortorder != NULL) {
            if ($sortorder != "DESC" && $sortorder != "ASC") $sortorder = "ASC";
            if(in_array($sortcolumn, $this->model->getFields())){
                $this->model->order = $sortorder;
                $this->model->columnIndex = $sortcolumn;
            }
        }

        $this->PageData->title = "Tambah_pinjaman Data";
        $this->PageData->subtitle = ["Tambah_pinjaman", "Print All"];
        $this->PageData->url = "Administrator/Tambah_pinjaman/printAll/";

        $data = array(
            'Page' => $this->PageData,
            'data' => $this->model->sort()->findAll(),
            'start' => 0
        );
        
        return view('Administrator/tambah_pinjaman/tambah_pinjaman_print', $data);
    }
    
    //ENDFUNCTION
}
