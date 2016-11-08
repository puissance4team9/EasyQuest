<?php 
class questionManager extends Model
{			
	public function creerQuestion($login,$quest,$date)
	{	
		$sql= 'SELECT idQuestion FROM Question';
		$req=$this->executerRequete($sql,null);
		
		$newId=1;
		while($data1 = $req->fetch())
		{		
			$newId++;
		}
		
		if($newId==1)
		{
			$sql1= 'INSERT INTO Question VALUES (1,?,?,?)';
			$req1=$this->executerRequete($sql1,array($login,$quest,$date));
			return $newId;
		}
		else
		{
			$ess=0;
			$sql2='SELECT idQuestion FROM Question';
			$req2=$this->executerRequete($sql2,null);
			
			while($data=$req2->fetch())
			{		
				if($data['idQuestion']>$ess) $ess=$data['idQuestion'];
			}
			$ess=$ess+1;
			$sql3= 'INSERT INTO Question VALUES (?,?,?,?)';
			$req3=$this->executerRequete($sql3,array($ess,$login,$quest,$date));
			return $ess;
		}
	}
	
	public function inserQuestion($idQuestion,$Categorie) 
	{
		$sql= 'INSERT INTO Participant VALUES (?,?)';
		$req=$this->executerRequete($sql,array($idQuestion,$Categorie));
	}
	
	public function inserTypeReponse($idQuestion,$typeReponse,$x) 
	{
		$sql= 'INSERT INTO TypeReponse VALUES (?,?,?)';
		$req=$this->executerRequete($sql,array($idQuestion,$typeReponse,$x));
	}
	
	
	public function mesQuestions($login)
	{
		$sql= 'SELECT * from Question where loginUt=? ';
		$req=$this->executerRequete($sql,array($login));
		$question=$req->fetchAll();
		return($question);
	}
	
	public function vosQuestions($idCategorie)
	{
		$sql='select * from Question,Participant,DateTri where idCategorie=? AND Participant.idQuestion=Question.idQuestion AND Question.date=DateTri.Date ORDER BY datePourLeTri desc';
		$req=$this->executerRequete($sql,array($idCategorie));
		$question=$req->fetchAll();
		return($question);
	}
	
	public function questionTypeRep($idQuestion)
	{
		$sql='select * from TypeReponse where idQuestion=? ORDER BY ordre asc; ';
		$req=$this->executerRequete($sql,array($idQuestion));
		$question=$req->fetchAll();
		return($question);
	}
	
	public function questionLabel($idQuestion)
	{
		$sql='select * from Question where idQuestion=? ';
		$req=$this->executerRequete($sql,array($idQuestion));
		$question=$req->fetch();
		return($question);
	}
	public function totalParticipant($idQuestion)
	{
		$sql='select COUNT(loginUt) from Question where idQuestion=? ';
		$req=$this->executerRequete($sql,array($idQuestion));
		$question=$req->fetchAll();
		return($question);
	}
	
	public function categorieUx($login)
	{
		$sql='select * from Utilisateur where loginUt=? ';
		$req=$this->executerRequete($sql,array($login));
		$cat=$req->fetch();
		return($cat);
	}
	
	public function insertReponse($login,$question,$reponse)
	{
		$sql='INSERT INTO Reponse VALUES(?,?,?) ';
		$req=$this->executerRequete($sql,array($login,$question,$reponse));
	}
	
	public function nbsQuestions($login)
	{
		$sql='select * from Question where loginUt=? ';
		$req=$this->executerRequete($sql,array($login));
		$question=$req->fetchAll();
		$nbs=0;
		foreach($question as $data)
		{
			$nbs++;
		}
		return($nbs);
	}
	
	public function aRepondu($login,$question)
	{
		$sql='select * from Reponse where loginUt=? AND idQuestion=?';
		$req=$this->executerRequete($sql,array($login,$question));
		$question=$req->fetchAll();
		$nbs=0;
		foreach($question as $data)
		{
			$nbs++;
		}
		return($nbs);	
	}
	
	public function nomPrenom($question)
	{
		$sql='select * from Question,Utilisateur where Question.idQuestion=? AND Question.loginUt=Utilisateur.loginUt';
		$req=$this->executerRequete($sql,array($question));
		$question=$req->fetch();
		return($question);
	}
	
	public function infoUx($login)
	{
		$sql='select * from Utilisateur where loginUt=? ';
		$req=$this->executerRequete($sql,array($login));
		$question=$req->fetch();
		return($question);
	}
	
	public function insertDateTri($date,$dateTri)
	{
		$sql='INSERT INTO DateTri values(?,?)';
		$req=$this->executerRequete($sql,array($date,$dateTri));
	}
	
	public function verifExistDate($date)
	{
		$sql= 'SELECT * from DateTri'; 
		$req=$this->executerRequete($sql);			
		while($data = $req->fetch())
		{		
			if($date == $data['Date']) 
			{
				return false;
			}
		}			
		return true;
	}
	
	public function toutesLesReponses($question)
	{
		$sql='select count(idQuestion) as nbsRepTot from Reponse where idQuestion=?';
		$req=$this->executerRequete($sql,array($question));
		$question=$req->fetch();
		$nbs=$question['nbsRepTot'];
		return($nbs);	
	}
	
	public function resultatDuSondage($question,$reponse)
	{
		$sql='select count(idQuestion) as nbsRepTot from Reponse where idQuestion=? and reponse=?';
		$req=$this->executerRequete($sql,array($question,$reponse));
		$question=$req->fetch();
		$nbs=$question['nbsRepTot'];
		return($nbs);	
	}
	
	public function statParticipant($critere,$question)
	{
		$sql='select '.$critere.' from Reponse, Utilisateur where idQuestion=? and Reponse.loginUt=Utilisateur.loginUt';
		$req=$this->executerRequete($sql,array($question));
		$resultat=$req->fetchAll();
		return($resultat);
	}
	
	public function statParTypeRep($question,$typeRep,$critere,$critereRep)
	{
		if($critere=="ageUt")
		{
			if($critereRep=="-18 ans") 
			{
				$sql='select count(Utilisateur.loginUt) as nbsRepTot from Reponse, Utilisateur where idQuestion=? and ageUt<18 and Reponse=? and Reponse.loginUt=Utilisateur.loginUt';
				$req=$this->executerRequete($sql,array($question,$typeRep));
			}
			else
			{
				if($critereRep=="18-22 ans")
				{
					$sql='select count(Utilisateur.loginUt) as nbsRepTot from Reponse, Utilisateur where idQuestion=? and ageUt>=18 and ageUt<=22 and Reponse=? and Reponse.loginUt=Utilisateur.loginUt';
					$req=$this->executerRequete($sql,array($question,$typeRep));
				}
				else
				{
					if($critereRep=="23-30 ans")
					{
						$sql='select count(Utilisateur.loginUt) as nbsRepTot from Reponse, Utilisateur where idQuestion=? and ageUt>=23 and ageUt<=30 and Reponse=? and Reponse.loginUt=Utilisateur.loginUt';
						$req=$this->executerRequete($sql,array($question,$typeRep));
					}
					else
					{
						if($critereRep=="31-50 ans")
						{
							$sql='select count(Utilisateur.loginUt) as nbsRepTot from Reponse, Utilisateur where idQuestion=? and ageUt>=31 and ageUt<=50 and Reponse=? and Reponse.loginUt=Utilisateur.loginUt';
							$req=$this->executerRequete($sql,array($question,$typeRep));
						}
						else
						{
							$sql='select count(Utilisateur.loginUt) as nbsRepTot from Reponse, Utilisateur where idQuestion=? and ageUt>50 and Reponse=? and Reponse.loginUt=Utilisateur.loginUt';
							$req=$this->executerRequete($sql,array($question,$typeRep));
						}
					}
				}
			}
		}
		else
		{
			$sql='select count(Utilisateur.loginUt) as nbsRepTot from Reponse, Utilisateur where idQuestion=? and '.$critere.'=? and Reponse=? and Reponse.loginUt=Utilisateur.loginUt';
			$req=$this->executerRequete($sql,array($question,$critereRep,$typeRep));
		}
		$resultat=$req->fetch();
		$nbs=$resultat['nbsRepTot'];
		return($nbs);
	}
	
}
?>
