<?php
class JsonDataBase
{
    public function __construct ($file)
    {
        $this->file = $file;
    }

    public function takeData () {
        if (file_exists($this->file)) {
            $file = file_get_contents($this->file);
            return json_decode($file, true);
        } else {
            return false;
        }
    }

    public function putData ($data) {
        $data = json_encode($data);
        file_put_contents($this->file, $data);
    }
}