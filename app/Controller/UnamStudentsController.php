<?php
class UnamStudentsController extends AppController{
	public $name = 'UnamStudents';
	
    public function search($id) 
    {
        // Si la petición fue realizada por medio de requestAction
        if(isset($this->params['requested'])) {
			// return $this->UnamStudent->findAllById($id);
			return $this->UnamStudent->findAllBycuenta($id);				
      }
}
}