<?php
namespace App\Controller;

use App\Controller\AppController;

class PeopleController extends AppController
{
    public $paginate = [
        'limit' => 5,
        'sort' => 'id',
        'direction' => 'asc',
        'contain' => ['Messages'],
    ];
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function index()
    {
        $data = $this->paginate($this->People);
        $this->set('data', $data);
    }


    public function edit()
    {
        $id = $this->request->query['id'];
        $entity = $this->People->get($id);
        $this->set('entity', $entity);
    }

    public function update()
    {
        if ($this->request->isPost()) {
            $data = $this->request->data['People'];
            $entity = $this->People->get($data['id']);
            $this->People->patchEntity($entity, $data);
            $this->People->save($entity);
        }
        return $this->redirect(['action'=>'index']);
    }

    public function add()
    {
        $msg = 'TYPE!!!!!';
        $entity = $this->People->newENtity();
        if ($this->request->isPost()) {
            $data = $this->request->data['People'];
            $entity = $this->People->newEntity($data);
            $this->People->save($entity);
         
            if ($this->People->save($entity)) {
                return $this->redirect(['action'=>'index']);
            }
            $msg = 'ERROR!!!!';
        }
        $this->set('msg', $msg);
        $this->set('entity', $entity);
    }

    public function create()
    {
        if ($this->request->isPost()) {
            $data = $this->request->data['People'];
            $entity = $this->People->newEntity($data);
            $this->People->save($entity);
        }
        return $this->redirect(['action' => 'index']);
    }

    public function delete()
    {
        $id = $this->request->query['id'];
        $entity = $this->People->get($id);
        $this->set('entity', $entity);
    }

    public function destroy()
    {
        if ($this->request->isPost()) {
            $data = $this->request->data['People'];
            $entity = $this->People->get($data['id']);
            $this->People->delete($entity);
        }
        return $this->redirect(['action'=>'index']);
    }
}
