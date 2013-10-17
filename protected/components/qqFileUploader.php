<?php

class qqUploadedFileXhr {

    // public $filename='';

    function save($path) {
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        if ($realSize != $this->getSize()) {
            return false;
        }

        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        return true;
    }

    function getName() {
        return $_GET['qqfile'];
    }

    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])) {
            return (int) $_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }

}

/**


 * Handle file uploads via regular form post (uses the $_FILES array)


 */
class qqUploadedFileForm {

    function save($path) {
        if (!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)) {
            return false;
        }
        return true;
    }

    function getName() {
        return $_FILES['qqfile']['name'];
    }

    function getSize() {
        return $_FILES['qqfile']['size'];
    }

}

class qqFileUploader {

    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760) {
        $allowedExtensions = array_map("strtolower", $allowedExtensions);
        $this->allowedExtensions = $allowedExtensions;
        $this->sizeLimit = $sizeLimit;
        //$this->checkServerSettings();

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false;
        }
    }

    private function checkServerSettings() {
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));
        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit) {
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");
        }
    }

    private function toBytes($str) {
        $val = trim($str);
        $last = strtolower($str[strlen($str) - 1]);
        switch ($last) {


            case 'g': $val *= 1024;


            case 'm': $val *= 1024;


            case 'k': $val *= 1024;
        }


        return $val;
    }

    /**


     * Returns array('success'=>true) or array('error'=>'error message')


     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE) {
        if (!is_writable($uploadDirectory)) {
            return array('error' => "Server error. Upload directory($uploadDirectory) isn't writable.");
        }
//        var_dump($this->file);
//        die();
        if (!$this->file) {
            return array('error' => 'No files were uploaded.');
        }

        $size = $this->file->getSize();
        if ($size == 0) {
            return array('error' => 'File is empty');
        }

        if ($size > $this->sizeLimit) {
            return array('error' => 'Файл слишком большой');
        }

        /*    не корректно работает с UTF-8
          $pathinfo = pathinfo($this->file->getName());
         */

        $pathinfo = self::pathinfo_utf($this->file->getName());

        //$filename = $pathinfo['filename'];
        $filename = md5(uniqid());

        if (isset($pathinfo['extension']))
            $ext = $pathinfo['extension'];
        else
            $ext = '';
        if ($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)) {
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'Файл не соответствует расширениям ' . $these . '.');
        }
        if (!$replaceOldFile) {
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }





        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)) {


            return array('success' => true, 'filename' => $filename . '.' . $ext, 'user_filename' => $pathinfo['filename'] . '.' . $ext, 'size' => $size, 'ext' => $ext);
        } else {


            return array('error' => 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
    }

    private function pathinfo_utf($path) {


        if (strpos($path, '/') !== false)
            $basename = end(explode('/', $path));


        elseif (strpos($path, '\\') !== false)
            $basename = end(explode('\\', $path));


        else {
            $basename = $path;


            $path = '/' . $path;
        }


        //return false;


        if (empty($basename))
            return false;





        $dirname = substr($path, 0, strlen($path) - strlen($basename) - 1);
        $extension = '12';
        if (strpos($basename, '.') !== false) {
            $a = explode('.', $basename);
            $bn = end($a);
            $extension = $bn;
            $filename = substr($basename, 0, strlen($basename) - strlen($extension) - 1);
        } else {
            $extension = '';
            $filename = $basename;
        }

        return array
            (
            'dirname' => $dirname,
            'basename' => $basename,
            'extension' => $extension,
            'filename' => $filename
        );
    }

}
?>


