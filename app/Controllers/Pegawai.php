<?php

namespace App\Controllers;
use App\Models\M_Pegawai;

class Pegawai extends BaseController {

    protected $model;

    public function __construct() {
        $this->model = new M_Pegawai();
        $this->helpers = ['form', 'url'];
    }

    public function index() {
        $data = [
            'result'    => $this->model->orderBy('nip', 'asc')->paginate(10),
            'pager'     => $this->model->pager,
            'title'     => 'Pegawai List'
        ];
        return view('pegawai/list', $data);
    }

    public function add()
    {
        $data = ['title' => 'Add Record Pegawai'];
        return view('pegawai/add', $data);
    }    
    
    public function store()
    {
        if ($this->request->isAJAX()) {
            $validation =  \Config\Services::validation();
            if (!$this->validate([
                'nip'           => 'required|min_length[5]|max_length[15]|is_unique[pegawai.nip]',
                'nama_pegawai'  => 'required',
                'alamat'        => 'required'
            ])){
                $this->output['errors'] = $validation->getErrors();
                echo json_encode($this->output);
            }else{
                $nip = $this->request->getPost('nip');
                $nama_pegawai = $this->request->getPost('nama_pegawai');
                $alamat = $this->request->getPost('alamat');
                $pegawai = [
                    'nip'           => $nip,
                    'nama_pegawai'  => $nama_pegawai,
                    'alamat'        => $alamat,
                ];
                $save = $this->model->save($pegawai);
                if ($save) {
                    $this->output['success'] = true;
                    $this->output['message'] = 'Record has been added successfully.';
                }
                echo json_encode($this->output);
            }
        }
    }    
    
    public function show($id)
    {
        if ($this->request->isAJAX()) {
            $result = $this->model->find($id);
            if ($result) {
                $this->output['success'] = true;
                $this->output['message']  = 'Data ditemukan';
                $this->output['data']   = $result;
            }
            echo json_encode($this->output);
        }
    }    

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $pegawai_id = $this->request->getVar('pegawai_id');
            $result = $this->model->find($pegawai_id);
            if ($result) {
                $this->output['success'] = true;
                $this->output['message']  = 'Data ditemukan';
                $this->output['data']   = $result;
            }
            echo json_encode($this->output);
        }
    }    

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation =  \Config\Services::validation();
            if (!$this->validate([
                'nip'           => 'required|min_length[5]|max_length[15]|is_unique[pegawai.nip,pegawai_id,{pegawai_id}]',
                'nama_pegawai'  => 'required',
                'alamat'        => 'required'
            ])){
                $this->output['errors'] = $validation->getErrors();
                echo json_encode($this->output);
            }else{
                $data = [
                    'nip'           => $this->request->getVar('nip'),
                    'nama_pegawai'  => $this->request->getVar('nama_pegawai'),
                    'alamat'        => $this->request->getVar('alamat')
                ];
                $pegawai_id = $this->request->getVar('pegawai_id');
                $update = $this->model->update($pegawai_id, $data);
                if ($update) {
                    $this->output['success'] = true;
                    $this->output['message']  = 'Record has been updated successfully';
                }
                echo json_encode($this->output);
            }
        }
    }    

    public function destroy()
    {
        if ($this->request->isAJAX()) {
            $pegawai_id = $this->request->getVar('pegawai_id');
            $delete = $this->model->delete($pegawai_id);
            if ($delete) {
                $this->output['success'] = true;
                $this->output['message']  = 'Record has been removed successfully.';
            }
            echo json_encode($this->output);
        }
    }
    
}
