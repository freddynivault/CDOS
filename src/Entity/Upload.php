<?php

namespace App\Entity;

use App\Repository\UploadRepository;
use Doctrine\ORM\Mapping as ORM;

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
    private $namepdf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $nom_structure;

    /**
     * @return mixed
     */
    public function getNomStructure()
    {
        return $this->nom_structure;
    }

    /**
     * @param mixed $nom_structure
     */
    public function setNomStructure($nom_structure): void
    {
        $this->nom_structure = $nom_structure;
    }

    /**
     * @return mixed
     */
    public function getDescriptionStructure()
    {
        return $this->description_structure;
    }

    /**
     * @param mixed $description_structure
     */
    public function setDescriptionStructure($description_structure): void
    {
        $this->description_structure = $description_structure;
    }

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description_structure;




    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intitule_poste;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description_poste;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $missions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo_structure;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombre_candidature;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $experience;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $convention_collective;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $outils;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $temps_travail;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_debut_contrat;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_entretien;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_publication;

    /**
     * @return mixed
     */
    public function getLogoStructure()
    {
        return $this->logo_structure;
    }

    /**
     * @param mixed $logo_structure
     */
    public function setLogoStructure($logo_structure): void
    {
        $this->logo_structure = $logo_structure;
    }

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_archivage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $formation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $competences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $qualites;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type_contrat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categorie_contrat;


    public function getId(): ?int
    {
        return $this->id;
    }





    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getIntitulePoste(): ?string
    {
        return $this->intitule_poste;
    }

    public function setIntitulePoste(string $intitule_poste): self
    {
        $this->intitule_poste = $intitule_poste;

        return $this;
    }

    public function getDescriptionPoste(): ?string
    {
        return $this->description_poste;
    }

    public function setDescriptionPoste(string $description_poste): self
    {
        $this->description_poste = $description_poste;

        return $this;
    }

    public function getMissions(): ?string
    {
        return $this->missions;
    }

    public function setMissions(string $missions): self
    {
        $this->missions = $missions;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getNombreCandidature(): ?int
    {
        return $this->nombre_candidature;
    }

    public function setNombreCandidature(int $nombre_candidature): self
    {
        $this->nombre_candidature = $nombre_candidature;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getConventionCollective(): ?string
    {
        return $this->convention_collective;
    }

    public function setConventionCollective(string $convention_collective): self
    {
        $this->convention_collective = $convention_collective;

        return $this;
    }

    public function getOutils(): ?string
    {
        return $this->outils;
    }

    public function setOutils(?string $outils): self
    {
        $this->outils = $outils;

        return $this;
    }

    public function getTempsTravail(): ?int
    {
        return $this->temps_travail;
    }

    public function setTempsTravail(int $temps_travail): self
    {
        $this->temps_travail = $temps_travail;

        return $this;
    }





    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(?int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(?string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getCompetences(): ?string
    {
        return $this->competences;
    }

    public function setCompetences(?string $competences): self
    {
        $this->competences = $competences;

        return $this;
    }

    public function getQualites(): ?string
    {
        return $this->qualites;
    }

    public function setQualites(?string $qualites): self
    {
        $this->qualites = $qualites;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->type_contrat;
    }

    public function setTypeContrat(string $type_contrat): self
    {
        $this->type_contrat = $type_contrat;

        return $this;
    }

    public function getCategorieContrat(): ?string
    {
        return $this->categorie_contrat;
    }

    public function setCategorieContrat(string $categorie_contrat): self
    {
        $this->categorie_contrat = $categorie_contrat;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getDateArchivage()
    {
        return $this->date_archivage;
    }

    /**
     * @param mixed $date_archivage
     */
    public function setDateArchivage($date_archivage): void
    {
        $this->date_archivage = $date_archivage;
    }

    /**
     * @return mixed
     */
    public function getDateDebutContrat()
    {
        return $this->date_debut_contrat;
    }

    /**
     * @param mixed $date_debut_contrat
     */
    public function setDateDebutContrat($date_debut_contrat): void
    {
        $this->date_debut_contrat = $date_debut_contrat;
    }

    /**
     * @return mixed
     */
    public function getDateEntretien()
    {
        return $this->date_entretien;
    }

    /**
     * @param mixed $date_entretien
     */
    public function setDateEntretien($date_entretien): void
    {
        $this->date_entretien = $date_entretien;
    }

    /**
     * @return mixed
     */
    public function getDatePublication()
    {
        return $this->date_publication;
    }

    /**
     * @param mixed $date_publication
     */
    public function setDatePublication($date_publication): void
    {
        $this->date_publication = $date_publication;
    }

    /**
     * @return mixed
     */
    public function getNamepdf()
    {
        return $this->namepdf;
    }

    /**
     * @param mixed $namepdf
     */
    public function setNamepdf($namepdf): void
    {
        $this->namepdf = $namepdf;
    }


}
