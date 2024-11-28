<?php

namespace App\Tests\Controller;

use App\Entity\Missions;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class MissionsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/missions/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Missions::class);

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
        self::assertPageTitleContains('Mission index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'mission[NomMission]' => 'Testing',
            'mission[DescriptionMission]' => 'Testing',
            'mission[PouvoirsRequis]' => 'Testing',
            'mission[VillesMission]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Missions();
        $fixture->setNomMission('My Title');
        $fixture->setDescriptionMission('My Title');
        $fixture->setPouvoirsRequis('My Title');
        $fixture->setVillesMission('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Mission');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Missions();
        $fixture->setNomMission('Value');
        $fixture->setDescriptionMission('Value');
        $fixture->setPouvoirsRequis('Value');
        $fixture->setVillesMission('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'mission[NomMission]' => 'Something New',
            'mission[DescriptionMission]' => 'Something New',
            'mission[PouvoirsRequis]' => 'Something New',
            'mission[VillesMission]' => 'Something New',
        ]);

        self::assertResponseRedirects('/missions/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNomMission());
        self::assertSame('Something New', $fixture[0]->getDescriptionMission());
        self::assertSame('Something New', $fixture[0]->getPouvoirsRequis());
        self::assertSame('Something New', $fixture[0]->getVillesMission());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Missions();
        $fixture->setNomMission('Value');
        $fixture->setDescriptionMission('Value');
        $fixture->setPouvoirsRequis('Value');
        $fixture->setVillesMission('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/missions/');
        self::assertSame(0, $this->repository->count([]));
    }
}
