<?php
/* SVN FILE: $Id$ */
/**
 * Pagination Array Component class file.
 * @subpackage    cake.cake.libs.view.helpers
 */
App::uses('Component', 'Controller');
App::uses('Router', 'Routing');
class PaginatorArrayComponent extends Component {
	public $component;
	public $options = array();
	public $limit = 3;
	public $step = 1;
	function __construct()
	{
		
	}
	public function initialize(Controller $controller) {
	
		$this->controller = $controller;
	
	}

    function startup( Controller $controller){
        $this->controller = & $controller;
    }

    function getParamsPaging($model, $page, $total, $current){
        $pageCount = ceil($total / $this->limit);
        $prevPage = '';
        $nextPage = '';

        if($page > 1)
            $prevPage = $page - 1;

        if($page + 1 <= $pageCount)
            $nextPage = $page + 1;

        return array(
            $model => array(
                'page' => $page,
                'current' => $current,
                'count' => $total,
                'prevPage' => $prevPage,
                'nextPage' => $nextPage,
                'pageCount' => $pageCount,
                'defaults' => array(
                    'limit' =>  $this->limit,
                    'step' => $this->step,
                    'order' => array(),
                    'conditions' => array(),

                ),
                'options' => array(
                    'page' => $page,
                    'limit' =>  $this->limit,
                    'order' => array(),
                    'conditions' => array(),

                )
            )
        );
    }

}
?>