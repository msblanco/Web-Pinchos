<?php

class File {
    private $file;

    public function __construct($file) {
        $this->file = $file;
    }

    public function get_name() {
        return $this->file['name'];
    }

    public function get_extension() {
        return substr($this->get_name(), strpos($this->get_name(), '.'), strlen($this->get_name()) - 1);
    }

    public function is_image() {
        $allowed_filetypes = array('.jpg','.gif','.bmp','.png');
        return in_array($this->get_extension(), $allowed_filetypes);
    }

    public function get_size() {
        return filesize($this->file['tmp_name']);
    }

    public function get_tmp_path() {
        return $this->file['tmp_name'];
    }

    public function save($path, $filename = null) {
        $filenew = FileManager::get_upload_path() . $this->get_name();
        if ($filename != null) {
            $filenew = FileManager::get_upload_path() . $filename . $this->get_extension();
        }
        if (move_uploaded_file($this->file['tmp_name'], $filenew)) {
            return $filenew;
        }
        else return FALSE;
    }
};

class FileManager {
    private static $instance;

    private static $max_filesize = 1572864;
    private static $upload_path = "./resources/img/";

    private function __construct() {
        if (!is_writeable($this->get_upload_path())) {
            trigger_error('No puedes subir archivos a ' . $this->upload_path . ' porque no tienes permisos suficientes.', E_USER_ERROR);
        }
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public static function set_max_filesize($filesize) {
        self::$max_filesize = $filesize;
    }

    public static function set_upload_path($path) {
        self::$upload_path = $path;
    }

    public static function get_max_filesize() {
        return self::$max_filesize;
    }

    public static function get_upload_path() {
        return self::$upload_path;
    }

    public function get_file() {
        if (isset($_FILES['userfile'])) {
            if (filesize($_FILES['userfile']['tmp_name']) > $this->max_filesize) {
                trigger_error('El archivo supera el tamaño máximo', E_USER_ERROR);
                return FALSE;
            }
            return new File($_FILES['userfile']);
        }
        else {
            trigger_error('No se ha subido un archivo', E_USER_ERROR);
            return 'No se ha subido un archivo';
        }
    }
};

?>
