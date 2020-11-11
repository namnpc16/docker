<?php
    function show_error($errors, $name)
    {
        if ($errors->has($name)) {

            $error = '<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fas fa-ban"></i>
                            '.$errors->first($name).'
                        </div>';
            return $error;
        }
    }

?>