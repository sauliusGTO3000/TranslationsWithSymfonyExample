<?php

namespace App\Controller;

use App\Entity\Translations;
use App\Form\TranslationsType;
use App\Repository\TranslationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;


/**
 * @Route("/translations")
 */
class TranslationsController extends Controller
{
    /**
     * @Route("/", name="translations_index", methods="GET")
     */
    public function index(TranslationsRepository $translationsRepository, TranslatorInterface $translator): Response
    {

        $translated = $translator->trans('Hello world, I can speak English!');
//        echo $translated;
        return $this->render('translations/index.html.twig', ['translations' => $translationsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="translations_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $translation = new Translations();
        $form = $this->createForm(TranslationsType::class, $translation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($translation);
            $em->flush();

            return $this->redirectToRoute('translations_index');
        }

        return $this->render('translations/new.html.twig', [
            'translation' => $translation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="translations_show", methods="GET")
     */
    public function show(Translations $translation): Response
    {
        return $this->render('translations/show.html.twig', ['translation' => $translation]);
    }

    /**
     * @Route("/{id}/edit", name="translations_edit", methods="GET|POST")
     */
    public function edit(Request $request, Translations $translation): Response
    {
        $form = $this->createForm(TranslationsType::class, $translation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('translations_edit', ['id' => $translation->getId()]);
        }

        return $this->render('translations/edit.html.twig', [
            'translation' => $translation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="translations_delete", methods="DELETE")
     */
    public function delete(Request $request, Translations $translation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$translation->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($translation);
            $em->flush();
        }

        return $this->redirectToRoute('translations_index');
    }
}
