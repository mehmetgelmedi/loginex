<?php

class KullaniciController extends ControllerBase
{

    public function indexAction(){

    }
    public function KaydolAction(){
       
    }
    public function GirisAction(){
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'Kullanici',
                'action' => 'index'
            ]);
            return;
        }
        if ($this->security->checkToken()){
            $kAdi=$this->request->getPost("kAdi");
            $parola=$this->request->getPost("parola");
            $kullanici=Kullanici::findFirstBykAdi($kAdi);
            if($kullanici){
                if($this->security->checkHash($parola,$kullanici->pass)){
                    $this->flash->success("giriş yapildi");
                    $this->session->set("kAdi",$this->request->getPost("kAdi"));   
                    $this->dispatcher->forward([
                    'controller' => "Kullanici",
                    'action' => 'index'
                    ]);
                }
                else {
                    $this->flash->error("hatali");
                    $this->dispatcher->forward([
                    'controller' => "Kullanici",
                    'action' => 'index'
                    ]);
                }  
            }
            else {
                $this->security->hash(rand());
            }
        }
        else {
            $this->flash->error("token yanlis");
        }
    }
    
    public function CikisAction(){
        $this->session->destroy();
        $this->flash->success("Çikiş yapildi");
        $this->response->redirect("");
    }
    public function _KaydolAction(){
        if (!$this->request->isPost()) {
        $this->dispatcher->forward([
            'controller' => 'Kullanici',
            'action' => 'Kaydol'
        ]);
        return;
        }
        $kAdi=$this->request->getPost('kAdi');
        $parola=$this->request->getPost('parola');

        $kullanici =new Kullanici();
        $kullanici->kAdi=$kAdi;
        $kullanici->pass=$this->security->hash($parola);

        if($kullanici->save()){
            $this->flash->success("kayit olundu.");
              $this->dispatcher->forward([
            'controller' => "Kullanici",
            'action' => 'index'
            ]);
        }
    }
}

