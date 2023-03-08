<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    private function loadDatasEffets(ObjectManager $manager): array {
	//  Le nom du fichier contenant les plans sous forme de tableaux PHP
	$file = dirname(__DIR__, 2) . '/tests/datasFixtures/effetsFixture.php';

	$liste = [];

	//  Charger le fichier s'il existe
	if (file_exists($file)) {
	    $liste = include $file;
	}
	//  Instancier et persister les Plans
	foreach ($liste as $datas) {
	    $entity = new \App\Entity\Effet();
	    $entity->setEffet($datas['effet']);

	    $manager->persist($entity);
	    $entities[] = $entity;
	}
	return $entities;
    }

    private function loadDatasTypesArtefacts(ObjectManager $manager): array {
	//  Le nom du fichier contenant les plans sous forme de tableaux PHP
	$file = dirname(__DIR__, 2) . '/tests/datasFixtures/typesArtefactsFixture.php';

	$liste = [];

	//  Charger le fichier s'il existe
	if (file_exists($file)) {
	    $liste = include $file;
	}
	//  Instancier et persister les Plans
	foreach ($liste as $datas) {
	    $entity = new \App\Entity\TypeArtefact();
	    $entity->setNom($datas['nom']);

	    $manager->persist($entity);
	    $entities[] = $entity;
	}
	return $entities;
    }

    private function loadDatasArtefacts(ObjectManager $manager, array $typeArtefacts): array {
	//  Le nom du fichier contenant les plans sous forme de tableaux PHP
	$file = dirname(__DIR__, 2) . '/tests/datasFixtures/artefactsFixture.php';

	$liste = [];

	//  Charger le fichier s'il existe
	if (file_exists($file)) {
	    $liste = include $file;
	}
	//  Instancier et persister les Plans
	foreach ($liste as $datas) {
	    $entity = new \App\Entity\Artefact();
	    $entity->setNom($datas['nom']);
	    $entity->setDetails($datas['details']);
	    $entity->setTypeArtefact($datas['typeArtefact']);

	    $manager->persist($entity);
	    $entities[] = $entity;
	}
	return $entities;
    }

    private function loadDatasPlans(ObjectManager $manager, array $effets, array $artefacts): array {
	//  Le nom du fichier contenant les plans sous forme de tableaux PHP
	$file = dirname(__DIR__, 2) . '/tests/datasFixtures/plansFixture.php';

	$liste = [];

	//  Charger le fichier s'il existe
	if (file_exists($file)) {
	    $liste = include $file;
	}
	//  Instancier et persister les Plans
	foreach ($liste as $datas) {
	    $entity = new \App\Entity\Plan();
	    $entity->setReference($datas['reference']);
	    $entity->setDuree($datas['duree']);
	    $entity->setEchelle($datas['echelle']);
	    $entity->setDialogues($datas['dialogues']);
	    $entity->setEffet($datas['effet']);
	    foreach ($datas['artefacts'] as $value) {
		$entity->addArtefact($value);
	    }

	    $manager->persist($entity);
	    $entities[] = $entity;
	}
	return $entities;
    }

    public function load(ObjectManager $manager): void {
	$effets = $this->loadDatasEffets($manager);
	$typeArtefacts = $this->loadDatasTypesArtefacts($manager);
	$artefacts = $this->loadDatasArtefacts($manager, $typeArtefacts);
	$plans = $this->loadDatasPlans($manager, $effets, $artefacts);

	$manager->flush();
    }

}
