<?php

namespace App\Tests\Controller;

use App\Entity\SuperHeros;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SuperHerosControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/super/heros/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(SuperHeros::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('SuperHero index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'super_hero[Nom]' => 'Testing',
            'super_hero[AlterEgo]' => 'Testing',
            'super_hero[Disponible]' => 'Testing',
            'super_hero[Energie]' => 'Testing',
            'super_hero[Biographie]' => 'Testing',
            'super_hero[ImageName]' => 'Testing',
            'super_hero[createdAt]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new SuperHeros();
        $fixture->setNom('My Title');
        $fixture->setAlterEgo('My Title');
        $fixture->setDisponible('My Title');
        $fixture->setEnergie('My Title');
        $fixture->setBiographie('My Title');
        $fixture->setImageName('My Title');
        $fixture->setCreatedAt('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('SuperHero');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new SuperHeros();
        $fixture->setNom('Value');
        $fixture->setAlterEgo('Value');
        $fixture->setDisponible('Value');
        $fixture->setEnergie('Value');
        $fixture->setBiographie('Value');
        $fixture->setImageName('Value');
        $fixture->setCreatedAt('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'super_hero[Nom]' => 'Something New',
            'super_hero[AlterEgo]' => 'Something New',
            'super_hero[Disponible]' => 'Something New',
            'super_hero[Energie]' => 'Something New',
            'super_hero[Biographie]' => 'Something New',
            'super_hero[ImageName]' => 'Something New',
            'super_hero[createdAt]' => 'Something New',
        ]);

        self::assertResponseRedirects('/super/heros/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getAlterEgo());
        self::assertSame('Something New', $fixture[0]->getDisponible());
        self::assertSame('Something New', $fixture[0]->getEnergie());
        self::assertSame('Something New', $fixture[0]->getBiographie());
        self::assertSame('Something New', $fixture[0]->getImageName());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new SuperHeros();
        $fixture->setNom('Value');
        $fixture->setAlterEgo('Value');
        $fixture->setDisponible('Value');
        $fixture->setEnergie('Value');
        $fixture->setBiographie('Value');
        $fixture->setImageName('Value');
        $fixture->setCreatedAt('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/super/heros/');
        self::assertSame(0, $this->repository->count([]));
    }
}
