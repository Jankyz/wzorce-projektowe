<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 14.10.2018
 * Time: 19:17
 */

/**
 * wzorzec projektowy - Kompozyt - składanie czegoś
 * - grupa obiektów ktore mozemy traktowac jako jeden obiekt
 * - hierarchia w formie struktury drzewiastej
 * Przykład:
 * - struktura plików oraz katalogow
 * - plik jest obiektem, katalog rowniez jest obiektem
 * - katalog jest jednoczesnie kolekcja obiektów reprezentujacych pliki
 *Schemat
 * FileSystem
 * File
 * Folder
 *
 * Folder -> File
 *        -> File
 *        -> Folder
 */

interface FileSystem
{
    public function getContent();
}

/**
 * Class Folder
 */
class Folder implements FileSystem
{
    protected $files = [];

    public function addFile($file)
    {
        $this->files[] = $file;
    }

    public function getContent()
    {
        $content = [];

        foreach ($this->files as $file) {
            $content[]  = $file->getContent();
        }
        return $content;
    }
}

/**
 * Class File
 */
class File implements FileSystem
{
    public function getContent()
    {
        return 'Zawartość pliku';
    }
}

/**
 * Kod od strony klienta
 */

$file1 = new File();
$file2 = new File();

$folder1 = new Folder();
$folder2 = new Folder();

$folder2->addFile($file1);
$folder2->addFile($file2);

$folder1->addFile($file1);
$folder1->addFile($file2);
$folder1->addFile($folder2);

print_r($folder1->getContent());