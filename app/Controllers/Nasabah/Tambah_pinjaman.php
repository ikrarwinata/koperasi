<?php
namespace App\Controllers\Nasabah;
/**
* Auto Generated By TrigerIgniter v1
* Codeigniter Version 4.1.x
* Codeigniter Controller
**/

use App\Models\Tambah_pinjaman_model;
use App\Controllers\BaseController;
use App\Models\Jenissimpan_pinjam_model;

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
        $this->PageData->access = ["Nasabah"];
        $this->PageData->parent = "Nasabah/Tambah_pinjaman";
        $this->PageData->header = (session()->has("level") ? NULL : ucfirst(str_replace("_", '', session("level"))) . " :: ") . 'Tambah_pinjaman';
        
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
            'container' => 'Nasabah/_templates/Container',
            'header' => 'Nasabah/_templates/header',
            'navbar' => 'Nasabah/_templates/navbar',
            'sidebar' => 'Nasabah/_templates/sidebar',
            'footer' => 'Nasabah/_templates/footer',
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
        $this->model->where("tambah_pinjaman.id_nasabah", session("id_nasabah"));
        $totalrecord = $this->model->getData($keyword)->countAllResults();        

        $this->PageData->title = "Pinjaman";
        $this->PageData->subtitle = [
            $this->PageData->title => 'Nasabah/Tambah_pinjaman/index'
        ];
        $this->PageData->url = "Nasabah/Tambah_pinjaman/index";

        $this->model->where("tambah_pinjaman.id_nasabah", session("id_nasabah"));
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
        return view('Nasabah/tambah_pinjaman/tambah_pinjaman_list', $data);
        //endindex
    }

    //READfunction
    public function read($id=NULL)
    {
        $id = $id==NULL?$this->request->getPostGet("id_pinjaman"):base64_decode(urldecode($id));

        $this->PageData->header .= ' :: Detail';
        $this->PageData->title = "Tambah_pinjaman Detail";
        $this->PageData->subtitle = [
            'Tambah_pinjaman' => 'Nasabah/Tambah_pinjaman/index',
            'Detail' => 'Nasabah/Tambah_pinjaman/read/' . urlencode(base64_encode($id)),
        ];
        $this->PageData->url = "Nasabah/Tambah_pinjaman/read/" . urlencode(base64_encode($id));
        
        $dataFind = $this->model->getById($id);

        if($dataFind == FALSE || $id == NULL){
            session()->setFlashdata('ci_flash_message', 'Sorry... This data is missing !');
            session()->setFlashdata('ci_flash_message_type', ' alert-danger ');
            return redirect()->to(base_url($this->PageData->parent . '/index'));
        }
        $data = [
            'data' => $this->model->getById($id), //getById on data
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('Nasabah/tambah_pinjaman/tambah_pinjaman_read', $data);
    }

    //CREATEfunction
    public function create()
    {
        $this->PageData->header .= ' :: ' . 'Pinjaman';
        $this->PageData->title = "Pengajuan Pinjaman";
        $this->PageData->subtitle = [
            'Pinjaman' => 'Nasabah/Tambah_pinjaman/index',
            'Pengajuan Pinjaman' => 'Nasabah/Tambah_pinjaman/create',
        ];
        $this->PageData->url = "Nasabah/Tambah_pinjaman/create";

        $jenis = new Jenissimpan_pinjam_model();
        $bungaSimpanan = 0;
        $check = $jenis->getRowBy("id_jenissimpanpinjam", session("id_jenissimpanpinjam"));
        if (isset($check->bunga_simpanan)) $bungaSimpanan = $check->bunga_simpanan;
        $saldo = $this->hitung_saldo_nasabah(session("id_nasabah"), $bungaSimpanan);

        $data = [
            'data' => (object) [
                'id_pinjaman' => set_value('id_pinjaman'),
                'bunga' => set_value('bunga', $check->bunga_pinjaman),
                'id_jenissimpanpinjam' => set_value('id_jenissimpanpinjam', session("id_jenissimpanpinjam")),
                'saldo' => set_value('saldo', $saldo),
                'jumlah_pinjaman' => set_value('jumlah_pinjaman'),
                'lama_angsuran' => set_value('lama_angsuran', 12),
                'total_angsuran' => set_value('total_angsuran'),
                'awal_pembayaran' => set_value('awal_pembayaran'),
                'akhir_pembayaran' => set_value('akhir_pembayaran'),
                'jaminan' => set_value('jaminan'),
                'tgl_pencairan' => set_value('tgl_pencairan'),
                'keterangan' => set_value('keterangan'),
            ],
            'action' => site_url($this->PageData->parent.'/createAction'),
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('Nasabah/tambah_pinjaman/tambah_pinjaman_form', $data);
    }
    
    //ACTIONCREATEfunction
    public function createAction()
    {
        if($this->isRequestValid() == FALSE){
            return $this->create();
        };

        $data = [
            'id_nasabah' => session("id_nasabah"),
            'id_jenissimpanpinjam' => session("id_jenissimpanpinjam"),
            'jumlah_pinjaman' => $this->request->getPost('jumlah_pinjaman'),
            'sisa' => $this->request->getPost('sisa'),
            'lama_angsuran' => $this->request->getPost('lama_angsuran'),
            'total_angsuran' => $this->request->getPost('total_angsuran'),
            'awal_pembayaran' => $this->request->getPost('awal_pembayaran'),
            'akhir_pembayaran' => $this->request->getPost('akhir_pembayaran'),
            'jaminan' => $this->request->getPost('jaminan'),
            'tgl_pencairan' => $this->request->getPost('tgl_pencairan'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];
        
        $this->model->insert($data);
        session()->setFlashdata('ci_flash_message', 'Create item success !');
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
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
                'jumlah_pinjaman' => 'trim|required|min_length[1]|max_length[11]',
                'lama_angsuran' => 'trim|required|min_length[1]|max_length[11]',
                'total_angsuran' => 'trim|required|min_length[1]|max_length[11]',
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

    //ENDFUNCTION
}
