<div class="breadcrumb">
    <div class="container">				
        <a href="/">Home</a><span class="arrow"></span>
                <h1 class="current-crumb">
                <?php //echo ($this->request->params['controller'] == 'Careers')?Inflector::singularize($this->request->params['controller']):$this->request->params['controller'];?>
                    <?php if($this->request->params['controller'] == 'Careers'){
                                echo Inflector::singularize($this->request->params['controller']);					
                        }else if($this->request->params['action'] == 'search'){
                                echo $this->request->params['controller'] = 'Search';
                        }else if($this->request->params['controller'] == 'Abouts'){
                                echo 'About Us';;
                        }else if($this->request->params['controller'] == 'Supports' && $this->request->params['action']=='contact_us'){
                                echo 'Contact Us';
                        }else if($this->request->params['controller'] == 'Supports'){
                                echo Inflector::singularize($this->request->params['controller']);
                        }else if($this->request->params['action'] == 'archive'){
                                echo 'Archive';
                        }else if($this->request->params['controller'] == 'articles' && $this->request->params['action']=='index' && !empty ($this->request->params['pass'])){
                                echo 'Categories';
                        }else{
                                echo $this->request->params['controller'];
                        }  ?>
                </h1>
    </div> 
</div>