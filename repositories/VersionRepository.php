<?php


namespace OpenEMR\Repositories;

use Doctrine\ORM\EntityRepository;
use OpenEMR\Entities\Version;

class VersionRepository extends EntityRepository
{
    /**
     * Updates the sole version entry in the database. The version
     * table doesn't use unique keys, so a special merger function
     * is used to ensure Doctrine doesn't insert a new entry and
     * only updates the original one.
     *
     * @param $version the new version entry.
     * @return true/false for if the update went through.
     */
    public function update(Version $version)
    {
        $response = false;

        try {
            $objectToBeUpdated = $this->updateNonKeyedEntityObject($this->findFirst(), $version);
            $updateInformation = $this->_em->persist($objectToBeUpdated);
            $this->_em->flush();
            $response = true;
        } catch (Exception $e) {
        }

        return $response;
    }

    /**
     * Finds the sole version entry in the database.
     *
     * @return version.
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
     * Uses MySQL-specific check to see if the version table exists.
     *
     * @return bool
     */
    public function doesTableExist()
    {
        $query = $this->_em->getConnection()->prepare("SHOW TABLES LIKE 'version'");
        $query->execute();
        $results = $query->fetch();

        return !empty($results);
    }

    /**
     * Special merger function to ensure Doctrine doesn't insert a new entry and
     * only updates the original one.
     *
     * @param $objectToBeUpdated the current entry in the table that needs to be updated.
     * @param $newObject the new value object.
     * @return the updated version ready to override the current version entry in the table.
     */
    private function updateNonKeyedEntityObject(Version $objectToBeUpdated, Version $newObject)
    {
        if (!empty($objectToBeUpdated)) {
            $objectToBeUpdated->setAcl($newObject->getAcl());
            $objectToBeUpdated->setDatabase($newObject->getDatabase());
            $objectToBeUpdated->setTag($newObject->getTag());
            $objectToBeUpdated->setRealPatch($newObject->getRealPatch());
            $objectToBeUpdated->setPatch($newObject->getPatch());
            $objectToBeUpdated->setMinor($newObject->getMinor());
            $objectToBeUpdated->setMajor($newObject->getMajor());

            return $objectToBeUpdated;
        }

        return null;
    }
}
