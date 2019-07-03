<?php

class userModel
{

    private $_bdd;

	public function __construct($host,$db,$username,$pass,$port=3306)
	{		
		 $this->_bdd = new PDO("mysql:host=".$host.";dbname=".$db.";port=".$port,$username,$pass);
		 $this->_bdd->exec("SET CHARACTER SET utf8");
	} 

	public function lireTout() 
	{				
		$sth = $this->_bdd->prepare("SELECT * FROM user");
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}

	public function lire($donnee)
   {
		$sth = $this->_bdd->prepare("SELECT * FROM user WHERE num=?");
		$sth->execute(array($donnee['num']));		
		return $sth->fetchAll(PDO::FETCH_ASSOC);
		
	}

   
	public function creer($donnee)
	{	
		$sth = $this->_bdd->prepare("INSERT INTO user (num,nom,localisation,email,boite_postale,telephone,categorie) VALUES (?,?,?,?,?,?,?);");
		$sth->execute(array(null,$donnee['nom'],$donnee['adresse'],$donnee['email'],$donnee['boitepo'],$donnee['telephone'],$donnee['categorie']));	
		return $this->_bdd->lastInsertId();
	}
    

    public function MAJ($donnee)
	 {		
		$sth = $this->dbh->prepare("UPDATE user SET num = IF(? = NULL, num , ?), nom = IF(? = NULL, nom , ?),localisation = IF(? = NULL, localisation , ?), email = IF(? = NULL, email , ?) , boite_postale = IF(? = NULL, boite_postale , ?) , telephone = IF(? = NULL, telephone , ?) , categorie = IF(? = NULL, email , ?)WHERE num=?");
		$sth->execute(array($donnee['num'],$donnee['num'],$donnee['nom'],$donnee['nom'],$donnee['localisation'],$donnee['localisation'],$donnee['email'],$donnee['email'],$donnee['boite_postale'],$donnee['boite_postale'],$donnee['telephone'],$donnee['telephone'],$donnee['categorie'],$donnee['categorie']));
  
		return 1;

    }


	public function supprimer($donnee) 
	{				
		$sth = $this->dbh->prepare("DELETE FROM user WHERE num=?");
		$sth->execute(array($donnee['num']));
		return 1;
	}
  	 

}

?>