<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\Event;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

class GenusController extends Controller
{
  /**
  * @Route("/genus/{genusName}")
  */
  public function showAction($genusName)
  {
    $notes = [
            'Octopus asked me a riddle, outsmarted me',
            'I counted 8 legs... as they wrapped around me',
            'Inked!'
        ];

    return $this->render('genus/show.html.twig', array(
            'name' => $genusName,
            'notes' => $notes
        ));
  }

    /**
     * @Route("/genususers", name="view_users")
     */
    public function testAction()
    {
        /** @var EntityManager $em */
        $em = $this->get('doctrine.orm.entity_manager');

        //$users = $em->getRepository('UserBundle:User')->findBy(['age' => 10, 'firstname' => 'toto']);
        //$users = $em->getRepository('UserBundle:User')->findByAge(10);

        //$users = $em->getRepository('UserBundle:User')->findByFirstname('titi');

        $users = $em->getRepository('UserBundle:User')->findAll();

        return $this->render('genus/users.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * @Route("/adduser", name="add_user")
     * @Route("/updateuser/{id}", name="updateuser")
     */
    public function updateUserAction($id = null, Request $request)
    {
        $user = new User();
        $em = $this->get('doctrine.orm.entity_manager');

        if ($id) {
            $user = $em->getRepository('UserBundle:User')->find($id);
        }

        $form = $this->get('form.factory')->create(UserType::class, $user);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request); // hydratation et validation du formulaire suivant param post récupérés dans la request

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('view_users');
            }
        }

        return $this->render('genus/addusers.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/showEvents", name="show_events")
     */
    public function showEventsAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');

        $qb = $em->createQueryBuilder();

        $qb->select("e")
            ->from('UserBundle:Event','e')
            ->join('e.promoter','u')
            ->where('u.solde > :maxValue'); //ça peut aussi être une entité ou des arrays

        $qb->setParameter("maxValue", 50);

        /**
         * @var $events Event[]
         */
        $events = $qb->getQuery()->getResult();

        return $this->render('genus/events.html.twig', array(
            'events' => $events,
        ));
    }
}
