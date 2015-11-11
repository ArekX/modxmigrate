<?php

require_once __DIR__ . '/fix_abstract.php';

class DeleteDirFix extends FixAbstract
{
    public function fix()
    {
        if (!file_exists($this->_config['file'])) {
            echo "Already removed. Skipping...\n";
            return;
        }
        $this->recursiveRemoveDir($this->_config['file']);
    }

    protected function recursiveRemoveDir($dir) 
    { 
        if (!is_dir($dir)) {
            return;
        }

        $objects = scandir($dir); 
        foreach ($objects as $object) { 
            if ($object != "." && $object != "..") { 
                if (is_dir($dir."/".$object)) {
                   $this->recursiveRemoveDir($dir."/".$object);
                } else {
                   unlink($dir."/".$object); 
                }
            } 
        }

        rmdir($dir); 
    }
}