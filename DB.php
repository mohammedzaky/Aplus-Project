<?php

class DataBase
{
      private $pd=null;

	public function __construct($name)
	{
	   $this->pd=new PDO("mysql:host=localhost;dbname=$name","root","");

	}
	 public function myExec($q)
	{
	   $this->pd->exec($q);

	}
	public function getRows($q,$arg)
	{
	    $stm= $this->pd->prepare($q);
		$stm->execute($arg);
		return $stm->fetchAll();

	}
	public function getRow($q,$arg)
	{
	    $stm= $this->pd->prepare($q);
		$stm->execute($arg);
		return $stm->fetch();
	}

	public function queryOp($q,$arg)
	{
	  $stm= $this->pd->prepare($q);
	  $stm->execute($arg);

	}
         public function getCount($q,$arg)
	 {
	  $stm=$this->pd->prepare($q);
	  $stm->execute($arg);
	  return $stm->rowCount();
	 }

}
 $db=new DataBase("cars_database");

?>
