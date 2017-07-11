    <?php

    class KullaniciController extends ControllerBase
    {

    public function indexAction(){

    }
    public function KaydolAction(){
       
    }
    public function GirisAction(){
    }
    private function GirisSession($kullanici){
        $this->session->set(
                'auth',
                [
                    'id'=>$kullanici->id,
                    'kAdi'=>$kullanici->kAdi,
                ]
            );
    }
    public function _GirisAction(){

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'kullanici',
                'action' => 'giris'
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
                    #$this->session->set("kAdi",$this->request->getPost("kAdi"));
                    $this->GirisSession($kullanici);
                    $this->dispatcher->forward([
                    'controller' => 'admin',
                    'action' => 'index'
                    ]);
                }
            }
            else {
				##hatali giriş
				$this->flash->error("giriş başarisiz");
                $this->security->hash(rand());
            }
        }
        else {
            $this->flash->error("token yanlis");
        }
    }
    
    public function _CikisAction(){
        $this->session->remove('auth');
        $this->flash->success("Çikiş yapildi");
        $this->dispatcher->forward([
            'controller' => "index",
            'action' => 'index'
            ]);
        #$this->response->redirect("");
    }
    public function _KaydolAction(){
        if (!$this->request->isPost()) {
        $this->dispatcher->forward([
            'controller' => 'Kullanici',
            'action' => 'kaydol'
        ]);
        return;
        }
        $kAdi=$this->request->getPost('kAdi');
        $parola=$this->request->getPost('parola');

        $kullanici =new Kullanici();
        $kullanici->kAdi=$kAdi;
        $kullanici->pass=$this->security->hash($parola);
        $kullanici->tarih=new Phalcon\Db\RawValue('now()');
        if($kullanici->save()){
            $this->flash->success("kayit olundu.");
            $this->dispatcher->forward([
            'controller' => "Kullanici",
            'action' => 'giris'
            ]);
        }
    }
}

