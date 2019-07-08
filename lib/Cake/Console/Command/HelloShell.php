<?php
class HelloShell extends AppShell {
	public $uses = array('Category');
    public function main() {
    	$this->Category->updateAll(array('Category.description'=>true));
        $this->out('Hello world.');
    }
	
	public function hey_there(){
		$this->out('Hey there '.$this->args[0]);
	}
	
	public function show() {
		$this->User->unbindAllModel();
		$user = $this->User->find('first',array('conditions' => array('id' => 1)));
        $this->out(print_r($user, true));
    }
}
?>