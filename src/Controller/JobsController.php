<?php

namespace App\Controller;

use App\Controller\Admin\JobApplicationCrudController;
use App\Entity\Job;
use App\Entity\JobApplication;
use App\Repository\JobApplicationRepository;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class JobsController extends AbstractController
{

    public function __construct(private HttpClientInterface $httpClient,
                                private AdminUrlGenerator   $urlGenerator)
    {
    }

    #[Route('/jobs', name: 'app_jobs')]
    public function index(JobRepository $jobRepository): Response
    {
        $jobs = $jobRepository->findAll();

        return $this->render('jobs/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    #[Route('/jobs/{job}', 'app_jobs_info')]
    public function info(Job $job, Request $request, EntityManagerInterface $entityManager): Response
    {

        $name = $request->request->get('name');
        $discordName = $request->request->get('discord_name');
        $email = $request->request->get('email');
        $age = $request->request->get('age');
        $strengths = $request->request->get('strengths');
        $weaknesses = $request->request->get('weaknesses');
        $onlineTime = $request->request->get('online_time');
        $minecraftExperience = $request->request->get('minecraft_experience');
        $origin = $request->request->get('origin');
        $about = $request->request->get('about');
        if ($name && $discordName && $email && $age && $strengths && $weaknesses
            && $onlineTime && $minecraftExperience && $origin && $about
            && $request->isMethod('POST')) {
            $jobApplication = new JobApplication();
            $jobApplication->setName($name);
            $jobApplication->setDiscordName($discordName);
            $jobApplication->setEmail($email);
            $jobApplication->setAge($age);
            $jobApplication->setStrengths($strengths);
            $jobApplication->setWeaknesses($weaknesses);
            $jobApplication->setOnlineTime($onlineTime);
            $jobApplication->setMinecraftExperience($minecraftExperience);
            $jobApplication->setOrigin($origin);
            $jobApplication->setAbout($about);
            $jobApplication->setJob($job);
            $jobApplication->setUpdatedAt(new \DateTimeImmutable());
            $jobApplication->setCreatedAt(new \DateTimeImmutable());
            $jobApplication->setRefId(uniqid());
            $entityManager->persist($jobApplication);
            $entityManager->flush();
            $this->createDiscordThread($jobApplication);
            return $this->redirectToRoute('app_jobs_success', [
                'job' => $job->getId(),
                'refId' => $jobApplication->getRefId()
            ]);
        }

        return $this->render('jobs/info.html.twig', [
            'job' => $job,
        ]);
    }

    #[Route('/jobs/{job}/success/{refId}', 'app_jobs_success')]
    public function success(Job $job, string $refId, JobApplicationRepository $applicationRepository): Response
    {
        $jobApplication = $applicationRepository->findOneBy([
            'job' => $job,
            'refId' => $refId
        ]);
        return $this->render('jobs/application-success.html.twig', [
            'job' => $job,
            'jobApplication' => $jobApplication
        ]);
    }

    public function createDiscordThread(JobApplication $jobApplication)
    {
        $url = $this->urlGenerator->setController(JobApplicationCrudController::class)->setAction('show')->setEntityId($jobApplication->getId())->generateUrl();
        $response = $this->httpClient->request(
            'POST',
            $_ENV["DISCORD_WEBHOOK_URL_JOBS"],
            [
                'json' => [
                    "thread_name" => $jobApplication->getName() . "'s Job Application for " . $jobApplication->getJob()->getName(),
                    "content" => "New job application",
                    "username" => "Job Announcer",
                    "tts" => "false",
                    "url" => $url,
                    "embeds" => [
                        [
                            "title" => $jobApplication->getName() . "'s Job Application for " . $jobApplication->getJob()->getName(),
                            "description" => "New job application",
                            "color" => hexdec("FF0000"),
                            "fields" => [
                                [
                                    "name" => "ID",
                                    "value" => $jobApplication->getId(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Name",
                                    "value" => $jobApplication->getName(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Discord name",
                                    "value" => $jobApplication->getDiscordName(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Email",
                                    "value" => $jobApplication->getEmail(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Age",
                                    "value" => $jobApplication->getAge(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Strengths",
                                    "value" => $jobApplication->getStrengths(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Weaknesses",
                                    "value" => $jobApplication->getWeaknesses(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Online time",
                                    "value" => $jobApplication->getOnlineTime(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Minecraft experience",
                                    "value" => $jobApplication->getMinecraftExperience(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Where did you find us?",
                                    "value" => $jobApplication->getOrigin(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "About",
                                    "value" => $jobApplication->getAbout(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Ref ID",
                                    "value" => $jobApplication->getRefId(),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Job",
                                    "value" => $jobApplication->getJob()->getName(),
                                    "inline" => false
                                ],
                            ],
                            "footer" => [
                                "text" => "Job Announcer"
                            ],
                            "timestamp" => date("Y-m-d\TH:i:s.v\Z")
                        ]
                    ],
                ]
            ]
        );
    }
}
