<?php


namespace OpenEMR\Repositories;

use OpenEMR\Entities\ChartTracker;
use Doctrine\ORM\EntityRepository;

class ChartTrackerRepository extends EntityRepository
{

    /**
     * Add chart tracker table entry.
     *
     * @param $tracker chart tracker information.
     * @return the pid.
     */
    public function save(ChartTracker $chartTracker)
    {
        $this->_em->persist($chartTracker);
        $this->_em->flush();
        return $chartTracker->getPid();
    }
}
