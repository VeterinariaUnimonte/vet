<?php

namespace VeterinariaUnimonte;


class App {

    public $name;

    public $url;



    public function __construct() {

        if (file_exists('./conf/navigation.php')) {
            require './conf/navigation.php';
        } else {
            require '../conf/navigation.php';
        }

        $this->name = $config['name'];
        $this->url = $config['url'];
}


}
