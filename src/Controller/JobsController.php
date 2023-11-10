<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\JobApplication;
use App\Repository\JobApplicationRepository;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobsController extends AbstractController
{
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
}
