<?php
class Utils {
    public static function getFileSizeUnderEvent($eventID){
        $path = '../Files/Events/'.$eventID.'/';

        return Utils::getTotalSize($path);
    }

    public static function getWebsiteAbsolute(){
        return "https://mrc353.encs.concordia.ca/";
    }
    public static function getYearlyCost(){
        return 1500;
    }

    public static function getTotalSize($dir){
        $size = 0;
        if(is_dir($dir))
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file){
                $size += $file->getSize();
            }
        return $size;
    }

    public static function getDiskUsageFactor($eventID){
        $size = Utils::getFileSizeUnderEvent($eventID);
        $totalSize = Utils::getTotalSize('../Files/');
	if($totalSize == 0)
		$totalSize = 1;
	$factor = $size / $totalSize;
        return $factor;
    }
}


?>
