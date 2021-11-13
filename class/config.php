<?php
class Database
{

    private $conect = null;

    public function __construct()
    {
        try {
            $this->conect = new PDO('mysql:host=localhost;dbname=incidencias','root','');
            $this->conect->exec("set names utf8");
            $this->conect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function connet()
    {
        return $this->conect;
    }
	public function close() {
        $this->conect = null;
    }
	public function __destruct()
	{
		$this->close();
	}
}

$bd = (new Database())->connet();