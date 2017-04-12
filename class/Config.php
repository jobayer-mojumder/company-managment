<?php
    class Config{

        public function getSuccessMsg($msg){
            echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>'.$msg.'</strong>
                </div>';
        }

        public function getErrorMsg($msg){
           echo '<div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                     <strong>'.$msg.'</strong>
                </div>';
        }



    }


?>