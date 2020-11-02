<?php
namespace App\Controller;

use App\Entity\HighScore;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use App\Service\HighScoreService;

class HighScoreController extends AbstractController
{
    /**
     * @Route("/", name="_highscores")
     * @Method({"GET"})
     */
    public function index()
    {
        $response = $this->response(
                200,
                'Back end up and running!'
        );

        return new JsonResponse($response);
    }

    /**
     * @Route("/get", name="_highscores_getscores")
     * @Method({"GET"})
     */
    public function GetScoresAction(HighScoreService $hs)
    {
        $em = $this->get('doctrine')->getManager();
        $scores = array();
        $scores = $em->getRepository(HighScore::class)->findAll();

        $highscores = array();
        foreach($scores as $s)
        {
            $s_data['nickname'] = $s->getNickname();
            $s_data['score'] = $s->getScore();
            $s_data['game'] = $s->getGame();
            array_push($highscores, $s_data);
            // $data = $s_data;
        }

        return new JsonResponse(array(
            'highscores' => $highscores
        ));
    }

    /**
     * @Route("/add", name="_highscores_add")
     * @Method({"POST"})
     */
    public function AddScoresAction(Request $req, HighScoreService $hs)
    {
        $nickname = $req->get('nickname');
        $score = $req->get('score');
        $game = $req->get('game');

        dump($nickname);
        dump($score);
        dump($game);

        $res = $hs->AddNewScore($nickname, $score, $game);

        return new JsonResponse($res);
    }

    /**
     * internal functions
     */
    public function response($code, $data) {
        return array(
            "code" => $code,
            "body" => $data,
        );
    }
}