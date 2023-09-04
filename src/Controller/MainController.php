<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CalendarRepository $calendar): Response
    {
        $events = $calendar->findAll();
        //dd($events);
        foreach($events as $event){
            $rdv[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'backgroundcolor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->isAllDay()
            ];
        }

        $data = json_encode($rdv);
        return $this->render('main/index.html.twig', compact('data'));
    }
}
