<?php
    /*
    if(isset($_GET)){
        $os = $_GET['os'];
        $dist = $_GET['dist'];
        $ver = $_GET['ver'];
    }else{*/
        $os = 'linux';
        $dist = 'ubuntu';
        $ver = '11.10';
    #}

    switch($dist){
        case "ubuntu":
            $config = json_decode(file_get_contents("config/ubuntu.json"), true);
            #var_dump($config);
            $ret = array(
                "template" => $config["template"]
                );
            $software_list = $config["version"]["common"];
            if(isset($config["version"][$ver])){
                foreach($config['version'][$ver] as $catalog => $content){
                    if(isset($software_list[$catalog])){
                        foreach($software_list[$catalog] as $i=>$common_package){
                            foreach($content as $specific_package){
                                if($common_package['name'] == $specific_package['name']){
                                    $software_list[$catalog][$i] = $specific_package;

                                }
                            }
                        }
                    }else{
                        $software_list[$catalog] = $content;
                    }
                }
            }
    }
    if(isset($software_list)){
        
        $ret = json_encode($software_list);
        echo $ret;
    }
?>
