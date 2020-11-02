<?php
namespace App\Service;

use App\Entity\HighScore;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

class HighScoreService {

    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function AddNewScore($n, $s, $g)
    {
        $hs = new HighScore();

        try {
            $hs->setNickname($n);
            $hs->setScore($s);
            $hs->setGame($g);
            $hs->setCreatedAt(new DateTime('now'));
            $this->em->persist($hs);
            $this->em->flush();

            $data['code'] = 200;
            $data['body']  = 'new score saved';

        } catch (Exception $e) {
            $data['code'] = 500;
            $data['body']  = "Ooopsies :" + $e;
        }

        return $data;
    }
}