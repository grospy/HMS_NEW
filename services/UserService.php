<?php


namespace OpenEMR\Services;

use OpenEMR\Common\Database\Connector;

class UserService
{
    /**
     * The user repository to be used for db CRUD operations.
     */
    private $repository;

    /**
     * Default constructor.
     */
    public function __construct()
    {
        $database = Connector::Instance();
        $entityManager = $database->entityManager;
        $this->repository = $entityManager->getRepository('\OpenEMR\Entities\User');
    }

    /**
     * @return Fully hydrated user object
     */
    public function getUser($userId)
    {
        return $this->repository->getUser($userId);
    }

    /**
     * @return active users (fully hydrated)
     */
    public function getActiveUsers()
    {
        return $this->repository->getActiveUsers();
    }

    /**
     * @return Fully hydrated user object.
     */
    public function getCurrentlyLoggedInUser()
    {
        return $this->repository->getCurrentlyLoggedInUser();
    }

    /**
     * Centralized holder of the `authProvider` session
     * value to encourage service ownership of global
     * session values.
     *
     * @return String of the current user group.
     */
    public function getCurrentlyLoggedInUserGroup()
    {
        return $_SESSION['authProvider'];
    }
}
