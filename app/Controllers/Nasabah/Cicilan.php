<?php
namespace App\Controllers\Nasabah;
/**
* Auto Generated By TrigerIgniter v1
* Codeigniter Version 4.1.x
* Codeigniter Controller
**/

use App\Models\Cicilan_model;
use App\Controllers\BaseController;
use App\Models\Tambah_pinjaman_model;

class Cicilan extends BaseController
{
    protected $model; //Default Models Of this Controler

    /**
     * Class constructor.
     */ 
    public function __construct()
    {
        $this->model = new Cicilan_model(); //Set Default Models Of this Controller
        $this->Template = $this->defaultTemplate(); //Template Of this Page
        $this->pager = \Config\Services::pager(); // Pagination
        $this->validation =  \Config\Services::validation();
    }

    // This event executed after constructor
    protected function onLoad(){
        $this->getLocale();
        $this->PageData->access = ["Nasabah"];
        $this->PageData->parent = "Nasabah/Cicilan";
        $this->PageData->header = (session()->has("level") ? NULL : ucfirst(str_replace("_", '', session("level"))) . " :: ") . 'Cicilan';
        
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
        $totalrecord = $this->model->getData($keyword)->countAllResults();        

        $this->PageData->title = "Nasabah/Cicilan";
        $this->PageData->subtitle = [
            $this->PageData->title => 'Nasabah/Cicilan/index'
        ];
        $this->PageData->url = "Nasabah/Cicilan/index";

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
        return view('Nasabah/cicilan/cicilan_list', $data);
        //endindex
    }

    //READfunction
    public function read($id=NULL)
    {
        $id = $id==NULL?$this->request->getPostGet("id_cicilan"):base64_decode(urldecode($id));

        $this->PageData->header .= ' :: Detail';
        $this->PageData->title = "Cicilan Detail";
        $this->PageData->subtitle = [
            'Cicilan' => 'Nasabah/Cicilan/index',
            'Detail' => 'Nasabah/Cicilan/read/' . urlencode(base64_encode($id)),
        ];
        $this->PageData->url = "Nasabah/Cicilan/read/" . urlencode(base64_encode($id));
        
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
        return view('Nasabah/cicilan/cicilan_read', $data);
    }

    //CREATEfunction
    public function create($id_pinjaman)
    {
        $this->PageData->header .= ' :: ' . 'Pembayaran Cicilan';
        $this->PageData->title = "Pembayaran Cicilan";
        $this->PageData->subtitle = [
            'Cicilan' => 'Nasabah/Cicilan/index',
            'Create New Item' => 'Nasabah/Cicilan/create',
        ];
        $this->PageData->url = "Nasabah/Cicilan/create";
        $p = new Tambah_pinjaman_model();
        $d = $p->getRowBy("id_pinjaman", base64_decode(urldecode($id_pinjaman)));
        $c = $this->model->where("id_pinjaman", $d->id_pinjaman)->totalRows();
        $data = [
            'data' => (object) [
                'id_cicilan' => set_value('id_cicilan'),
                'id_pinjaman' => set_value('id_pinjaman', $d->id_pinjaman),
                'jml_pinjaman' => set_value('jml_pinjaman', $d->jumlah_pinjaman),
                'lama_angsuran' => set_value('lama_angsuran', $d->lama_angsuran),
                'angsuran_ke' => set_value('angsuran_ke', $c + 1),
                'total_bayar' => set_value('total_bayar', $d->total_angsuran),
                'sisa_pinjaman' => set_value('sisa_pinjaman', $d->sisa),
            ],
            'action' => site_url($this->PageData->parent.'/createAction'),
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('Nasabah/cicilan/cicilan_form', $data);
    }
    
    //ACTIONCREATEfunction
    public function createAction()
    {
        if($this->isRequestValid() == FALSE){
            return $this->create(base64_encode(urlencode($this->request->getPost('id_pinjaman'))));
        };

        $p = new Tambah_pinjaman_model();
        $d = $p->getRowBy("id_pinjaman", $this->request->getPost('id_pinjaman'));
        $data = [
            'id_pinjaman' => $this->request->getPost('id_pinjaman'),
            'id_nasabah' => session('id_nasabah'),
            'id_jenissimpanpinjam' => session('id_jenissimpanpinjam'),
            'tgl_bayar' => date("Y-m-d"),
            'jml_pinjaman' => $d->jumlah_pinjaman,
            'lama_angsuran' => $d->lama_angsuran,
            'angsuran_ke' => $this->request->getPost('angsuran_ke'),
            'total_bayar' => $this->request->getPost('total_bayar'),
            'sisa_pinjaman' => $d->sisa
        ];
        
        $this->model->insert($data);

        $p->update($this->request->getPost('id_pinjaman'), ["sisa" => $d->sisa - $this->request->getPost('total_bayar')]);

        session()->setFlashdata('ci_flash_message', 'Create item success !');
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url('Nasabah/Tambah_pinjaman/index'));
    }

    //DELETE
    public function delete($id=NULL)
    {
        $id = $id == NULL ? $this->request->getPostGet("id_cicilan") : base64_decode(urldecode($id));
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
                'id_pinjaman' => 'trim|required|min_length[1]|max_length[11]',
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
