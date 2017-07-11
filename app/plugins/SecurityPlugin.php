<?php
use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;


class SecurityPlugin extends Plugin
{
	public function getAcl(){
		if(!isset($this->persistent->acl)){
			$acl=new AclList();
			$acl->setDefaultAction(Acl::DENY);
			$roles=[
				'users'=>new Role(
						'Users',
						'Uye'
					),
				'guests' =>new Role(
						'Guests',
						'Misafir'
					)
			];

			foreach ($roles as $role) {
				$acl->addRole($role);
			}
			$privateResources = array(
					'admin' =>array('index','sil'),
					'Kullanici'=>array('index'),
				);
			foreach ($privateResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}
			$publicResources=array(
					'index' => array('index'),
					'Kullanici'=>array('giris','kaydol','_Cikis','_Giris','_Kaydol'),
					//'Auth' => array('Giris','Kaydol','Cikis'),
					'errors'=>array('show404','show401')
				);

			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}
			foreach ($roles as $role) {
				foreach ($publicResources as $resource => $actions) {
					foreach ($actions as $action){
						$acl->allow($role->getName(), $resource, $action);
					}
				}
			}
			foreach ($privateResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('Users', $resource, $action);
				}
			}
			
			$this->persistent->acl=$acl;
		}
		return $this->persistent->acl;
	}
	public function beforeDispatch(Event $event, Dispatcher $dispatcher){ // Execute
			$auth = $this->session->get('auth');
			var_dump($auth);
			if(!$auth){
				$role ='Guests';
			} else{
				$role='Users';
			}
			var_dump($role);
			
			$controller=$dispatcher->getControllerName();
			$action=$dispatcher->getActionName();
			var_dump($controller);
			var_dump($action);
			$acl=$this->getAcl();
			if(!$acl->isResource($controller)){
				$dispatcher->forward(array(
						'controller'=>'errors',
						'action'=>'show404'
					));

				return false;
			}
			$allowed = $acl->isAllowed($role, $controller, $action);
			if (!$allowed) {
			var_dump($allowed);
				$dispatcher->forward(array(
					'controller' => 'errors',
					'action'     => 'show401'
				));
	            //$this->session->destroy();

				return false;
			}
		}
	}