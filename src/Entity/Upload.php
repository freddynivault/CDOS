<?php

namespace App\Entity;

use App\Repository\UploadRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UploadRepository::class)
 */
class Upload
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $namePdf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $localisation;


    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $nomStructure;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $descriptionStructure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $intitulePoste;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $descriptionPoste;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $missions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logoStructure;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreCandidature;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    private $experience;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $conventionCollective;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $outils;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tempsTravail;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */

    private $dateDebutContrat;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $dateEntretien;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     *
     */
    private $datePublication;


    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $dateArchivage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $salaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices={"BPJEPS","DEJEPS","L_Management","M_Management","L_APAS","M_APAS"}, message="Vous devez choisir une formation")
     */
    private $formation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $competences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $qualites;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices={"CDI","CDD","Stage","CDI interimaire","Service civique","Saisonnier"}, message="Vous devez choisir un type de contrat")
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices={"Emploi","Service_civ","Alternance","Stage"}, message="Vous devez choisir une catégorie pour cette offre")
     */
    private $categorieContrat;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNamePdf()
    {
        return $this->namePdf;
    }

    /**
     * @param mixed $namePdf
     */
    public function setNamePdf($namePdf): void
    {
        $this->namePdf = $namePdf;
    }


    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * @param mixed $localisation
     */
    public function setLocalisation($localisation): void
    {
        $this->localisation = $localisation;
    }

    /**
     * @return mixed
     */
    public function getNomStructure()
    {
        return $this->nomStructure;
    }

    /**
     * @param mixed $nomStructure
     */
    public function setNomStructure($nomStructure): void
    {
        $this->nomStructure = $nomStructure;
    }

    /**
     * @return mixed
     */
    public function getDescriptionStructure()
    {
        return $this->descriptionStructure;
    }

    /**
     * @param mixed $descriptionStructure
     */
    public function setDescriptionStructure($descriptionStructure): void
    {
        $this->descriptionStructure = $descriptionStructure;
    }

    /**
     * @return mixed
     */
    public function getIntitulePoste()
    {
        return $this->intitulePoste;
    }

    /**
     * @param mixed $intitulePoste
     */
    public function setIntitulePoste($intitulePoste): void
    {
        $this->intitulePoste = $intitulePoste;
    }

    /**
     * @return mixed
     */
    public function getDescriptionPoste()
    {
        return $this->descriptionPoste;
    }

    /**
     * @param mixed $descriptionPoste
     */
    public function setDescriptionPoste($descriptionPoste): void
    {
        $this->descriptionPoste = $descriptionPoste;
    }

    /**
     * @return mixed
     */
    public function getMissions()
    {
        return $this->missions;
    }

    /**
     * @param mixed $missions
     */
    public function setMissions($missions): void
    {
        $this->missions = $missions;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut): void
    {
        $this->statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getLogoStructure()
    {
        return $this->logoStructure;
    }

    /**
     * @param mixed $logoStructure
     */
    public function setLogoStructure($logoStructure): void
    {
        $this->logoStructure = $logoStructure;
    }

    /**
     * @return mixed
     */
    public function getNombreCandidature()
    {
        return $this->nombreCandidature;
    }

    /**
     * @param mixed $nombreCandidature
     */
    public function setNombreCandidature($nombreCandidature): void
    {
        $this->nombreCandidature = $nombreCandidature;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param mixed $experience
     */
    public function setExperience($experience): void
    {
        $this->experience = $experience;
    }

    /**
     * @return mixed
     */
    public function getConventionCollective()
    {
        return $this->conventionCollective;
    }

    /**
     * @param mixed $conventionCollective
     */
    public function setConventionCollective($conventionCollective): void
    {
        $this->conventionCollective = $conventionCollective;
    }

    /**
     * @return mixed
     */
    public function getOutils()
    {
        return $this->outils;
    }

    /**
     * @param mixed $outils
     */
    public function setOutils($outils): void
    {
        $this->outils = $outils;
    }

    /**
     * @return mixed
     */
    public function getTempsTravail()
    {
        return $this->tempsTravail;
    }

    /**
     * @param mixed $tempsTravail
     */
    public function setTempsTravail($tempsTravail): void
    {
        $this->tempsTravail = $tempsTravail;
    }

    /**
     * @return mixed
     */
    public function getDateDebutContrat()
    {
        return $this->dateDebutContrat;
    }

    /**
     * @param mixed $dateDebutContrat
     */
    public function setDateDebutContrat($dateDebutContrat): void
    {
        $this->dateDebutContrat = $dateDebutContrat;
    }

    /**
     * @return mixed
     */
    public function getDateEntretien()
    {
        return $this->dateEntretien;
    }

    /**
     * @param mixed $dateEntretien
     */
    public function setDateEntretien($dateEntretien): void
    {
        $this->dateEntretien = $dateEntretien;
    }

    /**
     * @return mixed
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * @param mixed $datePublication
     */
    public function setDatePublication($datePublication): void
    {
        $this->datePublication = $datePublication;
    }

    /**
     * @return mixed
     */
    public function getDateArchivage()
    {
        return $this->dateArchivage;
    }

    /**
     * @param mixed $dateArchivage
     */
    public function setDateArchivage($dateArchivage): void
    {
        $this->dateArchivage = $dateArchivage;
    }

    /**
     * @return mixed
     */
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * @param mixed $salaire
     */
    public function setSalaire($salaire): void
    {
        $this->salaire = $salaire;
    }

    /**
     * @return mixed
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * @param mixed $formation
     */
    public function setFormation($formation): void
    {
        $this->formation = $formation;
    }

    /**
     * @return mixed
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * @param mixed $competences
     */
    public function setCompetences($competences): void
    {
        $this->competences = $competences;
    }

    /**
     * @return mixed
     */
    public function getQualites()
    {
        return $this->qualites;
    }

    /**
     * @param mixed $qualites
     */
    public function setQualites($qualites): void
    {
        $this->qualites = $qualites;
    }

    /**
     * @return mixed
     */
    public function getTypeContrat()
    {
        return $this->typeContrat;
    }

    /**
     * @param mixed $typeContrat
     */
    public function setTypeContrat($typeContrat): void
    {
        $this->typeContrat = $typeContrat;
    }

    /**
     * @return mixed
     */
    public function getCategorieContrat()
    {
        return $this->categorieContrat;
    }

    /**
     * @param mixed $categorieContrat
     */
    public function setCategorieContrat($categorieContrat): void
    {
        $this->categorieContrat = $categorieContrat;
    }



}
