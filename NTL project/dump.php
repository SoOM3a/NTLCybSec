<?php
/**
 * Created by PhpStorm.
 * User: abdo
 * Date: 3/15/18
 * Time: 4:18 AM
 */



// Database Connection
require("configuration.php");


if(false === $con)
{
    die("couldn't connect to database");
}


$databases[] ="test";


//start exporting databases
foreach($databases as $mysql_database)
{

    echo sprintf("exporting database: %s", $mysql_database).PHP_EOL;
    //see which tables we have
    $sql = "SHOW TABLES;";
    $result = mysqli_query($sql);
    $tables = array();
    while($row = mysqli_fetch_array($result))
    {
        $tables[] = $row[0];
    }
    if(!count($tables))
    {
        echo ("no tables to export").PHP_EOL;
        continue;
    }
    $dir = $mysql_database."_db_export_tmp";
    if(!is_dir($dir))
    {
        if(!mkdir($dir, 0775))
        {
            die(sprintf("couldn't create directory %s", $dir)); //would probably affect all databases
        }
    }
    //export each table individually
    foreach($tables as $table)
    {
        $filename = $dir.DIRECTORY_SEPARATOR.$table.".sql";
        if($mysql_password != "")
        {
            $cmd = sprintf("mysqldump -h %s -u %s -p%s %s %s > %s", $mysql_host, $mysql_user, $mysql_password, $mysql_database, $table, $filename);
        }
        else
        {
            $cmd = sprintf("mysqldump -h %s -u %s %s %s > %s", $mysql_host, $mysql_user, $mysql_database, $table, $filename);
        }
        echo sprintf("exporting table: %s", $table).PHP_EOL;
        system($cmd, $return);
        if(0 !== $return)
        {
            die(sprintf("could not execute command %s", $cmd));
        }
    }
    //zip it up
    $zip = new ZipArchive();
    //remove potential old file
    $zip_file = $mysql_database.strftime($date_postfix).".zip";
    if(file_exists($zip_file))
    {
        unlink($zip_file);
    }
    if(true !== $zip -> open($zip_file, ZipArchive::CREATE))
    {
        die(sprintf("Couldn't create zip archive %s", $zip_file)); //would probably affect other exports, quit script
    }
    $directory = realpath($dir);
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($files as $file)
    {
        $file = realpath($file);
        $zip -> addFile($file, str_replace($directory . DIRECTORY_SEPARATOR, '', $file));
    }
    $zip -> close();
    //remove sql directory
    foreach($files as $file)
    {
        unlink(realpath($file));
    }
    rmdir($dir);
    echo (sprintf("Database %s successfully backed up to %s", $mysql_database, $zip_file)).PHP_EOL;
} //end of database loop




?>