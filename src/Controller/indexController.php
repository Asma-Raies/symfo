

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class indexController extends AbstractController{
 
 public function home()
 {
 
    $articles = ['Artcile1', 'Article 2','Article 3' ];
return $this->render('articles/index.html.twig',['articles' => $articles]);
 }

 public function new(Request $request) {
 $article = new Article();
 $form = $this->createFormBuilder($article)
 ->add('titre', TextType::class)
 ->add('contenu', TextType::class)
 ->add('date', DateType::class)
 ->add('save', SubmitType::class, array(
    'label' => 'Créer')
 )->getForm();
 
 
 $form->handleRequest($request);
 
 if($form->isSubmitted() && $form->isValid()) {
 $article = $form->getData();
 
 $entityManager = $this->getDoctrine()->getManager();
 $entityManager->persist($article);
 $entityManager->flush();
 
 return $this->redirectToRoute('article_list');
 }
 return $this->render('articles/new.html.twig',['form' => $form-
>createView()]);
 }
}

