<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class ChapterFourController
{
    /**
     * @Route("/chapter4/number")
     */
    public function numberAction()
    {
        $number = rand(0, 100);

        return new Response(
            '<html><body>Lucky number: ' . $number . '</body></html>'
        );
    }

    /**
     * @Route("/chapter4/number/{count}")
     */
    public function numberActionCount($count)
    {
        $numbers = array();

        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }

        $numbersList = implode(', ', $numbers);

        return new Response(
            '<html><body>Lucky numbers: '.$numbersList.'</body></html>'
        );
    }


    /**
     * @Route("/api/chapter4/number")
     */
    public function apiNumberAction()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
        );

        // calls json_encode() and sets the Content-Type header
        return new JsonResponse($data);
    }
	
   /**
	* Used by ChapterFive:forward
	*/
	public function forwardAction($name, $color)
	{
		return new Response('<p style="color:' .$color. ';">' .$name. '</p>');
	}
}
