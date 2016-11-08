<?php
	class UtilisateurManager extends Model
	{	
		public function createUser($login,$pass,$nom,$prenom,$sexe,$age,$categorie)
		{
			$sql1= 'SELECT * from Utilisateur'; 
			$req1=$this->executerRequete($sql1,null);			
			while($data1 = $req1->fetch())
			{		
				if($login == $data1['loginUt']) 
				{
					return $login;
				}
			}			
			$sql='INSERT INTO Utilisateur VALUES (?,?,?,?,?,?,?)';
			$req=$this->executerRequete($sql,array($login,$pass,$nom,$prenom,$sexe,$age,$categorie));
			return true;
		}
			
		public function logUser($login,$pass)
		{
			$sql1= 'SELECT * from Utilisateur'; 
			$req1=$this->executerRequete($sql1,null);			
			while($data1 = $req1->fetch())
			{		
				if($login == $data1['loginUt'] && $pass == $data1['motPassUt'])
				{
					return true;
				}
				if($login == $data1['loginUt'] && $pass != $data1['motPassUt'])
				{
					return $pass;
				}
				if($login != $data1['loginUt'] && $pass == $data1['motPassUt'])
				{
					return $login;
				}
			}
			return $login;	
		}
		
		public function delogUser()
		{
			$_SESSION=array();
			session_destroy();
		}
		
		public function verifCodeCategorie($cate)
		{
		$sql='select * from CodeCategorie where nomCategorie=?';
		$req=$this->executerRequete($sql,array($cate));
		$rep=$req->fetch();
		return $rep;
		}
	}
?>