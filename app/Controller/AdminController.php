<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class AdminController extends AppController {

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->layout = 'admin';		
	}
	
	public function index(){
		
	}

	//User Views
	public function usuarios(){
		$this->loadModel('User');
		$this->set('users', $this->User->find('all'));
	}

	public function agregar_usuario()
	{
		$this->loadModel('User');
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved'));
				return $this->redirect(array('action' => 'usuarios'));
			}
			$this->Flash->error(
				__('The user could not be saved. Please, try again.')
			);
		}
	}

	public function editar_usuario($id = null)
	{
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(
				__('The user could not be saved. Please, try again.')
			);
		}

		if (!$this->request->data) {
			$this->request->data = $post;
		}

	}
	public function eliminar_usuario()
	{
		$this->request->allowMethod('post');

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Flash->success(__('User deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Flash->error(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));

	}

	//Product Views
	public function productos(){
		$this->loadModel('Product');
		$this->set('products', $this->Product->find('all'));

		$this->loadModel('Category');
		$this->set('categories', $this->Category->find('all'));		
	}

	public function agregar_producto(){
		$this->loadModel('Product');
		$this->loadModel('Category');
		$this->set('categories', $this->Product->Category->find('list'));

		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Flash->success(__('The product has been saved'));
				return $this->redirect(array('action' => 'productos'));
			}
			$this->Flash->error(
				__('The product could not be saved. Please, try again.')
			);
		}		
	}

	public function editar_producto($id=null){
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Product->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved'));
				return $this->redirect(array('action' => 'productos'));
			}
			$this->Flash->error(
				__('The product could not be saved. Please, try again.')
			);
		}

		if (!$this->request->data) {
			$this->request->data = $post;
		}
	}

	public function eliminar_producto(){
		$this->request->allowMethod('post');

		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->Product->delete()) {
			$this->Flash->success(__('product deleted'));
			return $this->redirect(array('action' => 'productos'));
		}
		$this->Flash->error(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
	
	
}
