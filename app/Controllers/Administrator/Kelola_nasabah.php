<?php
namespace App\Controllers\Administrator;
/**
* Auto Generated By TrigerIgniter v1
* Codeigniter Version 4.1.x
* Codeigniter Controller
**/

use App\Models\Kelola_nasabah_model;
use App\Controllers\BaseController;
use App\Models\Jenissimpan_pinjam_model;
use App\Models\User_model;

class Kelola_nasabah extends BaseController
{
    protected $model; //Default Models Of this Controler

    /**
     * Class constructor.
     */ 
    public function __construct()
    {
        $this->model = new Kelola_nasabah_model(); //Set Default Models Of this Controller
        $this->Template = $this->defaultTemplate(); //Template Of this Page
        $this->pager = \Config\Services::pager(); // Pagination
        $this->validation =  \Config\Services::validation();
    }

    // This event executed after constructor
    protected function onLoad(){
        $this->getLocale();
        $this->PageData->access = ["Administrator"];
        $this->PageData->parent = "Administrator/Kelola_nasabah";
        $this->PageData->header = (session()->has("level") ? NULL : ucfirst(str_replace("_", '', session("level"))) . " :: ") . 'Kelola_nasabah';
        
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
        $totalrecord = $this->model->getData($keyword)->countAllResults();        

        $this->PageData->title = "Nasabah";
        $this->PageData->subtitle = [
            $this->PageData->title => 'Administrator/Kelola_nasabah/index'
        ];
        $this->PageData->url = "Administrator/Kelola_nasabah/index";

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
        return view('Administrator/kelola_nasabah/kelola_nasabah_list', $data);
        //endindex
    }

    //READfunction
    public function read($id=NULL)
    {
        $id = $id==NULL?$this->request->getPostGet("id_nasabah"):base64_decode(urldecode($id));

        $this->PageData->header .= ' :: Detail';
        $this->PageData->title = "Detail Nasabah";
        $this->PageData->subtitle = [
            'Nasabah' => 'Administrator/Kelola_nasabah/index',
            'Detail' => 'Administrator/Kelola_nasabah/read/' . urlencode(base64_encode($id)),
        ];
        $this->PageData->url = "Administrator/Kelola_nasabah/read/" . urlencode(base64_encode($id));
        
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
        return view('Administrator/kelola_nasabah/kelola_nasabah_read', $data);
    }

    //CREATEfunction
    public function create()
    {
        $this->PageData->header .= ' :: ' . 'Tambah Nasabah';
        $this->PageData->title = "Tambah Nasabah";
        $this->PageData->subtitle = [
            'Kelola_nasabah' => 'Administrator/Kelola_nasabah/index',
            'Create New Item' => 'Administrator/Kelola_nasabah/create',
        ];
        $this->PageData->url = "Administrator/Kelola_nasabah/create";
        $jenis = new Jenissimpan_pinjam_model();
        $data = [
            'data' => (object) [
                'id_nasabah' => set_value('id_nasabah'),
                'username' => set_value('username'),
                'password' => set_value('password'),
                'nama' => set_value('nama'),
                'no_hp' => set_value('no_hp'),
                'ttl' => set_value('ttl'),
                'jekel' => set_value('jekel'),
                'agama' => set_value('agama'),
                'alamat' => set_value('alamat'),
                'pndidikan_terakhir' => set_value('pndidikan_terakhir'),
                'pekerjaan' => set_value('pekerjaan'),
                'id_jenissimpanpinjam' => set_value('id_jenissimpanpinjam'),
                'penghasilan_perbulan' => set_value('penghasilan_perbulan'),
                'foto_ktp' => set_value('foto_ktp')
            ],
            'action' => site_url($this->PageData->parent.'/createAction'),
            'Page' => $this->PageData,
            'Template' => $this->Template,
            'jenissimpanpinjam' => $jenis->findALl()
        ];
        return view('Administrator/kelola_nasabah/kelola_nasabah_form', $data);
    }
    
    //ACTIONCREATEfunction
    public function createAction()
    {
        if($this->isRequestValid() == FALSE){
            return $this->create();
        };

        if ($this->request->getPost('password') == NULL) {
            session()->setFlashdata('ci_flash_message_password', 'field password required');
            session()->setFlashdata('ci_flash_message_password_type', 'is-invalid');
            return redirect()->to("/" . $this->parent . "/create");
        }

        $user = new User_model();
        if ($user->where("username", $this->request->getPost('username'))->totalRows() >= 1) {
            session()->setFlashdata('ci_flash_message_username', 'Username telah digunakan');
            session()->setFlashdata('ci_flash_message_username_type', 'is-invalid');
            return redirect()->to("/" . $this->parent . "/create");
        }
        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'ttl' => $this->request->getPost('ttl'),
            'jekel' => $this->request->getPost('jekel'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'pndidikan_terakhir' => $this->request->getPost('pndidikan_terakhir'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'id_jenissimpanpinjam' => $this->request->getPost('id_jenissimpanpinjam'),
            'penghasilan_perbulan' => $this->request->getPost('penghasilan_perbulan')
        ];
        
        if ($foto_ktp = $this->request->getFile('foto_ktp')) {
            if ($foto_ktp->isValid()) {
                if (!$foto_ktp->hasMoved()) {
                    $foto_ktp->move('uploads/kelola_nasabah/', $foto_ktp->getRandomName());
                }
                $data['foto_ktp'] = 'uploads/kelola_nasabah/'.$foto_ktp->getName();
            }else{
                session()->setFlashdata('ci_flash_message_foto_ktp', $foto_ktp->getErrorString() . ' (' . $foto_ktp->getError() . ')');
                session()->setFlashdata('ci_flash_message_foto_ktp_type', ' text-danger ');
                return $this->create();
            };
        };        
        
        $this->model->insert($data);

        $userData = [
            'username' => $this->request->getPost('username'),
            'password' => md5($this->request->getPost('password')),
            'nama' => $this->request->getPost('nama'),
            'hak_akses' => 'Nasabah'
        ];
        $user->insert($userData);
        session()->setFlashdata('ci_flash_message', 'Create item success !');
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }
    
    //UPDATEfunction
    public function update($id=NULL)
    {
        $id = $id == NULL ? $this->request->getPostGet("id_nasabah") : base64_decode(urldecode($id));

        $this->PageData->header .= ' :: ' . 'Update Item';
        $this->PageData->title = "Update Kelola_nasabah";
        $this->PageData->subtitle = [
            'Kelola_nasabah' => 'Administrator/Kelola_nasabah/index',
            'Update Item' => 'Administrator/Kelola_nasabah/update/' . urlencode(base64_encode($id)),
        ];
        $this->PageData->url = "Administrator/Kelola_nasabah/update/" . urlencode(base64_encode($id));

        $dataFind = $this->model->getById($id);

        if($dataFind == FALSE || $id == NULL){
            session()->setFlashdata('ci_flash_message', 'Sorry... This data is missing !');
            session()->setFlashdata('ci_flash_message_type', ' alert-danger ');
            return redirect()->to(base_url($this->PageData->parent . '/index'));
        }
        $data = [
            'data' => (object) [
                'id_nasabah' => set_value('id_nasabah', $dataFind->id_nasabah),
                'username' => set_value('username', $dataFind->username),
                'nama' => set_value('nama', $dataFind->nama),
                'no_hp' => set_value('no_hp', $dataFind->no_hp),
                'ttl' => set_value('ttl', $dataFind->ttl),
                'jekel' => set_value('jekel', $dataFind->jekel),
                'agama' => set_value('agama', $dataFind->agama),
                'alamat' => set_value('alamat', $dataFind->alamat),
                'pndidikan_terakhir' => set_value('pndidikan_terakhir', $dataFind->pndidikan_terakhir),
                'pekerjaan' => set_value('pekerjaan', $dataFind->pekerjaan),
                'id_jenissimpanpinjam' => set_value('id_jenissimpanpinjam', $dataFind->id_jenissimpanpinjam),
                'penghasilan_perbulan' => set_value('penghasilan_perbulan', $dataFind->penghasilan_perbulan),
                'foto_ktp' => set_value('foto_ktp', $dataFind->foto_ktp),
            ],
            'action' => site_url($this->PageData->parent.'/updateAction'),
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('Administrator/kelola_nasabah/kelola_nasabah_form', $data);
    }
    
    //ACTIONUPDATEfunction
    public function updateAction()
    {
        $id = $this->request->getPostGet('oldid_nasabah');
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
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'ttl' => $this->request->getPost('ttl'),
            'jekel' => $this->request->getPost('jekel'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'pndidikan_terakhir' => $this->request->getPost('pndidikan_terakhir'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'id_jenissimpanpinjam' => $this->request->getPost('id_jenissimpanpinjam'),
            'penghasilan_perbulan' => $this->request->getPost('penghasilan_perbulan'),
        ];
        
        if ($foto_ktp = $this->request->getFile('foto_ktp')) {
            if ($foto_ktp->isValid()) {
                if (!$foto_ktp->hasMoved()) {
                    $foto_ktp->move('uploads/kelola_nasabah/', $foto_ktp->getRandomName());
                }
                $data['foto_ktp'] = 'uploads/kelola_nasabah/'.$foto_ktp->getName();
                if ($this->request->getPost('oldfoto_ktp') != NULL) {
                    safeUnlink($this->request->getPost('oldfoto_ktp'));
                }
            }else{
                session()->setFlashdata('ci_flash_message_foto_ktp', $foto_ktp->getErrorString() . '(' . $foto_ktp->getError() . ')');
                session()->setFlashdata('ci_flash_message_foto_ktp_type', ' text-danger ');
                return $this->update(urlencode(base64_encode($id)));
            };
        };
        
        $this->model->update($id, $data);
        session()->setFlashdata('ci_flash_message', 'Update item success !');
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }

    //DELETE
    public function delete($id=NULL)
    {
        $id = $id == NULL ? $this->request->getPostGet("id_nasabah") : base64_decode(urldecode($id));
        $row = $this->model->getById($id);

        if ($row && $id != NULL) {
            if (isset($row->foto_ktp)) {
                if ($row->foto_ktp != NULL) {
                    safeUnlink($row->foto_ktp);
                }
            }
            
            $this->model->delete($id);
            $user = new User_model();
            $user->delete($row->username);
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
                $user = new User_model();
                foreach ($arr as $key => $id) {
                    $row = $this->model->getById($id);
                    if (! $row || $id == NULL) continue;
                    if (isset($row->foto_ktp)) {
                        if ($row->foto_ktp != NULL) {
                            safeUnlink($row->foto_ktp);
                        }
                    }
                    $this->model->delete($id);
                    $user->delete($row->username);
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
        $user = new User_model();
        $user->query("DELETE FROM user WHERE hak_akses = 'Nasabah'");
        session()->setFlashdata('ci_flash_message', 'Data truncated !');
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }

    // FORMVALIDATION
    private function isRequestValid(){
        $res = FALSE;

        $this->validation->setRules([
                'username' => 'trim|required|max_length[30]',
                'nama' => 'trim|required|max_length[60]',
                'no_hp' => 'trim|required|max_length[20]',
                'ttl' => 'trim|required|max_length[11]',
                'jekel' => 'trim|required|max_length[6]',
                'agama' => 'trim|required|max_length[30]',
                'alamat' => 'trim|required|max_length[65535]',
                'pndidikan_terakhir' => 'trim|required|max_length[40]',
                'pekerjaan' => 'trim|required|max_length[40]',
                'id_jenissimpanpinjam' => 'trim|required|max_length[11]',
                'penghasilan_perbulan' => 'trim|required|min_length[1]|max_length[15]',
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
        $this->response->setHeader('Content-Disposition', 'attachment;filename="Kelola_nasabah ' . date("Y") . '.xlsx"');
        // If you're serving to IE 9, then the following may be needed
        $cacheOptions = [
            'max-age'  => 1,
            's-maxage' => 900,
            'etag'     => 'excel_Kelola_nasabah'
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

        $this->PageData->title = "Kelola_nasabah Data";
        $this->PageData->subtitle = ["Kelola_nasabah", "Print All"];
        $this->PageData->url = "Administrator/Kelola_nasabah/printAll/";

        $data = array(
            'Page' => $this->PageData,
            'data' => $this->model->sort()->findAll(),
            'start' => 0
        );
        
        return view('Administrator/kelola_nasabah/kelola_nasabah_print', $data);
    }
    
    //ENDFUNCTION
}
