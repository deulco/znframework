<?php namespace ZN\FileSystem;

use File, Exceptions;

class InternalFolder extends FileSystemCommon implements FolderInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    //--------------------------------------------------------------------------------------------------------
    // Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @param bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function exists(String $file) : Bool
    {
        $file = $this->rpath($file);

        if( is_dir($file) )
        {
            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // create()
    //--------------------------------------------------------------------------------------------------------
    //
    // Dizin oluşturmak için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(String $file, Int $permission = 0755, Bool $recursive = true) : Bool
    {
        $file = $this->rpath($file);

        if( is_dir($file) )
        {
           return false;
        }

        return mkdir($file, $permission, $recursive);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // rename()
    //--------------------------------------------------------------------------------------------------------
    //
    // Dosya veya dizinin adını değiştirmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function rename(String $oldName, String $newName) : Bool
    {
        $oldName = $this->rpath($oldName);

        if( ! file_exists($oldName) )
        {
            return Exceptions::throws('FileSystem', 'folder:notFoundError', $oldName);
        }

        return rename($oldName, $newName);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // deleteEmpty()
    //--------------------------------------------------------------------------------------------------------
    //
    // Boş bir dizini silmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteEmpty(String $folder) : Bool
    {
        $folder = $this->rpath($folder);

        if( ! is_dir($folder) )
        {
           return false;
        }

        return rmdir($folder);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // delete()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizini içindekilerle birlikte silmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $name) : Bool
    {
        $name = $this->rpath($name);

        if( ! is_file($name) )
        {
            return Exceptions::throws('FileSystem', 'folder:notFoundError', $name);
        }

        // Is File
        if( is_file($name) )
        {
            // Delete File
            return unlink($name);    
        }
        else
        {
            // Is Dir
            if( ! $this->files($name) )
            {
                // Delete Empty Dir
                return $this->deleteEmpty($name);
            }   
            else
            {           
                // Delete
                for( $i = 0; $i < count($this->files($name)); $i++ )
                {
                    foreach( $this->files($name) as $val )
                    {                   
                        $this->delete($name."/".$val);
                    }
                }
            }
            
            // Delete Empty Dir
            return $this->deleteEmpty($name);
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // fileInfo()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dosya veya dizine ait dosyalar ve dizinler hakkında çeşitli bilgiler almak için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function fileInfo(String $dir, String $extension = NULL) : Array
    {
        $dir = $this->rpath($dir);

        if( is_dir($dir) )
        {
            $files = $this->files($dir, $extension);
            
            $dir = suffix($dir);
            
            $filesInfo = [];
            
            foreach( $files as $file )
            {
                $filesInfo[$file]['basename']   = pathInfos($dir.$file, 'basename');
                $filesInfo[$file]['size']       = filesize($dir.$file);
                $filesInfo[$file]['date']       = filemtime($dir.$file);
                $filesInfo[$file]['readable']   = is_readable($dir.$file);
                $filesInfo[$file]['writable']   = is_writable($dir.$file);
                $filesInfo[$file]['executable'] = is_executable($dir.$file);
                $filesInfo[$file]['permission'] = fileperms($dir.$file);
            }
            
            return $filesInfo;
        }
        elseif( is_file($dir) )
        {
            return (array) File::info($dir);
        }
        else
        {
            return Exceptions::throws('FileSystem', 'folder:notFoundError', $dir);
        }   
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Copy()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizini belirtilen başka bir konuma kopyalamak için kullanılır. Bu işlem kopyalanacak dizine
    // ait diğer alt dizin ve dosyaları da kapsamaktadır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function copy(String $source, String $target) : Bool
    {
        $source = $this->rpath($source);
        $target = $this->rpath($target);

        if( ! file_exists($source) )
        {
            return Exceptions::throws('FileSystem', 'folder:notFoundError', $source);
        }
        
        if( is_dir($source) )
        {
            if( ! $this->files($source) )
            {
                return copy($source, $target);
            }
            else
            {           
                if( ! is_dir($target) && ! file_exists($target) )
                {
                    $this->create($target);
                }
                
                if( is_array($this->files($source)) ) foreach( $this->files($source) as $val )
                {
                    $sourceDir = $source."/".$val;
                    $targetDir = $target."/".$val;
                    
                    if( is_file($sourceDir) )
                    {
                        copy($sourceDir, $targetDir);
                    }
                    
                    $this->copy($sourceDir, $targetDir);
                }   

                return true;                        
            }       
        }
        else
        {
            return copy($source, $target);  
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // change()
    //--------------------------------------------------------------------------------------------------------
    //
    // PHP'nin aktif çalışma dizinini değiştirmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------  
    public function change(String $name) : Bool
    {
        $name = $this->rpath($name);

        if( ! is_dir($name) )
        {
            return Exceptions::throws('FileSystem', 'folder:notFoundError', $name);
        }

        return chdir($name);
    }

    //--------------------------------------------------------------------------------------------------------
    // basePath()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------  
    public function basePath() : String
    {
        return getcwd();
    }

    //--------------------------------------------------------------------------------------------------------
    // disk()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $dir
    // @param string $type = 'free'
    //
    // @return Float
    //
    //--------------------------------------------------------------------------------------------------------  
    public function disk(String $dir, String $type = 'free') : Float
    {
        $dir = $this->rpath($dir);

        if( ! is_dir($dir) )
        {
            return Exceptions::throws('FileSystem', 'folder:notFoundError', $dir);
        }

        if( $type === 'free' )
        {
            return disk_free_space($dir);
        }
        else
        {
            return disk_total_space($dir);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // files()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizin içindeki dosya ve dizin listesini almak için kullanılır. Eğer listelenecek dosyalar
    // arasında belli uzantılı dosyaların listelenmesi istenilirse 2. parametreye dosya uzantısı
    // verilebilir. Sadece dizinlerin listelenmesi istenirse 'dir' parametresini kullanmanız gerekir.
    // Birden fazla uzantı belirmek isterseniz 2. parametreyi ['dir', 'php'] gibi belirtebilirsiniz.
    //
    //--------------------------------------------------------------------------------------------------------
    public function files(String $path, $extension = NULL, Bool $pathType = false) : Array
    {
        $path = $this->rpath($path);

        if( ! is_dir($path) )
        {
            return Exceptions::throws('FileSystem', 'folder:notFoundError', $path);
        }

        if( is_array($extension) )
        {
            $allFiles = [];

            foreach( $extension as $ext )
            {
                $allFiles = array_merge($allFiles, $this->_files($path, $ext, $pathType));
            }

            return $allFiles;
        }

        return $this->_files($path, $extension, $pathType);
    }

    //--------------------------------------------------------------------------------------------------------
    // allFiles()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizine ait tüm alt dizin ve dosyaların listesini almak için kullanılır. İç içe dizinlerde de
    // yer alan dosyaların listelenmesini isterseniz 2. parametreyi true ayarlayabilirsiniz.
    //
    //--------------------------------------------------------------------------------------------------------
    public function allFiles(String $pattern = '*', Bool $allFiles = false) : Array
    {
        $pattern = $this->rpath($pattern);

        if( $allFiles === true )
        {
            static $classes;
        
            if( is_dir($pattern) )
            {
                $pattern = suffix($pattern).'*'; 
            }

            $files = glob($pattern);

            if( ! empty($files) ) foreach( $files as $v )
            {
                if( is_file($v) )
                {
                    $classEx = explode('/', $v);

                    $classes[] = $v;
                }
                elseif( is_dir($v) )
                {
                    $this->allFiles($v, $allFiles);
                }
            }   
            
            return $classes;
        }
        
        if( strstr($pattern, '/') && strstr($pattern, '*') === false ) 
        {
            $pattern .= "*";
        }
        
        if( strstr($pattern, '/') === false && strstr($pattern, '*') === false ) 
        {
            $pattern .= "/*";
        }

        return glob($pattern);
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // protected _files()
    //--------------------------------------------------------------------------------------------------------
    protected function _files($path, $extension, $pathType = false)
    {
        $files = [];
        
        if( empty($path) )
        {
            $path = '.';
        }

        if( $pathType === true )
        {
            $prefixPath = $path;
        }
        else
        {
            $prefixPath = '';
        }
        
        $dir = opendir($path);
        
        while( $file = readdir($dir) )
        {
            if( $file !== '.' && $file !== '..' )
            {               
                if( ! empty($extension) && $extension !== 'dir' )
                {
                    if( extension($file) === $extension )
                    {
                        $files[] = $prefixPath.$file;   
                    }
                }
                else
                {
                    if( $extension === 'dir' )
                    {
                        if( is_dir(suffix($path).$file) )
                        {
                            $files[] = $prefixPath.$file;   
                        }
                    }
                    else
                    {
                        $files[] = $prefixPath.$file;
                    }
                }
            }
        }
        
        return $files;
    }   
}