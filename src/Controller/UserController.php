<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\UserType;
use App\Form\UserType2;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Service\TwilioService;

//

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Label\Font\NotoSans;
//


#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
public function index(UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager,SessionInterface $session): Response
{   
    if($session->get('user') !== null)
    $users = $userRepository->findAll();
    $forms = [];
$session = $request->getSession();

    foreach ($users as $user) {
       
        $form = $this->createForm(UserType2::class, $user, [
            'action' => $this->generateUrl('app_user_edit', ['id' => $user->getId()]),
            'method' => 'POST',
        ]);

        // Check if the form is submitted and valid outside of the loop
        // This will execute after the form submission
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();
          
    
            $this->addFlash('success', 'User updated successfully!');
        }

        // Store the form view in the forms array using the user's ID as the key
        $forms[$user->getId()] = $form->createView();
    }

    //

    //
    

    return $this->render('user/index.html.twig', [
        'users' => $users,
        'forms' => $forms,
    ]);
}
#[Route('/login', name: 'app_login')]
public function login(): Response
{
   
    return $this->render('user/login.html.twig', [
        'controller_name' => 'UserController',
    ]);
}

#[Route('/qr/{id}', name: 'app_qr_check')]
public function loginqr(UserRepository $userRepository,Request $request, EntityManagerInterface $entityManager,$id): Response
{
  
   
    $user = $userRepository->find($id);
  
    if ($user) {
       
            $session = $request->getSession();
            $session->set('email',$user->getemail());
            $session->set('user', $user);
            $session->set('nom', $user->getNom());
            $session->set('prenom', $user->getPrenom());
            $session->set('id', $user->getId());
            $session->set('role', $user->getRole());
            return $this->redirectToRoute('app_user_show',['id'=>$id]);
      
    } else {
        return $this->redirectToRoute('app_login');
    }

}
    #[Route('/logincheck', name: 'app_login_check')]
    public function logincheck(UserRepository $userRepository,Request $request, EntityManagerInterface $entityManager,TwilioService $twilioService): Response
    {
        $twilioService->sendVoiceOTP("+21655686370");
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $user = $userRepository->findOneBy(['email' => $email]);
        if ($user) {
            if (password_verify($password,$user->getPassword())) {
                $session = $request->getSession();
                $session->set('email', $email);
                $session->set('user', $user);
                $session->set('nom', $user->getNom());
                $session->set('prenom', $user->getPrenom());
                $session->set('id', $user->getId());
                $session->set('role', $user->getRole());
                return $this->redirectToRoute('app_user_index');
            } else {
                return $this->redirectToRoute('app_login');
            } 
        } else {
            return $this->redirectToRoute('app_login');
        }

    }


    #[Route('/logout', name: 'app_logout')]
    public function logout(UserRepository $userRepository,Request $request, EntityManagerInterface $entityManager): Response
    {
       
                $session = $request->getSession();
                $session->clear();
              
            return $this->redirectToRoute('app_login');
        

    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tempFilePath = $form['photo']->getData();
            $destinationPath = "uploads/" .$user->getNom()."-".$user->getPrenom()."-".$user->getCin().".png";
            $compressionQuality = 100;

            //$this->compressImage($tempFilePath, $destinationPath, $compressionQuality);
                $user->setPhoto($destinationPath);
                $passwordhash=password_hash($user->getPassword(),PASSWORD_DEFAULT);
                $user->setPassword($passwordhash);  
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(int $id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
    
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }
    $url="172.20.10.7".":8000"."/user/qr/".$id;
        $qrCode = QrCode::create($url)
            ->setEncoding(new Encoding('UTF-8'))
            ->setSize(120)
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
    
        $label = Label::create('')->setFont(new NotoSans(8));
    
        $writer = new PngWriter(); // Instantiate the PngWriter class
    
        $qrCodes = [];
    
        $qrCode->setForegroundColor(new Color(0, 56, 131));
        $qrCodes['changeColor'] = $writer->write(
            $qrCode,
            null,
            $label->setText('')
        )->getDataUri();
    
        $qrCode->setSize(200)->setForegroundColor(new Color(0, 0, 0))->setBackgroundColor(new Color(255, 255, 255));
        $qrCodes['withImage'] = $writer->write(
            $qrCode,
            null, // Removed logo
            $label->setText('With Image')->setFont(new NotoSans(20))
        )->getDataUri();
    
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'qrCodes' => $qrCodes,
        ]);
    }
    
    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }
    
        $form = $this->createForm(UserType2::class, $user);
        $form->handleRequest($request);
        $session = $request->getSession();
    
        if ($form->isSubmitted() ) {
            $entityManager->flush();
            
            if ($user->getId() == $session->get('user')->getId()) {
                $session->set('user', $user);
            }
    
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
    

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, int $id, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
    
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }
    
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
    

    private  function compressImage($source, $destination, $quality) {
        $info = getimagesize($source);
        
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } else {
            return false;
        }    // Sauvegarder l'image compressée
           imagejpeg($image, $destination, $quality);
           
           // Libérer la mémoire
           imagedestroy($image);
           
           return true;
       }
}
