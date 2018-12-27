<?php


namespace OpenEMR\Repositories;

use OpenEMR\Entities\ProductRegistration;
use Doctrine\ORM\EntityRepository;

class ProductRegistrationRepository extends EntityRepository
{
    /**
     * Finds the sole product registration entry in the database.
     *
     * @return product registration entry.
     */
    public function findFirst()
    {
        $results = $this->_em->getRepository($this->_entityName)->findAll();
        if (!empty($results)) {
            return $results[0];
        }

        return null;
    }

    /**
     * Add product registration entry.
     *
     * @param $registration registration information.
     * @return the id.
     */
    public function save(ProductRegistration $entry)
    {
        $this->_em->persist($entry);
        $this->_em->flush();
        return $entry->getRegistrationId();
    }
}
